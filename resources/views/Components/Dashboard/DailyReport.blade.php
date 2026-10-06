@php
    $dailyReports = collect($DailyReports ?? []);
    $radioBroadcasts = collect($RadioBroadcastReports ?? []);
    $deviceLogs = collect($DeviceReports ?? []);
    $periodicChecks = collect($PeriodicCheckReports ?? []);
    $officerLogs = collect($OfficerOnDutyReports ?? []);
    $otherLogs = collect($OtherReports ?? []);
    $availabilityReports = collect($AvailabilityReports ?? []);
    $incidentReports = $availabilityReports->filter(fn ($report) => strtolower((string) ($report->ReportType ?? '')) === 'incident');
    $hospitalReports = $availabilityReports->filter(fn ($report) => strtolower((string) ($report->ReportType ?? '')) === 'hospital');
    $tugsReports = $availabilityReports->filter(fn ($report) => strtolower((string) ($report->ReportType ?? '')) === 'tugs');
    $cctvReports = $availabilityReports->filter(fn ($report) => strtolower((string) ($report->ReportType ?? '')) === 'cctv');
    $tugJobCounts = $tugsReports
        ->filter(fn ($report) => trim((string) ($report->Tugs ?? '')) !== '')
        ->groupBy(fn ($report) => strtoupper(trim((string) $report->Tugs)))
        ->map(fn ($reports) => $reports->sum(fn ($report) => is_numeric($report->NoOfJobs ?? null) ? (int) $report->NoOfJobs : 0))
        ->sortDesc();
    $maxTugJobs = max(1, (int) $tugJobCounts->max());
    $tugJobTotal = (int) $tugJobCounts->sum();
    $officerCount = $officerLogs->sum(function ($log) {
        return collect(range(1, 7))->filter(function ($index) use ($log) {
            $suffix = $index === 1 ? '' : $index;
            return !empty($log->{'Name' . $suffix});
        })->count();
    });

    $today = date('Y-m-d');
    $statusColors = [
        'DEPARTURE' => 'status-coral',
        'ARRIVAL' => 'status-blue',
        'BERTHING' => 'status-teal',
        'UNBERTHING' => 'status-coral',
        'SHIFTING' => 'status-amber',
        'DISEMBARKATION' => 'status-teal',
        'EMBARKATION' => 'status-green',
        'INSPECTION' => 'status-amber',
        'DRILL' => 'status-violet',
        'DIVE CHECK' => 'status-violet',
        'WEATHER BROADCAST' => 'status-blue',
        'DOCKING' => 'status-blue',
        'MAINTENANCE' => 'status-green',
        'BREAKDOWN' => 'status-red',
        'BUNKERY' => 'status-teal',
        'IDLE' => 'status-slate',
    ];

    $movementFields = [
        'BERTHING' => ['BerthingStartDate', 'BerthingEndDate', 'BerthingStartTime', 'BerthingEndTime', 'BerthingDate', 'BerthingTime', 'BerthingDeployedVessel1', 'BerthingDeployedVessel2', 'BerthingDeployedVessel3'],
        'UNBERTHING' => ['UnberthingStartDate', 'UnberthingEndDate', 'UnberthingStartTime', 'UnberthingEndTime', 'UnberthingDate', 'UnberthingTime', 'UnberthingDeployedVessel1', 'UnberthingDeployedVessel2', 'UnberthingDeployedVessel3'],
        'SHIFTING' => ['ShiftingStartDate', 'ShiftingEndDate', 'ShiftingStartTime', 'ShiftingEndTime', 'ShiftingDate', 'ShiftingTime', 'ShiftingDeployedVessel1', 'ShiftingDeployedVessel2', 'ShiftingDeployedVessel3'],
    ];
    $statusCounts = $dailyReports->filter(fn ($report) => !in_array(strtoupper($report->Status ?? ''), array_keys($movementFields), true))
        ->groupBy(fn ($report) => strtoupper($report->Status ?? 'UNSPECIFIED'))
        ->map(fn ($reports) => $reports->count())
        ->sortDesc();
    foreach ($movementFields as $movement => $fields) {
        $count = $dailyReports->filter(function ($report) use ($movement, $fields) {
            return strtoupper($report->Status ?? '') === $movement
                || collect($fields)->contains(fn ($field) => !empty($report->{$field}));
        })->count();
        if ($count > 0) $statusCounts->put($movement, $count);
    }
    $statusCounts = $statusCounts->sortDesc();
    $statusAllocationTotal = max(1, (int) $statusCounts->sum());

    $activeReports = $dailyReports->filter(fn ($report) => ($report->TillNow ?? '') === 'YES' || ($report->EndDate ?? '') >= $today)->count();
    $uniqueVessels = $dailyReports->pluck('Vessel')->filter()->unique()->count();
    $dateLabel = $dailyReports->pluck('StartDate')->filter()->sortDesc()->first();
    $totalLogs = $dailyReports->count() + $radioBroadcasts->count() + $deviceLogs->count() + $periodicChecks->count() + $officerLogs->count() + $otherLogs->count() + $availabilityReports->count();

    $displayDate = function ($date) {
        if (!$date) return 'Not set';
        try {
            return \Carbon\Carbon::parse($date)->format('d M Y');
        } catch (\Throwable $e) {
            return $date;
        }
    };

    $displayTime = function ($time) {
        if (!$time) return '--:--';
        try {
            return \Carbon\Carbon::parse($time)->format('H:i');
        } catch (\Throwable $e) {
            return $time;
        }
    };

    $displayCall = function ($value) {
        return $value === 'Yes' ? 'Done' : ($value === 'No' || !$value ? '--:--' : $value);
    };
