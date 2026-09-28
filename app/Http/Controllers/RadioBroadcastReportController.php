<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RadioBroadcastReportController extends Controller
{
    private const BOOLEAN_ALERT_FIELDS = ['WatchKeepingAlert', 'RelatedDistress', 'Responders'];
    private const CALL_TIME_FIELDS = ['FirstCallTime', 'SecondCallTime'];

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

        foreach (self::BOOLEAN_ALERT_FIELDS as $field) {
            $data[$field] = $request->boolean($field) ? 'Yes' : 'No';
        }

        foreach (self::CALL_TIME_FIELDS as $field) {
            $value = $request->input($field);
            $data[$field] = in_array($value, ['Yes', 'No'], true) ? 'No' : ($value ?: 'No');
        }

        return $data;
    }

   public function add_radio_broadcast_report(Request $request, ?string $Id = null)
    {
        $rows = $request->input('vessels', []);

        if (!is_array($rows)) {
            $rows = [];
        }

        $attributes = collect($rows)
            ->filter(function ($row) {
                return is_array($row) && filled($row['Vessel'] ?? null);
            })
            ->map(function (array $row) use ($request) {

                return [
                    'Vessel' => $row['Vessel'],

                    'WatchKeepingAlert' => $row['WatchKeepingAlert'] ?? 'No',

                    'RelatedDistress' => $row['RelatedDistress'] ?? 'No',

                    'FirstCallTime' => !empty($row['FirstCallTimeEnabled'])
                        ? $request->input('FirstCallTime')
                        : 'No',

                    'SecondCallTime' => !empty($row['SecondCallTimeEnabled'])
                        ? $request->input('SecondCallTime')
                        : 'No',

                    'Responders' => $row['Responders'] ?? 'No',

                    'DoneBy' => $request->input('DoneBy'),

                    'Remarks_' => $row['Remarks_'] ?? 'null',
                    'Remarks' => $request->input('Remarks'),
                    'Date' => $request->input('Date'),
                    'DateIn'    => now()->format('Y-m-d'),
                    'TimeIn'    => now()->format('H:i A'),
                ];
            })
            ->values()
            ->all();

        // TEST
        // dd($attributes);

        if (!empty($attributes)) {

            DB::table('radio_broadcast_reports')->insert($attributes);

            foreach ($attributes as $report) {

                $this->notifyReport(
                    $report['Vessel'],
                    'Create',
                    'Radio Broadcast Report Created!',
                    $report['DoneBy']
                        . ' created a radio broadcast report for '
                        . $report['Vessel']
                        . ' dated '
                        . $report['Date']
                        . '.'
                );
            }
        }

        return back();
    }

    public function edit_radio_broadcast_report(
        Request $request,
        string $Id
    ) { 
        $attributes = [
            'Vessel' => $request->input('Vessel'),
            'DoneBy' => $request->input('DoneBy'),
            'Remarks' => $request->input('Remarks'),
            'Remarks_' => $request->input('Remarks_'),
            'Date' => $request->input('Date'),

            'WatchKeepingAlert' =>
                $request->boolean('WatchKeepingAlert') ? 'Yes' : 'No',

            'RelatedDistress' =>
                $request->boolean('RelatedDistress') ? 'Yes' : 'No',

            'Responders' =>
                $request->boolean('Responders') ? 'Yes' : 'No',

            'FirstCallTime' =>
                $request->boolean('FirstCallTimeEnabled')
                    ? $request->input('FirstCallTime')
                    : null,

            'SecondCallTime' =>
                $request->boolean('SecondCallTimeEnabled')
                    ? $request->input('SecondCallTime')
                    : null,

            'DateIn' => now()->toDateString(),
            'TimeIn' => now()->format('H:i'),
        ];
 
        $updated = DB::table('radio_broadcast_reports')
            ->where('id', $Id)
            ->update($attributes);

        if ($updated === 0) {
            $exists = DB::table('radio_broadcast_reports')
                ->where('id', $Id)
                ->exists();

            if (!$exists) {
                abort(404, 'Radio broadcast report not found.');
            }
        }

        $this->notifyReport(
            $attributes['Vessel'],
            'Update',
            'Radio Broadcast Report Updated!',
            ($attributes['DoneBy'] ?: 'An officer') .
            ' updated the radio broadcast report for ' .
            $attributes['Vessel'] .
            ' dated ' .
            $attributes['Date'] .
            '.'
        );

        return back()->with(
            'success',
            'Radio broadcast report updated successfully.'
        );
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