<?php

namespace App\Http\Controllers;

use App\Models\VesselAvailability;
use Illuminate\Http\Request;
use App\Models\Employee; 

class VesselAvailabilityController extends Controller
{
   
    public function api()
    {
        $VesselAvailability = VesselAvailability::orderBy('StartDate', 'DESC')->where('TillNow', 'YES')->orderBy('StartTime', 'DESC')->orderBy('EndDate', 'DESC')->orderBy('EndTime', 'DESC')->get(); 
        return response()->json($VesselAvailability);
    }

    public function index(Request $Request)
    {  
        VesselAvailability::where('TillNow', 'YES')->update([
            'EndTime' => date('H:i'),
            'EndDate' => date('Y-m-d'),
        ]);
        \DB::table('generator_availability')->where('TillNow', 'YES')->update([
            'EndTime' => date('H:i'),
            'EndDate' => date('Y-m-d'),
        ]);
 
        $Employees = Employee::orderBy('EmployeeId', 'DESC')->get();
        $Vessels = \DB::table('vessels_vessel_information')->get();
        $Ranks = \DB::table('ranks')->get();
        $Companies = \DB::table('companies')->orderBy('id', 'DESC')->get();
        $VesselAvailability = VesselAvailability::orderBy('StartDate', 'DESC')->orderBy('StartTime', 'DESC')->orderBy('EndDate', 'DESC')->orderBy('EndTime', 'DESC')->paginate(20); 
        $Vessels = \DB::table('vessels_vessel_information')->select(['VesselName', 'ImoNumber', 'CallSign'])->get();
        $STARTDATE = date('Y-m-d'); 
        $NumberOfVessels = \DB::table('vessels_vessel_information')->get();
        $NumberOfVessels_IDLE = VesselAvailability::select('Vessel')->where('Status', 'IDLE')
                                ->where(function($query) {
                                    $query->where('StartDate', '>=', date('Y-m-d'))
                                            ->orWhere('EndDate', '>=', date('Y-m-d'));
                                }) 
                                ->groupBy('Vessel')->get(); 
        
        $NumberOfVessels_BUNKERY = VesselAvailability::select('Vessel')->where('Status', 'BUNKERY')->where('EndDate', '>=', date('Y-m-d')) 
                                ->orWhere(function($query) {
                                    $query->where('Status', 'BUNKERY') 
                                            ->where('TillNow', 'YES');
                                })->groupBy('Vessel')->get();
        $NumberOfVessels_INSPECTION = VesselAvailability::select('Vessel')->where('Status', 'INSPECTION')->where('EndDate', '>=', date('Y-m-d')) 
                                ->orWhere(function($query) {
                                    $query->where('Status', 'INSPECTION') 
                                            ->where('TillNow', 'YES');
                                })->groupBy('Vessel')->get();
        $NumberOfVessels_MAINTENANCE = VesselAvailability::select('Vessel')->where('Status', 'MAINTENANCE')->where('EndDate', '>=', date('Y-m-d')) 
                                ->orWhere(function($query) {
                                    $query->where('Status', 'MAINTENANCE') 
                                            ->where('TillNow', 'YES');
                                })->groupBy('Vessel')->get();
        $NumberOfVessels_OPERATION = VesselAvailability::select('Vessel')->where('Status', 'OPERATION')->where('EndDate', '>=', date('Y-m-d')) 
                                ->orWhere(function($query) {
                                    $query->where('Status', 'OPERATION') 
                                            ->where('TillNow', 'YES');
                                })->groupBy('Vessel')->get();
        $NumberOfVessels_BREAKDOWN = VesselAvailability::select('Vessel')->where('Status', 'BREAKDOWN')->where('EndDate', '>=', date('Y-m-d')) 
                                ->orWhere(function($query) {
                                    $query->where('Status', 'BREAKDOWN') 
                                            ->where('TillNow', 'YES');
                                })->groupBy('Vessel')->get();
        $NumberOfVessels_DOCKING = VesselAvailability::select('Vessel')->where('Status', 'DOCKING')->where('EndDate', '>=', date('Y-m-d')) 
                                ->orWhere(function($query) {
                                    $query->where('Status', 'DOCKING') 
                                            ->where('TillNow', 'YES');
                                })->groupBy('Vessel')->get(); 
         
        
        if ((isset($Request->VesselStatus))) {
            $VesselAvailability = VesselAvailability::where('Vessel', $Request->Vessel)->where('Status', $Request->Status)->orderBy('StartDate', 'DESC')->orderBy('StartTime', 'DESC')->orderBy('EndTime', 'DESC')->paginate(20); 
        }
        
        if (isset($Request->SpecificDay)) {
            $VesselAvailability = VesselAvailability::where('Vessel', $Request->Vessel_FILTER)->where('StartDate', $Request->SpecificDay)->orderBy('StartDate', 'DESC')->orderBy('StartTime', 'DESC')->orderBy('EndTime', 'DESC')->paginate(20); 
        }

        if (isset($Request->FromDate_FILTERBYDATE) AND isset($Request->EndDate_FILTERBYDATE)) {
            $STARTDATE = $Request->FromDate_FILTERBYDATE;
            $ENDDATE = $Request->EndDate_FILTERBYDATE;

            $NumberOfVessels_IDLE = VesselAvailability::select('Vessel')->where('Status', 'IDLE')->whereBetween('StartDate', [$STARTDATE, $ENDDATE])->groupBy('Vessel')->get();
            $NumberOfVessels_BUNKERY = VesselAvailability::select('Vessel')->where('Status', 'BUNKERY')->whereBetween('StartDate', [$STARTDATE, $ENDDATE])->groupBy('Vessel')->get();
            $NumberOfVessels_INSPECTION = VesselAvailability::select('Vessel')->where('Status', 'INSPECTION')->whereBetween('StartDate', [$STARTDATE, $ENDDATE])->groupBy('Vessel')->get();
            $NumberOfVessels_MAINTENANCE = VesselAvailability::select('Vessel')->where('Status', 'MAINTENANCE')->whereBetween('StartDate', [$STARTDATE, $ENDDATE])->groupBy('Vessel')->get();
            $NumberOfVessels_OPERATION = VesselAvailability::select('Vessel')->where('Status', 'OPERATION')->whereBetween('StartDate', [$STARTDATE, $ENDDATE])->groupBy('Vessel')->get();
            $NumberOfVessels_BREAKDOWN = VesselAvailability::select('Vessel')->where('Status', 'BREAKDOWN')->whereBetween('StartDate', [$STARTDATE, $ENDDATE])->groupBy('Vessel')->get();
            $NumberOfVessels_DOCKING = VesselAvailability::select('Vessel')->where('Status', 'DOCKING')->whereBetween('StartDate', [$STARTDATE, $ENDDATE])->groupBy('Vessel')->get();
            $VesselAvailability = VesselAvailability::whereBetween('EndDate', [$STARTDATE, $ENDDATE])->orderBy('StartDate', 'DESC')->orderBy('StartTime', 'DESC')->orderBy('EndTime', 'DESC')->paginate(20); 
            
            if (isset($Request->Vessel_FILTER)) { 
                $NumberOfVessels_IDLE = VesselAvailability::select('Vessel')->where('Vessel', $Request->Vessel_FILTER)->where('Status', 'IDLE')->whereBetween('StartDate', [$STARTDATE, $ENDDATE])->groupBy('Vessel')->get();
                $NumberOfVessels_BUNKERY = VesselAvailability::select('Vessel')->where('Vessel', $Request->Vessel_FILTER)->where('Status', 'BUNKERY')->whereBetween('StartDate', [$STARTDATE, $ENDDATE])->groupBy('Vessel')->get();
                $NumberOfVessels_INSPECTION = VesselAvailability::select('Vessel')->where('Vessel', $Request->Vessel_FILTER)->where('Status', 'INSPECTION')->whereBetween('StartDate', [$STARTDATE, $ENDDATE])->groupBy('Vessel')->get();
                $NumberOfVessels_MAINTENANCE = VesselAvailability::select('Vessel')->where('Vessel', $Request->Vessel_FILTER)->where('Status', 'MAINTENANCE')->whereBetween('StartDate', [$STARTDATE, $ENDDATE])->groupBy('Vessel')->get();
                $NumberOfVessels_OPERATION = VesselAvailability::select('Vessel')->where('Vessel', $Request->Vessel_FILTER)->where('Status', 'OPERATION')->whereBetween('StartDate', [$STARTDATE, $ENDDATE])->groupBy('Vessel')->get();
                $NumberOfVessels_BREAKDOWN = VesselAvailability::select('Vessel')->where('Vessel', $Request->Vessel_FILTER)->where('Status', 'BREAKDOWN')->whereBetween('StartDate', [$STARTDATE, $ENDDATE])->groupBy('Vessel')->get();
                $NumberOfVessels_DOCKING = VesselAvailability::select('Vessel')->where('Vessel', $Request->Vessel_FILTER)->where('Status', 'DOCKING')->whereBetween('StartDate', [$STARTDATE, $ENDDATE])->groupBy('Vessel')->get();
                $VesselAvailability = VesselAvailability::where('Vessel', $Request->Vessel_FILTER)->whereBetween('EndDate', [$STARTDATE, $ENDDATE])->orderBy('StartDate', 'DESC')->orderBy('StartTime', 'DESC')->orderBy('EndTime', 'DESC')->paginate(20); 
            }
            
            return view('Pages.Availability', [ 
                'Employees' => $Employees,
                'Vessels' => $Vessels,
                'Ranks' => $Ranks,
                'Companies' => $Companies,
                'VesselAvailability' => $VesselAvailability,
                'Vessels' => $Vessels,
                'NumberOfVessels' => count($NumberOfVessels),
                'STARTDATE' => $STARTDATE,
                'NumberOfVessels_IDLE' => count($NumberOfVessels_IDLE),
                'NumberOfVessels_BUNKERY' => count($NumberOfVessels_BUNKERY),
                'NumberOfVessels_INSPECTION' => count($NumberOfVessels_INSPECTION),
                'NumberOfVessels_MAINTENANCE' => count($NumberOfVessels_MAINTENANCE),
                'NumberOfVessels_OPERATION' => count($NumberOfVessels_OPERATION),
                'NumberOfVessels_BREAKDOWN' => count($NumberOfVessels_BREAKDOWN),
                'NumberOfVessels_DOCKING' => count($NumberOfVessels_DOCKING),
            ]);
        } 

        if(isset($Request->FilterValue)) {
            $VesselAvailability = VesselAvailability::where('Vessel', 'LIKE', '%' . $Request->FilterValue . '%')
                                    ->orWhere('Status', 'LIKE', '%' . $Request->FilterValue . '%')
                                    ->orWhere('DoneBy', 'LIKE', '%' . $Request->FilterValue . '%')
                                    ->orWhere('Comment', 'LIKE', '%' . $Request->FilterValue . '%')
                                    ->orWhere('Location', 'LIKE', '%' . $Request->FilterValue . '%')
                                    ->orWhere('StartTime', 'LIKE', '%' . $Request->FilterValue . '%')
                                    ->orWhere('EndTime', 'LIKE', '%' . $Request->FilterValue . '%')
                                    ->orWhere('StartDate', 'LIKE', '%' . $Request->FilterValue . '%')
                                    ->orWhere('EndDate', 'LIKE', '%' . $Request->FilterValue . '%')
                                    ->orWhere('TillNow', 'LIKE', '%' . $Request->FilterValue . '%')
                                    ->orderBy('StartDate', 'DESC')->orderBy('StartTime', 'DESC')->orderBy('EndTime', 'DESC') 
                                    ->paginate(14);
            $Vessels = \DB::table('vessels_vessel_information')
                                    ->select(['VesselName', 'ImoNumber', 'CallSign'])
                                    ->where('VesselName', 'LIKE', '%' . $Request->FilterValue . '%')
                                    ->orWhere('ImoNumber', 'LIKE', '%' . $Request->FilterValue . '%')
                                    ->orWhere('CallSign', 'LIKE', '%' . $Request->FilterValue . '%')
                                    ->get(); 
                                    
                if ($Request->FilterValue == 'Ready') {
                    $VesselAvailability = VesselAvailability::where('Status', 'IDLE')->orderBy('StartDate', 'DESC')->orderBy('StartTime', 'DESC')->orderBy('EndTime', 'DESC')->paginate(20);  
                }
            return view('Pages.Availability', [ 
                'Employees' => $Employees,
                'Vessels' => $Vessels,
                'Ranks' => $Ranks,
                'Companies' => $Companies,
                'VesselAvailability' => $VesselAvailability,
                'Vessels' => $Vessels,
                'NumberOfVessels' => count($NumberOfVessels),
                'STARTDATE' => $STARTDATE,
                'StartDate' => $STARTDATE,
                'NumberOfVessels_IDLE' => count($NumberOfVessels_IDLE),
                'NumberOfVessels_BUNKERY' => count($NumberOfVessels_BUNKERY),
                'NumberOfVessels_INSPECTION' => count($NumberOfVessels_INSPECTION),
                'NumberOfVessels_MAINTENANCE' => count($NumberOfVessels_MAINTENANCE),
                'NumberOfVessels_OPERATION' => count($NumberOfVessels_OPERATION),
                'NumberOfVessels_BREAKDOWN' => count($NumberOfVessels_BREAKDOWN),
                'NumberOfVessels_DOCKING' => count($NumberOfVessels_DOCKING),
            ]);
        }

        return view('Pages.Availability', [
            'Employees' => $Employees,
            'Vessels' => $Vessels,
            'Ranks' => $Ranks,
            'Companies' => $Companies,
            'VesselAvailability' => $VesselAvailability,
            'Vessels' => $Vessels,
            'NumberOfVessels' => count($NumberOfVessels),
            'STARTDATE' => $STARTDATE,
            'NumberOfVessels_IDLE' => count($NumberOfVessels_IDLE),
            'NumberOfVessels_BUNKERY' => count($NumberOfVessels_BUNKERY),
            'NumberOfVessels_INSPECTION' => count($NumberOfVessels_INSPECTION),
            'NumberOfVessels_MAINTENANCE' => count($NumberOfVessels_MAINTENANCE),
            'NumberOfVessels_OPERATION' => count($NumberOfVessels_OPERATION),
            'NumberOfVessels_BREAKDOWN' => count($NumberOfVessels_BREAKDOWN),
            'NumberOfVessels_DOCKING' => count($NumberOfVessels_DOCKING),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $Request)
    { 

    }

    /**
     * Display the specified resource.
     */
    public function show(VesselAvailability $VesselAvailability)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VesselAvailability $VesselAvailability)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        \DB::transaction(function () use ($request, $id) {

            $startTime = substr($request->EditStartTime, 0, 5);
            $endTime   = substr($request->EditEndTime, 0, 5);
            $startDate = $request->EditStartDate;
            $endDate   = $request->EditEndDate;
            $vessel    = $request->EditVessel;
            $currentRow = VesselAvailability::where('id', $id)
                ->lockForUpdate()
                ->firstOrFail();
            $previousRow = VesselAvailability::where('Vessel', $vessel)
                ->where('id', '!=', $id)
                ->where('StartDate', $startDate)
                ->where('StartTime', '<', $currentRow->StartTime)
                ->orderBy('StartTime', 'desc')
                ->lockForUpdate()
                ->first();
            $nextRow = VesselAvailability::where('Vessel', $vessel)
                ->where('id', '!=', $id)
                ->where('StartDate', $startDate)
                ->where('StartTime', '>', $currentRow->StartTime)
                ->orderBy('StartTime', 'asc')
                ->lockForUpdate()
                ->first();
            $currentRow->update([
                'Vessel'    => $vessel,
                'DoneBy'    => $request->EditDoneBy,
                'Attachment'=> $request->EditAttachment,
                'Comment'   => $request->EditComment,
                'Report'    => $request->EditReport,
                'Picture'   => $request->EditPicture,
                'Location'  => $request->EditLocation,
                'StartTime' => $startTime,
                'EndTime'   => $endTime,
                'StartDate' => $startDate,
                'EndDate'   => $endDate,
                'TillNow'   => $request->EditTillNow,
                'DateIn'    => now()->format('Y-m-d'),
                'TimeIn'    => now()->format('H:i A'),
            ]);
            if ($previousRow) {
                $previousRow->update([
                    'EndTime' => $startTime,
                    'EndDate' => $startDate,
                    'TillNow' => 'NO',
                ]);
            }
            if ($nextRow) {
                $nextRow->update([
                    'EndTime' => $startTime,
                    'EndDate' => $startDate, 
                    'TillNow' => 'NO',
                ]);
            }
            \DB::table('notifications')->insert([
                'DateIn' => now()->format('Y-m-d'),
                'TimeIn' => now()->format('H:i A'),
                'UserId' => session()->get('USER_ID'),
                'Vessel' => $vessel,
                'Action' => 'Update',
                'Subject'=> 'Availability Update!',
                'Notification' =>
                    $request->EditDoneBy .
                    ' has updated availability for ' .
                    $vessel .
                    ' from ' .
                    date('H:i A', strtotime($startTime)) .
                    ' till ' .
                    date('H:i A', strtotime($endTime)) .
                    ' (' . $startDate . ' - ' . $endDate . ').',
            ]);
        });
        return back();
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VesselAvailability $VesselAvailability, $Id)
    { 
        $Availability = VesselAvailability::where('id', $Id)->first();
        \DB::table('notifications')->insert([
        'DateIn' => date('Y-m-d'),
        'TimeIn' => date('H:i A'),
        'UserId' => session()->get('USER_ID'),
        'Vessel' => $Availability->Vessel, 
        'Action' => 'Delete',
        'Subject' => 'Availability Removed!',
        'Notification' => $Availability->DoneBy . ' has deleted the availability for ' . $Availability->Vessel . ' which was on ' . $Availability->Status . ' from ' . date('H:i A', strtotime($Availability->StartTime)) . ' - ' . date('H:i A', strtotime($Availability->EndTime)) . ' (' . $Availability->StartDate . ' - ' . $Availability->EndDate . ') . The tracking status is no longer available.',
    ]);
        VesselAvailability::where('id', $Id)->delete();
        return redirect()->route('Availability');
    }
}
