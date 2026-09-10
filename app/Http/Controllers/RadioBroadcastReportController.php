<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RadioBroadcastReportController extends Controller
{
    private const ALERT_FIELDS = ['WatchKeepingAlert', 'RelatedDistress', 'FirstCallTime', 'SecondCallTime', 'Responders'];

    private function attributes(Request $request): array
    {
        $data = [
            'Vessel' => $request->input('Vessel'),
            'DoneBy' => $request->input('DoneBy'),
            'Remarks' => $request->input('Remarks'),
            'Date' => $request->input('Date'),
            'DateIn' => now()->toDateString(),
            'TimeIn' => now()->format('H:i'),
        ];

        foreach (self::ALERT_FIELDS as $field) {
            $data[$field] = $request->boolean($field) ? 'Yes' : 'No';
        }

        return $data;
    }

    public function add_radio_broadcast_report(Request $request, ?string $Id = null)
    {
        DB::table('radio_broadcast_reports')->insert($this->attributes($request));
        return back();
    }

    public function edit_radio_broadcast_report(Request $request, string $Id)
    {
        DB::table('radio_broadcast_reports')->where('id', $Id)->update($this->attributes($request));
        return back();
    }

    public function delete_radio_broadcast_report(string $Id)
    {
        DB::table('radio_broadcast_reports')->where('id', $Id)->delete();
        return back();
    }
}