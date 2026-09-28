<?php

namespace App\Http\Controllers;

use App\Models\PeriodicCheck;
use Illuminate\Http\Request;

class PeriodicCheckController extends Controller
{
    private function validatedAttributes(Request $request): array
    {
        return $request->validate([
            'Type' => ['required', 'in:Weekly,Bi-weekly,Monthly'],
            'Equipment' => ['required', 'in:PA System,Alarm,Iridium Satellite Phone,CCTV'],
            'Location' => ['required', 'in:Dockyard,Bullnose,Others'],
            'Date' => ['required', 'date'],
            'Time' => ['required', 'date_format:H:i'],
            'DoneBy' => ['required', 'string', 'max:255'],
            'Remarks' => ['required_if:Location,Others', 'nullable', 'string'],
        ]);
    }

    public function store(Request $request)
    {
        $attributes = $this->validatedAttributes($request);
        $check = PeriodicCheck::create($attributes);
        $this->notifyReport('MOC Office', 'Create', 'Periodic Check Created!', $check->DoneBy . ' created a ' . $check->Type . ' check for ' . $check->Equipment . ' on ' . $check->Date . '.');

        return back();
    }

    public function update(Request $request, int $id)
    {
        $attributes = $this->validatedAttributes($request);
        $check = PeriodicCheck::findOrFail($id);
        $check->update($attributes);
        $this->notifyReport('MOC Office', 'Update', 'Periodic Check Updated!', $check->DoneBy . ' updated a ' . $check->Type . ' check for ' . $check->Equipment . ' on ' . $check->Date . '.');

        return back();
    }

    public function destroy(int $id)
    {
        $check = PeriodicCheck::findOrFail($id);
        $this->notifyReport('MOC Office', 'Delete', 'Periodic Check Removed!', ($check->DoneBy ?: 'A user') . ' deleted the periodic check dated ' . $check->Date . '.');
        $check->delete();

        return back();
    }
}