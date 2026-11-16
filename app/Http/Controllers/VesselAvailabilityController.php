<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\VesselAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class VesselAvailabilityController extends Controller
{
    public function api()
    {
        $VesselAvailability = VesselAvailability::where('TillNow', 'YES')
            ->orderByDesc('StartDate')
            ->orderByDesc('StartTime')
            ->orderByDesc('EndDate')
            ->orderByDesc('EndTime')
            ->get();

        return response()->json($VesselAvailability);
    }

    public function index(Request $Request)
    {
        $now = now();
        $todayStr = $now->toDateString();
        $nowTimeStr = $now->format('H:i');

        // 1. Throttle TillNow updates to once per minute so concurrent GET requests don't lock tables
        if (Cache::add('availability_till_now_tick', true, 60)) {
            VesselAvailability::where('TillNow', 'YES')->update([
                'EndTime' => $nowTimeStr,
                'EndDate' => $todayStr,
            ]);
            DB::table('generator_availability')->where('TillNow', 'YES')->update([
                'EndTime' => $nowTimeStr,
                'EndDate' => $todayStr,
            ]);
        }

        // 2. Cache static/semi-static lookup tables for 10 minutes
        $Employees = Cache::remember('avail_employees', 600, fn () => Employee::orderByDesc('EmployeeId')->get());
        $Ranks     = Cache::remember('avail_ranks', 600, fn () => DB::table('ranks')->get());
        $Companies = Cache::remember('avail_companies', 600, fn () => DB::table('companies')->orderByDesc('id')->get());
        $availabilityCompanies = Cache::remember('avail_companies_', 600, fn () => DB::table('companies_')->get());

        $Vessels = DB::table('vessels_vessel_information')
            ->select(['VesselName', 'ImoNumber', 'CallSign'])
            ->get();
        $NumberOfVessels = $Vessels->count();
        $allVesselNames = $Vessels->pluck('VesselName')->unique()->values();

        $availabilityFleet = DB::table('vessels_vessel_information as v')
            ->select(['v.VesselName', 'v.Captain', 'v.NightDutyCaptain', 'v.VesselType', 'v.Company', 'v.ImoNumber', 'v.CallSign', 's4.Area'])
            ->join('vessels_section_4 as s4', 'v.VesselName', '=', 's4.VesselName')
            ->orderBy('v.VesselName')
            ->get();

        $availabilityVesselsByCompanyType = $availabilityFleet->groupBy(
            fn ($vessel) => $vessel->Company . '|' . $vessel->VesselType
        );
        $availabilityVesselNames = $availabilityFleet->pluck('VesselName')->unique()->values();

        // 3. Current Availability Status per Vessel
        $STARTDATE = $todayStr;
        $hasAvailabilityRange = $Request->filled('FromDate_FILTERBYDATE')
            && $Request->filled('EndDate_FILTERBYDATE')
            && !$Request->filled('SpecificDay');

        $availabilityStatusQuery = DB::table('vessel_availabilities')
            ->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime', 'TillNow'])
            ->whereIn('Vessel', $availabilityVesselNames);

        if ($hasAvailabilityRange) {
            $availabilityStatusQuery->whereBetween('StartDate', [
                $Request->FromDate_FILTERBYDATE,
                $Request->EndDate_FILTERBYDATE,
            ])->whereNotNull('Status')->orderByDesc('EndTime');
        } elseif ($Request->filled('SpecificDay')) {
            $availabilityStatusQuery->where('StartDate', $Request->SpecificDay)->orderByDesc('EndTime');
        } else {
            $availabilityStatusQuery->where(function ($query) use ($STARTDATE) {
                $query->where('EndDate', '>=', $STARTDATE)->orWhere('TillNow', 'YES');
            })->orderByDesc('StartDate')->orderByDesc('StartTime')->orderByDesc('EndTime');
        }

        $availabilityStatusRows = $availabilityStatusQuery->get();
        $availabilityStatusByVessel = $availabilityStatusRows->groupBy('Vessel')->map->first();
        $availabilityTodayStatusByVessel = $availabilityStatusRows
            ->filter(fn ($a) => $a->StartDate === $STARTDATE || $a->TillNow === 'YES')
            ->groupBy('Vessel')
            ->map->first();

        // 4. FIX FULL-TABLE SCAN: Fetch ONLY the single latest ROB row per vessel via ROW_NUMBER()
        $availabilityRobsByVessel = DB::table('other_reports')
            ->fromSub(function ($query) use ($availabilityVesselNames) {
                $query->from('other_reports')
                    ->select(['Vessel', 'ROB'])
                    ->selectRaw('ROW_NUMBER() OVER (PARTITION BY Vessel ORDER BY `Date` DESC, `TimeIn` DESC, `id` DESC) as rn')
                    ->whereIn('Vessel', $availabilityVesselNames)
                    ->whereNotNull('ROB')
                    ->where('ROB', '!=', '');
            }, 'ranked_robs')
            ->where('rn', 1)
            ->get()
            ->keyBy('Vessel');

        // 5. Yearly stats per vessel
        $availabilityStatsByVessel = DB::table('vessel_availabilities')
            ->select(['Vessel', 'Status', 'StartDate', 'StartTime', 'EndDate', 'EndTime'])
            ->whereIn('Vessel', $availabilityVesselNames)
            ->whereIn('Status', ['DOCKING', 'BUNKERY', 'INSPECTION', 'MAINTENANCE', 'BREAKDOWN', 'IDLE'])
            ->whereBetween('StartDate', [$now->copy()->startOfYear()->toDateString(), $now->copy()->endOfYear()->toDateString()])
            ->get()
            ->groupBy('Vessel');

        // 6. FIX FULL-TABLE SCAN: Fetch ONLY the single latest comment per vessel via ROW_NUMBER()
        $availabilityLatestCommentsByVessel = DB::table('vessel_availabilities')
            ->fromSub(function ($query) use ($allVesselNames) {
                $query->from('vessel_availabilities')
                    ->select(['Vessel', 'Comment'])
                    ->selectRaw('ROW_NUMBER() OVER (PARTITION BY Vessel ORDER BY `StartDate` DESC, `StartTime` DESC, `id` DESC) as rn')
                    ->whereIn('Vessel', $allVesselNames);
            }, 'ranked_comments')
            ->where('rn', 1)
            ->get()
            ->keyBy('Vessel');

        // 7. Latest Checklists per Boat
        $availabilityChecklistData = collect();
        foreach (['checklist_1a', 'checklist_1b', 'checklist_1c', 'checklist_1d', 'checklist_1e'] as $table) {
            $availabilityChecklistData[$table] = DB::table($table)
                ->fromSub(function ($query) use ($table, $availabilityVesselNames) {
                    $query->from($table)
                        ->select('*')
                        ->selectRaw('ROW_NUMBER() OVER (PARTITION BY Boat ORDER BY `Date` DESC, `TimeIn` DESC, `id` DESC) as rn')
                        ->whereIn('Boat', $availabilityVesselNames);
                }, 'ranked_cl')
                ->where('rn', 1)
                ->get()
                ->keyBy('Boat');
        }

        $checklistHistoryQuery = DB::table('checklist_1a')->select(['id', 'Boat', 'Date']);
        if ($Request->filled('Vessel_FILTER') && $Request->filled('FromDate_FILTERBYDATE') && $Request->filled('EndDate_FILTERBYDATE')) {
            $checklistHistoryQuery->where('Boat', $Request->Vessel_FILTER)
                ->whereBetween('Date', [$Request->FromDate_FILTERBYDATE, $Request->EndDate_FILTERBYDATE]);
        } elseif ($Request->filled('SpecificDay')) {
            if ($Request->filled('Vessel_FILTER')) {
                $checklistHistoryQuery->where('Boat', $Request->Vessel_FILTER);
            }
            $checklistHistoryQuery->where('Date', $Request->SpecificDay);
        }
        $Checklist1 = $checklistHistoryQuery->orderByDesc('Date')->orderByDesc('TimeIn')->paginate(20);
        $checklistHistoryIds = collect($Checklist1->items())->pluck('id');

        $availabilityChecklistRowsById = collect();
        foreach (['checklist_1a', 'checklist_1b', 'checklist_1c', 'checklist_1d', 'checklist_1e'] as $table) {
            $availabilityChecklistRowsById[$table] = $checklistHistoryIds->isEmpty()
                ? collect()
                : DB::table($table)->whereIn('id', $checklistHistoryIds)->get()->keyBy('id');
        }

        // 8. Generators & Machineries (Fetch ONLY latest availability per GeneratorId via ROW_NUMBER)
        $availabilityGenerators = DB::table('generators')->orderBy('EngineMake')->get();
        $availabilityGeneratorsByCompanyClass = $availabilityGenerators->groupBy(
            fn ($g) => $g->Company . '|' . $g->Class
        );
        $availabilityMachineTypeCounts = $availabilityGenerators
            ->groupBy(fn ($g) => $g->Company . '|' . strtolower($g->MachineType ?? ''))
            ->map->count();

        $availabilityGeneratorIds = $availabilityGenerators
            ->whereIn('Class', ['ENGINES IN STOCK', 'ASHORE MACHINERY'])
            ->pluck('id');

        $availabilityByGeneratorId = $availabilityGeneratorIds->isEmpty()
            ? collect()
            : DB::table('generator_availability')
                ->fromSub(function ($query) use ($availabilityGeneratorIds) {
                    $query->from('generator_availability')
                        ->select('*')
                        ->selectRaw('ROW_NUMBER() OVER (PARTITION BY GeneratorId ORDER BY `EndDate` DESC, `StartTime` DESC, `id` DESC) as rn')
                        ->whereIn('GeneratorId', $availabilityGeneratorIds);
                }, 'ranked_gen')
                ->where('rn', 1)
                ->get()
                ->keyBy('GeneratorId');

        // 9. Tracking timelines (only select columns used in the view)
        $availabilityTrackingQuery = DB::table('vessel_availabilities')
            ->select(['Vessel', 'Status', 'StartDate', 'EndDate', 'StartTime', 'EndTime', 'TillNow'])
            ->whereIn('Vessel', $allVesselNames);

        if ($hasAvailabilityRange) {
            $availabilityTrackingQuery->whereBetween('EndDate', [
                $Request->FromDate_FILTERBYDATE,
                $Request->EndDate_FILTERBYDATE,
            ]);
        } elseif ($Request->filled('SpecificDay')) {
            $availabilityTrackingQuery->where('StartDate', '<=', $Request->SpecificDay)
                ->where('EndDate', '>=', $Request->SpecificDay);
        } else {
            $availabilityTrackingQuery->where(function ($query) use ($STARTDATE) {
                $query->where(function ($activeQuery) use ($STARTDATE) {
                    $activeQuery->where('StartDate', '<=', $STARTDATE)
                        ->where('EndDate', '>=', $STARTDATE);
                })->orWhere('TillNow', 'YES');
            });
        }
        $availabilityTrackingByVessel = $availabilityTrackingQuery
            ->orderByDesc('DateIn')->orderByDesc('TimeIn')
            ->get()
            ->groupBy('Vessel');

        $machineries = $availabilityGenerators->unique('EngineMake')->values();
        $generatorTrackingByEngine = DB::table('generator_availability')
            ->select(['EngineMake', 'Status', 'StartDate', 'EndDate', 'StartTime', 'EndTime', 'TillNow'])
            ->whereIn('EngineMake', $machineries->pluck('EngineMake'))
            ->where(function ($query) use ($STARTDATE) {
                $query->where(function ($activeQuery) use ($STARTDATE) {
                    $activeQuery->where('StartDate', '<=', $STARTDATE)
                        ->where('EndDate', '>=', $STARTDATE);
                })->orWhere('TillNow', 'YES');
            })
            ->orderByDesc('DateIn')->orderByDesc('TimeIn')
            ->get()
            ->groupBy('EngineMake');

        // 10. Collapse 5 separate COUNT(*) queries into 1 single conditional aggregation query
        $lastSunday = date('Y-m-d', strtotime('last Sunday'));
        $lastWeekMonday = date('Y-m-d', strtotime('last week Monday'));
        $rawCounts = DB::table('vessel_availabilities')
            ->selectRaw('
                SUM(CASE WHEN StartDate > ? OR (StartDate = ? AND StartTime > ?) THEN 1 ELSE 0 END) as scheduled,
                SUM(CASE WHEN StartDate = ? THEN 1 ELSE 0 END) as today,
                SUM(CASE WHEN StartDate >= ? THEN 1 ELSE 0 END) as thisWeek,
                SUM(CASE WHEN StartDate >= ? AND StartDate < ? THEN 1 ELSE 0 END) as lastWeek,
                SUM(CASE WHEN StartDate < ? THEN 1 ELSE 0 END) as older
            ', [$todayStr, $todayStr, $nowTimeStr, $todayStr, $lastSunday, $lastWeekMonday, $lastSunday, $lastWeekMonday])
            ->first();

        $availabilityHistoryCounts = [
            'scheduled' => (int) ($rawCounts->scheduled ?? 0),
            'today'     => (int) ($rawCounts->today ?? 0),
            'thisWeek'  => (int) ($rawCounts->thisWeek ?? 0),
            'lastWeek'  => (int) ($rawCounts->lastWeek ?? 0),
            'older'     => (int) ($rawCounts->older ?? 0),
        ];

        // 11. Cache Recent Workflow (4-month historical aggregation) for 15 minutes
        $workflowStatuses = ['IDLE', 'BUNKERY', 'INSPECTION', 'MAINTENANCE', 'OPERATION', 'BREAKDOWN', 'DOCKING'];
        $availabilityWorkflowData = Cache::remember('avail_recent_workflow_' . $todayStr, 900, function () use ($now, $workflowStatuses) {
            $workflowStartDate = $now->copy()->subMonths(4)->startOfMonth()->toDateString();
            $workflowEndDate = $now->copy()->subMonth()->endOfMonth()->toDateString();

            $workflowRows = DB::table('vessel_availabilities')
                ->select(['Vessel', 'Status', 'StartDate', 'EndDate'])
                ->whereIn('Status', $workflowStatuses)
                ->where(function ($query) use ($workflowStartDate, $workflowEndDate) {
                    $query->whereBetween('StartDate', [$workflowStartDate, $workflowEndDate])
                        ->orWhereBetween('EndDate', [$workflowStartDate, $workflowEndDate]);
                })
                ->distinct()
                ->get();

            $workflowVesselsByStatusAndMonth = [];
            for ($monthOffset = 1; $monthOffset <= 4; $monthOffset++) {
                $monthStart = $now->copy()->subMonths($monthOffset)->startOfMonth()->toDateString();
                $monthEnd = $now->copy()->subMonths($monthOffset)->endOfMonth()->toDateString();
                foreach ($workflowRows as $workflowRow) {
                    if (($workflowRow->StartDate >= $monthStart && $workflowRow->StartDate <= $monthEnd) ||
                        ($workflowRow->EndDate >= $monthStart && $workflowRow->EndDate <= $monthEnd)) {
                        $workflowVesselsByStatusAndMonth[$workflowRow->Status][$monthOffset][$workflowRow->Vessel] = $workflowRow->Vessel;
                    }
                }
            }

            $data = [];
            foreach ($workflowStatuses as $status) {
                for ($monthOffset = 1; $monthOffset <= 4; $monthOffset++) {
                    $monthSuffix = $monthOffset === 1 ? 'LASTMONTH' : 'LAST' . $monthOffset . 'MONTHS';
                    $variableName = 'NumberOfVessels_' . $status . '_' . $monthSuffix;
                    $data[$variableName] = collect(
                        array_values($workflowVesselsByStatusAndMonth[$status][$monthOffset] ?? [])
                    );
                }
            }
            return $data;
        });

        // Paginate GeneratorAvailability here in the controller (moved out of Blade)
        $GeneratorAvailability = DB::table('generator_availability')
            ->orderByDesc('StartDate')
            ->orderByDesc('StartTime')
            ->paginate(10, ['*'], 'gen_page');

        $availabilityViewData = array_merge([
            'availabilityCompanies' => $availabilityCompanies,
            'availabilityVesselsByCompanyType' => $availabilityVesselsByCompanyType,
            'availabilityStatusByVessel' => $availabilityStatusByVessel,
            'availabilityTodayStatusByVessel' => $availabilityTodayStatusByVessel,
            'availabilityRobsByVessel' => $availabilityRobsByVessel,
            'availabilityStatsByVessel' => $availabilityStatsByVessel,
            'availabilityLatestCommentsByVessel' => $availabilityLatestCommentsByVessel,
            'availabilityChecklistData' => $availabilityChecklistData,
            'availabilityChecklistRowsById' => $availabilityChecklistRowsById,
            'Checklist1' => $Checklist1,
            'GeneratorAvailability' => $GeneratorAvailability,
            'availabilityGeneratorsByCompanyClass' => $availabilityGeneratorsByCompanyClass,
            'availabilityMachineTypeCounts' => $availabilityMachineTypeCounts,
            'availabilityByGeneratorId' => $availabilityByGeneratorId,
            'availabilityTrackingByVessel' => $availabilityTrackingByVessel,
            'machineries' => $machineries,
            'generatorTrackingByEngine' => $generatorTrackingByEngine,
            'availabilityHistoryCounts' => $availabilityHistoryCounts,
        ], $availabilityWorkflowData);

        // 12. Daily / Operational Reports (with safety limit to prevent browser DOM freeze)
        $defaultStartDate = $now->copy()->startOfDay()->subDay();
        $hasSpecificDay = $Request->filled('DailyReportFilter_SpecificDay');
        $hasDateRange = $Request->filled('FromDate_DAILYREPORTFILTER') && $Request->filled('EndDate_DAILYREPORTFILTER');
        $usesDefaultDateRange = !$hasSpecificDay && !$hasDateRange;

        $fromDate = $usesDefaultDateRange
            ? $defaultStartDate->toDateString()
            : ($hasSpecificDay ? $Request->DailyReportFilter_SpecificDay : $Request->FromDate_DAILYREPORTFILTER);
        $endDate = $usesDefaultDateRange
            ? $todayStr
            : ($hasSpecificDay ? $Request->DailyReportFilter_SpecificDay : $Request->EndDate_DAILYREPORTFILTER);
        $currentTime = $now->format('H:i:s');
        $limitToCurrentTime = $usesDefaultDateRange;

        $ReportDateFilter = function ($query, string $column = 'Date', ?string $timeColumn = null) use ($limitToCurrentTime, $fromDate, $endDate, $currentTime) {
            $query->whereBetween($column, [$fromDate, $endDate]);

            if ($limitToCurrentTime && $timeColumn !== null) {
                $query->where(function ($dateQuery) use ($column, $timeColumn, $endDate, $currentTime) {
                    $dateQuery->where($column, '<', $endDate)
                        ->orWhere(function ($todayQuery) use ($column, $timeColumn, $endDate, $currentTime) {
                            $todayQuery->where($column, $endDate)
                                ->where(function ($timeQuery) use ($timeColumn, $currentTime) {
                                    $timeQuery->where($timeColumn, '<=', $currentTime)
                                        ->orWhereNull($timeColumn)
                                        ->orWhere($timeColumn, '');
                                });
                        });
                });
            }

            return $query;
        };

        $ReportData = [
            'DashboardFromDate' => $fromDate,
            'DashboardEndDate' => $endDate,
            'DashboardCurrentTime' => $currentTime,
            'DashboardUsesDefaultDateRange' => $usesDefaultDateRange,
            'DailyReports' => $ReportDateFilter(DB::table('daily_reports'), 'StartDate', 'StartTime')
                ->orderByDesc('StartDate')->orderByDesc('StartTime')->limit(500)->get(),
            'RadioBroadcastReports' => $ReportDateFilter(
                DB::table('radio_broadcast_reports as r')->leftJoin('vessels_vessel_information as v', 'r.Vessel', '=', 'v.VesselName'),
                'r.Date',
                'r.TimeIn'
            )->select('r.id as report_id', 'r.*', 'v.*')->orderByDesc('r.Date')->orderByDesc('r.id')->limit(500)->get(),
            'DeviceReports' => $ReportDateFilter(DB::table('device_reports'), 'Date', 'Time')
                ->orderByDesc('Date')->orderByDesc('id')->limit(500)->get(),
            'OfficerOnDutyReports' => $ReportDateFilter(DB::table('officer_on_duty_reports'), 'Date', 'TimeIn')
                ->orderByDesc('Date')->orderByDesc('id')->limit(500)->get(),
            'OtherReports' => $ReportDateFilter(DB::table('other_reports'), 'Date', 'TimeIn')
                ->where(function ($query) {
                    $query->where(fn ($q) => $q->whereNotNull('ROB')->where('ROB', '!=', ''))
                          ->orWhere(fn ($q) => $q->whereNotNull('FreshWater')->where('FreshWater', '!=', ''));
                })
                ->orderByDesc('Date')->orderByDesc('TimeIn')->orderByDesc('id')->limit(500)->get(),
            'AvailabilityReports' => $ReportDateFilter(DB::table('availability_reports'), 'Date', 'Time')
                ->orderByDesc('Date')->orderByDesc('Time')->orderByDesc('id')->limit(1000)->get(),
            'PeriodicCheckReports' => $ReportDateFilter(DB::table('periodic_checks'), 'Date', 'Time')
                ->orderByDesc('Date')->orderByDesc('Time')->orderByDesc('id')->limit(500)->get(),
        ];

        // 13. Status counts for Dashboard cards
        $defaultStatusRows = VesselAvailability::query()
            ->select(['Status', 'Vessel'])
            ->whereIn('Status', $workflowStatuses)
            ->where(function ($query) use ($STARTDATE) {
                $query->where(function ($idleQuery) use ($STARTDATE) {
                    $idleQuery->where('Status', 'IDLE')
                        ->where(function ($dateQuery) use ($STARTDATE) {
                            $dateQuery->where('StartDate', '>=', $STARTDATE)
                                ->orWhere('EndDate', '>=', $STARTDATE);
                        });
                })->orWhere(function ($activeQuery) use ($STARTDATE) {
                    $activeQuery->whereIn('Status', ['BUNKERY', 'INSPECTION', 'MAINTENANCE', 'OPERATION', 'BREAKDOWN', 'DOCKING'])
                        ->where(function ($dateQuery) use ($STARTDATE) {
                            $dateQuery->where('EndDate', '>=', $STARTDATE)
                                ->orWhere('TillNow', 'YES');
                        });
                });
            })
            ->distinct()
            ->get()
            ->groupBy('Status');

        $statusCounts = [];
        foreach ($workflowStatuses as $status) {
            $statusCounts['NumberOfVessels_' . $status] = $defaultStatusRows->get($status, collect())->count();
        }

        // 14. Main $VesselAvailability pagination & filters (avoid redundant queries when overridden)
        if ($Request->filled('FromDate_FILTERBYDATE') && $Request->filled('EndDate_FILTERBYDATE')) {
            $STARTDATE = $Request->FromDate_FILTERBYDATE;
            $ENDDATE = $Request->EndDate_FILTERBYDATE;

            $rangeStatusQuery = VesselAvailability::query()
                ->select(['Status', 'Vessel'])
                ->whereIn('Status', $workflowStatuses)
                ->whereBetween('StartDate', [$STARTDATE, $ENDDATE]);
            if ($Request->filled('Vessel_FILTER')) {
                $rangeStatusQuery->where('Vessel', $Request->Vessel_FILTER);
            }
            $rangeStatusRows = $rangeStatusQuery->distinct()->get()->groupBy('Status');
            foreach ($workflowStatuses as $status) {
                $statusCounts['NumberOfVessels_' . $status] = $rangeStatusRows->get($status, collect())->count();
            }

            $vaQuery = VesselAvailability::whereBetween('EndDate', [$STARTDATE, $ENDDATE]);
            if ($Request->filled('Vessel_FILTER')) {
                $vaQuery->where('Vessel', $Request->Vessel_FILTER);
            }
            $VesselAvailability = $vaQuery->orderByDesc('StartDate')->orderByDesc('StartTime')->orderByDesc('EndTime')->paginate(20);
        } elseif (isset($Request->FilterValue)) {
            if ($Request->FilterValue === 'Ready') {
                $VesselAvailability = VesselAvailability::where('Status', 'IDLE')
                    ->orderByDesc('StartDate')->orderByDesc('StartTime')->orderByDesc('EndTime')->paginate(20);
            } else {
                $term = '%' . $Request->FilterValue . '%';
                $VesselAvailability = VesselAvailability::where(function ($q) use ($term) {
                    $q->where('Vessel', 'LIKE', $term)
                      ->orWhere('Status', 'LIKE', $term)
                      ->orWhere('DoneBy', 'LIKE', $term)
                      ->orWhere('Comment', 'LIKE', $term)
                      ->orWhere('Location', 'LIKE', $term)
                      ->orWhere('StartTime', 'LIKE', $term)
                      ->orWhere('EndTime', 'LIKE', $term)
                      ->orWhere('StartDate', 'LIKE', $term)
                      ->orWhere('EndDate', 'LIKE', $term)
                      ->orWhere('TillNow', 'LIKE', $term);
                })->orderByDesc('StartDate')->orderByDesc('StartTime')->orderByDesc('EndTime')->paginate(14);
            }

            $Vessels = DB::table('vessels_vessel_information')
                ->select(['VesselName', 'ImoNumber', 'CallSign'])
                ->where('VesselName', 'LIKE', '%' . $Request->FilterValue . '%')
                ->orWhere('ImoNumber', 'LIKE', '%' . $Request->FilterValue . '%')
                ->orWhere('CallSign', 'LIKE', '%' . $Request->FilterValue . '%')
                ->get();
        } elseif (isset($Request->VesselStatus)) {
            $VesselAvailability = VesselAvailability::where('Vessel', $Request->Vessel)
                ->where('Status', $Request->Status)
                ->orderByDesc('StartDate')->orderByDesc('StartTime')->orderByDesc('EndTime')->paginate(20);
        } elseif (isset($Request->SpecificDay)) {
            $VesselAvailability = VesselAvailability::where('Vessel', $Request->Vessel_FILTER)
                ->where('StartDate', $Request->SpecificDay)
                ->orderByDesc('StartDate')->orderByDesc('StartTime')->orderByDesc('EndTime')->paginate(20);
        } else {
            $VesselAvailability = VesselAvailability::orderByDesc('StartDate')
                ->orderByDesc('StartTime')
                ->orderByDesc('EndDate')
                ->orderByDesc('EndTime')
                ->paginate(20);
        }

        return view('Pages.Availability', array_merge([
            'Employees'          => $Employees,
            'Vessels'            => $Vessels,
            'Ranks'              => $Ranks,
            'Companies'          => $Companies,
            'VesselAvailability' => $VesselAvailability,
            'NumberOfVessels'    => $NumberOfVessels,
            'STARTDATE'          => $STARTDATE,
            'StartDate'          => $STARTDATE,
        ], $statusCounts, $ReportData, $availabilityViewData));
    }

    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $startTime = substr($request->EditStartTime, 0, 5);
            $endTime   = substr($request->EditEndTime, 0, 5);
            $startDate = $request->EditStartDate;
            $endDate   = $request->EditEndDate;
            $vessel    = $request->EditVessel;

            $currentRow = VesselAvailability::where('id', $id)->lockForUpdate()->firstOrFail();

            $previousRow = VesselAvailability::where('Vessel', $vessel)
                ->where('id', '!=', $id)
                ->where('StartDate', $startDate)
                ->where('StartTime', '<', $currentRow->StartTime)
                ->orderBy('StartTime', 'desc')
                ->lockForUpdate()
                ->first();

            $nextRow = VesselAvailability::where('Vessel', $vessel)
                ->where('id', '!=', $id)
                ->where('StartDate', $startDate)
                ->where('StartTime', '>', $currentRow->StartTime)
                ->orderBy('StartTime', 'asc')
                ->lockForUpdate()
                ->first();

            $currentRow->update([
                'Vessel'     => $vessel,
                'DoneBy'     => $request->EditDoneBy,
                'Attachment' => $request->EditAttachment,
                'Comment'    => $request->EditComment,
                'Report'     => $request->EditReport,
                'Picture'    => $request->EditPicture,
                'Location'   => $request->EditLocation,
                'StartTime'  => $startTime,
                'EndTime'    => $endTime,
                'StartDate'  => $startDate,
                'EndDate'    => $endDate,
                'TillNow'    => $request->EditTillNow,
                'DateIn'     => now()->format('Y-m-d'),
                'TimeIn'     => now()->format('H:i A'),
            ]);

            if ($previousRow) {
                $previousRow->update([
                    'EndTime' => $startTime,
                    'EndDate' => $startDate,
                    'TillNow' => 'NO',
                ]);
            }
            if ($nextRow) {
                $nextRow->update([
                    'EndTime' => $startTime,
                    'EndDate' => $startDate,
                    'TillNow' => 'NO',
                ]);
            }

            DB::table('notifications')->insert([
                'DateIn'       => now()->format('Y-m-d'),
                'TimeIn'       => now()->format('H:i A'),
                'UserId'       => session()->get('USER_ID'),
                'Vessel'       => $vessel,
                'Action'       => 'Update',
                'Subject'      => 'Availability Update!',
                'Notification' => $request->EditDoneBy . ' has updated availability for ' . $vessel . ' from ' . date('H:i A', strtotime($startTime)) . ' till ' . date('H:i A', strtotime($endTime)) . ' (' . $startDate . ' - ' . $endDate . ').',
            ]);
        });

        // Clear cached workflow/lookup stats on mutation
        Cache::forget('avail_recent_workflow_' . now()->toDateString());

        return back();
    }

    public function destroy(VesselAvailability $VesselAvailability, $Id)
    {
        $Availability = VesselAvailability::where('id', $Id)->firstOrFail();

        DB::table('notifications')->insert([
            'DateIn'       => date('Y-m-d'),
            'TimeIn'       => date('H:i A'),
            'UserId'       => session()->get('USER_ID'),
            'Vessel'       => $Availability->Vessel,
            'Action'       => 'Delete',
            'Subject'      => 'Availability Removed!',
            'Notification' => $Availability->DoneBy . ' has deleted the availability for ' . $Availability->Vessel . ' which was on ' . $Availability->Status . ' from ' . date('H:i A', strtotime($Availability->StartTime)) . ' - ' . date('H:i A', strtotime($Availability->EndTime)) . ' (' . $Availability->StartDate . ' - ' . $Availability->EndDate . ') . The tracking status is no longer available.',
        ]);

        VesselAvailability::where('id', $Id)->delete();
        Cache::forget('avail_recent_workflow_' . now()->toDateString());

        return redirect()->route('Availability');
    }
}