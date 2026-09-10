<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OtherReportController extends Controller
{
    private function attributes(Request $request): array
    {
        return ['Vessel' => $request->input('Vessel'), 'ROB' => $request->input('ROB'), 'FreshWater' => $request->input('FreshWater'), 'DoneBy' => $request->input('DoneBy'), 'Remarks' => $request->input('Remarks'), 'Date' => $request->input('Date'), 'DateIn' => now()->toDateString(), 'TimeIn' => now()->format('H:i')];
    }

    public function add_other_report(Request $request, ?string $Id = null)
    {
        DB::table('other_reports')->insert($this->attributes($request));
        return back();
    }

    public function edit_other_report(Request $request, string $Id)
    {
        DB::table('other_reports')->where('id', $Id)->update($this->attributes($request));
        return back();
    }

    public function delete_other_report(string $Id)
    {
        DB::table('other_reports')->where('id', $Id)->delete();
        return back();
    }
}