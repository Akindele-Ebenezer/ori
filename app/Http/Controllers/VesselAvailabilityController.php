<?php

namespace App\Http\Controllers;

use App\Models\VesselAvailability;
use Illuminate\Http\Request;
use App\Models\Employee; 

class VesselAvailabilityController extends Controller
{
   
    public function api()
    {
        $VesselAvailability = VesselAvailability::orderBy('StartDate', 'DESC')->where('TillNow', 'YES')->orderBy('StartTime', 'DESC')->orderBy('EndDate', 'DESC')->orderBy('EndTime', 'DESC')->get(); 
        return response()->json($VesselAvailability);
    }

    public function index(Request $Request)
    {  
        // dd();
        VesselAvailability::where('TillNow', 'YES')->update([
            'EndTime' => date('H:i'),
            'EndDate' => date('Y-m-d'),
        ]);
        \DB::table('generator_availability')->where('TillNow', 'YES')->update([
            'EndTime' => date('H:i'),
            'EndDate' => date('Y-m-d'),
        ]);
 
        $Employees = Employee::orderBy('EmployeeId', 'DESC')->get();
        $Ranks = \DB::table('ranks')->get();
        $Companies = \DB::table('companies')->orderBy('id', 'DESC')->get();
        $VesselAvailability = VesselAvailability::orderBy('StartDate', 'DESC')->orderBy('StartTime', 'DESC')->orderBy('EndDate', 'DESC')->orderBy('EndTime', 'DESC')->paginate(20); 
        $Vessels = \DB::table('vessels_vessel_information')->select(['VesselName', 'ImoNumber', 'CallSign'])->get();
        $STARTDATE = date('Y-m-d'); 
        $NumberOfVessels = $Vessels->count();
        $now = now();

        $availabilityCompanies = \DB::table('companies_')->get();
        $availabilityFleet = \DB::table('vessels_vessel_information as v')
            ->select(['v.VesselName', 'v.Captain', 'v.NightDutyCaptain', 'v.VesselType', 'v.Company', 'v.ImoNumber', 'v.CallSign', 's4.Area'])
            ->join('vessels_section_4 as s4', 'v.VesselName', '=', 's4.VesselName')
            ->orderBy('v.VesselName')
            ->get();
        $availabilityVesselsByCompanyType = $availabilityFleet->groupBy(function ($vessel) {
            return $vessel->Company . '|' . $vessel->VesselType;
        });
        $availabilityVesselNames = $availabilityFleet->pluck('VesselName')->unique()->values();
        $allVesselNames = $Vessels->pluck('VesselName')->unique()->values();

        $hasAvailabilityRange = $Request->filled('FromDate_FILTERBYDATE')
            && $Request->filled('EndDate_FILTERBYDATE')
            && !$Request->filled('SpecificDay');
        $availabilityStatusQuery = \DB::table('vessel_availabilities')
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
            ->filter(function ($availability) use ($STARTDATE) {
                return $availability->StartDate === $STARTDATE || $availability->TillNow === 'YES';
            })
            ->groupBy('Vessel')
            ->map->first();

        $availabilityRobsByVessel = \DB::table('other_reports')
            ->select(['Vessel', 'ROB'])
            ->whereIn('Vessel', $availabilityVesselNames)
            ->whereNotNull('ROB')
            ->where('ROB', '!=', '')
            ->orderByDesc('Date')->orderByDesc('TimeIn')->orderByDesc('id')
            ->get()
            ->groupBy('Vessel')
            ->map->first();

        $availabilityStatsByVessel = \DB::table('vessel_availabilities')
            ->select(['Vessel', 'Status', 'StartDate', 'StartTime', 'EndDate', 'EndTime'])
            ->whereIn('Vessel', $availabilityVesselNames)
            ->whereIn('Status', ['DOCKING', 'BUNKERY', 'INSPECTION', 'MAINTENANCE', 'BREAKDOWN', 'IDLE'])
            ->whereBetween('StartDate', [$now->copy()->startOfYear()->toDateString(), $now->copy()->endOfYear()->toDateString()])
            ->get()
            ->groupBy('Vessel');

        $availabilityLatestCommentsByVessel = \DB::table('vessel_availabilities')
            ->select(['Vessel', 'Comment'])
            ->whereIn('Vessel', $allVesselNames)
            ->orderByDesc('StartDate')->orderByDesc('StartTime')
            ->get()
            ->groupBy('Vessel')
            ->map->first();

        $availabilityChecklistData = collect();
        foreach (['checklist_1a', 'checklist_1b', 'checklist_1c', 'checklist_1d', 'checklist_1e'] as $table) {
            $latestDates = \DB::table($table)
                ->select('Boat')
                ->selectRaw('MAX(`Date`) as LatestDate')
                ->whereIn('Boat', $availabilityVesselNames)
                ->groupBy('Boat');
            $availabilityChecklistData[$table] = \DB::table($table . ' as checklist')
                ->joinSub($latestDates, 'latest', function ($join) {
                    $join->on('checklist.Boat', '=', 'latest.Boat')
                        ->on('checklist.Date', '=', 'latest.LatestDate');
                })
                ->orderBy('checklist.Boat')->orderBy('checklist.TimeIn')
                ->get()
                ->groupBy('Boat')
                ->map->first();
        }
        $checklistHistoryQuery = \DB::table('checklist_1a')->select(['id', 'Boat', 'Date']);
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
            $availabilityChecklistRowsById[$table] = \DB::table($table)
                ->whereIn('id', $checklistHistoryIds)
                ->get()
                ->keyBy('id');
        }

