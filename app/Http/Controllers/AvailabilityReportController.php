<?php

namespace App\Http\Controllers;

use App\Models\AvailabilityReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AvailabilityReportController extends Controller
{
    private const FIELDS_BY_TYPE = [
        'incident' => ['PersonVesselInvolved', 'NatureOf', 'Location', 'AidRequired', 'SalvageTugs'],
        'hospital' => ['Name', 'VesselOffice', 'Admission', 'DepartureTime', 'ArrivalTime'],
        'tugs' => ['Vessel', 'NoOfJobs', 'NavyJobs', 'Tugs'],
        'cctv' => ['Vessel', 'RecordingCapacity', 'Positioning', 'Correction', 'From', 'To'],
    ];

    public function store(Request $request, string $type)
    {
        abort_unless(isset(self::FIELDS_BY_TYPE[$type]), 404);
        if ($type === 'cctv') {
            $data = $request->validate([
                'vessels' => ['required', 'array', 'min:1'],
                'vessels.*.Vessel' => ['required', 'string', 'distinct', 'exists:vessels_vessel_information,VesselName'],
                'vessels.*.RecordingCapacity' => ['required', 'string', 'max:255'],
                'vessels.*.Positioning' => ['required', 'in:OK,NOT OK'],
                'vessels.*.Correction' => ['required', 'in:OK,NOT OK'],
                'vessels.*.From' => ['required', 'string', 'max:255'],
                'vessels.*.To' => ['required', 'string', 'max:255'],
                'Date' => ['required', 'date'],
                'DoneBy' => ['required', 'string', 'max:255'],
                'Remarks' => ['nullable', 'string'],
            ]);

            $reports = DB::transaction(function () use ($data) {
                return collect($data['vessels'])->map(fn (array $vessel) => AvailabilityReport::create([
                    'ReportType' => 'cctv',
                    'Vessel' => $vessel['Vessel'],
                    'RecordingCapacity' => $vessel['RecordingCapacity'],
                    'Positioning' => $vessel['Positioning'],
                    'Correction' => $vessel['Correction'],
                    'From' => $vessel['From'],
                    'To' => $vessel['To'],
                    'Date' => $data['Date'],
                    'DoneBy' => $data['DoneBy'],
                    'Remarks' => $data['Remarks'] ?? null,
                ]))->all();
            });

            foreach ($reports as $report) {
                $this->notifyReport($report->Vessel, 'Create', 'CCTV Positioning Created!', $data['DoneBy'] . ' created a CCTV positioning record for ' . $report->Vessel . ' dated ' . $data['Date'] . '.');
            }

            return back();
        }

        $rules = $this->rulesForType($type, true);
        $data = $request->validate($rules);
        $data['ReportType'] = $type;
        AvailabilityReport::create($data);

        $this->notifyReport($data['Vessel'] ?? $data['PersonVesselInvolved'] ?? 'Availability', 'Create', 'Availability Report Created!', ($data['DoneBy'] ?? 'A user') . ' created a ' . $type . ' report.');
        return back();
    }

    public function update(Request $request, string $type, int $id)
    {
        abort_unless(isset(self::FIELDS_BY_TYPE[$type]), 404);
        $data = $request->validate($this->rulesForType($type, false));
        $report = AvailabilityReport::where('ReportType', $type)->findOrFail($id);
        $report->update($data);
        $this->notifyReport($report->Vessel ?: $report->PersonVesselInvolved ?: 'Availability', 'Update', 'Availability Report Updated!', ($report->DoneBy ?: 'A user') . ' updated a ' . $report->ReportType . ' report.');
        return back();
    }

    public function destroy(string $type, int $id)
    {
        abort_unless(isset(self::FIELDS_BY_TYPE[$type]), 404);
        $report = AvailabilityReport::where('ReportType', $type)->findOrFail($id);
        $this->notifyReport($report->Vessel ?: $report->PersonVesselInvolved ?: 'Availability', 'Delete', 'Availability Report Removed!', ($report->DoneBy ?: 'A user') . ' deleted a ' . $report->ReportType . ' report.');
        $report->delete();
        return back();
    }

    private function rulesForType(string $type, bool $creating): array
    {
        abort_unless(isset(self::FIELDS_BY_TYPE[$type]), 404);
        $rules = [];
        foreach (self::FIELDS_BY_TYPE[$type] as $field) {
            $isRequired = $type === 'cctv' || ($creating && ($type !== 'hospital' || in_array($field, ['Name', 'VesselOffice'], true)));
            $rules[$field] = [$isRequired ? 'required' : 'nullable', 'string', 'max:255'];
        }
        if ($type === 'cctv') {
            $rules['Positioning'] = ['required', 'in:OK,NOT OK'];
            $rules['Correction'] = ['required', 'in:OK,NOT OK'];
        }
        if ($type === 'tugs') {
            $rules['NoOfJobs'] = ['required', 'integer', 'min:0'];
        }
        $rules['Date'] = ['required', 'date'];
        $rules['Time'] = [$type === 'cctv' ? 'nullable' : 'required', 'date_format:H:i'];
        $rules['DoneBy'] = ['required', 'string', 'max:255'];
        $rules['Remarks'] = ['nullable', 'string'];

        return $rules;
    }
}
