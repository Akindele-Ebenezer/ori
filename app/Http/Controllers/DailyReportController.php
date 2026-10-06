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
            'BerthingDate' => $request->input('BerthingStartDate') ?: null,
            'BerthingTime' => $request->input('BerthingStartTime') ?: null,
            'BerthingStartDate' => $request->input('BerthingStartDate') ?: null,
            'BerthingEndDate' => $request->input('BerthingEndDate') ?: null,
            'BerthingStartTime' => $request->input('BerthingStartTime') ?: null,
            'BerthingEndTime' => $request->input('BerthingEndTime') ?: null,
            'BerthingDeployedVessel1' => $request->input('BerthingDeployedVessel1'),
            'BerthingDeployedVessel2' => $request->input('BerthingDeployedVessel2'),
            'BerthingDeployedVessel3' => $request->input('BerthingDeployedVessel3'),
            'UnberthingDate' => $request->input('UnberthingStartDate') ?: null,
            'UnberthingTime' => $request->input('UnberthingStartTime') ?: null,
            'UnberthingStartDate' => $request->input('UnberthingStartDate') ?: null,
            'UnberthingEndDate' => $request->input('UnberthingEndDate') ?: null,
            'UnberthingStartTime' => $request->input('UnberthingStartTime') ?: null,
            'UnberthingEndTime' => $request->input('UnberthingEndTime') ?: null,
            'UnberthingDeployedVessel1' => $request->input('UnberthingDeployedVessel1'),
            'UnberthingDeployedVessel2' => $request->input('UnberthingDeployedVessel2'),
            'UnberthingDeployedVessel3' => $request->input('UnberthingDeployedVessel3'),
            'ShiftingDate' => $request->input('ShiftingStartDate') ?: null,
            'ShiftingTime' => $request->input('ShiftingStartTime') ?: null,
            'ShiftingStartDate' => $request->input('ShiftingStartDate') ?: null,
            'ShiftingEndDate' => $request->input('ShiftingEndDate') ?: null,
            'ShiftingStartTime' => $request->input('ShiftingStartTime') ?: null,
            'ShiftingEndTime' => $request->input('ShiftingEndTime') ?: null,
            'ShiftingDeployedVessel1' => $request->input('ShiftingDeployedVessel1'),
            'ShiftingDeployedVessel2' => $request->input('ShiftingDeployedVessel2'),
            'ShiftingDeployedVessel3' => $request->input('ShiftingDeployedVessel3'),
            'TillNow' => $request->input('TillNow', 'NO'),
            'DateIn' => now()->toDateString(),
            'TimeIn' => now()->format('H:i'),
        ];
    }

    public function add_daily_report(Request $request, ?string $Id = null)
    { 
        $request->validate($this->validationRules());
        $attributes = $this->attributes($request);
        DB::table('daily_reports')->insert($attributes);
        $this->notifyReport(
            $attributes['Vessel'] ?: 'All vessels',
            'Create',
            'Daily Report Created!',
            $attributes['DoneBy'] . ' created a daily report for ' . ($attributes['Vessel'] ?: 'all vessels') . ' with status ' . $attributes['Status'] . ' (' . $attributes['StartDate'] . ' - ' . $attributes['EndDate'] . ').'
        );
        return back();
    }

    public function edit_daily_report(Request $request, string $Id)
    {        
        $request->validate($this->validationRules($Id));
        $attributes = $this->attributes($request);
        DB::table('daily_reports')->where('id', $Id)->update($attributes);
        $this->notifyReport(
            $attributes['Vessel'] ?: 'All vessels',
            'Update',
            'Daily Report Updated!',
            $attributes['DoneBy'] . ' updated a daily report for ' . ($attributes['Vessel'] ?: 'all vessels') . ' with status ' . $attributes['Status'] . ' (' . $attributes['StartDate'] . ' - ' . $attributes['EndDate'] . ').'
        );
        return back();
    }

    public function delete_daily_report(string $Id)
    {
        $report = DB::table('daily_reports')->where('id', $Id)->first();
        if ($report) {
            $this->notifyReport(
                $report->Vessel ?: 'All vessels',
                'Delete',
                'Daily Report Removed!',
                ($report->DoneBy ?: 'A user') . ' deleted the daily report for ' . ($report->Vessel ?: 'all vessels') . ' with status ' . $report->Status . '.'
            );
        }
        DB::table('daily_reports')->where('id', $Id)->delete();
        return back();
    }

    private function validationRules(?string $Id = null): array
    {
        $allowedStatuses = ['DEPARTURE', 'ARRIVAL', 'DISEMBARKATION', 'EMBARKATION', 'MAINTENANCE', 'INSPECTION', 'DRILL', 'DIVE CHECK', 'WEATHER BROADCAST'];
        if ($Id !== null) {
            $currentStatus = DB::table('daily_reports')->where('id', $Id)->value('Status');
            if (in_array($currentStatus, ['BERTHING', 'UNBERTHING'], true)) {
                $allowedStatuses[] = $currentStatus;
            }
        }

        return [
            'Vessel' => ['required', 'string', 'max:255'],
            'DeployedVessel1' => ['nullable', 'string', 'max:255'],
            'DeployedVessel2' => ['nullable', 'string', 'max:255'],
            'DeployedVessel3' => ['nullable', 'string', 'max:255'],
            'Status' => ['required', 'in:' . implode(',', $allowedStatuses)],
            'DoneBy' => ['required', 'string', 'max:255'],
            'Remarks' => ['nullable', 'string'],
            'StartTime' => ['required', 'regex:/^(?:[01]\d|2[0-3]):[0-5]\d(?:\sHRS)?$/i'],
            'EndTime' => ['required', 'regex:/^(?:[01]\d|2[0-3]):[0-5]\d(?:\sHRS)?$/i'],
            'StartDate' => ['required', 'date'],
            'EndDate' => ['required', 'date', 'after_or_equal:StartDate'],
            'BerthingStartDate' => ['nullable', 'date', 'required_with:BerthingEndDate'],
            'BerthingEndDate' => ['nullable', 'date', 'after_or_equal:BerthingStartDate'],
            'BerthingStartTime' => ['nullable', 'date_format:H:i'],
            'BerthingEndTime' => ['nullable', 'date_format:H:i'],
            'BerthingDeployedVessel1' => ['nullable', 'string', 'max:255'],
            'BerthingDeployedVessel2' => ['nullable', 'string', 'max:255'],
            'BerthingDeployedVessel3' => ['nullable', 'string', 'max:255'],
            'UnberthingStartDate' => ['nullable', 'date', 'required_with:UnberthingEndDate'],
            'UnberthingEndDate' => ['nullable', 'date', 'after_or_equal:UnberthingStartDate'],
            'UnberthingStartTime' => ['nullable', 'date_format:H:i'],
            'UnberthingEndTime' => ['nullable', 'date_format:H:i'],
            'UnberthingDeployedVessel1' => ['nullable', 'string', 'max:255'],
            'UnberthingDeployedVessel2' => ['nullable', 'string', 'max:255'],
            'UnberthingDeployedVessel3' => ['nullable', 'string', 'max:255'],
            'ShiftingStartDate' => ['nullable', 'date', 'required_with:ShiftingEndDate'],
            'ShiftingEndDate' => ['nullable', 'date', 'after_or_equal:ShiftingStartDate'],
            'ShiftingStartTime' => ['nullable', 'date_format:H:i'],
            'ShiftingEndTime' => ['nullable', 'date_format:H:i'],
            'ShiftingDeployedVessel1' => ['nullable', 'string', 'max:255'],
            'ShiftingDeployedVessel2' => ['nullable', 'string', 'max:255'],
            'ShiftingDeployedVessel3' => ['nullable', 'string', 'max:255'],
        ];
    }
}