        $availabilityGenerators = \DB::table('generators')->orderBy('EngineMake')->get();
        $availabilityGeneratorsByCompanyClass = $availabilityGenerators->groupBy(function ($generator) {
            return $generator->Company . '|' . $generator->Class;
        });
        $availabilityMachineTypeCounts = $availabilityGenerators
            ->groupBy(function ($generator) {
                return $generator->Company . '|' . strtolower($generator->MachineType ?? '');
            })
            ->map->count();
        $availabilityGeneratorIds = $availabilityGenerators
            ->whereIn('Class', ['ENGINES IN STOCK', 'ASHORE MACHINERY'])
            ->pluck('id');
        $availabilityByGeneratorId = \DB::table('generator_availability')
            ->whereIn('GeneratorId', $availabilityGeneratorIds)
            ->orderByDesc('EndDate')->orderByDesc('StartTime')
            ->get()
            ->groupBy('GeneratorId')
            ->map->first();

        $availabilityTrackingQuery = \DB::table('vessel_availabilities')
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
        $generatorTrackingByEngine = \DB::table('generator_availability')
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

        $today = $now->toDateString();
        $lastSunday = date('Y-m-d', strtotime('last Sunday'));
        $lastWeekMonday = date('Y-m-d', strtotime('last week Monday'));
        $availabilityHistoryCounts = [
            'scheduled' => VesselAvailability::where('StartDate', '>', $today)
                ->orWhere(function ($query) use ($today, $now) {
                    $query->where('StartDate', $today)->where('StartTime', '>', $now);
                })->count(),
            'today' => VesselAvailability::where('StartDate', $today)->count(),
            'thisWeek' => VesselAvailability::where('StartDate', '>=', $lastSunday)->count(),
            'lastWeek' => VesselAvailability::where('StartDate', '>=', $lastWeekMonday)
                ->where('StartDate', '<', $lastSunday)->count(),
            'older' => VesselAvailability::where('StartDate', '<', $lastWeekMonday)->count(),
        ];

