<?php

namespace App\Http\Controllers;

use App\Models\AvailabilityReport;
use Illuminate\Http\Request;

class AvailabilityReportController extends Controller
{
    private const FIELDS_BY_TYPE = [
        'incident' => ['PersonVesselInvolved', 'NatureOf', 'Location', 'AidRequired', 'SalvageTugs'],
        'hospital' => ['Name', 'VesselOffice', 'Admission', 'DepartureTime', 'ArrivalTime'],
        'tugs' => ['Vessel', 'NoOfJobs', 'NavyJobs', 'Tugs'],
    ];

    public function store(Request $request, string $type)
    {
        abort_unless(isset(self::FIELDS_BY_TYPE[$type]), 404);
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
            $isRequired = $creating && ($type !== 'hospital' || in_array($field, ['Name', 'VesselOffice'], true));
            $rules[$field] = [$isRequired ? 'required' : 'nullable', 'string', 'max:255'];
        }
        $rules['Date'] = ['required', 'date'];
        $rules['Time'] = ['required', 'date_format:H:i'];
        $rules['DoneBy'] = ['required', 'string', 'max:255'];
        $rules['Remarks'] = ['nullable', 'string'];

        return $rules;
    }
}
