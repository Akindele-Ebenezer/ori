<?php

namespace App\Http\Controllers;

use App\Models\Vessel;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Employee;

class VesselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $Request)
    {
        $Vessels = \DB::table('vessels_vessel_information')->get();
        $Ranks = \DB::table('ranks')->get();
        $Companies = \DB::table('companies')->orderBy('id', 'DESC')->get();
        $Employees = Employee::orderBy('EmployeeId', 'DESC')->get();

        if(isset($Request->FilterValue)) {  
            $Vessels = \DB::table('vessels_vessel_information')->where('VesselName', 'LIKE', '%' . $Request->FilterValue . '%')
                            ->orWhere('ImoNumber', 'LIKE', '%' . $Request->FilterValue . '%')
                            ->orWhere('CallSign', 'LIKE', '%' . $Request->FilterValue . '%')
                            ->orWhere('Flag', 'LIKE', '%' . $Request->FilterValue . '%')
                            ->orWhere('PortOfRegistry', 'LIKE', '%' . $Request->FilterValue . '%')
                            ->orWhere('RegistrationOfficialNumber', 'LIKE', '%' . $Request->FilterValue . '%')
                            ->paginate(14);
                                        
            return view('Pages.Vessels', [
                'Employees' => $Employees,
                'Vessels' => $Vessels,
                'Ranks' => $Ranks,
                'Companies' => $Companies,
            ]);
        }
        return view('Pages.Vessels', [
            'Employees' => $Employees,
            'Vessels' => $Vessels,
            'Ranks' => $Ranks,
            'Companies' => $Companies,
        ]);
    } 

    public function operations(Request $Request)
    {
        $Vessels = \DB::table('vessels_vessel_information')->get();
        $Employees = Employee::orderBy('EmployeeId', 'DESC')->get();
        $Ranks = \DB::table('ranks')->get();
        $Companies = \DB::table('companies')->orderBy('id', 'DESC')->get();
        $Operations = Testimonial::orderBy('DateIn', 'DESC')->orderBy('TimeIn', 'DESC')->paginate(14);
        
        if(isset($Request->FilterValue)) { 
            $Operations = Testimonial::where('Date', 'LIKE', '%' . $Request->FilterValue . '%')
                            ->orWhere('EmployeeName', 'LIKE', '%' . $Request->FilterValue . '%')
                            ->orWhere('EmployeeId', 'LIKE', '%' . $Request->FilterValue . '%')
                            ->orWhere('AreaOfOperation', 'LIKE', '%' . $Request->FilterValue . '%')
                            ->orWhere('DischargeBook', 'LIKE', '%' . $Request->FilterValue . '%')
                            ->orWhere('CurrentVessel', 'LIKE', '%' . $Request->FilterValue . '%')
                            ->orWhere('Rank', 'LIKE', '%' . $Request->FilterValue . '%')
                            ->orWhere('Company', 'LIKE', '%' . $Request->FilterValue . '%')
                            ->orWhere('Template', 'LIKE', '%' . $Request->FilterValue . '%')
                            ->orderBy('DateIn', 'DESC')->orderBy('TimeIn', 'DESC')
                            ->paginate(14);
                                        
            return view('Pages.Operations', [
                'Vessels' => $Vessels,
                'Employees' => $Employees,
                'Operations' => $Operations,
                'Ranks' => $Ranks,
                'Companies' => $Companies,
            ]);
        }

        return view('Pages.Operations', [
            'Vessels' => $Vessels,
            'Employees' => $Employees,
            'Operations' => $Operations,
            'Ranks' => $Ranks,
            'Companies' => $Companies,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $Request)
    {
        \DB::table('vessels_vessel_information')->insert([
            'UserId' => session()->get('USER_ID'),
            'DateIn' => date('Y-m-d'),
            'TimeIn' => date('H:i a'),
            'ImoNumber' => $Request->ImoNumber,
            'VesselType' => $Request->VesselType,
            'Company' => $Request->Company,
            'VesselName' => $Request->VesselName,
            'CallSign' => $Request->CallSign,
            'Flag' => $Request->Flag,
            'PortOfRegistry' => $Request->PortOfRegistry,
            'RegistrationOfficialNumber' => $Request->RegistrationNumber,
            'Loa' => $Request->Loa,
            'Boa' => $Request->Boa,
            'DepthMouled' => $Request->DepthMoulded, 
        ]);
        \DB::table('vessels_general_others')->insert([
            'UserId' => session()->get('USER_ID'), 
            'UserId' => session()->get('USER_ID'),
            'DateIn' => date('Y-m-d'),
            'TimeIn' => date('H:i a'),
            'VesselName' => $Request->VesselName,
            'ImoNumber' => $Request->ImoNumber,
            'SummerLoadDraught' => $Request->SummerLoadDraught,
            'Lpp' => $Request->Lpp,
            'Owner' => $Request->Owner,
            'Builder' => $Request->Builder,
            'DateKeelLaid' => $Request->DateKeelLaid,
            'DateOfBuild' => $Request->DateOfBuild,
            'PlaceOfBuild' => $Request->PlaceOfBuild,
            'Material' => $Request->Material,
            'YardNumber' => $Request->YardNumber, 
        ]);
        \DB::table('vessels_section_3')->insert([
            'UserId' => session()->get('USER_ID'),  
            'DateIn' => date('Y-m-d'),
            'TimeIn' => date('H:i a'),
            'VesselName' => $Request->VesselName,
            'ImoNumber' => $Request->ImoNumber,
            'TypesOfEngines' => $Request->TypesOfEngines,
            'NumberOfEngines' => $Request->NumberOfEngines,
            'NumberOfCylinder' => $Request->NumberOfCyliners,
            'EngineOutputKw' => $Request->EngineOutput,
            'EngineMakers' => $Request->EngineMakers,
            'YearOfEngineBuilt' => $Request->YearOfEngineBuilt,
            'PlaceEnginesBuilt' => $Request->PlaceEnginesBuilt,
            'Diametermm' => $Request->Diametermm,
            'LengthOfStrokemm' => $Request->LengthOfStrokemm, 
        ]);
        \DB::table('vessels_section_4')->insert([  
            'UserId' => session()->get('USER_ID'),  
            'DateIn' => date('Y-m-d'),
            'TimeIn' => date('H:i a'),
            'VesselName' => $Request->VesselName,
            'ImoNumber' => $Request->ImoNumber,
            'GrossTonnage' => $Request->GrossTonnage,
            'NetTonnage' => $Request->NetTonnage, 
            'ROB' => $Request->ROB, 
            'TankCapacity' => $Request->TankCapacity, 
            'Area' => $Request->Area, 
        ]);
        \DB::table('notifications')->insert([
            'DateIn' => now()->format('Y-m-d'),
            'TimeIn' => now()->format('H:i A'),
            'UserId' => session()->get('USER_ID'),
            'Vessel' => $Request->VesselName,
            'Action' => 'Create',
            'Subject'=> 'Vessel Created!',
            'Notification' =>
                'A vessel has been created. Vessel Name: ' .
                $Request->VesselName .
                '. Created by ' .
                session()->get('FullName') .
                ' on ' .
                now()->format('Y-m-d') .
                ' at ' .
                now()->format('H:i A') . '.',
        ]);
        return redirect()->route('Vessels');
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
    public function show(Vessel $vessel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vessel $vessel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $Request, Vessel $vessel)
    {  
        \DB::table('vessels_vessel_information')->where('VesselName', $Request->EditVesselName)->update([ 
            'UserId' => session()->get('USER_ID'),
            'VesselName' => $Request->EditVesselName,
            'Captain' => $Request->EditCaptain,
            'NightDutyCaptain' => $Request->EditNightDutyCaptain,
            'VesselType' => $Request->EditVesselType,
            'ImoNumber' => $Request->EditImoNumber,
            'Company' => $Request->EditCompany,
            'CallSign' => $Request->EditCallSign,
            'Flag' => $Request->EditFlag,
            'PortOfRegistry' => $Request->EditPortOfRegistry,
            'RegistrationOfficialNumber' => $Request->EditRegistrationNumber,
            'Loa' => $Request->EditLoa,
            'Boa' => $Request->EditBoa,
            'DepthMouled' => $Request->EditDepthMoulded, 
        ]);
        \DB::table('vessels_general_others')->where('VesselName', $Request->EditVesselName)->update([  
            'UserId' => session()->get('USER_ID'),
            'VesselName' => $Request->EditVesselName,
            'ImoNumber' => $Request->EditImoNumber,
            'SummerLoadDraught' => $Request->EditSummerLoadDraught,
            'Lpp' => $Request->EditLpp,
            'Owner' => $Request->EditOwner,
            'Builder' => $Request->EditBuilder,
            'DateKeelLaid' => $Request->EditDateKeelLaid,
            'DateOfBuild' => $Request->EditDateOfBuild,
            'PlaceOfBuild' => $Request->EditPlaceOfBuild,
            'Material' => $Request->EditMaterial,
            'YardNumber' => $Request->EditYardNumber, 
        ]);
        \DB::table('vessels_section_3')->where('VesselName', $Request->EditVesselName)->update([ 
            'UserId' => session()->get('USER_ID'),  
            'VesselName' => $Request->EditVesselName,
            'ImoNumber' => $Request->EditImoNumber,
            'TypesOfEngines' => $Request->EditTypesOfEngines,
            'NumberOfEngines' => $Request->EditNumberOfEngines,
            'NumberOfCylinder' => $Request->EditNumberOfCyliners,
            'EngineOutputKw' => $Request->EditEngineOutput,
            'EngineMakers' => $Request->EditEngineMakers,
            'YearOfEngineBuilt' => $Request->EditYearOfEngineBuilt,
            'PlaceEnginesBuilt' => $Request->EditPlaceEnginesBuilt,
            'Diametermm' => $Request->EditDiametermm,
            'LengthOfStrokemm' => $Request->EditLengthOfStrokemm, 
        ]);
        \DB::table('vessels_section_4')->where('VesselName', $Request->EditVesselName)->update([  
            'UserId' => session()->get('USER_ID'),   
            'VesselName' => $Request->EditVesselName,
            'ImoNumber' => $Request->EditImoNumber,
            'GrossTonnage' => $Request->EditGrossTonnage,
            'ROB' => $Request->EditROB, 
            'TankCapacity' => $Request->EditTankCapacity, 
            'Area' => $Request->EditArea, 
        ]);
        
        \DB::table('notifications')->insert([
            'DateIn' => now()->format('Y-m-d'),
            'TimeIn' => now()->format('H:i A'),
            'UserId' => session()->get('USER_ID'),
            'Vessel' => $Request->EditVesselName,
            'Action' => 'Update',
            'Subject'=> 'Vessel Updated!',
            'Notification' =>
                'A vessel has been updated. Vessel Name: ' .
                $Request->EditVesselName .
                '. Updated by ' .
                session()->get('FullName') .
                ' on ' .
                now()->format('Y-m-d') .
                ' at ' .
                now()->format('H:i A') . '.',
        ]);
        return back();
    }

    public function savePosition(Request $request)
    { 
        $vessels = $request->input('vessels'); 
        $updatedCount = 0;
        $vesselNames = [];
        $movedVessels = [];

        foreach ($vessels as $id => $newPosition) {
            // Get current vessel data from database
            $vessel = \DB::table('vessels_section_4')->where('id', $id)->first();
            
            if (!$vessel) continue;
            
            $vesselName = $vessel->VesselName ?? "Vessel #{$id}";
            $oldX = $vessel->x_position ?? 0;
            $oldY = $vessel->y_position ?? 0;
            $oldRot = $vessel->rotation_angle ?? 0;
            
            $newX = $newPosition['x'];
            $newY = $newPosition['y'];
            $newRot = $newPosition['rotation'] ?? 0;
            
            // Calculate if vessel actually moved
            $positionChanged = (
                abs($oldX - $newX) > 0.01 ||  // Small threshold for floating point
                abs($oldY - $newY) > 0.01 ||
                abs($oldRot - $newRot) > 0.1
            );
            
            // Calculate distance moved
            $distanceMoved = sqrt(pow($newX - $oldX, 2) + pow($newY - $oldY, 2));
            
            if ($positionChanged) {
                // Only update if position actually changed
                \DB::table('vessels_section_4')
                ->where('id', $id)
                ->update([
                    'x_position' => $newX,
                    'y_position' => $newY,
                    'rotation_angle' => $newRot,
                    'updated_at' => now()
                ]);
                
                $updatedCount++;
                $vesselNames[] = $vesselName;
                
                // Track movement details for notification
                $movedVessels[] = [
                    'name' => $vesselName,
                    'oldPos' => "($oldX, $oldY)",
                    'newPos' => "($newX, $newY)",
                    'distance' => round($distanceMoved, 1),
                    'rotationChange' => round(abs($newRot - $oldRot), 1)
                ];
            } else {
                // Log that vessel didn't move (optional)
                \Log::info("Vessel {$vesselName} did not move, skipping update");
            }
        }

        // Only create notification if vessels actually moved
        if ($updatedCount > 0) {
            // Single vessel moved
            if ($updatedCount === 1) {
                $moved = $movedVessels[0];
                \DB::table('notifications')->insert([
                    'DateIn' => now()->format('Y-m-d'),
                    'TimeIn' => now()->format('H:i A'),
                    'UserId' => session()->get('USER_ID'),
                    'Vessel' => $moved['name'],
                    'Action' => 'Position Update',
                    'Subject' => "Vessel Moved: {$moved['name']}",
                    'Notification' => sprintf(
                        "Vessel Position Updated\n" .
                        "Vessel: %s\n" .
                        "Moved: from %s to %s\n" .
                        "Distance: %s units\n" .
                        "Rotation change: %s°\n" .
                        "Updated by: %s\n" .
                        "Time: %s",
                        $moved['name'],
                        $moved['oldPos'],
                        $moved['newPos'],
                        $moved['distance'],
                        $moved['rotationChange'],
                        session()->get('FullName'),
                        now()->format('H:i A')
                    ),
                ]);
            } 
            // Multiple vessels moved
            else {
                // Calculate total distance for summary
                $totalDistance = array_sum(array_column($movedVessels, 'distance'));
                
                \DB::table('notifications')->insert([
                    'DateIn' => now()->format('Y-m-d'),
                    'TimeIn' => now()->format('H:i A'),
                    'UserId' => session()->get('USER_ID'),
                    'Vessel' => 'Multiple',
                    'Action' => 'Bulk Position Update',
                    'Subject' => "{$updatedCount} Vessels Repositioned",
                    'Notification' => sprintf(
                        "Bulk Vessel Position Update\n" .
                        "Vessels moved: %d\n" .
                        "Total distance moved: %s units\n" .
                        "Vessels affected: %s\n" .
                        "Updated by: %s\n" .
                        "Time: %s\n\n" .
                        "Details:\n%s",
                        $updatedCount,
                        round($totalDistance, 1),
                        implode(', ', array_slice($vesselNames, 0, 5)) . (count($vesselNames) > 5 ? " + " . (count($vesselNames) - 5) . " more" : ""),
                        session()->get('FullName'),
                        now()->format('H:i A'),
                        implode("\n", array_map(function($v) {
                            return "• {$v['name']}: moved {$v['distance']} units to {$v['newPos']}";
                        }, array_slice($movedVessels, 0, 3))) . (count($movedVessels) > 3 ? "\n• ... and " . (count($movedVessels) - 3) . " more" : "")
                    ),
                ]);
            }
        } else {
            // Optional: Log that no vessels moved
            \Log::info("Position save request received but no vessels actually moved");
            
            // Optional: Create a "no changes" notification if you want
            /*
            \DB::table('notifications')->insert([
                'DateIn' => now()->format('Y-m-d'),
                'TimeIn' => now()->format('H:i A'),
                'UserId' => session()->get('USER_ID'),
                'Vessel' => 'None',
                'Action' => 'Position Save',
                'Subject' => "No vessels moved",
                'Notification' => session()->get('FullName') . " saved positions but no vessels actually moved at " . now()->format('H:i A'),
            ]);
            */
        }
        return back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vessel $Vessel, $VesselName)
    {   
        \DB::table('vessels_vessel_information')->where('VesselName', $VesselName)->delete();
        \DB::table('vessels_general_others')->where('VesselName', $VesselName)->delete();
        \DB::table('vessels_section_3')->where('VesselName', $VesselName)->delete();
        \DB::table('vessels_section_4')->where('VesselName', $VesselName)->delete();
        return back(); 
    }

    public function portfolio()
    {
        $Employees = Employee::orderBy('EmployeeId', 'DESC')->paginate(40);
        $Companies = \DB::table('companies')->orderBy('id', 'DESC')->get();
        $Ranks = \DB::table('ranks')->orderBy('id', 'DESC')->get();
        $Vessels = \DB::table('vessels_vessel_information')->select('VesselName')->get(); 
        $portfolios = \DB::table('portfolio')->get();
        return view('Pages.Portfolio', [
                'Employees' => $Employees,
                'Vessels' => $Vessels,  
                'Ranks' => $Ranks,  
                'Companies' => $Companies,  
                'Portfolios' => $portfolios,
        ]);
    }
}
