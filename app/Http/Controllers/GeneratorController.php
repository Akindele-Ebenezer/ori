<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneratorController extends Controller
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
        \DB::table('generators')->insert([  
            'Priority_InternalNo' => $Request->Priority_InternalNo,
            'UsedBy' => $Request->UsedBy,
            'EngineMake' => $Request->EngineMake,
            'Power' => $Request->VesselType,
            'Model' => $Request->Model,
            'MachineType' => $Request->MachineType,
            'SN' => $Request->SN,
            'EngineType' => $Request->EngineType,
            'Location' => $Request->Location,
            'Remarks' => $Request->Remarks,
            'Company' => $Request->Company,
            'Class' => $Request->Class,
            'Picture' => $Request->Picture, 
        ]);
        \DB::table('notifications')->insert([
            'DateIn' => date('Y-m-d'),
            'TimeIn' => date('H:i A'),
            'UserId' => session()->get('USER_ID'),
            'Vessel' => $Request->EngineMake, 
            'Action' => 'Create',
            'Subject' => 'New Availability Alert!',
            'Notification' =>  'User ID: ' . session()->get('USER_ID') . ' added a generator/engine (' . $Request->EngineMake . ") to generator's tracking list.",
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
        \DB::table('generators')->where('id', $Id)->update([
            'Priority_InternalNo' => $Request->Priority_InternalNo,
            'UsedBy' => $Request->UsedBy,
            'EngineMake' => $Request->EngineMake,
            'Power' => $Request->VesselType,
            'Model' => $Request->Model,
            'MachineType' => $Request->MachineType,
            'SN' => $Request->SN,
            'EngineType' => $Request->EngineType,
            'Location' => $Request->Location,
            'Remarks' => $Request->Remarks,
            'Company' => $Request->Company,
            'Class' => $Request->Class,
            'Picture' => $Request->Picture, 
        ]);
        \DB::table('notifications')->insert([
            'DateIn' => date('Y-m-d'),
            'TimeIn' => date('H:i A'),
            'UserId' => session()->get('USER_ID'),
            'Vessel' => $Request->EngineMake, 
            'Action' => 'Update',
            'Subject' => 'Generator Information Updated',
            'Notification' =>  'User ID: ' . session()->get('USER_ID') . ' modified/updated some details of ' . $Request->EngineMake,
        ]); 
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
