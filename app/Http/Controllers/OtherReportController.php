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
        }
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