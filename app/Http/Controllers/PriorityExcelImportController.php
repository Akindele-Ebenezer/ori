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
        if ($request->hasFile('PriorityAttachment')) {
            VesselAvailability::where('Source', 'PRIORITY')
                ->whereNull('Status')
                ->delete();

            $attachmentPath = $request->file('PriorityAttachment')->store('files', 'public');
            Excel::import(
                new PriorityImportClass,
                storage_path('app/public/' . $attachmentPath)
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
        $request->validate([
            'Vessel' => ['required', 'string', 'max:255'],
            'Status' => ['required', 'string', 'max:255'],
            'DoneBy' => ['required', 'string', 'max:255'],
            'Attachment' => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx,csv,jpg,jpeg,png', 'max:10240'],
            'Report' => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx,csv,jpg,jpeg,png', 'max:10240'],
            'Picture' => ['nullable', 'file', 'mimes:jpg,jpeg,png,gif,webp', 'max:10240'],
            'StartTime' => ['required', 'string'],
            'EndTime' => ['required', 'string'],
            'StartDate' => ['required', 'date'],
            'EndDate' => ['required', 'date'],
        ]);
        \DB::transaction(function () use ($request) {

            $fileNameReport = '';
            $fileNamePicture = '';
            $attachmentName = '';

            if ($request->hasFile('Attachment')) {
                $attachmentName = $request->file('Attachment')->store('vessel-attachments', 'public');
            }

            // ---- Report Upload
            if ($request->hasFile('Report')) {
                $reportFile = $request->file('Report');
                $fileNameReport = time() . '_' . $reportFile->getClientOriginalName();
                $reportDirectory = public_path('Documents/Reports/Vessels/' . $request->Vessel);
                if (!is_dir($reportDirectory)) {
                    mkdir($reportDirectory, 0755, true);
                }
                $reportFile->move(
                    $reportDirectory,
                    $fileNameReport
                );
            }
            if ($request->hasFile('Picture')) {
                $pictureFile = $request->file('Picture');
                $fileNamePicture = time() . '_' . $pictureFile->getClientOriginalName();
                $pictureDirectory = public_path('Documents/Pictures/Vessels/' . $request->Vessel);
                if (!is_dir($pictureDirectory)) {
                    mkdir($pictureDirectory, 0755, true);
                }
                $pictureFile->move(
                    $pictureDirectory,
                    $fileNamePicture
                );
            }
            $startTime = substr($request->StartTime, 0, 5);
            $endTime   = substr($request->EndTime, 0, 5);
            $currentRow = VesselAvailability::create([
                'Vessel'     => $request->Vessel,
                'Status'     => $request->Status,
                'DoneBy'     => $request->DoneBy,
                'Attachment' => $attachmentName,
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