        $workflowStatuses = ['IDLE', 'BUNKERY', 'INSPECTION', 'MAINTENANCE', 'OPERATION', 'BREAKDOWN', 'DOCKING'];
        $workflowStartDate = $now->copy()->subMonths(4)->startOfMonth()->toDateString();
        $workflowEndDate = $now->copy()->subMonth()->endOfMonth()->toDateString();
        $workflowRows = VesselAvailability::query()
            ->select(['Vessel', 'Status', 'StartDate', 'EndDate'])
            ->whereIn('Status', $workflowStatuses)
            ->where(function ($query) use ($workflowStartDate, $workflowEndDate) {
                $query->whereBetween('StartDate', [$workflowStartDate, $workflowEndDate])
                    ->orWhereBetween('EndDate', [$workflowStartDate, $workflowEndDate]);
            })
            ->get();
        $workflowVesselsByStatusAndMonth = [];
        for ($monthOffset = 1; $monthOffset <= 4; $monthOffset++) {
            $monthStart = $now->copy()->subMonths($monthOffset)->startOfMonth()->toDateString();
            $monthEnd = $now->copy()->subMonths($monthOffset)->endOfMonth()->toDateString();
            foreach ($workflowRows as $workflowRow) {
                $startsInMonth = $workflowRow->StartDate >= $monthStart && $workflowRow->StartDate <= $monthEnd;
                $endsInMonth = $workflowRow->EndDate >= $monthStart && $workflowRow->EndDate <= $monthEnd;
                if ($startsInMonth || $endsInMonth) {
                    $workflowVesselsByStatusAndMonth[$workflowRow->Status][$monthOffset][$workflowRow->Vessel] = $workflowRow->Vessel;
                }
            }
        }
        $availabilityWorkflowData = [];
        foreach ($workflowStatuses as $status) {
            for ($monthOffset = 1; $monthOffset <= 4; $monthOffset++) {
                $monthSuffix = $monthOffset === 1 ? 'LASTMONTH' : 'LAST' . $monthOffset . 'MONTHS';
                $variableName = 'NumberOfVessels_' . $status . '_' . $monthSuffix;
                $availabilityWorkflowData[$variableName] = collect(
                    array_values($workflowVesselsByStatusAndMonth[$status][$monthOffset] ?? [])
                );
            }
        }

        $availabilityViewData = [
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
            'availabilityGeneratorsByCompanyClass' => $availabilityGeneratorsByCompanyClass,
            'availabilityMachineTypeCounts' => $availabilityMachineTypeCounts,
            'availabilityByGeneratorId' => $availabilityByGeneratorId,
            'availabilityTrackingByVessel' => $availabilityTrackingByVessel,
            'machineries' => $machineries,
            'generatorTrackingByEngine' => $generatorTrackingByEngine,
            'availabilityHistoryCounts' => $availabilityHistoryCounts,
        ];
        $availabilityViewData = array_merge($availabilityViewData, $availabilityWorkflowData);
        $defaultStartDate = $now->copy()->startOfDay()->subDay();
        $defaultEndDate = $now->copy()->startOfDay();
        $hasSpecificDay = $Request->filled('DailyReportFilter_SpecificDay');
        $hasDateRange = $Request->filled('FromDate_DAILYREPORTFILTER') && $Request->filled('EndDate_DAILYREPORTFILTER');
        $usesDefaultDateRange = !$hasSpecificDay && !$hasDateRange;
        $fromDate = $usesDefaultDateRange
            ? $defaultStartDate->toDateString()
            : ($hasSpecificDay ? $Request->DailyReportFilter_SpecificDay : $Request->FromDate_DAILYREPORTFILTER);
        $endDate = $usesDefaultDateRange
            ? $now->toDateString()
            : ($hasSpecificDay ? $Request->DailyReportFilter_SpecificDay : $Request->EndDate_DAILYREPORTFILTER);
        $currentTime = $now->format('H:i:s');
        $limitToCurrentTime = $usesDefaultDateRange;

