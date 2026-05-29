<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneratorAvailability; 

class GeneratorAvailabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $Request)
    {  
        $CurrentRow = GeneratorAvailability::create([   
            'GeneratorId' => $Request->GeneratorId,
            'EngineMake' => $Request->Generator,
            'Status' => $Request->Status,
            'DoneBy' => $Request->DoneBy,  
            'Remarks' => $Request->Remarks,  
            'StartTime' => substr($Request->StartTime, 0, 5),
            'EndTime' => substr($Request->EndTime, 0, 5),
            'StartDate' => $Request->StartDate,
            'EndDate' => $Request->EndDate,
            'TillNow' => $Request->TillNow,
            'DateIn' => date('Y-m-d'),
            'TimeIn' => date('H:i a'),
        ]);  
        $PreviousRow = GeneratorAvailability::where('GeneratorId', $Request->GeneratorId)
            ->where('StartDate', '<=', $Request->StartDate)
            ->where(function ($query) use ($Request) {
                $query->where('StartDate', '<', $Request->StartDate)
                        ->orWhere('StartTime', '<', substr($Request->StartTime, 0, 5));
            })
            ->orderBy('StartDate', 'desc')
            ->orderBy('StartTime', 'desc')
            ->first();  

        $NextRow = GeneratorAvailability::where('GeneratorId', $Request->GeneratorId)
            ->where('StartDate', '>=', $Request->EndDate)
            ->where(function ($query) use ($Request) {
                $query->where('StartDate', '>', $Request->EndDate)
                    ->orWhere('StartTime', '>', substr($Request->EndTime, 0, 5));
            })
            ->orderBy('StartDate', 'asc')
            ->orderBy('StartTime', 'asc')
            ->first();

            if ($PreviousRow) {
                GeneratorAvailability::where('id', $PreviousRow->id)->update([
                    'EndDate' => $Request->StartDate,
                    'EndTime' => substr($Request->StartTime, 0, 5),
                    'TillNow' => 'NO',
                ]);
            }
        
            if ($NextRow) {
                GeneratorAvailability::where('id', $NextRow->id)->update([
                    'StartDate' => $Request->EndDate,
                    'StartTime' => substr($Request->EndTime, 0, 5),
                    'TillNow' => 'NO',
                ]);
            }  
            
        GeneratorAvailability::where('id', '<', $CurrentRow->id)
            ->where('GeneratorId', $Request->GeneratorId)
            ->update([ 
                'TillNow' => 'NO',
            ]); 
            
        \DB::table('notifications')->insert([
            'DateIn' => date('Y-m-d'),
            'TimeIn' => date('H:i A'),
            'UserId' => session()->get('USER_ID'),
            'Vessel' => $Request->EngineMake, 
            'Action' => 'Create',
            'Subject' => 'New Availability Alert!',
            'Notification' =>  $Request->DoneBy . ' created availability for ' . $Request->EngineMake . "'s tracking list. The Generator is on " . $Request->Status . ' from ' . date('H:i A', strtotime(substr($Request->StartTime, 0, 5))) . ' to ' . date('H:i A', strtotime(substr($Request->EndTime, 0, 5))) . ' (' . $Request->StartDate . ' - ' . $Request->EndDate . ').',
        ]);    
        return back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $Request, string $Id)
    {
        //
        \DB::table('generator_availability')->where('id', $Id)->update([  
            'EngineMake' => $Request->EditEngineMake, 
            'Status' => $Request->EditStatus,
            'DoneBy' => $Request->EditDoneBy,  
            'Remarks' => $Request->EditRemarks,  
            'StartTime' => substr($Request->EditStartTime, 0, 5),
            'EndTime' => substr($Request->EditEndTime, 0, 5),
            'StartDate' => $Request->EditStartDate,
            'EndDate' => $Request->EditEndDate,
            'TillNow' => $Request->EditTillNow, 
        ]);
        \DB::table('notifications')->insert([
            'DateIn' => date('Y-m-d'),
            'TimeIn' => date('H:i A'),
            'UserId' => session()->get('USER_ID'),
            'Vessel' => $Request->EditEngineMake, 
            'Action' => 'Update',
            'Subject' => 'Availability Update!',
            'Notification' => $Request->EditDoneBy . ' has updated availability for ' . $Request->EditEngineMake . '! The Generator is currently on ' . $Request->EditStatus . ' from ' . date('H:i A', strtotime(substr($Request->EditStartTime, 0, 5))) . ' till ' . date('H:i A', strtotime(substr($Request->EditEndTime, 0, 5))) . ' (' . $Request->EditStartDate .' - ' . $Request->EditEndDate . ').',
        ]); 
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $Id)
    {
        $Availability = \DB::table('generator_availability')->where('id', $Id)->first();
        \DB::table('notifications')->insert([
        'DateIn' => date('Y-m-d'),
        'TimeIn' => date('H:i A'),
        'UserId' => session()->get('USER_ID'),
        'Vessel' => $Availability->EngineMake, 
        'Action' => 'Delete',
        'Subject' => 'Availability Removed!',
        'Notification' => $Availability->DoneBy . ' has deleted the availability for (Generator) ' . $Availability->EngineMake . ' which was on ' . $Availability->Status . ' from ' . date('H:i A', strtotime($Availability->StartTime)) . ' - ' . date('H:i A', strtotime($Availability->EndTime)) . ' (' . $Availability->StartDate . ' - ' . $Availability->EndDate . ') . The tracking status is no longer available.',
    ]); 
    \DB::table('generator_availability')->where('id', $Id)->delete();
    return redirect()->route('Availability');
    }
}
