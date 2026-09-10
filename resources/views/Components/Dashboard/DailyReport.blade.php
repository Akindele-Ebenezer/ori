@php
    $dailyReports = collect($DailyReports ?? []);
    $radioBroadcasts = collect($RadioBroadcastReports ?? []);
    $deviceLogs = collect($DeviceReports ?? []);
    $officerLogs = collect($OfficerOnDutyReports ?? []);
    $otherLogs = collect($OtherReports ?? []);
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
        'INSPECTION' => 'status-amber',
        'DRILL' => 'status-violet',
        'DOCKING' => 'status-blue',
        'MAINTENANCE' => 'status-green',
        'BREAKDOWN' => 'status-red',
        'BUNKERY' => 'status-teal',
        'IDLE' => 'status-slate',
    ];

    $statusCounts = $dailyReports->groupBy(fn ($report) => strtoupper($report->Status ?? 'UNSPECIFIED'))
        ->map(fn ($reports) => $reports->count())
        ->sortDesc();

    $activeReports = $dailyReports->filter(fn ($report) => ($report->TillNow ?? '') === 'YES' || ($report->EndDate ?? '') >= $today)->count();
    $uniqueVessels = $dailyReports->pluck('Vessel')->filter()->unique()->count();
    $dateLabel = $dailyReports->pluck('StartDate')->filter()->sortDesc()->first();
    $totalLogs = $dailyReports->count() + $radioBroadcasts->count() + $deviceLogs->count() + $officerLogs->count() + $otherLogs->count();

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
@endphp

