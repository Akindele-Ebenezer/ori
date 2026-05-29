<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VesselAvailability;
use App\Imports\PriorityImportClass; 
use Maatwebsite\Excel\Writer; 
use Maatwebsite\Excel\Facades\Excel;

class PriorityExcelImportController extends Controller
{
    public function import(Request $request)
    { 
        if ($request->hasFile('Attachment')) {
            VesselAvailability::where('Source', 'PRIORITY')
                ->whereNull('Status')
                ->delete();

            Excel::import(
                new PriorityImportClass,
                $request->file('Attachment')->store('files')
            );
            \DB::table('notifications')->insert([
                'DateIn' => now()->format('Y-m-d'),
                'TimeIn' => now()->format('H:i A'),
                'Vessel' => 'Vessels',
                'Action' => 'Create',
                'Subject' => 'New Availability Alert!',
                'Notification' => session()->get('FullName') . ' uploaded data from PRIORITY.',
            ]);
            return redirect()->back();
        } 
        \DB::transaction(function () use ($request) {

            $fileNameReport = '';
            $fileNamePicture = '';

            // ---- Report Upload
            if ($request->hasFile('Report')) {
                $reportFile = $request->file('Report');
                $fileNameReport = time() . '_' . $reportFile->getClientOriginalName();
                $reportFile->move(
                    public_path('Documents/Reports/Vessels/' . $request->Vessel),
                    $fileNameReport
                );
            }
            if ($request->hasFile('Picture')) {
                $pictureFile = $request->file('Picture');
                $fileNamePicture = time() . '_' . $pictureFile->getClientOriginalName();
                $pictureFile->move(
                    public_path('Documents/Pictures/Vessels/' . $request->Vessel),
                    $fileNamePicture
                );
            }
            $startTime = substr($request->StartTime, 0, 5);
            $endTime   = substr($request->EndTime, 0, 5);
            $currentRow = VesselAvailability::create([
                'Vessel'     => $request->Vessel,
                'Status'     => $request->Status,
                'DoneBy'     => $request->DoneBy,
                'Report'     => $fileNameReport,
                'Picture'    => $fileNamePicture,
                'Comment'    => $request->Comment,
                'Location'   => $request->Location,
                'Source'     => 'SEA_SERVICE',
                'StartTime'  => $startTime,
                'EndTime'    => $endTime,
                'StartDate'  => $request->StartDate,
                'EndDate'    => $request->EndDate,
                'TillNow'    => $request->TillNow,
                'DateIn'     => now()->format('Y-m-d'),
                'TimeIn'     => now()->format('H:i A'),
            ]);
            \DB::table('notifications')->insert([
                'DateIn' => now()->format('Y-m-d'),
                'TimeIn' => now()->format('H:i A'),
                'UserId' => session()->get('USER_ID'),
                'Vessel' => $request->Vessel,
                'Action' => 'Create',
                'Subject' => 'New Availability Alert!',
                'Notification' =>
                    $request->DoneBy . ' created availability for ' .
                    $request->Vessel . "'s tracking list. The Vessel is on " .
                    $request->Status . ' from ' .
                    date('H:i A', strtotime($startTime)) .
                    ' to ' .
                    date('H:i A', strtotime($endTime)) .
                    ' (' . $request->StartDate . ' - ' . $request->EndDate . ').',
            ]);
            $previousRow = VesselAvailability::where('Vessel', $request->Vessel)
                ->where('StartDate', '<=', $request->StartDate)
                ->where(function ($query) use ($request, $startTime) {
                    $query->where('StartDate', '<', $request->StartDate)
                        ->orWhere('StartTime', '<', $startTime);
                })
                ->orderBy('StartDate', 'desc')
                ->orderBy('StartTime', 'desc')
                ->first();

            $nextRow = VesselAvailability::where('Vessel', $request->Vessel)
                ->where('StartDate', '>=', $request->EndDate)
                ->where(function ($query) use ($request, $endTime) {
                    $query->where('StartDate', '>', $request->EndDate)
                        ->orWhere('StartTime', '>', $endTime);
                })
                ->orderBy('StartDate', 'asc')
                ->orderBy('StartTime', 'asc')
                ->first();
            if ($previousRow) {
                VesselAvailability::where('id', $previousRow->id)->update([
                    'EndTime' => $startTime,
                    'EndDate' => $request->StartDate,
                    'TillNow' => 'NO',
                ]);
            }
            if ($nextRow) {
                VesselAvailability::where('id', $nextRow->id)->update([
                    'StartTime' => $endTime,
                    'StartDate' => $request->EndDate,
                    'TillNow'   => 'NO',
                ]);
            }
            VesselAvailability::where('id', '<', $currentRow->id)
                ->where('Vessel', $request->Vessel)
                ->update(['TillNow' => 'NO']);
            if ($currentRow->StartDate < now()->format('Y-m-d')) {
                \DB::table('notifications')->insert([
                    'DateIn' => now()->format('Y-m-d'),
                    'TimeIn' => now()->format('H:i A'),
                    'Vessel' => $request->Vessel,
                    'Action' => 'Delete',
                    'Subject' => 'User Creation Alert!',
                    'Notification' =>
                        session()->get('FullName') .
                        ' created availability that is not today! Vessel Availability ID: ' .
                        $currentRow->id .
                        ', Start Date: ' . $request->StartDate .
                        ', Start Time: ' . $request->StartTime .
                        ', End Date: ' . $request->EndDate .
                        ', End Time: ' . $request->EndTime,
                ]);
            } 
        });

        return redirect()->route('Availability');
    }
}
