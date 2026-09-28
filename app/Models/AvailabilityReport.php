<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvailabilityReport extends Model
{
    protected $fillable = [
        'ReportType', 'PersonVesselInvolved', 'NatureOf', 'Location', 'AidRequired',
        'SalvageTugs', 'Name', 'VesselOffice', 'Admission', 'DepartureTime',
        'ArrivalTime', 'Vessel', 'NoOfJobs', 'NavyJobs', 'Tugs', 'Date', 'Time',
        'DoneBy', 'Remarks',
    ];
}