        $ReportDateFilter = function ($query, string $column = 'Date', ?string $timeColumn = null) use ($limitToCurrentTime, $fromDate, $endDate, $currentTime) {
            $query->whereBetween($column, [$fromDate, $endDate]);

            if ($limitToCurrentTime && $timeColumn !== null) {
                $query->where(function ($dateQuery) use ($column, $timeColumn, $endDate, $currentTime) {
                    $dateQuery->whereDate($column, '<', $endDate)
                        ->orWhere(function ($todayQuery) use ($column, $timeColumn, $endDate, $currentTime) {
                            $todayQuery->whereDate($column, $endDate)
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

        $DailyReportsQuery = $ReportDateFilter(\DB::table('daily_reports'), 'StartDate', 'StartTime');
        $ReportData = [
            'DashboardFromDate' => $fromDate,
            'DashboardEndDate' => $endDate,
            'DashboardCurrentTime' => $currentTime,
            'DashboardUsesDefaultDateRange' => $usesDefaultDateRange,
            'DailyReports' => $DailyReportsQuery->orderByDesc('StartDate')->orderByDesc('StartTime')->get(),
            'RadioBroadcastReports' => $ReportDateFilter(\DB::table('radio_broadcast_reports as r')->leftJoin('vessels_vessel_information as v', 'r.Vessel', '=', 'v.VesselName'), 'r.Date', 'r.TimeIn')->select('r.id as report_id','r.*', 'v.*')->orderByDesc('r.Date')->orderByDesc('r.id')->get(),
            'DeviceReports' => $ReportDateFilter(\DB::table('device_reports'), 'Date', 'Time')->orderByDesc('Date')->orderByDesc('id')->get(),
            'OfficerOnDutyReports' => $ReportDateFilter(\DB::table('officer_on_duty_reports'), 'Date', 'TimeIn')->orderByDesc('Date')->orderByDesc('id')->get(),
            'OtherReports' => $ReportDateFilter(\DB::table('other_reports'), 'Date', 'TimeIn')
                                ->where(function ($query) {
                                    $query->where(function ($q) {
                                        $q->whereNotNull('ROB')
                                        ->where('ROB', '!=', '');
                                    })
                                    ->orWhere(function ($q) {
                                        $q->whereNotNull('FreshWater')
                                        ->where('FreshWater', '!=', '');
                                    });
                                }) 
                                ->orderByDesc('Date')
                                ->orderByDesc('TimeIn')
                                ->orderByDesc('id')
                                ->get(),
            'AvailabilityReports' => $ReportDateFilter(\DB::table('availability_reports'), 'Date', 'Time')
                                ->orderByDesc('Date')
                                ->orderByDesc('Time')
                                ->orderByDesc('id')
                                ->get(), 
            'PeriodicCheckReports' => $ReportDateFilter(\DB::table('periodic_checks'), 'Date', 'Time')
                                ->orderByDesc('Date')
                                ->orderByDesc('Time')
                                ->orderByDesc('id')
                                ->get(),
        ];
        $availabilityStatuses = ['IDLE', 'BUNKERY', 'INSPECTION', 'MAINTENANCE', 'OPERATION', 'BREAKDOWN', 'DOCKING'];
        $defaultStatusRows = VesselAvailability::query()
            ->select(['Status', 'Vessel'])
            ->whereIn('Status', $availabilityStatuses)
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
        foreach ($availabilityStatuses as $status) {
            ${'NumberOfVessels_' . $status} = $defaultStatusRows->get($status, collect());
        }
         
        
        if ((isset($Request->VesselStatus))) {
            $VesselAvailability = VesselAvailability::where('Vessel', $Request->Vessel)->where('Status', $Request->Status)->orderBy('StartDate', 'DESC')->orderBy('StartTime', 'DESC')->orderBy('EndTime', 'DESC')->paginate(20); 
        }
        
        if (isset($Request->SpecificDay)) {
            $VesselAvailability = VesselAvailability::where('Vessel', $Request->Vessel_FILTER)->where('StartDate', $Request->SpecificDay)->orderBy('StartDate', 'DESC')->orderBy('StartTime', 'DESC')->orderBy('EndTime', 'DESC')->paginate(20); 
        }

        if (isset($Request->FromDate_FILTERBYDATE) AND isset($Request->EndDate_FILTERBYDATE)) {
            $STARTDATE = $Request->FromDate_FILTERBYDATE;
            $ENDDATE = $Request->EndDate_FILTERBYDATE;

            $rangeStatusQuery = VesselAvailability::query()
                ->select(['Status', 'Vessel'])
                ->whereIn('Status', $availabilityStatuses)
                ->whereBetween('StartDate', [$STARTDATE, $ENDDATE]);
            if ($Request->filled('Vessel_FILTER')) {
                $rangeStatusQuery->where('Vessel', $Request->Vessel_FILTER);
            }
            $rangeStatusRows = $rangeStatusQuery->distinct()->get()->groupBy('Status');
            foreach ($availabilityStatuses as $status) {
                ${'NumberOfVessels_' . $status} = $rangeStatusRows->get($status, collect());
            }
            $VesselAvailability = VesselAvailability::whereBetween('EndDate', [$STARTDATE, $ENDDATE])->orderBy('StartDate', 'DESC')->orderBy('StartTime', 'DESC')->orderBy('EndTime', 'DESC')->paginate(20); 
            
            if ($Request->filled('Vessel_FILTER')) {
                $VesselAvailability = VesselAvailability::where('Vessel', $Request->Vessel_FILTER)->whereBetween('EndDate', [$STARTDATE, $ENDDATE])->orderBy('StartDate', 'DESC')->orderBy('StartTime', 'DESC')->orderBy('EndTime', 'DESC')->paginate(20); 
            }
            
            return view('Pages.Availability', array_merge([ 
                'Employees' => $Employees,
                'Vessels' => $Vessels,
                'Ranks' => $Ranks,
                'Companies' => $Companies,
                'VesselAvailability' => $VesselAvailability,
                'Vessels' => $Vessels,
                'NumberOfVessels' => $NumberOfVessels,
                'STARTDATE' => $STARTDATE,
                'NumberOfVessels_IDLE' => count($NumberOfVessels_IDLE),
                'NumberOfVessels_BUNKERY' => count($NumberOfVessels_BUNKERY),
                'NumberOfVessels_INSPECTION' => count($NumberOfVessels_INSPECTION),
                'NumberOfVessels_MAINTENANCE' => count($NumberOfVessels_MAINTENANCE),
                'NumberOfVessels_OPERATION' => count($NumberOfVessels_OPERATION),
                'NumberOfVessels_BREAKDOWN' => count($NumberOfVessels_BREAKDOWN),
                'NumberOfVessels_DOCKING' => count($NumberOfVessels_DOCKING),
            ], $ReportData, $availabilityViewData));
        } 

        if(isset($Request->FilterValue)) {
            $VesselAvailability = VesselAvailability::where('Vessel', 'LIKE', '%' . $Request->FilterValue . '%')
                                    ->orWhere('Status', 'LIKE', '%' . $Request->FilterValue . '%')
                                    ->orWhere('DoneBy', 'LIKE', '%' . $Request->FilterValue . '%')
                                    ->orWhere('Comment', 'LIKE', '%' . $Request->FilterValue . '%')
                                    ->orWhere('Location', 'LIKE', '%' . $Request->FilterValue . '%')
                                    ->orWhere('StartTime', 'LIKE', '%' . $Request->FilterValue . '%')
                                    ->orWhere('EndTime', 'LIKE', '%' . $Request->FilterValue . '%')
                                    ->orWhere('StartDate', 'LIKE', '%' . $Request->FilterValue . '%')
                                    ->orWhere('EndDate', 'LIKE', '%' . $Request->FilterValue . '%')
                                    ->orWhere('TillNow', 'LIKE', '%' . $Request->FilterValue . '%')
                                    ->orderBy('StartDate', 'DESC')->orderBy('StartTime', 'DESC')->orderBy('EndTime', 'DESC') 
                                    ->paginate(14);
            $Vessels = \DB::table('vessels_vessel_information')
                                    ->select(['VesselName', 'ImoNumber', 'CallSign'])
                                    ->where('VesselName', 'LIKE', '%' . $Request->FilterValue . '%')
                                    ->orWhere('ImoNumber', 'LIKE', '%' . $Request->FilterValue . '%')
                                    ->orWhere('CallSign', 'LIKE', '%' . $Request->FilterValue . '%')
                                    ->get(); 
                                    
                if ($Request->FilterValue == 'Ready') {
                    $VesselAvailability = VesselAvailability::where('Status', 'IDLE')->orderBy('StartDate', 'DESC')->orderBy('StartTime', 'DESC')->orderBy('EndTime', 'DESC')->paginate(20);  
                }
            return view('Pages.Availability', array_merge([ 
                'Employees' => $Employees,
                'Vessels' => $Vessels,
                'Ranks' => $Ranks,
                'Companies' => $Companies,
                'VesselAvailability' => $VesselAvailability,
                'Vessels' => $Vessels,
                'NumberOfVessels' => $NumberOfVessels,
                'STARTDATE' => $STARTDATE,
                'StartDate' => $STARTDATE,
                'NumberOfVessels_IDLE' => count($NumberOfVessels_IDLE),
                'NumberOfVessels_BUNKERY' => count($NumberOfVessels_BUNKERY),
                'NumberOfVessels_INSPECTION' => count($NumberOfVessels_INSPECTION),
                'NumberOfVessels_MAINTENANCE' => count($NumberOfVessels_MAINTENANCE),
                'NumberOfVessels_OPERATION' => count($NumberOfVessels_OPERATION),
                'NumberOfVessels_BREAKDOWN' => count($NumberOfVessels_BREAKDOWN),
                'NumberOfVessels_DOCKING' => count($NumberOfVessels_DOCKING),
            ], $ReportData, $availabilityViewData));
        }

        return view('Pages.Availability', array_merge([
            'Employees' => $Employees,
            'Vessels' => $Vessels,
            'Ranks' => $Ranks,
            'Companies' => $Companies,
            'VesselAvailability' => $VesselAvailability,
            'Vessels' => $Vessels,
            'NumberOfVessels' => $NumberOfVessels,
            'STARTDATE' => $STARTDATE,
            'NumberOfVessels_IDLE' => count($NumberOfVessels_IDLE),
            'NumberOfVessels_BUNKERY' => count($NumberOfVessels_BUNKERY),
            'NumberOfVessels_INSPECTION' => count($NumberOfVessels_INSPECTION),
            'NumberOfVessels_MAINTENANCE' => count($NumberOfVessels_MAINTENANCE),
            'NumberOfVessels_OPERATION' => count($NumberOfVessels_OPERATION),
            'NumberOfVessels_BREAKDOWN' => count($NumberOfVessels_BREAKDOWN),
            'NumberOfVessels_DOCKING' => count($NumberOfVessels_DOCKING),
        ], $ReportData, $availabilityViewData));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $Request)
    { 

    }

    /**
     * Display the specified resource.
     */
    public function show(VesselAvailability $VesselAvailability)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VesselAvailability $VesselAvailability)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        \DB::transaction(function () use ($request, $id) {

            $startTime = substr($request->EditStartTime, 0, 5);
            $endTime   = substr($request->EditEndTime, 0, 5);
            $startDate = $request->EditStartDate;
            $endDate   = $request->EditEndDate;
            $vessel    = $request->EditVessel;
            $currentRow = VesselAvailability::where('id', $id)
                ->lockForUpdate()
                ->firstOrFail();
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
                'Vessel'    => $vessel,
                'DoneBy'    => $request->EditDoneBy,
                'Attachment'=> $request->EditAttachment,
                'Comment'   => $request->EditComment,
                'Report'    => $request->EditReport,
                'Picture'   => $request->EditPicture,
                'Location'  => $request->EditLocation,
                'StartTime' => $startTime,
                'EndTime'   => $endTime,
                'StartDate' => $startDate,
                'EndDate'   => $endDate,
                'TillNow'   => $request->EditTillNow,
                'DateIn'    => now()->format('Y-m-d'),
                'TimeIn'    => now()->format('H:i A'),
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
            \DB::table('notifications')->insert([
                'DateIn' => now()->format('Y-m-d'),
                'TimeIn' => now()->format('H:i A'),
                'UserId' => session()->get('USER_ID'),
                'Vessel' => $vessel,
                'Action' => 'Update',
                'Subject'=> 'Availability Update!',
                'Notification' =>
                    $request->EditDoneBy .
                    ' has updated availability for ' .
                    $vessel .
                    ' from ' .
                    date('H:i A', strtotime($startTime)) .
                    ' till ' .
                    date('H:i A', strtotime($endTime)) .
                    ' (' . $startDate . ' - ' . $endDate . ').',
            ]);
        });
        return back();
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VesselAvailability $VesselAvailability, $Id)
    { 
        $Availability = VesselAvailability::where('id', $Id)->first();
        \DB::table('notifications')->insert([
        'DateIn' => date('Y-m-d'),
        'TimeIn' => date('H:i A'),
        'UserId' => session()->get('USER_ID'),
        'Vessel' => $Availability->Vessel, 
        'Action' => 'Delete',
        'Subject' => 'Availability Removed!',
        'Notification' => $Availability->DoneBy . ' has deleted the availability for ' . $Availability->Vessel . ' which was on ' . $Availability->Status . ' from ' . date('H:i A', strtotime($Availability->StartTime)) . ' - ' . date('H:i A', strtotime($Availability->EndTime)) . ' (' . $Availability->StartDate . ' - ' . $Availability->EndDate . ') . The tracking status is no longer available.',
    ]);
        VesselAvailability::where('id', $Id)->delete();
        return redirect()->route('Availability');
    }
}
