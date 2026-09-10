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
        $rows = $request->input('vessels');
        if (!is_array($rows)) {
            $rows = [$request->all()];
        }

        $attributes = collect($rows)
            ->filter(fn ($row) => is_array($row) && filled($row['Vessel'] ?? null))
            ->map(function (array $row) use ($request) {
                $rowRequest = Request::create('/', 'POST', array_merge($row, [
                    'DoneBy' => $request->input('DoneBy'),
                    'Remarks' => $request->input('Remarks'),
                    'Date' => $request->input('Date'),
                ]));
                return $this->attributes($rowRequest);
            })
            ->values()
            ->all();

        if ($attributes) {
            DB::table('radio_broadcast_reports')->insert($attributes);
            foreach ($attributes as $report) {
                $this->notifyReport($report['Vessel'], 'Create', 'Radio Broadcast Report Created!', $report['DoneBy'] . ' created a radio broadcast report for ' . $report['Vessel'] . ' dated ' . $report['Date'] . '.');
            }
        }
        return back();
    }

    public function edit_radio_broadcast_report(Request $request, string $Id)
    {
        $attributes = $this->attributes($request);
        DB::table('radio_broadcast_reports')->where('id', $Id)->update($attributes);
        $this->notifyReport($attributes['Vessel'], 'Update', 'Radio Broadcast Report Updated!', $attributes['DoneBy'] . ' updated the radio broadcast report for ' . $attributes['Vessel'] . ' dated ' . $attributes['Date'] . '.');
        return back();
    }

    public function delete_radio_broadcast_report(string $Id)
    {
        $report = DB::table('radio_broadcast_reports')->where('id', $Id)->first();
        if ($report) {
            $this->notifyReport($report->Vessel, 'Delete', 'Radio Broadcast Report Removed!', ($report->DoneBy ?: 'A user') . ' deleted the radio broadcast report for ' . $report->Vessel . '.');
        }
        DB::table('radio_broadcast_reports')->where('id', $Id)->delete();
        return back();
    }
}