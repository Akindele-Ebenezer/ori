<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DailyReportController extends Controller
{
    private function attributes(Request $request): array
    {
        return [
            'Vessel' => $request->input('Vessel'),
            'DeployedVessel1' => $request->input('DeployedVessel1'),
            'DeployedVessel2' => $request->input('DeployedVessel2'),
            'DeployedVessel3' => $request->input('DeployedVessel3'),
            'Status' => $request->input('Status'),
            'DoneBy' => $request->input('DoneBy'),
            'Remarks' => $request->input('Remarks'),
            'StartTime' => substr((string) $request->input('StartTime'), 0, 5),
            'EndTime' => substr((string) $request->input('EndTime'), 0, 5),
            'StartDate' => $request->input('StartDate'),
            'EndDate' => $request->input('EndDate'),
            'TillNow' => $request->input('TillNow', 'NO'),
            'DateIn' => now()->toDateString(),
            'TimeIn' => now()->format('H:i'),
        ];
    }

    public function add_daily_report(Request $request, ?string $Id = null)
    { 
        $request->validate($this->validationRules());
        DB::table('daily_reports')->insert($this->attributes($request));
        return back();
    }

    public function edit_daily_report(Request $request, string $Id)
    {        
        $request->validate($this->validationRules());
        DB::table('daily_reports')->where('id', $Id)->update($this->attributes($request));
        return back();
    }

    public function delete_daily_report(string $Id)
    {
        DB::table('daily_reports')->where('id', $Id)->delete();
        return back();
    }

    private function validationRules(): array
    {
        return [
            'Vessel' => ['nullable', 'string', 'max:255'],
            'DeployedVessel1' => ['nullable', 'string', 'max:255'],
            'DeployedVessel2' => ['nullable', 'string', 'max:255'],
            'DeployedVessel3' => ['nullable', 'string', 'max:255'],
            'Status' => ['required', 'in:DEPARTURE,ARRIVAL,INSPECTION,DRILL'],
            'DoneBy' => ['required', 'string', 'max:255'],
            'Remarks' => ['nullable', 'string'],
            'StartTime' => ['required', 'regex:/^(?:[01]\d|2[0-3]):[0-5]\d(?:\sHRS)?$/i'],
            'EndTime' => ['required', 'regex:/^(?:[01]\d|2[0-3]):[0-5]\d(?:\sHRS)?$/i'],
            'StartDate' => ['required', 'date'],
            'EndDate' => ['required', 'date', 'after_or_equal:StartDate'],
        ];
    }
}