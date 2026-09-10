<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfficerOnDutyReportController extends Controller
{
    private function attributes(Request $request): array
    {
        $data = ['Supervisor' => $request->input('Supervisor'), 'Remarks' => $request->input('Remarks'), 'Date' => $request->input('Date'), 'DateIn' => now()->toDateString(), 'TimeIn' => now()->format('H:i')];
        for ($index = 1; $index <= 7; $index++) {
            $suffix = $index === 1 ? '' : $index;
            foreach (['Name', 'Morning', 'Afternoon', 'Night'] as $field) {
                $key = $field . $suffix;
                $data[$key] = $field === 'Name' ? $request->input($key) : ($request->input($key, 'No'));
            }
        }
        for ($index = 1; $index <= 7; $index++) {
            $suffix = $index === 1 ? '' : $index;
            $field = 'Signature' . $suffix;
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('officer-signatures', 'public');
            }
        }
        return $data;
    }

    public function add_officer_on_duty_report(Request $request, ?string $Id = null)
    {
        $attributes = $this->attributes($request);
        DB::table('officer_on_duty_reports')->insert($attributes);
        $this->notifyReport($attributes['Supervisor'] ?: 'All vessels', 'Create', 'Officers On Duty Report Created!', 'A watchkeeping report was created by ' . ($attributes['Supervisor'] ?: $request->input('DoneBy', 'a user')) . ' for ' . $attributes['Date'] . '.');
        return back();
    }

    public function edit_officer_on_duty_report(Request $request, string $Id)
    {
        $attributes = $this->attributes($request);
        DB::table('officer_on_duty_reports')->where('id', $Id)->update($attributes);
        $this->notifyReport($attributes['Supervisor'] ?: 'All vessels', 'Update', 'Officers On Duty Report Updated!', 'A watchkeeping report was updated by ' . ($attributes['Supervisor'] ?: $request->input('DoneBy', 'a user')) . ' for ' . $attributes['Date'] . '.');
        return back();
    }

    private function validationRules(): array
    {
        $rules = ['Supervisor' => ['nullable', 'string', 'max:255'], 'Date' => ['required', 'date']];
        foreach (range(1, 7) as $index) {
            $suffix = $index === 1 ? '' : $index;
            $rules['Signature' . $suffix] = ['nullable', 'image', 'max:5120'];
        }
        return $rules;
    }

    public function delete_officer_on_duty_report(string $Id)
    {
        $report = DB::table('officer_on_duty_reports')->where('id', $Id)->first();
        if ($report) {
            $this->notifyReport($report->Supervisor ?: 'All vessels', 'Delete', 'Officers On Duty Report Removed!', 'A watchkeeping report for ' . $report->Date . ' was deleted.');
        }
        DB::table('officer_on_duty_reports')->where('id', $Id)->delete();
        return back();
    }
}