@php
    $statuses = ['DOCKING', 'BUNKERY', 'INSPECTION', 'MAINTENANCE', 'BREAKDOWN', 'IDLE'];
    $statusRows = $availabilityStatsByVessel->get($Vessel->VesselName, collect())->groupBy('Status');
    $minutesByStatus = [];
    $hoursByStatus = [];
    $daysByStatus = [];

    foreach ($statuses as $status) {
        $minutesByStatus[$status] = 0;
        $hoursByStatus[$status] = 0;
        $daysByStatus[$status] = 0;

        foreach ($statusRows->get($status, collect()) as $period) {
            $start = \Carbon\Carbon::parse(($period->StartDate ?? date('Y-m-d')) . ' ' . ($period->StartTime ?? '00:00'));
            $end = \Carbon\Carbon::parse(($period->EndDate ?? date('Y-m-d')) . ' ' . ($period->EndTime ?? '00:00'));
            $minutesByStatus[$status] += $end->diffInMinutes($start);
            $hoursByStatus[$status] += $end->diffInHours($start);
            $daysByStatus[$status] += $end->diffInDays($start);
        }
    }

    $totalMinutes = array_sum($minutesByStatus);
    $vesselComment = $availabilityLatestCommentsByVessel->get($Vessel->VesselName);
    $statusHours = function ($status) use ($hoursByStatus) {
        return round(\Carbon\CarbonInterval::hours($hoursByStatus[$status])->totalDays);
    };
    $statusPercentage = function ($status) use ($minutesByStatus, $totalMinutes) {
        return round(($minutesByStatus[$status] / max($totalMinutes, 1)) * 100, 2);
    };
    $statusDuration = function ($status) use ($hoursByStatus, $minutesByStatus) {
        return $hoursByStatus[$status] === 0
            ? round($minutesByStatus[$status] / 60, 2) . ' min(s)'
            : $hoursByStatus[$status] . ' hour(s)';
    };
@endphp
<span class="Hide">{{ $Vessel->VesselName }}</span>
<span class="Hide">{{ $statusHours('DOCKING') }}</span>
<span class="Hide">{{ $statusHours('BUNKERY') }}</span>
<span class="Hide">{{ $statusHours('INSPECTION') }}</span>
<span class="Hide">{{ $statusHours('MAINTENANCE') }}</span>
<span class="Hide">{{ $statusHours('BREAKDOWN') }}</span>
<span class="Hide">{{ $statusPercentage('DOCKING') }}</span>
<span class="Hide">{{ $statusPercentage('BUNKERY') }}</span>
<span class="Hide">{{ $statusPercentage('INSPECTION') }}</span>
<span class="Hide">{{ $statusPercentage('MAINTENANCE') }}</span>
<span class="Hide">{{ $statusPercentage('BREAKDOWN') }}</span>
<span class="Hide">{{ $vesselComment->Comment ?? 'Vessel is on ' . (strtolower($Availability_STATUS->Status ?? 'operation') == 'idle' ? 'operation' : strtolower($Availability_STATUS->Status ?? 'operation')) }}</span>
<span class="Hide">{{ strtolower($Availability_STATUS->Status ?? 'idle') }}</span>
<span class="Hide">{{ $statusDuration('DOCKING') }}</span>
<span class="Hide">{{ $statusDuration('BUNKERY') }}</span>
<span class="Hide">{{ $statusDuration('INSPECTION') }}</span>
<span class="Hide">{{ $statusDuration('MAINTENANCE') }}</span>
<span class="Hide">{{ $statusDuration('BREAKDOWN') }}</span>
<span class="Hide">{{ $statusHours('IDLE') }}</span>
<span class="Hide">{{ $statusPercentage('IDLE') }}</span>
<span class="Hide">{{ $statusDuration('IDLE') }}</span>
