<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfficerOnDutyReportController extends Controller
{
    private function attributes(Request $request): array
    {
        $data = ['Remarks' => $request->input('Remarks'), 'Date' => $request->input('Date'), 'DateIn' => now()->toDateString(), 'TimeIn' => now()->format('H:i')];
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
        $request->validate($this->validationRules());
        DB::table('officer_on_duty_reports')->insert($this->attributes($request));
        return back();
    }

    public function edit_officer_on_duty_report(Request $request, string $Id)
    {
        $request->validate($this->validationRules());
        DB::table('officer_on_duty_reports')->where('id', $Id)->update($this->attributes($request));
        return back();
    }

    private function validationRules(): array
    {
        $rules = ['Date' => ['required', 'date']];
        foreach (range(1, 7) as $index) {
            $suffix = $index === 1 ? '' : $index;
            $rules['Signature' . $suffix] = ['nullable', 'image', 'max:5120'];
        }
        return $rules;
    }

    public function delete_officer_on_duty_report(string $Id)
    {
        DB::table('officer_on_duty_reports')->where('id', $Id)->delete();
        return back();
    }
}