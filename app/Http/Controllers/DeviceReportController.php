<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeviceReportController extends Controller
{
    private const DEVICE_FIELDS = ['VhfBaseRadio', 'VhfHandHeld', 'Ais', 'VhfRecorder', 'WindDetector', 'StormDetector', 'ComputerSystem', 'PublicAddressSystem', 'FireAlarmSystem', 'VoltageRegulator', 'VhfRepeater', 'MobilePhone', 'Intercomm', 'CCTV', 'Internet'];

    private function attributes(Request $request): array
    {
        $data = ['DoneBy' => $request->input('DoneBy'), 'Remarks' => $request->input('Remarks'), 'Date' => $request->input('Date'), 'DateIn' => now()->toDateString(), 'TimeIn' => now()->format('H:i')];
        foreach (self::DEVICE_FIELDS as $field) {
            $data[$field] = $request->input($field, 'No');
        }
        return $data;
    }

    public function add_device_report(Request $request, ?string $Id = null)
    {
        $attributes = $this->attributes($request);
        DB::table('device_reports')->insert($attributes);
        $this->notifyReport('MOC Office', 'Create', 'Devices Report Created!', $attributes['DoneBy'] . ' created a devices report for ' . $attributes['Date'] . '.');
        return back();
    }

    public function edit_device_report(Request $request, string $Id)
    {
        $attributes = $this->attributes($request);
        DB::table('device_reports')->where('id', $Id)->update($attributes);
        $this->notifyReport('MOC Office', 'Update', 'Devices Report Updated!', $attributes['DoneBy'] . ' updated a devices report for ' . $attributes['Date'] . '.');
        return back();
    }

    public function delete_device_report(string $Id)
    {
        $report = DB::table('device_reports')->where('id', $Id)->first();
        if ($report) {
            $this->notifyReport('MOC Office', 'Delete', 'Devices Report Removed!', ($report->DoneBy ?: 'A user') . ' deleted the devices report dated ' . $report->Date . '.');
        }
        DB::table('device_reports')->where('id', $Id)->delete();
        return back();
    }
}