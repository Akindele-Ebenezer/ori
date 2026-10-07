<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvailabilityReport extends Model
{
    protected $fillable = [
        'ReportType', 'PersonVesselInvolved', 'NatureOf', 'Location', 'AidRequired',
        'SalvageTugs', 'Name', 'VesselOffice', 'Admission', 'DepartureTime',
        'ArrivalTime', 'Vessel', 'NoOfJobs', 'NavyJobs', 'Tugs', 'Type', 'Office',
        'Driver', 'Lodging', 'RecordingCapacity',
        'Positioning', 'Correction', 'From', 'To', 'Date', 'Time',
        'DoneBy', 'Remarks',
    ];
}