<div class="DailyVesselOperations">
    <section class="ori-deck" data-daily-report-dashboard>
        <p class="deck-close">✖</p>
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
                        GENERAL REPORT
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
                <span class="deck-card-metric-note">Across 5 Log Classes</span>
            </div>
        </div>

        <!-- Main Activity Section -->
        <div class="deck-main-layout">
            <section class="deck-panel">
                <div class="deck-panel-head">
                    <div>
                        <h2>Vessel Operational Logbook</h2>
                        <span>Showing recent vessel movements & activities</span>
                    </div>
                    <input class="deck-search" type="search" placeholder="Search vessel, officer, status..." data-report-search aria-label="Search vessel logs">
                </div>

                @if ($dailyReports->isEmpty())
                    <div style="padding: 3rem; text-align: center; color: var(--text-muted);">
                        <strong>No Operational Records Found</strong>
                        <p style="margin-top: 0.5rem; font-size: 0.8rem;">Vessel activities submitted today will automatically display here.</p>
                    </div>
                @else
                    <div class="deck-table-wrap">
                        <table class="deck-table">
                            <thead>
                                <tr>
                                    <th>Vessel Details</th>
                                    <th>Status</th>
                                    <th>Duty Officer</th>
                                    <th>Window / Schedule</th>
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
                                    @endphp
                                    <tr data-report-row data-search-value="{{ strtolower(($report->Vessel ?? '') . ' ' . ($report->DeployedVessel1 ?? '') . ' ' . ($report->DeployedVessel2 ?? '') . ' ' . ($report->DeployedVessel3 ?? '') . ' ' . $status . ' ' . ($report->DoneBy ?? '') . ' ' . $remarks) }}">
                                        <td>
                                            <span class="deck-vessel-title">{{ $report->Vessel ?? 'Unnamed Vessel' }}</span>
                                            <span class="deck-sub-text">Deployed: {{ $deployedVessels ?: 'None' }}</span>
                                            <span class="deck-sub-text">{{ $report->TillNow === 'YES' ? '⚡ Ongoing Event' : 'Scheduled Entry' }}</span>
                                        </td>
                                        <td>
                                            <span class="status-pill {{ $statusClass }}">{{ $status }}</span>
                                        </td>
                                        <td>
                                            <strong style="font-weight: 700; color: var(--text-main);">{{ $report->DoneBy ?? 'Unassigned' }}</strong>
                                        </td>
                                        <td>
                                            <div>{{ $displayDate($report->StartDate ?? null) }}</div>
                                            <span class="deck-sub-text">{{ $displayTime($report->StartTime ?? null) }} — {{ $displayTime($report->EndTime ?? null) }}</span>
                                        </td>
                                        <td style="color: var(--text-muted); font-family: 'DM Sans', sans-serif;">
                                            {{ $remarks ?: 'None' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>

            <!-- Sidebar Analytics -->
            <aside style="display: flex; flex-direction: column; gap: 1.5rem;">
                <section class="deck-panel" style="padding: 1.5rem;">
                    <h2 style="font-size: 1rem; margin: 0 0 1.25rem 0;">Status Allocation</h2>
                    @forelse ($statusCounts as $status => $count)
                        @php 
                            $statusClass = $statusColors[$status] ?? 'status-slate'; 
                            $percentage = $dailyReports->count() ? round(($count / $dailyReports->count()) * 100) : 0;
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

                <section class="deck-panel" style="padding: 1.25rem; background: #f0fdfa; border-color: #ccfbf1;">
                    <strong style="color: var(--accent-teal); display: block; margin-bottom: 0.4rem; font-size: 0.9rem;">Operations Briefing</strong>
                    <p style="font-family: 'DM Sans', sans-serif; font-size: 0.8rem; color: #134e4a; margin: 0; line-height: 1.5;">
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
                    <h2>Radio Communications Log</h2>
                    <span>{{ $radioBroadcasts->count() }} Entries</span>
                </div>
                <ul class="deck-log-list">
                    @foreach ($radioBroadcasts as $log)
                        <li class="deck-log-item">
                            <div>
                                <span class="deck-vessel-title">{{ $log->Vessel }}</span>
                                <span class="deck-sub-text">{{ $log->DoneBy }} · {{ $displayDate($log->Date) }}</span>
                            </div>
                            <span style="font-size: 0.8rem; color: var(--text-muted); font-family: 'DM Sans', sans-serif;">{{ $log->Remarks }}</span>
                            <span class="status-pill status-teal">{{ $log->Responders }}</span>
                        </li>
                    @endforeach
                </ul>
            </section>

            <!-- Officers Watchkeeping Shift -->
            <section class="deck-log-panel">
                <div class="deck-panel-head">
                    <h2>Watchkeeping Roster</h2>
                    <span>{{ $officerCount }} Duty Officers</span>
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
                                    <span class="deck-vessel-title">{{ $officerName }}</span>
                                    <span class="deck-sub-text">{{ $displayDate($log->Date) }}</span>
                                </div>
                                @if ($log->{'Signature' . $suffix})
                                    <img src="{{ asset('storage/' . $log->{'Signature' . $suffix}) }}" alt="{{ $officerName }} signature" style="display: block; width: 8rem; height: 2.5rem; object-fit: contain; background: #fff; border-radius: 0.25rem;">
                                @else
                                    <span class="deck-sub-text">No signature uploaded</span>
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
                    <h2>Bridge Equipment & Device Diagnostics</h2>
                    <span>{{ $deviceLogs->count() }} Active Inspection Batches</span>
                </div>
                @foreach ($deviceLogs as $log)
                    @php
                        $deviceFields = ['VhfBaseRadio', 'VhfHandHeld', 'Ais', 'VhfRecorder', 'WindDetector', 'StormDetector', 'ComputerSystem', 'PublicAddressSystem', 'FireAlarmSystem', 'VoltageRegulator', 'VhfRepeater', 'MobilePhone', 'Intercomm', 'CCTV', 'Internet'];
                        $workingDevices = collect($deviceFields)->filter(fn ($device) => $log->{$device} === 'Yes')->count();
                    @endphp
                    <div style="border-bottom: 1px solid var(--border-dim);">
                        <div class="deck-log-item" style="border-bottom: none; background: #f8fafc;">
                            <div>
                                <span class="deck-vessel-title">MOC OFFICE</span>
                                <span class="deck-sub-text">Checked by {{ $log->DoneBy }}</span>
                            </div>
                            <span style="font-size: 0.8rem; color: var(--text-muted); font-family: 'DM Sans', sans-serif;">{{ $log->Remarks }}</span>
                            <span class="status-pill status-blue">{{ $workingDevices }} / {{ count($deviceFields) }} operational</span>
                        </div>
                        <div class="check-matrix">
                            @foreach ($deviceFields as $device)
                                @php $result = $log->{$device}; @endphp
                                <div class="check-badge">
                                    <span>{{ preg_replace('/(?<!^)([A-Z])/', ' $1', $device) }}</span>
                                    <strong class="{{ $result === 'Yes' ? 'pass' : 'fail' }}">{{ $result === 'Yes' ? 'OK' : 'FAIL' }}</strong>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </section>

            <!-- Tank Sounding / ROB Logs -->
            <section class="deck-log-panel full-width">
                <div class="deck-panel-head">
                    <h2>ROB & Freshwater Status Logs</h2>
                    <span>{{ $otherLogs->count() }} Tank Soundings</span>
                </div>
                <ul class="deck-log-list">
                    @foreach ($otherLogs as $log)
                        <li class="deck-log-item">
                            <div>
                                <span class="deck-vessel-title">{{ $log->Vessel }}</span>
                                <span class="deck-sub-text">{{ $displayDate($log->Date) }}</span>
                            </div>
                            <span style="font-size: 0.8rem; color: var(--text-muted); font-family: 'DM Sans', sans-serif;">{{ $log->Remarks }}</span>
                            <div style="display: flex; gap: 0.5rem;">
                                <span class="status-pill status-amber">ROB {{ $log->ROB }}</span>
                                <span class="status-pill status-blue">FW {{ $log->FreshWater }}</span>
                                <span class="status-pill status-teal">CCTV {{ $log->CCTV ?? 'No' }}</span>
                                <span class="status-pill status-violet">Internet {{ $log->Internet ?? 'No' }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </section>
        </div>
    </section>
</div>