@endphp
<div class="DailyVesselOperations">
    <section class="ori-deck" data-daily-report-dashboard>
        <p class="deck-close" title="Close Dashboard">✖</p>
        
        <!-- Header Section -->
        <header class="deck-hero">
            <div>
                <div class="deck-eyebrow">Fleet Intelligence Console</div>
                <h1>Daily Vessel Operations</h1>
                <p>Real-time telemetry, watchkeeping logs, equipment diagnostics, and active status tracking.</p>
            </div>
            <div class="deck-date-pill">
                <small>Active Log Window</small> 
                <strong>
                    @if(
                        request()->filled('FromDate_DAILYREPORTFILTER') &&
                        request()->filled('EndDate_DAILYREPORTFILTER')
                    )
                        {{ 'From ' . request('FromDate_DAILYREPORTFILTER') . ' to ' . request('EndDate_DAILYREPORTFILTER') }}
                    @elseif(request()->filled('DailyReportFilter_SpecificDay'))
                        {{ 'For ' . request('DailyReportFilter_SpecificDay') }}
                    @else
                        TODAY · {{ $today }}
                    @endif
                </strong>
                <button class="DailyReportFilterButton">+ Filter Daily Reports</button>
            </div>
        </header>

        <!-- Top Line Telemetry Metrics -->
        <div class="deck-metrics">
            <div class="deck-card-metric">
                <span class="deck-card-metric-label">Daily Reports</span>
                <span class="deck-card-metric-value">{{ $dailyReports->count() }}</span>
                <span class="deck-card-metric-note">Logged Entries Today</span>
            </div>
            <div class="deck-card-metric">
                <span class="deck-card-metric-label">Active Vessels</span>
                <span class="deck-card-metric-value">{{ $uniqueVessels }}</span>
                <span class="deck-card-metric-note">Tracked Fleet Units</span>
            </div>
            <div class="deck-card-metric">
                <span class="deck-card-metric-label">Ongoing Tasks</span>
                <span class="deck-card-metric-value">{{ $activeReports }}</span>
                <span class="deck-card-metric-note">Till-Now Operations</span>
            </div>
            <div class="deck-card-metric">
                <span class="deck-card-metric-label">Total Submissions</span>
                <span class="deck-card-metric-value">{{ $totalLogs }}</span>
                <span class="deck-card-metric-note">Across 6 Log Classes</span>
            </div>
        </div>

        <!-- Main Activity Section -->
        <div class="deck-main-layout">
            <section class="deck-panel">
                <div class="deck-panel-head">
                    <div>
                        <h2>Vessel Operational Logbook</h2>
                        <span>Showing <strong data-report-visible-count>{{ $dailyReports->count() }}</strong> of {{ $dailyReports->count() }} vessel movements & activities</span>
                    </div>
                    <input class="deck-search" type="search" placeholder="Search vessel, officer, status..." data-report-search aria-label="Search vessel logs">
                </div>

                @if ($dailyReports->isEmpty())
                    <div style="padding: 4rem; text-align: center; color: var(--text-muted);">
                        <svg style="width: 48px; height: 48px; margin: 0 auto 1rem auto; opacity: 0.5;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <strong style="display: block; font-size: 1.125rem; color: var(--text-main);">No Operational Records Found</strong>
                        <p style="margin-top: 0.5rem; font-size: 0.875rem;">Vessel activities submitted today will automatically display here.</p>
                    </div>
                @else
                    <div class="deck-table-wrap">
                        <table class="deck-table">
                            <thead>
                                <tr>
                                    <th>Vessel Details</th>
                                    <th>Status</th>
                                    <th>Duty Officer</th>
                                    <th>Schedule & Movement</th>
                                    <th>Remarks & Notes</th>
                                </tr>
                            </thead>
                            <tbody data-report-list>
                                @foreach ($dailyReports as $report)
                                    @php
                                        $status = strtoupper($report->Status ?? 'UNSPECIFIED');
                                        $statusClass = $statusColors[$status] ?? 'status-slate';
                                        $remarks = $report->Remarks ?? $report->Comment ?? '';
                                        $deployedVessels = collect([
                                            $report->DeployedVessel1 ?? null,
                                            $report->DeployedVessel2 ?? null,
                                            $report->DeployedVessel3 ?? null,
                                        ])->filter()->implode(', ');
                                        $berthingVessels = collect([$report->BerthingDeployedVessel1 ?? null, $report->BerthingDeployedVessel2 ?? null, $report->BerthingDeployedVessel3 ?? null])->filter()->implode(', ');
                                        $unberthingVessels = collect([$report->UnberthingDeployedVessel1 ?? null, $report->UnberthingDeployedVessel2 ?? null, $report->UnberthingDeployedVessel3 ?? null])->filter()->implode(', ');
                                        $shiftingVessels = collect([$report->ShiftingDeployedVessel1 ?? null, $report->ShiftingDeployedVessel2 ?? null, $report->ShiftingDeployedVessel3 ?? null])->filter()->implode(', ');
                                    @endphp
                                    <tr data-report-row data-report="{{ base64_encode(json_encode($report)) }}" data-search-value="{{ strtolower(($report->Vessel ?? '') . ' ' . ($report->DeployedVessel1 ?? '') . ' ' . ($report->DeployedVessel2 ?? '') . ' ' . ($report->DeployedVessel3 ?? '') . ' ' . $berthingVessels . ' ' . $unberthingVessels . ' ' . $shiftingVessels . ' ' . $status . ' ' . ($report->DoneBy ?? '') . ' ' . $remarks) }}">
                                        <td>
                                            <span class="deck-vessel-title">{{ $report->Vessel ?? 'Unnamed Vessel' }}</span>
                                            <span class="deck-sub-text">Deployed: {{ $deployedVessels ?: 'None' }}</span>
                                            <span class="deck-sub-text" style="color: {{ $report->TillNow === 'YES' ? 'var(--accent-primary)' : 'inherit' }}">{{ $report->TillNow === 'YES' ? '⚡ Ongoing Event' : 'Scheduled Entry' }}</span>
                                        </td>
                                        <td>
                                            <span class="status-pill {{ $statusClass }}">{{ $status }}</span>
                                        </td>
                                        <td>
                                            <strong style="font-weight: 600; color: var(--text-main);">{{ $report->DoneBy ?? 'Unassigned' }}</strong>
                                        </td>
                                        <td>
                                            <div style="font-weight: 500;">{{ $displayDate($report->StartDate ?? null) }}</div>
                                            <span class="deck-sub-text">{{ $displayTime($report->StartTime ?? null) }} — {{ $displayTime($report->EndTime ?? null) }}</span>
                                            @if (!empty($report->BerthingStartDate) || !empty($report->BerthingEndDate) || !empty($report->BerthingStartTime) || !empty($report->BerthingEndTime) || !empty($report->BerthingDate) || !empty($report->BerthingTime) || $berthingVessels)
                                                <span class="deck-sub-text">Berthing: {{ $displayDate($report->BerthingStartDate ?? $report->BerthingDate ?? null) }} — {{ $displayDate($report->BerthingEndDate ?? null) }} · {{ $displayTime($report->BerthingStartTime ?? $report->BerthingTime ?? null) }} — {{ $displayTime($report->BerthingEndTime ?? null) }}{{ $berthingVessels ? ' · ' . $berthingVessels : '' }}</span>
                                            @endif
                                            @if (!empty($report->UnberthingStartDate) || !empty($report->UnberthingEndDate) || !empty($report->UnberthingStartTime) || !empty($report->UnberthingEndTime) || !empty($report->UnberthingDate) || !empty($report->UnberthingTime) || $unberthingVessels)
                                                <span class="deck-sub-text">Unberthing: {{ $displayDate($report->UnberthingStartDate ?? $report->UnberthingDate ?? null) }} — {{ $displayDate($report->UnberthingEndDate ?? null) }} · {{ $displayTime($report->UnberthingStartTime ?? $report->UnberthingTime ?? null) }} — {{ $displayTime($report->UnberthingEndTime ?? null) }}{{ $unberthingVessels ? ' · ' . $unberthingVessels : '' }}</span>
                                            @endif
                                            @if (!empty($report->ShiftingStartDate) || !empty($report->ShiftingEndDate) || !empty($report->ShiftingStartTime) || !empty($report->ShiftingEndTime) || !empty($report->ShiftingDate) || !empty($report->ShiftingTime) || $shiftingVessels)
                                                <span class="deck-sub-text">Shifting: {{ $displayDate($report->ShiftingStartDate ?? $report->ShiftingDate ?? null) }} — {{ $displayDate($report->ShiftingEndDate ?? null) }} · {{ $displayTime($report->ShiftingStartTime ?? $report->ShiftingTime ?? null) }} — {{ $displayTime($report->ShiftingEndTime ?? null) }}{{ $shiftingVessels ? ' · ' . $shiftingVessels : '' }}</span>
                                            @endif
                                        </td>
                                        <td style="color: var(--text-muted); max-width: 250px;">
                                            {{ str_ireplace(['merchant', 'marchant'], 'MARCHANT', $remarks ?: 'None') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                <section class="tug-assignments-insight" aria-labelledby="tug-assignments-heading">
                    <div class="tug-jobs-heading">
                        <div class="tug-jobs-copy">
                            <h3 id="tug-assignments-heading">Tug Assignments</h3>
                            <p class="tug-jobs-caption">Jobs by tug, compared with the busiest tug.</p>
                        </div>
                        <div class="tug-jobs-total">
                            <strong>{{ number_format($tugJobTotal) }}</strong>
                            <span>Total jobs</span>
                        </div>
                    </div>
                    @if ($tugJobCounts->isNotEmpty())
                        <div class="tug-jobs-legend" aria-label="Bar color thresholds">
                            <span class="tug-jobs-legend-item"><i class="tug-jobs-swatch tug-jobs-swatch--low" aria-hidden="true"></i>Low <small>0-25%</small></span>
                            <span class="tug-jobs-legend-item"><i class="tug-jobs-swatch tug-jobs-swatch--medium" aria-hidden="true"></i>Medium <small>26-50%</small></span>
                            <span class="tug-jobs-legend-item"><i class="tug-jobs-swatch tug-jobs-swatch--high" aria-hidden="true"></i>High <small>51-99%</small></span>
                            <span class="tug-jobs-legend-item"><i class="tug-jobs-swatch tug-jobs-swatch--full" aria-hidden="true"></i>Full <small>100%</small></span>
                        </div>
                        <ol class="tug-jobs-list" aria-label="Job counts by tug">
                            @foreach ($tugJobCounts as $tug => $jobs)
                                @php
                                    $jobPercentage = (int) round(($jobs / $maxTugJobs) * 100);
                                    $jobLevel = $jobPercentage <= 25 ? 'low' : ($jobPercentage <= 50 ? 'medium' : ($jobPercentage < 100 ? 'high' : 'full'));
                                @endphp
                                <li class="tug-jobs-row">
                                    <div class="tug-jobs-meta">
                                        <div class="tug-jobs-name">
                                            <span class="tug-jobs-rank" aria-hidden="true">{{ $loop->iteration }}</span>
                                            <span class="tug-jobs-label" title="{{ $tug }}">{{ $tug }}</span>
                                        </div>
                                        <strong>{{ number_format((int) $jobs) }} <span>jobs</span></strong>
                                    </div>
                                    <div class="tug-jobs-track tug-jobs-track--{{ $jobLevel }}" role="meter" aria-label="{{ $tug }} job count" aria-valuetext="{{ number_format((int) $jobs) }} jobs, {{ $jobPercentage }}% of busiest tug" aria-valuemin="0" aria-valuemax="100" aria-valuenow="{{ $jobPercentage }}">
                                        <span aria-hidden="true" style="width: {{ $jobPercentage }}%"></span>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    @else
                        <div class="tug-jobs-empty">No tug assignment data available.</div>
                    @endif
                </section>
            </section>

            <!-- Sidebar Analytics -->
            <aside style="display: flex; flex-direction: column; gap: 1.5rem;">
                <section class="deck-panel" style="padding: 1.5rem;">
                    <h2>Status Allocation</h2>
                    @forelse ($statusCounts as $status => $count)
                        @php 
                            $statusClass = $statusColors[$status] ?? 'status-slate'; 
                            $percentage = round(($count / $statusAllocationTotal) * 100);
                        @endphp
                        <div class="breakdown-row">
                            <div class="breakdown-meta">
                                <span>{{ $status }}</span>
                                <strong>{{ $count }} ({{ $percentage }}%)</strong>
                            </div>
                            <div class="breakdown-bar">
                                <div class="breakdown-fill {{ $statusClass }}" style="width: {{ $percentage }}%; background-color: currentColor;"></div>
                            </div>
                        </div>
                    @empty
                        <span class="deck-sub-text">No distribution metrics available.</span>
                    @endforelse
                </section>

                <section class="deck-panel" style="padding: 1.5rem; background: #f0fdfa; border-color: #ccfbf1; border-left: 4px solid #0d9488;">
                    <strong style="color: #0f766e; display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.75rem; font-size: 0.9rem;">
                        <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Operations Briefing
                    </strong>
                    <p style="font-size: 0.875rem; color: #134e4a; margin: 0; line-height: 1.6;">
                        Verify active till-now events with bridge staff before watch handover. Ensure VHF check logs correspond to high-traffic departure windows.
                    </p>
                </section>
            </aside>
        </div>

        <!-- Log Grid Breakdown -->
        <div class="deck-log-grid">
            <!-- Radio Broadcasts -->
            <section class="deck-log-panel">
                <div class="deck-panel-head">
                    <div>
                        <h2>Radio Communications Log</h2>
                        <span>
                            Showing
                            <strong data-report-visible-count>
                                {{ $radioBroadcasts->filter(fn ($log) => $log->VesselType != 'FUEL STATION')->count() }}
                            </strong>
                            of
                            {{ $radioBroadcasts->filter(fn ($log) => $log->VesselType != 'FUEL STATION')->count() }} Entries
                        </span>
                    </div>
                    <input class="radio-communications-search" type="search" placeholder="Search logs..." data-report-search aria-label="Search vessel radio communications">
                </div>
                <ul class="deck-log-list">
                    @foreach ($radioBroadcasts as $log)
                        @if ($log->VesselType != 'FUEL STATION')
                            <li
                                data-report-row
                                class="deck-log-item"
                                data-search-value="{{ strtolower(trim(
                                    ($log->Vessel ?? '') . ' ' .
                                    ($log->DoneBy ?? '') . ' ' .
                                    (data_get($log, 'Remarks_') ?: data_get($log, 'Remarks', '')) . ' ' .
                                    ($log->Date ?? '') . ' ' .
                                    '1st ' . $displayCall($log->FirstCallTime ?? '') . ' ' .
                                    '2nd ' . $displayCall($log->SecondCallTime ?? '') . ' ' .
                                    'responders ' . ($log->Responders ?? '')
                                )) }}"
                            >
                                <div>
                                    <span class="deck-vessel-title">{{ $log->Vessel }}</span>
                                    <span class="deck-sub-text">{{ $log->DoneBy }} · {{ $displayDate($log->Date) }}</span>
                                </div>

                                <span style="font-size: 0.875rem; color: var(--text-muted);">
                                    {{ data_get($log, 'Remarks_') ?: data_get($log, 'Remarks', 'None') }}
                                </span>

                                <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                    <span class="status-pill {{ ($log->FirstCallTime ?? '') === 'No' ? 'status-red' : 'status-teal' }}">
                                        1st {{ $displayCall($log->FirstCallTime ?? '') }}
                                    </span>
                                    <span class="status-pill {{ ($log->SecondCallTime ?? '') === 'No' ? 'status-red' : 'status-blue' }}">
                                        2nd {{ $displayCall($log->SecondCallTime ?? '') }}
                                    </span>
                                    <span class="status-pill {{ ($log->Responders ?? '') === 'No' ? 'status-red' : 'status-violet' }}">
                                        Responders {{ $log->Responders ?? '' }}
                                    </span>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </section>

            <!-- Officers Watchkeeping Shift -->
            <section class="deck-log-panel">
                <div class="deck-panel-head">
                    <div>
                        <h2>Watchkeeping Roster</h2>
                        <span>{{ $officerCount }} Duty Officers</span>
                    </div>
                </div>
                <div class="shift-header">
                    <span>Officer / Role</span>
                    <span style="text-align: center;">Signature</span>
                    <span style="text-align: center;">Morning</span>
                    <span style="text-align: center;">Midday</span>
                    <span style="text-align: center;">Night</span>
                </div>
                @foreach ($officerLogs as $log)
                    @for ($index = 1; $index <= 7; $index++)
                        @php $suffix = $index === 1 ? '' : $index; $officerName = $log->{'Name' . $suffix}; @endphp
                        @if ($officerName)
                            <div class="shift-row">
                                <div>
                                    <span class="deck-vessel-title" style="font-size: 0.9rem;">{{ $officerName }}</span>
                                    <span class="deck-sub-text">{{ $displayDate($log->Date) }}</span>
                                </div>
                                @if ($log->{'Signature' . $suffix})
                                    <img src="{{ route('public.storage', ['path' => $log->{'Signature' . $suffix}]) }}" alt="{{ $officerName }} signature" style="display: block; width: 100%; max-width: 6rem; height: 2.5rem; object-fit: contain; margin: 0 auto; background: #fff; border-radius: 4px; border: 1px solid var(--border-dim);">
                                @else
                                    <span class="deck-sub-text" style="text-align: center; font-size: 0.75rem;">N/A</span>
                                @endif
                                <div class="shift-pill {{ $log->{'Morning' . $suffix} === 'Yes' ? 'active' : 'inactive' }}">{{ $log->{'Morning' . $suffix} === 'Yes' ? '✓' : '–' }}</div>
                                <div class="shift-pill {{ $log->{'Afternoon' . $suffix} === 'Yes' ? 'active' : 'inactive' }}">{{ $log->{'Afternoon' . $suffix} === 'Yes' ? '✓' : '–' }}</div>
                                <div class="shift-pill {{ $log->{'Night' . $suffix} === 'Yes' ? 'active' : 'inactive' }}">{{ $log->{'Night' . $suffix} === 'Yes' ? '✓' : '–' }}</div>
                            </div>
                        @endif
                    @endfor
                @endforeach
            </section>

            <!-- Bridge Equipment Health Check -->
            <section class="deck-log-panel full-width">
                <div class="deck-panel-head">
                    <div>
                        <h2>Bridge Equipment & Device Diagnostics</h2>
                        <span>{{ $deviceLogs->count() }} Active Inspection Batches</span>
                    </div>
                </div>
                @foreach ($deviceLogs as $log)
                    @php
                        $deviceFields = ['VhfBaseRadio', 'VhfHandHeld', 'Ais', 'VhfRecorder', 'WindDetector', 'StormDetector', 'ComputerSystem', 'PublicAddressSystem', 'FireAlarmSystem', 'VoltageRegulator', 'VhfRepeater', 'MobilePhone', 'Intercomm', 'CCTV', 'Internet'];
                        $workingDevices = collect($deviceFields)->filter(fn ($device) => $log->{$device} === 'Yes')->count();
                    @endphp
                    <div style="border-bottom: 1px solid var(--border-dim);">
                        <div class="deck-log-item" style="border-bottom: none; background: #f8fafc; grid-template-columns: 1fr;">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem;">
                                <div>
                                    <span class="deck-vessel-title">MOC OFFICE</span>
                                    <span class="deck-sub-text">Checked by {{ $log->DoneBy }} · {{ $displayDate($log->Date) }} {{ $displayTime($log->Time) }} HRS</span>
                                </div>
                                <span class="status-pill status-blue">{{ $workingDevices }} / {{ count($deviceFields) }} operational</span>
                            </div>
                            <span style="font-size: 0.875rem; color: var(--text-muted);">{{ $log->Remarks }}</span>
                        </div>
                        <div class="check-matrix">
                            @foreach ($deviceFields as $device)
                                @php $result = $log->{$device}; @endphp
                                @if ($device === 'CCTV')
                                <details class="check-badge cctv-location-popover">
                                    <summary>
                                        <span>CCTV</span>
                                        <strong class="{{ $result === 'Yes' ? 'pass' : 'fail' }}">{{ $result === 'Yes' ? 'OK' : 'FAIL' }}</strong>
                                    </summary>
                                    <div class="cctv-location-statuses">
                                        <div><span>Dockyard</span><strong class="{{ ($log->CCTVDockyard ?? 'No') === 'Yes' ? 'pass' : 'fail' }}">{{ ($log->CCTVDockyard ?? 'No') === 'Yes' ? 'OK' : 'FAIL' }}</strong></div>
                                        <div><span>Bullnose</span><strong class="{{ ($log->CCTVBullnose ?? 'No') === 'Yes' ? 'pass' : 'fail' }}">{{ ($log->CCTVBullnose ?? 'No') === 'Yes' ? 'OK' : 'FAIL' }}</strong></div>
                                    </div>
                                </details>
                                @else
                                <div class="check-badge">
                                    <span>{{ preg_replace('/(?<!^)([A-Z])/', ' $1', $device) }}</span>
                                    <strong class="{{ $result === 'Yes' ? 'pass' : 'fail' }}">{{ $result === 'Yes' ? 'OK' : 'FAIL' }}</strong>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </section>

            <!-- Periodic Checks -->
            <section class="deck-log-panel">
                <div class="deck-panel-head">
                    <div>
                        <h2>Periodic Checks</h2>
                        <span>{{ $periodicChecks->count() }} checks logged</span>
                    </div>
                </div>
                @forelse ($periodicChecks as $check)
                    <div class="deck-log-item" style="grid-template-columns: 1fr auto; align-items: center;">
                        <div>
                            <span class="deck-vessel-title">{{ $check->Equipment }} · {{ $check->Location }}</span>
                            <span class="deck-sub-text">{{ $check->Type }} · {{ $displayDate($check->Date) }} {{ $displayTime($check->Time) }} · {{ $check->DoneBy }}</span>
                        </div>
                        @if ($check->Remarks)
                            <span style="font-size: 0.875rem; color: var(--text-muted); background: #f1f5f9; padding: 0.5rem; border-radius: 4px; max-width: 200px; text-align: right;">{{ $check->Remarks }}</span>
                        @endif
                    </div>
                @empty
                    <div style="padding: 2rem; text-align: center; color: var(--text-muted);">
                        <span style="font-size: 0.875rem;">No periodic checks for this date range.</span>
                    </div>
                @endforelse
            </section>

            @php
                $availabilityTable = function ($reports, $title, $searchLabel, $columns) {
                    return compact('reports', 'title', 'searchLabel', 'columns');
                };
                $availabilityTables = [
                    $availabilityTable($incidentReports, 'Incident Reports', 'Search incident reports', [
                        'Person / Vessel Involved' => 'PersonVesselInvolved',
                        'Nature Of' => 'NatureOf',
                        'Location' => 'Location',
                        'Aid Required' => 'AidRequired',
                        'Salvage Tugs' => 'SalvageTugs',
                    ]),
                    $availabilityTable($hospitalReports, 'Hospital Reports', 'Search hospital reports', [
                        'Name' => 'Name',
                        'Vessel / Office' => 'VesselOffice',
                        'Admission' => 'Admission',
                        'Departure Time' => 'DepartureTime',
                        'Arrival Time' => 'ArrivalTime',
                    ]),
                    $availabilityTable($tugsReports, 'Tugs Reports', 'Search tugs reports', [
                        'Vessel' => 'Vessel',
                        'No. Of Jobs' => 'NoOfJobs',
                        'Navy Jobs' => 'NavyJobs',
                        'Tugs' => 'Tugs',
                    ]),
                    $availabilityTable($cctvReports, 'CCTV Positioning', 'Search CCTV positioning reports', [
                        'Vessel' => 'Vessel',
                        'Recording Capacity' => 'RecordingCapacity',
                        'Positioning' => 'Positioning',
                        'Correction' => 'Correction',
                        'From' => 'From',
                        'To' => 'To',
                    ]),
                ];
            @endphp

            @foreach ($availabilityTables as $availabilityTable)
                <section class="deck-log-panel full-width">
                    <div class="deck-panel-head">
                        <div>
                            <h2>{{ $availabilityTable['title'] }}</h2>
                            <span>Showing <strong data-report-visible-count>{{ $availabilityTable['reports']->count() }}</strong> of {{ $availabilityTable['reports']->count() }} Entries</span>
                        </div>
                        <input type="search" placeholder="{{ $availabilityTable['searchLabel'] }}" data-report-search aria-label="{{ $availabilityTable['searchLabel'] }}">
                    </div>
                    <div class="deck-table-wrap">
                        <table class="deck-table">
                            <thead>
                                <tr>
                                    @foreach ($availabilityTable['columns'] as $label => $field)
                                        <th>{{ $label }}</th>
                                    @endforeach
                                    <th>Date / Time</th>
                                    <th>Done By</th>
                                    <th>Remarks</th>
                                    <th style="visibility: hidden; width: 100px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($availabilityTable['reports'] as $report)
                                    @php
                                        $searchValue = strtolower(trim(collect($availabilityTable['columns'])->map(fn ($field) => $report->{$field} ?? '')->implode(' ') . ' ' . ($report->Date ?? '') . ' ' . ($report->Time ?? '') . ' ' . ($report->DoneBy ?? '') . ' ' . ($report->Remarks ?? '')));
                                    @endphp
                                    <tr
                                        data-report-row
                                        data-availability-report="{{ base64_encode(json_encode($report)) }}"
                                        data-search-value="{{ $searchValue }}"
                                    >
                                        @foreach ($availabilityTable['columns'] as $field)
                                            <td><strong>{{ $report->{$field} ?: 'None' }}</strong></td>
                                        @endforeach
                                        <td style="white-space: nowrap;">{{ $displayDate($report->Date) }} <br><span class="deck-sub-text" style="display:inline;">{{ $displayTime($report->Time) }}</span></td>
                                        <td>{{ $report->DoneBy ?: 'Unassigned' }}</td>
                                        <td style="color: var(--text-muted); max-width: 200px;">{{ $report->Remarks ?: 'None' }}</td>
                                        <td class="action" style="visibility: hidden">
                                            <div style="display: flex; gap: 0.25rem;">
                                                <button type="button" class="EditAvailabilityReportButton" data-report-type="{{ $report->ReportType }}">Edit</button>
                                                <button type="button" class="DeleteAvailabilityReportButton" data-report-type="{{ $report->ReportType }}">Del</button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ count($availabilityTable['columns']) + 4 }}" style="text-align: center; padding: 2rem; color: var(--text-muted);">
                                            No {{ strtolower($availabilityTable['title']) }} found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            @endforeach

            <!-- Tank Sounding / ROB Logs -->
            <section class="deck-log-panel full-width">
                <div class="deck-panel-head">
                    <div>
                        <h2>ROB & Freshwater Status Logs</h2>
                        <span>
                            Showing
                            <strong data-report-visible-count>
                                {{ $otherLogs->count() }}
                            </strong>
                            of {{ $otherLogs->count() }} Tank Soundings
                        </span>
                    </div>
                    <input class="rob-freshwater-search" type="search" placeholder="Search vessel, time..." data-report-search aria-label="Search ROB & Freshwater logs">
                </div>
                <div class="deck-log-list" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));">
                    @foreach ($otherLogs as $log)
                        <div
                            class="deck-log-item"
                            style="border-right: 1px solid var(--border-dim); grid-template-columns: 1fr;"
                            data-report-row
                            data-search-value="{{ strtolower(trim(
                                ($log->Vessel ?? '') . ' ' .
                                ($log->Date ?? '') . ' ' .
                                ($log->Remarks ?? '') . ' ' .
                                'ROB ' . ($log->ROB ?? '') . ' ' .
                                'Freshwater FW ' . ($log->FreshWater ?? '') . ' ' .
                                'CCTV ' . ($log->CCTV ?? 'No') . ' ' .
                                'Internet ' . ($log->Internet ?? 'No')
                            )) }}"
                        >
                            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                <div>
                                    <span class="deck-vessel-title">{{ $log->Vessel }}</span>
                                    <span class="deck-sub-text">{{ $displayDate($log->Date) }}</span>
                                </div>
                            </div>

                            <span style="font-size: 0.875rem; color: var(--text-muted);">
                                {{ $log->Remarks ?: 'No remarks recorded.' }}
                            </span>

                            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                <span class="status-pill status-amber">ROB {{ $log->ROB }}</span>
                                <span class="status-pill status-blue">FW {{ $log->FreshWater }}</span>
                                <span class="status-pill {{ ($log->CCTV ?? 'No') === 'No' ? 'status-red' : 'status-teal' }}">CCTV {{ $log->CCTV ?? 'No' }}</span>
                                <span class="status-pill {{ ($log->Internet ?? 'No') === 'No' ? 'status-red' : 'status-violet' }}">Internet {{ $log->Internet ?? 'No' }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </section>
</div>