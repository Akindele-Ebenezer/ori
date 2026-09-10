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
        DB::table('daily_reports')->insert($this->attributes($request));
        return back();
    }

    public function edit_daily_report(Request $request, string $Id)
    {        
        DB::table('daily_reports')->where('id', $Id)->update($this->attributes($request));
        return back();
    }

    public function delete_daily_report(string $Id)
    {
        DB::table('daily_reports')->where('id', $Id)->delete();
        return back();
    }
}