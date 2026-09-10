<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OtherReportController extends Controller
{
    private function attributes(Request $request): array
    {
        return ['Vessel' => $request->input('Vessel'), 'ROB' => $request->input('ROB'), 'FreshWater' => $request->input('FreshWater'), 'CCTV' => $request->input('CCTV', 'No'), 'Internet' => $request->input('Internet', 'No'), 'DoneBy' => $request->input('DoneBy'), 'Remarks' => $request->input('Remarks'), 'Date' => $request->input('Date'), 'DateIn' => now()->toDateString(), 'TimeIn' => now()->format('H:i')];
    }

    public function add_other_report(Request $request, ?string $Id = null)
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
            DB::table('other_reports')->insert($attributes);
            foreach ($attributes as $report) {
                $this->notifyReport($report['Vessel'], 'Create', 'Others Report Created!', $report['DoneBy'] . ' created an Others report for ' . $report['Vessel'] . ' dated ' . $report['Date'] . '.');
            }
        }
        return back();
    }

    public function edit_other_report(Request $request, string $Id)
    {
        $attributes = $this->attributes($request);
        DB::table('other_reports')->where('id', $Id)->update($attributes);
        $this->notifyReport($attributes['Vessel'], 'Update', 'Others Report Updated!', $attributes['DoneBy'] . ' updated the Others report for ' . $attributes['Vessel'] . ' dated ' . $attributes['Date'] . '.');
        return back();
    }

    public function delete_other_report(string $Id)
    {
        $report = DB::table('other_reports')->where('id', $Id)->first();
        if ($report) {
            $this->notifyReport($report->Vessel, 'Delete', 'Others Report Removed!', ($report->DoneBy ?: 'A user') . ' deleted the Others report for ' . $report->Vessel . '.');
        }
        DB::table('other_reports')->where('id', $Id)->delete();
        return back();
    }
}