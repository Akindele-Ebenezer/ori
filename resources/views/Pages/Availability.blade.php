@extends('Layouts.Layout-2')
@section('Title', 'Availability - ' . session()->get('APP_NAME'))

@section('Content')
@include('Components.Dashboard.VesselSpotlight')
@include('Components.Dashboard.DailyReport')
@include('Partials.Components1')

@php
    $todayStr = date('Y-m-d');
    $nowTimeStr = date('H:i');
    $nowCarbon = \Carbon\Carbon::now();

    // Pre-calculate the 8 time-slot boundaries ONCE for the entire page instead of inside loops
    $timeSlots = [
        ['start' => \Carbon\Carbon::parse($STARTDATE . ' 00:00'), 'end' => \Carbon\Carbon::parse($STARTDATE . ' 03:00')],
        ['start' => \Carbon\Carbon::parse($STARTDATE . ' 03:00'), 'end' => \Carbon\Carbon::parse($STARTDATE . ' 06:00')],
        ['start' => \Carbon\Carbon::parse($STARTDATE . ' 06:00'), 'end' => \Carbon\Carbon::parse($STARTDATE . ' 09:00')],
        ['start' => \Carbon\Carbon::parse($STARTDATE . ' 09:00'), 'end' => \Carbon\Carbon::parse($STARTDATE . ' 12:00')],
        ['start' => \Carbon\Carbon::parse($STARTDATE . ' 12:00'), 'end' => \Carbon\Carbon::parse($STARTDATE . ' 15:00')],
        ['start' => \Carbon\Carbon::parse($STARTDATE . ' 15:00'), 'end' => \Carbon\Carbon::parse($STARTDATE . ' 18:00')],
        ['start' => \Carbon\Carbon::parse($STARTDATE . ' 18:00'), 'end' => \Carbon\Carbon::parse($STARTDATE . ' 21:00')],
        ['start' => \Carbon\Carbon::parse($STARTDATE . ' 21:00'), 'end' => \Carbon\Carbon::parse($STARTDATE . ' 23:59')],
    ];

    $hasDateFilter = request()->filled('FromDate_FILTERBYDATE');
    $hasAnyFilter = $hasDateFilter || request()->filled('SpecificDay');
    $currentPage = request()->query('page', 1);

    // Helper closure to bucket tracking records into the 8 time slots in a SINGLE pass
    $bucketTrackingRecords = function ($records) use ($timeSlots, $todayStr, $nowTimeStr) {
        $buckets = [[], [], [], [], [], [], [], []];
        foreach ($records as $item) {
            $sTime = \Carbon\Carbon::parse($item->StartDate . ' ' . $item->StartTime);
            $eTime = \Carbon\Carbon::parse($item->EndDate . ' ' . $item->EndTime);
            $statusLower = strtolower($item->Status);

            if (!empty($item->TillNow) && $item->TillNow == 'YES') {
                $eTime = (($item->EndDate == $item->StartDate) && ($item->EndTime <= $nowTimeStr))
                    ? $eTime
                    : \Carbon\Carbon::parse($todayStr . ' ' . $nowTimeStr);
            }

            $entry = [
                'status'     => $statusLower,
                'startFmt'   => $sTime->format('H:i') . ' HRS',
                'endFmt'     => $eTime->format('H:i') . ' HRS',
                'startDate'  => $item->StartDate,
                'endDate'    => $item->EndDate,
            ];

            foreach ($timeSlots as $idx => $slot) {
                if (
                    ($sTime >= $slot['start'] && $sTime < $slot['end']) ||
                    ($eTime >= $slot['start'] && $eTime < $slot['end']) ||
                    ($sTime < $slot['start'] && $eTime >= $slot['end'])
                ) {
                    $buckets[$idx][] = $entry;
                }
            }
        }
        return $buckets;
    };

    // Vessel category definitions to eliminate 7x repeated code blocks
    $vesselCategories = [
        ['key' => 'DREDGER',       'label' => 'DREDGERS',      'alwaysShowHeader' => true],
        ['key' => 'TUG BOAT',      'label' => 'TUG BOATS',     'alwaysShowHeader' => false],
        ['key' => 'PILOT CUTTERS', 'label' => 'PILOT CUTTERS', 'alwaysShowHeader' => false],
        ['key' => 'MOORING',       'label' => 'MOORINGS',      'alwaysShowHeader' => false],
        ['key' => 'MULTICAT',      'label' => 'MULTICATS',     'alwaysShowHeader' => false],
        ['key' => 'SURVEY',        'label' => 'SURVEY',        'alwaysShowHeader' => false],
        ['key' => 'SPEED BOAT',    'label' => 'SPEED BOATS',   'alwaysShowHeader' => false],
        ['key' => 'PLOUGHING',     'label' => 'PLOUGHING',     'alwaysShowHeader' => false],
        ['key' => 'OTHERS',        'label' => 'OTHERS',        'alwaysShowHeader' => false],
    ];
    $tugPriority = ['MAJIYA' => 0, 'UBIMA' => 1, 'UROMI' => 2, 'DAURA' => 3, 'ZARANDA' => 4, 'ASAGA' => 5, 'EMEKUKU' => 6, 'GUSAU' => 7];
@endphp

<button class="DisplayDailyReportButton">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-80q-106 0-173-33.5T240-200q0-24 14.5-44.5T295-280l63 59q-9 4-19.5 9T322-200q13 16 60 28t98 12q51 0 98.5-12t60.5-28q-7-8-18-13t-21-9l62-60q28 16 43 36.5t15 45.5q0 53-67 86.5T480-80Zm1-220q99-73 149-146.5T680-594q0-102-65-154t-135-52q-70 0-135 52t-65 154q0 67 49 139.5T481-300Zm-1 100Q339-304 269.5-402T200-594q0-71 25.5-124.5T291-808q40-36 90-54t99-18q49 0 99 18t90 54q40 36 65.5 89.5T760-594q0 94-69.5 192T480-200Zm0-320q33 0 56.5-23.5T560-600q0-33-23.5-56.5T480-680q-33 0-56.5 23.5T400-600q0 33 23.5 56.5T480-520Zm0-80Z"/></svg>
</button>
<button class="DisplayMapButton" title="Display Map">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-80q-106 0-173-33.5T240-200q0-24 14.5-44.5T295-280l63 59q-9 4-19.5 9T322-200q13 16 60 28t98 12q51 0 98.5-12t60.5-28q-7-8-18-13t-21-9l62-60q28 16 43 36.5t15 45.5q0 53-67 86.5T480-80Zm1-220q99-73 149-146.5T680-594q0-102-65-154t-135-52q-70 0-135 52t-65 154q0 67 49 139.5T481-300Zm-1 100Q339-304 269.5-402T200-594q0-71 25.5-124.5T291-808q40-36 90-54t99-18q49 0 99 18t90 54q40 36 65.5 89.5T760-594q0 94-69.5 192T480-200Zm0-320q33 0 56.5-23.5T560-600q0-33-23.5-56.5T480-680q-33 0-56.5 23.5T400-600q0 33 23.5 56.5T480-520Zm0-80Z"/></svg>
</button>
<button class="DisplayTanksButton" title="Display Tanks">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M120-120v-720h720v720H120Zm80-80h560v-560H200v560Zm140-140h280v-280H340v280Z"/></svg>
</button>
<button class="DisplayVesselsOnSiteButton Hide" title="Vessels On Site">
    <svg width="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M19 12C19 15.866 15.866 19 12 19M19 12C19 8.13401 15.866 5 12 5M19 12H21M12 19C8.13401 19 5 15.866 5 12M12 19V21M5 12C5 8.13401 8.13401 5 12 5M5 12H3M12 5V3M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
</button> 
<button class="DisplayGeneratorAvailabilityFormButton" title="Add Generator Availability">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M570-82q-19 5-34.5-6.5T520-120v-200q0-20 15.5-31.5T571-358q37 10 74 14t75 4q38 0 75.5-4t74.5-14q19-5 34.5 6.5T920-320v200q0 20-15.5 31.5T870-82q-37-10-74.5-14t-75.5-4q-38 0-75.5 4T570-82Zm-90-398ZM370-80l-16-128q-13-5-24.5-12T307-235l-119 50L78-375l103-78q-1-7-1-13.5v-27q0-6.5 1-13.5L78-585l110-190 119 50q11-8 23-15t24-12l16-128h220l16 128q13 5 24.5 12t22.5 15l119-50 110 190-103 78q1 7 1 13.5v33.5q0 10-2 20h-82q2-10 3-20t1-20q-1-19-3-33.5t-6-27.5l86-65-39-68-99 42q-22-23-48.5-38.5T533-694l-13-106h-79l-14 106q-31 8-57.5 23.5T321-633l-99-41-39 68 86 64q-5 15-7 30t-2 32q0 16 2 31t7 30l-86 65 39 68 99-42q24 25 54 42t65 22v184h-70Zm70-266v-91q-8-8-13-19t-5-24q0-25 17.5-42.5T482-540q25 0 42.5 17.5T542-480q0 11-3.5 21.5T527-440h89q3-10 4.5-19.5T622-480q0-58-41-99t-99-41q-59 0-99.5 41T342-480q0 48 27.5 84t70.5 50Z"/></svg>
</button> 
<button class="AddGeneratorButton" title="Add New Generator">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M42-120v-112q0-33 17-62t47-44q51-26 115-44t141-18q77 0 141 18t115 44q30 15 47 44t17 62v112H42Zm80-80h480v-32q0-11-5.5-20T582-266q-36-18-92.5-36T362-320q-71 0-127.5 18T142-266q-9 5-14.5 14t-5.5 20v32Zm240-240q-66 0-113-47t-47-113h-10q-9 0-14.5-5.5T172-620q0-9 5.5-14.5T192-640h10q0-45 22-81t58-57v38q0 9 5.5 14.5T302-720q9 0 14.5-5.5T322-740v-54q9-3 19-4.5t21-1.5q11 0 21 1.5t19 4.5v54q0 9 5.5 14.5T422-720q9 0 14.5-5.5T442-740v-38q36 21 58 57t22 81h10q9 0 14.5 5.5T552-620q0 9-5.5 14.5T532-600h-10q0 66-47 113t-113 47Zm0-80q33 0 56.5-23.5T442-600H282q0 33 23.5 56.5T362-520Zm300 160-6-30q-6-2-11.5-4.5T634-402l-28 10-20-36 22-20v-24l-22-20 20-36 28 10q4-4 10-7t12-5l6-30h40l6 30q6 2 12 5t10 7l28-10 20 36-22 20v24l22 20-20 36-28-10q-5 5-10.5 7.5T708-390l-6 30h-40Zm20-70q12 0 21-9t9-21q0-12-9-21t-21-9q-12 0-21 9t-9 21q0 12 9 21t21 9Zm72-130-8-42q-9-3-16.5-7.5T716-620l-42 14-28-48 34-30q-2-5-2-8v-16q0-3 2-8l-34-30 28-48 42 14q6-6 13.5-10.5T746-798l8-42h56l8 42q9 3 16.5 7.5T848-780l42-14 28 48-34 30q2 5 2 8v16q0 3-2 8l34 30-28 48-42-14q-6 6-13.5 10.5T818-602l-8 42h-56Zm28-90q21 0 35.5-14.5T832-700q0-21-14.5-35.5T782-750q-21 0-35.5 14.5T732-700q0 21 14.5 35.5T782-650ZM362-200Z"/></svg>
</button> 
<button class="DisplayMap1Button" title="View Vessel Location">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-80q-106 0-173-33.5T240-200q0-24 14.5-44.5T295-280l63 59q-9 4-19.5 9T322-200q13 16 60 28t98 12q51 0 98.5-12t60.5-28q-7-8-18-13t-21-9l62-60q28 16 43 36.5t15 45.5q0 53-67 86.5T480-80Zm1-220q99-73 149-146.5T680-594q0-102-65-154t-135-52q-70 0-135 52t-65 154q0 67 49 139.5T481-300Zm-1 100Q339-304 269.5-402T200-594q0-71 25.5-124.5T291-808q40-36 90-54t99-18q49 0 99 18t90 54q40 36 65.5 89.5T760-594q0 94-69.5 192T480-200Zm0-320q33 0 56.5-23.5T560-600q0-33-23.5-56.5T480-680q-33 0-56.5 23.5T400-600q0 33 23.5 56.5T480-520Zm0-80Z"/></svg>
</button>
<button class="DisplayAddChecklist1Button" title="Add new handover statement for small boats">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M479-418ZM158-200 82-468q-3-12 2.5-28t23.5-22l52-18v-184q0-33 23.5-56.5T240-800h120v-120h240v120h120q33 0 56.5 23.5T800-720v184l52 18q21 8 25 23.5t1 26.5l-76 268q-50 0-91-23.5T640-280q-30 33-71 56.5T480-200q-48 0-89-23.5T320-280q-30 33-71 56.5T158-200ZM80-40v-80h80q42 0 83-13t77-39q36 26 77 38t83 12q42 0 83-12t77-38q36 26 77 39t83 13h80v80h-80q-42 0-82-10t-78-30q-38 20-78.5 30T480-40q-41 0-81.5-10T320-80q-38 20-78 30t-82 10H80Zm160-522 240-78 240 78v-158H240v158Zm240 282q47 0 79.5-33t80.5-89q48 54 65 74t41 34l44-160-310-102-312 102 46 158q24-14 41-32t65-74q50 57 81.5 89.5T480-280Z"/></svg>
</button>
<button class="DisplayChart5Button" title="Display Graphical Data">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M640-160v-280h160v280H640Zm-240 0v-640h160v640H400Zm-240 0v-440h160v440H160Z"/></svg>
</button>

<div class="vessel-content notifications availability">  
    <h3 class="company-logo"><img src="{{ asset('Images/company-logo.jpeg') }}" alt=""></h3>
    @unless (count($Vessels) > 0)
        <p class="empty-data">There's no vessel in the system..</p>
    @endunless

    @foreach ($availabilityCompanies as $Comapny)
        <h3 class="company-heading">
            <span>{{ $Comapny->Organization }}</span>
        </h3>
        <h3 class="report-summary">Report summary <img class="report-summary ReportPdfButton" src="{{ asset('images/pdf.png') }}" alt=""></h3>
        <h3 class="report-summary -x"><img class="ToggleVessels_Icon" src="{{ asset('/images/add (1).png') }}" alt="">Vessels</h3>

        @foreach ($vesselCategories as $cat)
            @php
                $categoryVessels = $availabilityVesselsByCompanyType->get($Comapny->Alias . '|' . $cat['key'], collect());
                if ($cat['key'] === 'TUG BOAT' && $categoryVessels->isNotEmpty()) {
                    $categoryVessels = $categoryVessels
                        ->sortBy(fn($v) => $tugPriority[$v->VesselName] ?? 8)
                        ->values();
                }
                $catCount = count($categoryVessels);
            @endphp

            @if ($cat['alwaysShowHeader'])
                <h3 class="vessel-type-heading vessels_">{{ $cat['label'] }} :: {{ $catCount }}</h3>
                @if ($catCount === 0)
                    <span class="vessels_">No data available..</span>
                @endif
            @else
                @if ($catCount === 0)
                    <span class="vessels_"></span>
                @else
                    <h3 class="vessel-type-heading vessels_">{{ $cat['label'] }} :: {{ $catCount }}</h3>
                @endif
            @endif

            @foreach ($categoryVessels as $Vessel)
                @php
                    $Availability_STATUS = $availabilityStatusByVessel->get($Vessel->VesselName);
                    $Availability_STATUS_2 = ($cat['key'] === 'PILOT CUTTERS')
                        ? $availabilityTodayStatusByVessel->get($Vessel->VesselName, $Availability_STATUS)
                        : $Availability_STATUS;

                    $StartDate = $Availability_STATUS->StartDate ?? '00:00';
                    $EndDate   = (!empty($Availability_STATUS->TillNow) && $Availability_STATUS->TillNow == 'YES')
                        ? $todayStr
                        : ($Availability_STATUS->EndDate ?? '00:00');

                    $StartTime   = substr($Availability_STATUS->StartTime ?? '00:00', 0, 5) . ' HRS';
                    $StartTime_2 = substr($Availability_STATUS_2->StartTime ?? '00:00', 0, 5) . ' HRS';
                    $EndTime_2   = (!empty($Availability_STATUS_2->TillNow) && $Availability_STATUS_2->TillNow == 'YES')
                        ? $nowTimeStr . ' HRS'
                        : substr($Availability_STATUS_2->EndTime ?? '00:00', 0, 5) . ' HRS';

                    $rawStatus = $Availability_STATUS->Status ?? 'READY TO GO';
                    $statusLower = strtolower($rawStatus);
                    $status2Lower = strtolower($Availability_STATUS_2->Status ?? 'READY TO GO');

                    if (!empty($Availability_STATUS->TillNow) && $Availability_STATUS->TillNow == 'YES') {
                        $s = $Availability_STATUS->Status ?? 'READY';
                        $displayStatus = ($s == 'IDLE') ? 'READY' : (($s == 'BUNKERY') ? 'BUNKERING' : $s);
                    } else {
                        $s = $Availability_STATUS->Status ?? 'READY TO GO';
                        $displayStatus = ($s == 'IDLE') ? 'READY' : ($Availability_STATUS->Status ?? 'READY');
                    }

                    $vesselRob = $availabilityRobsByVessel->get($Vessel->VesselName);
                @endphp

                <div class="list tooltip-x vessels_">
                    @if ($EndDate === $StartDate)
                        <span class="Hide tooltip-x-span"><div class="{{ $status2Lower }} tooltip-x-div"></div> On {{ $Availability_STATUS_2->Status ?? 'READY TO GO' }} <br> {{ $StartTime_2 }} - {{ $EndTime_2 }}</span>
                    @else
                        <span class="Hide tooltip-x-span"><div class="{{ strtolower($Availability_STATUS->Status ?? '') }} tooltip-x-div"></div> On {{ $rawStatus }} <br> {{ $StartTime }} - {{ $EndTime_2 }}</span>
                    @endif
                    <div class="inner -x">
                        <img class="OpenMaintenanceInfoIcon" src="{{ asset('images/ship (2).png') }}" alt="">
                        <div class="Hide">{{ $statusLower }}</div>
                        <div class="Hide"> {{ $Vessel->VesselName }}</div>

                        @if ($cat['key'] === 'PILOT CUTTERS')
                            @php
                                $Checklist1a = $availabilityChecklistData->get('checklist_1a', collect())->get($Vessel->VesselName);
                                $Checklist1b = $availabilityChecklistData->get('checklist_1b', collect())->get($Vessel->VesselName);
                                $Checklist1c = $availabilityChecklistData->get('checklist_1c', collect())->get($Vessel->VesselName);
                                $Checklist1d = $availabilityChecklistData->get('checklist_1d', collect())->get($Vessel->VesselName);
                                $Checklist1e = $availabilityChecklistData->get('checklist_1e', collect())->get($Vessel->VesselName);
                            @endphp
                            @include('Components.Includes.Checklists.Checklist1_DATA')
                        @endif

                        <strong class="notification-wrapper">
                            @include('Components.Includes.VesselStats_Optimized')
                            <span class="status-x {{ $statusLower }}"></span>
                            <span class="vessel-name--">{{ $Vessel->VesselName }}</span>
                            <img class="captain--" src="/images/captain.png" alt="">
                            <span class="vessel-captain--">{{ $Vessel->Captain }}</span>
                            <span class="vessel-night-duty-captain--">{{ $Vessel->NightDutyCaptain }}</span>
                            <span class="vessel-area--">{{ $Vessel->Area ?? 'N/A' }}</span>
                            <span class="vessel-rob--">{{ $vesselRob->ROB ?? 0 }}</span>
                            <span class="imo availability-status vessels {{ $statusLower }} {{ $cat['key'] !== 'DREDGER' ? ($Availability_STATUS->Status ?? 'ready') : '' }} status-1" data-availability-status="{{ $statusLower }}">
                                {{ $displayStatus }}
                            </span>
                        </strong>
                        <img class="ReportPdfButtonForVessels" src="{{ asset('images/pdf.png') }}">
                        <span class="Hide">{{ $Vessel->VesselName }}</span>
                    </div>
                </div>
            @endforeach
        @endforeach

        {{-- Machinery Section --}}
        @php
            $pumpCount       = $availabilityMachineTypeCounts->get($Comapny->Alias . '|pump', 0);
            $generatorCount  = $availabilityMachineTypeCounts->get($Comapny->Alias . '|generator', 0);
            $engineCount     = $availabilityMachineTypeCounts->get($Comapny->Alias . '|engine', 0);
            $compressorCount = $availabilityMachineTypeCounts->get($Comapny->Alias . '|compressor', 0);

            $machineryGroups = [
                ['key' => 'ENGINES IN STOCK', 'label' => 'ENGINES IN STOCK'],
                ['key' => 'ASHORE MACHINERY', 'label' => 'ASHORE MACHINERY'],
            ];
        @endphp
        <h3 class="report-summary -x"><img class="ToggleGenerators_Icon" src="{{ asset('/images/add (1).png') }}" alt="">Pumps ({{ $pumpCount }}) :: Generators ({{ $generatorCount }}) :: Engines ({{ $engineCount }}) :: Compressors ({{ $compressorCount }})</h3>

        @foreach ($machineryGroups as $mGroup)
            @php
                $groupItems = $availabilityGeneratorsByCompanyClass->get($Comapny->Alias . '|' . $mGroup['key'], collect());
            @endphp
            @if (count($groupItems) === 0)
                <span class="generators_"></span>
            @else
                <h3 class="vessel-type-heading generators_">{{ $mGroup['label'] }} :: {{ count($groupItems) }}</h3>
            @endif

            @foreach ($groupItems as $Generator)
                @php
                    $genAvail = $availabilityByGeneratorId->get($Generator->id);
                    $genStatus = $genAvail->Status ?? 'READY';
                    $genStatusDisplay = ($genStatus == 'IDLE') ? 'READY' : $genStatus;
                    $genStatusLower = strtolower($genStatus);
                @endphp
                <div class="list tooltip-x generators_">
                    <span class="Hide tooltip-x-span"><div class="{{ $genStatus }} tooltip-x-div"></div> On {{ $genStatusDisplay }}
                         <br> {{ $genAvail->StartDate ?? $todayStr }} <br> {{ $genAvail->EndDate ?? $todayStr }} 
                         <br> {{ $genAvail->StartTime ?? '00:00' }} HRS - {{ $genAvail->EndTime ?? '00:00' }} HRS
                    </span>
                    <div class="inner -x">
                        <img class="" src="{{ asset('images/' . ($Generator->MachineType ?? 'Generator') . '.png') }}" alt="">
                        <div class="Hide">{{ $genStatusLower }}</div>
                        <div class="Hide"> {{ $Generator->EngineMake }}</div>
                        <strong class="notification-wrapper _generator_">
                            <span class="status-x {{ $genStatusLower }}"></span>
                            <span class="vessel-name--">{{ $Generator->EngineMake }} - {{ $Generator->UsedBy }}</span>
                            <span class="imo availability-status generators {{ $genStatusLower }} status-1" data-availability-status="{{ $genStatusLower }}">
                                {{ $genStatusDisplay }}
                            </span>
                        </strong>
                        <span class="Hide">{{ $Generator->Priority_InternalNo ?? '-' }}</span>
                        <span class="Hide">{{ $Generator->EngineMake ?? '-' }}</span>
                        <span class="Hide">{{ $Generator->Model ?? '-' }}</span>
                        <span class="Hide">{{ $Generator->SN ?? '-' }}</span>
                        <span class="Hide">{{ $Generator->EngineType ?? '-' }}</span>
                        <span class="Hide">{{ $Generator->Location ?? '-' }}</span>
                        <span class="Hide">{{ $Generator->Remarks ?? '-' }}</span>
                        <span class="Hide">{{ $Generator->Company ?? '-' }}</span>
                        <span class="Hide">{{ $Generator->Class ?? '-' }}</span>
                        <span class="Hide">{{ $Generator->UsedBy ?? '-' }}</span>
                        <span class="Hide">{{ $Generator->Power ?? '-' }}</span>
                        <span class="Hide">{{ $Generator->id ?? '-' }}</span>
                        <span class="Hide">{{ $Generator->MachineType ?? '-' }}</span>
                        <img class="ReportPdfButtonForVessels" src="{{ asset('images/pdf.png') }}">
                        <span class="Hide">{{ $Generator->EngineMake }}</span>
                    </div>
                </div>
            @endforeach
        @endforeach
    @endforeach
</div>

<div class="content-data availability dashboard"> 
    <div class="dashboard-inner"> 
        <h1 class="dashboard-heading"><svg class="-x" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m136-240-56-56 296-298 160 160 208-206H640v-80h240v240h-80v-104L536-320 376-480 136-240Z"/></svg>Availability Dashboard</h1>
        <button class="RecordAvailabilityButton">+ Record/Schedule Availability</button>
        <button class="FilterByDateButton">+ Filter</button>
        <div class="upper-links">
            <a href="/Portfolio" class="portfolio-link">Videos</a>
            <div class="open-idashboard">iDashboard</div>
        </div>
        <a class="weatherwidget-io" href="https://forecast7.com/en/6d523d38/lagos/" data-label_1="LAGOS" data-label_2="WEATHER" data-icons="Climacons" data-theme="original">LAGOS WEATHER</a>
        <script>
            !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
        </script>

        <div class="board-1 universal-operations-board">
            {{--
            <div class="div">
                <h1>
                    Vessels/Machineries <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M192 32c0-17.7 14.3-32 32-32H352c17.7 0 32 14.3 32 32V64h48c26.5 0 48 21.5 48 48V240l44.4 14.8c23.1 7.7 29.5 37.5 11.5 53.9l-101 92.6c-16.2 9.4-34.7 15.1-50.9 15.1c-19.6 0-40.8-7.7-59.2-20.3c-22.1-15.5-51.6-15.5-73.7 0c-17.1 11.8-38 20.3-59.2 20.3c-16.2 0-34.7-5.7-50.9-15.1l-101-92.6c-18-16.5-11.6-46.2 11.5-53.9L96 240V112c0-26.5 21.5-48 48-48h48V32zM160 218.7l107.8-35.9c13.1-4.4 27.3-4.4 40.5 0L416 218.7V128H160v90.7zM306.5 421.9C329 437.4 356.5 448 384 448c26.9 0 55.4-10.8 77.4-26.1l0 0c11.9-8.5 28.1-7.8 39.2 1.7c14.4 11.9 32.5 21 50.6 25.2c17.2 4 27.9 21.2 23.9 38.4s-21.2 27.9-38.4 23.9c-24.5-5.7-44.9-16.5-58.2-25C449.5 501.7 417 512 384 512c-31.9 0-60.6-9.9-80.4-18.9c-5.8-2.7-11.1-5.3-15.6-7.7c-4.5 2.4-9.7 5.1-15.6 7.7c-19.8 9-48.5 18.9-80.4 18.9c-33 0-65.5-10.3-94.5-25.8c-13.4 8.4-33.7 19.3-58.2 25c-17.2 4-34.4-6.7-38.4-23.9s6.7-34.4 23.9-38.4c18.1-4.2 36.2-13.3 50.6-25.2c11.1-9.4 27.3-10.1 39.2-1.7l0 0C136.7 437.2 165.1 448 192 448c27.5 0 55-10.6 77.5-26.1c11.1-7.9 25.9-7.9 37 0z"></path></svg>
                </h1>
                <h2 class="sub-heading">
                    @foreach ($availabilityCompanies as $Company)
                        {{ $Company->Organization }}/ 
                    @endforeach
                    FLEET
                </h2>
                <strong class="total">{{ $NumberOfVessels }}</strong> 
                <table>
                    <tr>
                        <th>Ready</th>
                        <th>Bunkering</th>
                        <th>Inspection</th>
                    </tr>
                    <tr>
                        <td class="ready-x"></td>
                        <td class="bunkery-x"></td>
                        <td class="inspection-x"></td> 
                    </tr>
                </table>
                <br>
                <h2>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m136-240-56-56 296-298 160 160 208-206H640v-80h240v240h-80v-104L536-320 376-480 136-240Z"/></svg> BIG DATA 
                    </span> 
                    <span>ANALYTICS</span>
                </h2>
            </div> 

            <div class="div">
                <h1>
                    Other <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M192 32c0-17.7 14.3-32 32-32H352c17.7 0 32 14.3 32 32V64h48c26.5 0 48 21.5 48 48V240l44.4 14.8c23.1 7.7 29.5 37.5 11.5 53.9l-101 92.6c-16.2 9.4-34.7 15.1-50.9 15.1c-19.6 0-40.8-7.7-59.2-20.3c-22.1-15.5-51.6-15.5-73.7 0c-17.1 11.8-38 20.3-59.2 20.3c-16.2 0-34.7-5.7-50.9-15.1l-101-92.6c-18-16.5-11.6-46.2 11.5-53.9L96 240V112c0-26.5 21.5-48 48-48h48V32zM160 218.7l107.8-35.9c13.1-4.4 27.3-4.4 40.5 0L416 218.7V128H160v90.7zM306.5 421.9C329 437.4 356.5 448 384 448c26.9 0 55.4-10.8 77.4-26.1l0 0c11.9-8.5 28.1-7.8 39.2 1.7c14.4 11.9 32.5 21 50.6 25.2c17.2 4 27.9 21.2 23.9 38.4s-21.2 27.9-38.4 23.9c-24.5-5.7-44.9-16.5-58.2-25C449.5 501.7 417 512 384 512c-31.9 0-60.6-9.9-80.4-18.9c-5.8-2.7-11.1-5.3-15.6-7.7c-4.5 2.4-9.7 5.1-15.6 7.7c-19.8 9-48.5 18.9-80.4 18.9c-33 0-65.5-10.3-94.5-25.8c-13.4 8.4-33.7 19.3-58.2 25c-17.2 4-34.4-6.7-38.4-23.9s6.7-34.4 23.9-38.4c18.1-4.2 36.2-13.3 50.6-25.2c11.1-9.4 27.3-10.1 39.2-1.7l0 0C136.7 437.2 165.1 448 192 448c27.5 0 55-10.6 77.5-26.1c11.1-7.9 25.9-7.9 37 0z"></path></svg>
                </h1>
                <h2 class="sub-heading">STATUS</h2>
                <strong style="visibility: hidden;">0</strong>
                <table>
                    <tr>
                        <th class="operation-responsive Hide">Operation</th>
                        <th>Maintenance</th>
                        <th>Docking</th>
                        <th>Breakdown</th> 
                    </tr>
                    <tr> 
                        <td class="operation-responsive Hide">{{ $NumberOfVessels_OPERATION }}</td>
                        <td class="maintenance-x"></td>
                        <td class="docking-x"></td>
                        <td class="breakdown-x"></td>
                    </tr>
                </table> <br>
                <h2>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m136-240-56-56 296-298 160 160 208-206H640v-80h240v240h-80v-104L536-320 376-480 136-240Z"/></svg> LIVE
                    </span> 
                    <span>
                        @if ($STARTDATE == $todayStr)
                            TODAY
                        @elseif ($STARTDATE == date('Y-m-d', strtotime('yesterday')))
                            YESTERDAY 
                        @elseif (request()->filled('SpecificDay'))
                            {{ request('SpecificDay') }} 
                        @elseif ($hasDateFilter && request()->filled('EndDate_FILTERBYDATE') && !request()->filled('SpecificDay'))
                            {{ request('FromDate_FILTERBYDATE') }} to {{ request('EndDate_FILTERBYDATE') }}
                        @endif 
                    </span>
                </h2>
            </div> 
            --}}
            @php
                $universalDailyReports = collect($DailyReports ?? []);
                $universalTugsReports = collect($AvailabilityReports ?? [])
                    ->filter(fn ($report) => strtolower((string) ($report->ReportType ?? '')) === 'tugs');
                $universalTugJobs = $universalTugsReports
                    ->filter(fn ($report) => trim((string) ($report->Tugs ?? '')) !== '')
                    ->groupBy(fn ($report) => strtoupper(trim((string) $report->Tugs)))
                    ->map(fn ($reports) => $reports->sum(fn ($report) => is_numeric($report->NoOfJobs ?? null) ? (int) $report->NoOfJobs : 0))
                    ->sortDesc();
                $universalTugJobTotal = (int) $universalTugJobs->sum();
                $universalMaxTugJobs = max(1, (int) $universalTugJobs->max());
            @endphp
            <div class="dashboard-2-x universal-dashboard">
                <div class="universal-dashboard-head">
                    <h1>Universal Operations</h1>
                    <span>{{ $universalDailyReports->count() }} vessel logs · {{ $universalTugJobTotal }} tug jobs</span>
                </div>
                <div class="universal-dashboard-scroll">
                    <section class="universal-dashboard-section">
                        <div class="universal-dashboard-title">
                            <h2>Vessel Operational Logbook</h2>
                            <span>{{ $universalDailyReports->count() }} entries</span>
                        </div>
                        <div class="universal-dashboard-table-wrap" data-auto-scroll-container>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Vessel</th>
                                        <th>Status</th>
                                        <th>Remarks</th>
                                        <th>Date / Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($universalDailyReports->take(30) as $dailyReport)
                                        @php
                                            $status = strtoupper((string) ($dailyReport->Status ?? 'UNSPECIFIED'));
                                            $statusClass = strtolower(str_replace(' ', '-', $status));
                                            $startTime = !empty($dailyReport->StartTime) ? substr((string) $dailyReport->StartTime, 0, 5) : '--:--';
                                            $endTime = !empty($dailyReport->EndTime) ? substr((string) $dailyReport->EndTime, 0, 5) : '--:--';
                                            $startDate = !empty($dailyReport->StartDate) ? \Carbon\Carbon::parse($dailyReport->StartDate)->format('d M Y') : 'Date not set';
                                            $endDate = !empty($dailyReport->EndDate) ? \Carbon\Carbon::parse($dailyReport->EndDate)->format('d M Y') : null;
                                        @endphp
                                        <tr data-auto-scroll-item>
                                            <td><strong>{{ $dailyReport->Vessel ?: 'Unnamed Vessel' }}</strong></td>
                                            <td><span class="universal-status {{ $statusClass }}">{{ $status }}</span></td>
                                            <td>{{ $dailyReport->Remarks ?: 'No remarks' }}</td>
                                            <td>
                                                {{ $startDate }}@if ($endDate && $endDate !== $startDate) - {{ $endDate }}@endif
                                                <br>{{ $startTime }} - {{ $endTime }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="universal-empty">No vessel operational records found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>
            <section class="universal-tugs-dashboard deck-panel">
                <section class="tug-assignments-insight" aria-labelledby="availability-tug-assignments-heading">
                    <div class="tug-jobs-heading">
                        <div class="tug-jobs-copy">
                            <h3 id="availability-tug-assignments-heading">Tug Assignments</h3>
                            <p class="tug-jobs-caption">Jobs by tug, compared with the busiest tug.</p>
                        </div>
                        <div class="tug-jobs-total">
                            <strong>{{ number_format($universalTugJobTotal) }}</strong>
                            <span>Total jobs</span>
                        </div>
                    </div>
                    @if ($universalTugJobs->isNotEmpty())
                        <div class="tug-jobs-legend" aria-label="Bar color thresholds">
                            <span class="tug-jobs-legend-item"><i class="tug-jobs-swatch tug-jobs-swatch--low" aria-hidden="true"></i>Low <small>0-25%</small></span>
                            <span class="tug-jobs-legend-item"><i class="tug-jobs-swatch tug-jobs-swatch--medium" aria-hidden="true"></i>Medium <small>26-50%</small></span>
                            <span class="tug-jobs-legend-item"><i class="tug-jobs-swatch tug-jobs-swatch--high" aria-hidden="true"></i>High <small>51-99%</small></span>
                            <span class="tug-jobs-legend-item"><i class="tug-jobs-swatch tug-jobs-swatch--full" aria-hidden="true"></i>Full <small>100%</small></span>
                        </div>
                        <div class="universal-tugs-list-scroll" data-auto-scroll-container>
                            <ol class="tug-jobs-list" aria-label="Job counts by tug">
                                @foreach ($universalTugJobs as $tug => $jobs)
                                    @php
                                        $jobPercentage = (int) round(($jobs / $universalMaxTugJobs) * 100);
                                        $jobLevel = $jobPercentage <= 25 ? 'low' : ($jobPercentage <= 50 ? 'medium' : ($jobPercentage < 100 ? 'high' : 'full'));
                                        $tugAssignments = $universalTugsReports
                                            ->filter(fn ($report) => strtoupper(trim((string) ($report->Tugs ?? ''))) === $tug)
                                            ->sortByDesc(fn ($report) => ($report->Date ?? '') . ' ' . ($report->Time ?? ''));
                                    @endphp
                                    <li class="tug-jobs-row" data-auto-scroll-item>
                                        <div class="tug-jobs-meta">
                                            <div class="tug-jobs-name">
                                                <span class="tug-jobs-rank" aria-hidden="true">{{ $loop->iteration }}</span>
                                                <span class="tug-jobs-label" title="{{ $tug }}">{{ $tug }}</span>
                                            </div>
                                            <strong>{{ number_format((int) $jobs) }} <span>jobs</span></strong>
                                        </div>
                                        <div class="tug-jobs-assignments">
                                            @forelse ($tugAssignments as $assignment)
                                                <span class="deck-sub-text">{{ $assignment->Vessel ?: 'No vessel recorded' }} · {{ $assignment->Date ? \Carbon\Carbon::parse($assignment->Date)->format('d M Y') : 'Date not set' }} {{ $assignment->Time ? substr((string) $assignment->Time, 0, 5) : '--:--' }}</span>
                                            @empty
                                                <span class="deck-sub-text">No vessel recorded</span>
                                            @endforelse
                                        </div>
                                        <div class="tug-jobs-track tug-jobs-track--{{ $jobLevel }}" role="meter" aria-label="{{ $tug }} job count" aria-valuetext="{{ number_format((int) $jobs) }} jobs, {{ $jobPercentage }}% of busiest tug" aria-valuemin="0" aria-valuemax="100" aria-valuenow="{{ $jobPercentage }}">
                                            <span aria-hidden="true" style="width: {{ $jobPercentage }}%"></span>
                                        </div>
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    @else
                        <div class="tug-jobs-empty">No tug assignment data available.</div>
                    @endif
                </section>
            </section>
            <script>
                (() => {
                    const containers = document.querySelectorAll('.universal-operations-board [data-auto-scroll-container]');
                    window.setInterval(() => {
                        containers.forEach((container) => {
                            if (container.scrollHeight <= container.clientHeight + 1) return;
                            const item = container.querySelector('[data-auto-scroll-item]');
                            const step = item ? item.getBoundingClientRect().height : 36;
                            const maxTop = container.scrollHeight - container.clientHeight;
                            const nextTop = container.scrollTop >= maxTop - 1
                                ? 0
                                : Math.min(container.scrollTop + step, maxTop);
                            container.scrollTo({
                                top: nextTop,
                                behavior: 'smooth',
                            });
                        });
                    }, 2000);
                })();
            </script>
            @include('Components.Charts.Chart1-JS') 
            {{-- @include('Components.Charts.Chart2')   --}}
            @include('Components.Charts.Chart4-JS') 
            @include('Components.Charts.Chart5-JS') 
            @include('Components.Charts.Chart6-JS')
        </div>  

        <div class="board-1 board-x">
            <div class="div indicators">
                <h1>
                    Indicators <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M352 124.5l-51.9-13c-6.5-1.6-11.3-7.1-12-13.8s2.8-13.1 8.7-16.1l40.8-20.4L294.4 28.8c-5.5-4.1-7.8-11.3-5.6-17.9S297.1 0 304 0H416h32 16c30.2 0 58.7 14.2 76.8 38.4l57.6 76.8c6.2 8.3 9.6 18.4 9.6 28.8c0 26.5-21.5 48-48 48H538.5c-17 0-33.3-6.7-45.3-18.7L480 160H448v21.5c0 24.8 12.8 47.9 33.8 61.1l106.6 66.6c32.1 20.1 51.6 55.2 51.6 93.1C640 462.9 590.9 512 530.2 512H496 432 32.3c-3.3 0-6.6-.4-9.6-1.4C13.5 507.8 6 501 2.4 492.1C1 488.7 .2 485.2 0 481.4c-.2-3.7 .3-7.3 1.3-10.7c2.8-9.2 9.6-16.7 18.6-20.4c3-1.2 6.2-2 9.5-2.2L433.3 412c8.3-.7 14.7-7.7 14.7-16.1c0-4.3-1.7-8.4-4.7-11.4l-44.4-44.4c-30-30-46.9-70.7-46.9-113.1V181.5v-57zM512 72.3c0-.1 0-.2 0-.3s0-.2 0-.3v.6zm-1.3 7.4L464.3 68.1c-.2 1.3-.3 2.6-.3 3.9c0 13.3 10.7 24 24 24c10.6 0 19.5-6.8 22.7-16.3zM130.9 116.5c16.3-14.5 40.4-16.2 58.5-4.1l130.6 87V227c0 32.8 8.4 64.8 24 93H112c-6.7 0-12.7-4.2-15-10.4s-.5-13.3 4.6-17.7L171 232.3 18.4 255.8c-7 1.1-13.9-2.6-16.9-9s-1.5-14.1 3.8-18.8L130.9 116.5z"></path></svg>
                </h1> 
                <div class="indicators-wrapper">
                    <div class="indicators-inner">
                        <div class="indicators-inner-x">
                            <span class="docking"></span> 
                            <span class="FilterDocking">DOCKING</span>
                            <span class="indicator-count" data-indicator-count="docking" aria-label="Docking status count">0</span>
                        </div>
                        <div class="indicators-inner-x">
                            <span class="inspection"></span> 
                            <span class="FilterInspection">INSPECTION</span>
                            <span class="indicator-count" data-indicator-count="inspection" aria-label="Inspection status count">0</span>
                        </div>
                        <div class="indicators-inner-x">
                            <span class="bunkery"></span> 
                            <span class="FilterBunkering">BUNKERING</span>
                            <span class="indicator-count" data-indicator-count="bunkery" aria-label="Bunkering status count">0</span>
                        </div>
                    </div>
                    <div class="indicators-inner">
                        <div class="indicators-inner-x">
                            <span class="breakdown"></span> 
                            <span class="FilterBreakdown">BREAKDOWN</span>
                            <span class="indicator-count" data-indicator-count="breakdown" aria-label="Breakdown status count">0</span>
                        </div>
                        <div class="indicators-inner-x">
                            <span class="idle"></span> 
                            <span class="FilterReady">READY TO GO</span>
                            <span class="indicator-count" data-indicator-count="ready" aria-label="Ready status count">0</span>
                        </div> 
                        <div class="indicators-inner-x">
                            <span class="maintenance"></span> 
                            <span class="FilterMaintenance">MAINTENANCE</span>
                            <span class="indicator-count" data-indicator-count="maintenance" aria-label="Maintenance status count">0</span>
                        </div>
                    </div>
                </div>
            </div> 
            <script>
                (() => {
                    const countAvailabilityStatuses = () => {
                        const content = document.querySelector('.vessel-content.notifications.availability');
                        if (!content) return;

                        const statusElements = Array.from(content.querySelectorAll('.availability-status[data-availability-status]'));
                        const aliases = {
                            docking: ['docking'],
                            inspection: ['inspection'],
                            bunkery: ['bunkery', 'bunkering'],
                            breakdown: ['breakdown'],
                            ready: ['ready', 'ready to go', 'idle'],
                            maintenance: ['maintenance']
                        };

                        Object.keys(aliases).forEach((key) => {
                            const count = statusElements.filter((element) => {
                                const status = (element.getAttribute('data-availability-status') || '')
                                    .trim()
                                    .toLowerCase()
                                    .replace(/\s+/g, ' ');
                                return aliases[key].indexOf(status) !== -1;
                            }).length;
                            const countElement = document.querySelector('[data-indicator-count="' + key + '"]');
                            if (countElement) countElement.textContent = String(count);
                        });
                    };

                    countAvailabilityStatuses();
                    document.addEventListener('vessel-content-updated', countAvailabilityStatuses);
                })();
            </script>

            <div class="div tracking">
                <h1>Tracking (Status)</h1>  
                <table>
                    <tr>
                        <th>VESSEL</th>
                        <th>00:00 - 02:59</th>`
                        <th>03:00 - 05:59</th>
                        <th>06:00 - 08:59</th>
                        <th>09:00 - 11:59</th>
                        <th>12:00 - 14:59</th>
                        <th>15:00 - 17:59</th>
                        <th>18:00 - 20:59</th>
                        <th>21:00 - 23:59</th>
                    </tr>
                    @foreach ($Vessels as $Vessel)
                        @php 
                            $Vessel_ = $availabilityLatestCommentsByVessel->get($Vessel->VesselName);
                            $Vessel_STARTIME = $availabilityTrackingByVessel->get($Vessel->VesselName, collect());
                            if (!$hasAnyFilter) {
                                $Vessel_STARTIME = $Vessel_STARTIME->forPage($currentPage, 30);
                            }
                            $vesselBuckets = $bucketTrackingRecords($Vessel_STARTIME);
                        @endphp
                        <tr>
                            <td>{{ $Vessel_->Vessel ?? '-' }}</td>
                            @for ($slotIdx = 0; $slotIdx < 8; $slotIdx++)
                                <td>
                                    <div class="flex">
                                        @foreach ($vesselBuckets[$slotIdx] as $entry)
                                            <div class="{{ $entry['status'] }} status tooltip-x">
                                                <span class="Hide tooltip-x-span">
                                                    <div class="{{ $entry['status'] }} tooltip-x-div"></div> On {{ $entry['status'] }} <br> {{ $entry['startFmt'] }} - {{ $entry['endFmt'] }}
                                                    @if ($hasDateFilter)
                                                        <br>
                                                        @ {{ $entry['startDate'] }}
                                                        @if ($entry['endDate'] > $entry['startDate'])
                                                            <br> &nbsp;&nbsp;&nbsp; {{ $entry['endDate'] }}
                                                        @endif
                                                    @endif
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                            @endfor
                        </tr>
                    @endforeach

                    <tr>
                        <th>MACHINERY</th>
                        <th>00:00 - 02:59</th>`
                        <th>03:00 - 05:59</th>
                        <th>06:00 - 08:59</th>
                        <th>09:00 - 11:59</th>
                        <th>12:00 - 14:59</th>
                        <th>15:00 - 17:59</th>
                        <th>18:00 - 20:59</th>
                        <th>21:00 - 23:59</th>
                    </tr>
                    @foreach ($machineries as $Machinery)
                        @php
                            $Machinery_STARTIME = $generatorTrackingByEngine
                                ->get($Machinery->EngineMake, collect())
                                ->forPage($currentPage, 30);
                            $machineryBuckets = $bucketTrackingRecords($Machinery_STARTIME);
                        @endphp
                        <tr>
                            <td>{{ $Machinery->EngineMake ?? '-' }}</td>
                            @for ($slotIdx = 0; $slotIdx < 8; $slotIdx++)
                                <td>
                                    <div class="flex">
                                        @foreach ($machineryBuckets[$slotIdx] as $entry)
                                            <div class="{{ $entry['status'] }} status tooltip-x">
                                                <span class="Hide tooltip-x-span">
                                                    <div class="{{ $entry['status'] }} tooltip-x-div"></div> On {{ $entry['status'] }} <br> {{ $entry['startFmt'] }} - {{ $entry['endFmt'] }}
                                                    @if ($hasDateFilter)
                                                        <br>
                                                        @ {{ $entry['startDate'] }}
                                                        @if ($entry['endDate'] > $entry['startDate'])
                                                            <br> &nbsp;&nbsp;&nbsp; {{ $entry['endDate'] }}
                                                        @endif
                                                    @endif
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                            @endfor
                        </tr>
                    @endforeach 
                </table>
            </div>  
        </div>  

        <div class="board-3">
            <div class="div">
                <h1>Vessel Availability</h1>
                <table>
                    <tr>
                        <th>Vessel</th>
                        <th>Status</th>
                        <th>Done by</th>
                        <th>Start date</th>
                        <th>Start time</th>
                        <th>End date</th>
                        <th>End time</th>
                        <th>Source</th>
                        <th>#</th>
                     :: {{ count($VesselAvailability) }}</tr> 
                    @forelse ($VesselAvailability as $Availabilty)
                        @php
                            $StartTime = $Availabilty->StartTime;
                            $StartDate = $Availabilty->StartDate;
                            $EndDate = $Availabilty->EndDate;
                            $Date = $Availabilty->StartDate;

                            $_StartDateTime = \Carbon\Carbon::parse(($StartDate ?? $todayStr) . ' ' . ($StartTime ?? '00:00'));
                            $_EndDateTime = \Carbon\Carbon::parse(($EndDate ?? $todayStr) . ' ' . ($Availabilty->EndTime ?? '00:00'));
                            $_MinutesBetween = $_StartDateTime->diffInMinutes($_EndDateTime);
                            $_HoursBetween = intdiv($_MinutesBetween, 60);
                            $_TotalDays = intdiv($_HoursBetween, 24);
                        @endphp
                        @if ($StartTime > $nowCarbon || $StartDate > $todayStr || $EndDate > $todayStr)
                            <tr class="scheduled history Hide">
                                <td>Scheduled :: {{ $availabilityHistoryCounts['scheduled'] }}</td>
                            </tr>
                        @endif
                        @include('Components.History.AvailabilityHistory')
                        <tr> 
                            <td class="Hide">{{ $Availabilty->id }}</td> 
                            <td class="Hide"> {{ $Availabilty->Vessel }}</td> 
                            <td class="Hide">{{ $Availabilty->Status }}</td> 
                            <td class="Hide">{{ $Availabilty->DoneBy }}</td> 
                            <td class="Hide">{{ $Availabilty->Attachment }}</td> 
                            <td class="Hide">{{ $Availabilty->StartTime }}</td> 
                            <td class="Hide">{{ $Availabilty->EndTime }}</td> 
                            <td class="Hide">{{ $Availabilty->StartDate }}</td> 
                            <td class="Hide">{{ $Availabilty->EndDate }}</td> 
                            <td class="Hide">{{ $Availabilty->TillNow }}</td>
                            <td class="Hide">{{ $Availabilty->Comment }}</td> 
                            <td class="Hide">{{ $Availabilty->Report }}</td> 
                            <td class="Hide">{{ $Availabilty->Picture }}</td> 
                            <td class="Hide">{{ $Availabilty->Location }}</td>  
                            <td class="Hide">{{ $Availabilty->Remark }}</td>
                            <td>{{ $Availabilty->Vessel }}</td> 
                            <td>
                                {{ $Availabilty->Status == 'IDLE' ? 'READY' : ($Availabilty->Status == 'BUNKERY' ? 'BUNKERING' : $Availabilty->Status) }} 
                                <small>
                                    @if ($_MinutesBetween < 60)
                                        {{ $_MinutesBetween }} minutes
                                    @elseif($_HoursBetween < 24)
                                        {{ $_HoursBetween }} hour(s)
                                    @elseif($_TotalDays > 0)
                                        {{ $_TotalDays }} day(s)
                                    @endif
                                </small>
                            </td>
                            <td>{{ strtoupper($Availabilty->DoneBy) }}</td>
                            <td>{{ $Availabilty->StartDate }}</td>
                            <td>{{ substr($Availabilty->StartTime ?? '00:00', 0, 5) . ' HRS' }}</td>
                            <td>{{ $Availabilty->EndDate }}</td> 
                            <td>{{ substr($Availabilty->EndTime ?? '00:00', 0, 5) . ' HRS' }}</td> 
                            <td>{{ $Availabilty->Source }}</td>
                            <td class="action"> 
                                <img class="EditAvailabilityButton" src="{{ asset('images/write.png') }}" alt=""> 
                                <img class="DeleteAvailabilityButton" src="{{ asset('images/delete.png') }}" alt="">
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="action">System don't have any records yet..</td>
                        </tr>
                    @endforelse
                </table>
                {{ $VesselAvailability->appends(request()->query())->links() }}
            </div> 
        </div> 

        <div class="board-3i">
            <div class="div">
                <h1>Daily Report</h1>
                <table>
                    <tr>
                        <th class="Hide">ID</th>
                        <th>Vessel</th>
                        <th>Deployed Vessels</th>
                        <th>Status</th>
                        <th>Done by</th>
                        <th>Start date</th>
                        <th>Start time</th>
                        <th>End date</th>
                        <th>End time</th> 
                        <th>Movement milestones</th>
                        <th>#</th>
                    </tr>
                    @forelse ($DailyReports as $DailyReport)
                    <tr data-report="{{ base64_encode(json_encode($DailyReport)) }}">
                        <td class="Hide">{{ $DailyReport->id }}</td>
                        <td>{{ $DailyReport->Vessel }}</td>
                        <td>{{ implode(', ', array_filter([$DailyReport->DeployedVessel1, $DailyReport->DeployedVessel2, $DailyReport->DeployedVessel3])) }}</td>
                        <td>{{ $DailyReport->Status }}</td>
                        <td>{{ $DailyReport->DoneBy }}</td>
                        <td>{{ $DailyReport->StartDate }}</td>
                        <td>{{ $DailyReport->StartTime }}</td>
                        <td>{{ $DailyReport->EndDate }}</td>
                        <td>{{ $DailyReport->EndTime }}</td>
                        <td>
                            <div>
                                Berthing: {{ $DailyReport->BerthingStartDate ?: ($DailyReport->BerthingDate ?: '-') }} — {{ $DailyReport->BerthingEndDate ?: '-' }}
                                {{ $DailyReport->BerthingStartTime ? substr($DailyReport->BerthingStartTime, 0, 5) : ($DailyReport->BerthingTime ? substr($DailyReport->BerthingTime, 0, 5) : '--:--') }} — {{ $DailyReport->BerthingEndTime ? substr($DailyReport->BerthingEndTime, 0, 5) : '--:--' }}
                                ({{ implode(', ', array_filter([$DailyReport->BerthingDeployedVessel1, $DailyReport->BerthingDeployedVessel2, $DailyReport->BerthingDeployedVessel3])) ?: 'No deployed vessels' }})
                            </div>
                            <div>
                                Unberthing: {{ $DailyReport->UnberthingStartDate ?: ($DailyReport->UnberthingDate ?: '-') }} — {{ $DailyReport->UnberthingEndDate ?: '-' }}
                                {{ $DailyReport->UnberthingStartTime ? substr($DailyReport->UnberthingStartTime, 0, 5) : ($DailyReport->UnberthingTime ? substr($DailyReport->UnberthingTime, 0, 5) : '--:--') }} — {{ $DailyReport->UnberthingEndTime ? substr($DailyReport->UnberthingEndTime, 0, 5) : '--:--' }}
                                ({{ implode(', ', array_filter([$DailyReport->UnberthingDeployedVessel1, $DailyReport->UnberthingDeployedVessel2, $DailyReport->UnberthingDeployedVessel3])) ?: 'No deployed vessels' }})
                            </div>
                            <div>
                                Shifting: {{ $DailyReport->ShiftingStartDate ?: ($DailyReport->ShiftingDate ?: '-') }} — {{ $DailyReport->ShiftingEndDate ?: '-' }}
                                {{ $DailyReport->ShiftingStartTime ? substr($DailyReport->ShiftingStartTime, 0, 5) : ($DailyReport->ShiftingTime ? substr($DailyReport->ShiftingTime, 0, 5) : '--:--') }} — {{ $DailyReport->ShiftingEndTime ? substr($DailyReport->ShiftingEndTime, 0, 5) : '--:--' }}
                                ({{ implode(', ', array_filter([$DailyReport->ShiftingDeployedVessel1, $DailyReport->ShiftingDeployedVessel2, $DailyReport->ShiftingDeployedVessel3])) ?: 'No deployed vessels' }})
                            </div>
                        </td>
                        <td class="action">  
                            <img class="EditDailyReportButton" src="{{ asset('images/write.png') }}" alt="Edit">
                            <img class="DeleteDailyReportButton" src="{{ asset('images/delete.png') }}" alt="Delete">
                        </td>
                    </tr>
                    @empty
                    <tr><td class="action" colspan="11">System doesn't have any records yet.</td></tr>
                    @endforelse
                </table>
            </div> 
        </div> 

        <div class="board-3i">
            <div class="div">
                <h1>Radio Broadcast</h1>
                <table>
                    <tr>
                        <th class="Hide">ID</th>
                        <th>Date</th> 
                        <th>Vessel</th>
                        <th>Done by</th>
                        <th>1st Call Time</th>
                        <th>2nd Call Time</th>
                        <th>#</th>
                    </tr>
                    @forelse ($RadioBroadcastReports as $RadioBroadcast)
                    <tr data-report="{{ base64_encode(json_encode($RadioBroadcast)) }}">
                        <td class="Hide">{{ $RadioBroadcast->report_id }}</td>
                        <td>{{ $RadioBroadcast->Date }}</td>
                        <td>{{ $RadioBroadcast->Vessel }}</td>
                        <td>{{ $RadioBroadcast->DoneBy }}</td>
                        <td>{{ $RadioBroadcast->FirstCallTime === 'Yes' ? 'Done' : ($RadioBroadcast->FirstCallTime ?: '--:--') }}</td>
                        <td>{{ $RadioBroadcast->SecondCallTime === 'Yes' ? 'Done' : ($RadioBroadcast->SecondCallTime ?: '--:--') }}</td>
                        <td class="action">  
                            <img class="EditRadioBroadcastButton" src="{{ asset('images/write.png') }}" alt="Edit">
                            <img class="DeleteRadioBroadcastButton" src="{{ asset('images/delete.png') }}" alt="Delete">
                        </td>
                    </tr>
                    @empty
                    <tr><td class="action" colspan="7">System doesn't have any records yet.</td></tr>
                    @endforelse
                </table>
            </div> 
        </div> 

        <div class="board-3i">
            <div class="div">
                <h1>Devices</h1>
                <table>
                    <tr> 
                        <th class="Hide">ID</th>
                        <th>Date</th>
                        <th>Done by</th>  
                        <th>Remarks</th> 
                        <th>#</th>
                    </tr>
                    @forelse ($DeviceReports as $Devices)
                    <tr data-report="{{ base64_encode(json_encode($Devices)) }}">
                        <td class="Hide">{{ $Devices->id }}</td>
                        <td>{{ $Devices->Date }}</td>
                        <td>{{ $Devices->DoneBy }}</td>
                        <td>{{ $Devices->Remarks }}</td>
                        <td class="action">  
                            <img class="EditDevicesButton" src="{{ asset('images/write.png') }}" alt="Edit">
                            <img class="DeleteDevicesButton" src="{{ asset('images/delete.png') }}" alt="Delete">
                        </td>
                    </tr>
                    @empty
                    <tr><td class="action" colspan="5">System doesn't have any records yet.</td></tr>
                    @endforelse
                </table>
            </div> 
        </div> 

        <div class="board-3i">
            <div class="div">
                <h1>Periodic Checks</h1>
                <table>
                    <tr>
                        <th class="Hide">ID</th>
                        <th>Type</th>
                        <th>Equipment</th>
                        <th>Location</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Done by</th>
                        <th>Remarks</th>
                        <th>#</th>
                    </tr>
                    @forelse ($PeriodicCheckReports as $PeriodicCheck)
                    <tr data-report="{{ base64_encode(json_encode($PeriodicCheck)) }}">
                        <td class="Hide">{{ $PeriodicCheck->id }}</td>
                        <td>{{ $PeriodicCheck->Type }}</td>
                        <td>{{ $PeriodicCheck->Equipment }}</td>
                        <td>{{ $PeriodicCheck->Location }}</td>
                        <td>{{ $PeriodicCheck->Date }}</td>
                        <td>{{ $PeriodicCheck->Time }}</td>
                        <td>{{ $PeriodicCheck->DoneBy }}</td>
                        <td>{{ $PeriodicCheck->Remarks }}</td>
                        <td class="action">
                            <img class="EditPeriodicChecksButton" src="{{ asset('images/write.png') }}" alt="Edit">
                            <img class="DeletePeriodicChecksRowButton" src="{{ asset('images/delete.png') }}" alt="Delete">
                        </td>
                    </tr>
                    @empty
                    <tr><td class="action" colspan="9">System doesn't have any records yet.</td></tr>
                    @endforelse
                </table>
            </div>
        </div>

        <div class="board-3i">
            <div class="div">
                <h1>Officers On Duty</h1>
                <table>
                    <tr>
                        <th class="Hide">ID</th>
                        <th>Date</th>
                        <th>Supervisor</th>
                        <th>Done by</th>  
                        <th>Remarks</th> 
                        <th>#</th>
                    </tr>
                    @forelse ($OfficerOnDutyReports as $OfficersOnDuty)
                    <tr data-report="{{ base64_encode(json_encode($OfficersOnDuty)) }}">
                        <td class="Hide">{{ $OfficersOnDuty->id }}</td>
                        <td>{{ $OfficersOnDuty->Date }}</td>
                        <td>{{ $OfficersOnDuty->Supervisor }}</td>
                        <td>{{ $OfficersOnDuty->Name }}</td>
                        <td>{{ $OfficersOnDuty->Remarks }}</td>
                        <td class="action">  
                            <img class="EditOfficersOnDutyButton" src="{{ asset('images/write.png') }}" alt="Edit">
                            <img class="DeleteOfficersOnDutyButton" src="{{ asset('images/delete.png') }}" alt="Delete">
                        </td>
                    </tr>
                    @empty
                    <tr><td class="action" colspan="6">System doesn't have any records yet.</td></tr>
                    @endforelse
                </table>
            </div> 
        </div> 

        <div class="board-3i">
            <div class="div">
                <h1>Others</h1>
                <table>
                    <tr>
                        <th class="Hide">ID</th>
                        <th>Vessel</th>
                        <th>ROB</th>
                        <th>FRESH WATER</th>  
                        <th>Date</th> 
                        <th>#</th>
                    </tr>
                    @forelse ($OtherReports as $Others)
                    <tr data-report="{{ base64_encode(json_encode($Others)) }}">
                        <td class="Hide">{{ $Others->id }}</td>
                        <td>{{ $Others->Vessel }}</td>
                        <td>{{ $Others->ROB ?? 0 }}</td>
                        <td>{{ $Others->FreshWater }}</td>
                        <td>{{ $Others->Date }}</td>
                        <td class="action">  
                            <img class="EditOthersButton" src="{{ asset('images/write.png') }}" alt="Edit">
                            <img class="DeleteOthersButton" src="{{ asset('images/delete.png') }}" alt="Delete">
                        </td>
                    </tr>
                    @empty
                    <tr><td class="action" colspan="6">System doesn't have any records yet.</td></tr>
                    @endforelse
                </table>
            </div> 
        </div>

        @php
            // Group $AvailabilityReports once instead of filtering the collection 5 separate times
            $reportsByType = $AvailabilityReports->groupBy('ReportType');
        @endphp

        <div class="board-3i">
            <div class="div">
                <h1>Incident Report</h1>
                <table>
                    <tr>
                        <th class="Hide">ID</th>
                        <th>Person / Vessel Involved</th>
                        <th>Nature Of (IAN)</th>
                        <th>Location</th>
                        <th>Date</th> 
                        <th>#</th>
                    </tr>
                    @forelse ($reportsByType->get('incident', []) as $IncidentReport)
                    <tr data-availability-report="{{ base64_encode(json_encode($IncidentReport)) }}">
                        <td class="Hide">{{ $IncidentReport->id }}</td>
                        <td>{{ $IncidentReport->PersonVesselInvolved ?? 0 }}</td>
                        <td>{{ $IncidentReport->NatureOf }}</td>
                        <td>{{ $IncidentReport->Location }}</td>
                        <td>{{ $IncidentReport->Date }}</td>
                        <td class="action">  
                            <img class="EditAvailabilityReportButton" src="{{ asset('images/write.png') }}" alt="Edit">
                            <img class="DeleteAvailabilityReportButton" src="{{ asset('images/delete.png') }}" alt="Delete">
                        </td>
                    </tr>
                    @empty
                    <tr><td class="action" colspan="6">System doesn't have any records yet.</td></tr>
                    @endforelse
                </table>
            </div> 
        </div>

        <div class="board-3i">
            <div class="div">
                <h1>Hospital Visit</h1>
                <table>
                    <tr>
                        <th class="Hide">ID</th>
                        <th>Hospital Name</th>  
                        <th>Vessel / Office</th>
                        <th>Admission </th>
                        <th>Date</th> 
                        <th>#</th>
                    </tr>
                    @forelse ($reportsByType->get('hospital', []) as $HospitalVisit)
                    <tr data-availability-report="{{ base64_encode(json_encode($HospitalVisit)) }}">
                        <td class="Hide">{{ $HospitalVisit->id }}</td>
                        <td>{{ $HospitalVisit->Name }}</td>
                        <td>{{ $HospitalVisit->VesselOffice ?? 0 }}</td>
                        <td>{{ $HospitalVisit->Admission }}</td>
                        <td>{{ $HospitalVisit->Date }}</td>
                        <td class="action">  
                            <img class="EditAvailabilityReportButton" src="{{ asset('images/write.png') }}" alt="Edit">
                            <img class="DeleteAvailabilityReportButton" src="{{ asset('images/delete.png') }}" alt="Delete">
                        </td>
                    </tr>
                    @empty
                    <tr><td class="action" colspan="6">System doesn't have any records yet.</td></tr>
                    @endforelse
                </table>
            </div> 
        </div>

        <div class="board-3i">
            <div class="div">
                <h1>Tugs Assignment</h1>
                <table>
                    <tr>
                        <th class="Hide">ID</th>
                        <th>Vessel</th>  
                        <th>No. Of Jobs</th>
                        <th>Navy Jobs</th>
                        <th>Date</th> 
                        <th>Time</th>
                        <th>#</th>
                    </tr>
                    @forelse ($reportsByType->get('tugs', []) as $TugsAssignment)
                    <tr data-availability-report="{{ base64_encode(json_encode($TugsAssignment)) }}">
                        <td class="Hide">{{ $TugsAssignment->id }}</td>
                        <td>{{ $TugsAssignment->Vessel }}</td>
                        <td>{{ $TugsAssignment->NoOfJobs ?? 0 }}</td>
                        <td>{{ $TugsAssignment->NavyJobs }}</td>
                        <td>{{ $TugsAssignment->Date }}</td>
                        <td>{{ $TugsAssignment->Time }}</td>
                        <td class="action">  
                            <img class="EditAvailabilityReportButton" src="{{ asset('images/write.png') }}" alt="Edit">
                            <img class="DeleteAvailabilityReportButton" src="{{ asset('images/delete.png') }}" alt="Delete">
                        </td>
                    </tr>
                    @empty
                    <tr><td class="action" colspan="7">System doesn't have any records yet.</td></tr>
                    @endforelse
                </table>
            </div> 
        </div>

        <div class="board-3i">
            <div class="div">
                <h1>Travelling</h1>
                <table>
                    <tr>
                        <th class="Hide">ID</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Vessel</th>
                        <th>Office</th>
                        <th>Driver</th>
                        <th>Lodging</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Done By</th>
                        <th>#</th>
                    </tr>
                    @forelse ($reportsByType->get('travelling', []) as $TravellingReport)
                    <tr data-availability-report="{{ base64_encode(json_encode($TravellingReport)) }}">
                        <td class="Hide">{{ $TravellingReport->id }}</td>
                        <td>{{ $TravellingReport->Name }}</td>
                        <td>{{ $TravellingReport->Type }}</td>
                        <td>{{ $TravellingReport->Vessel }}</td>
                        <td>{{ $TravellingReport->Office }}</td>
                        <td>{{ $TravellingReport->Driver }}</td>
                        <td>{{ $TravellingReport->Lodging }}</td>
                        <td>{{ $TravellingReport->Date }}</td>
                        <td>{{ $TravellingReport->Time }}</td>
                        <td>{{ $TravellingReport->DoneBy }}</td>
                        <td class="action">
                            <img class="EditAvailabilityReportButton" src="{{ asset('images/write.png') }}" alt="Edit">
                            <img class="DeleteAvailabilityReportButton" src="{{ asset('images/delete.png') }}" alt="Delete">
                        </td>
                    </tr>
                    @empty
                    <tr><td class="action" colspan="11">System doesn't have any records yet.</td></tr>
                    @endforelse
                </table>
            </div>
        </div>

        <div class="board-3i">
            <div class="div">
                <h1>CCTV Positioning</h1>
                <table>
                    <tr>
                        <th class="Hide">ID</th>
                        <th>Vessel</th>
                        <th>Recording Capacity</th>
                        <th>Positioning</th>
                        <th>Correction</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Date</th>
                        <th>#</th>
                    </tr>
                    @forelse ($reportsByType->get('cctv', []) as $CctvPositioning)
                    <tr data-availability-report="{{ base64_encode(json_encode($CctvPositioning)) }}">
                        <td class="Hide">{{ $CctvPositioning->id }}</td>
                        <td>{{ $CctvPositioning->Vessel }}</td>
                        <td>{{ $CctvPositioning->RecordingCapacity }}</td>
                        <td>{{ $CctvPositioning->Positioning }}</td>
                        <td>{{ $CctvPositioning->Correction }}</td>
                        <td>{{ $CctvPositioning->From }}</td>
                        <td>{{ $CctvPositioning->To }}</td>
                        <td>{{ $CctvPositioning->Date }}</td>
                        <td class="action">
                            <img class="EditAvailabilityReportButton" src="{{ asset('images/write.png') }}" alt="Edit">
                            <img class="DeleteAvailabilityReportButton" src="{{ asset('images/delete.png') }}" alt="Delete">
                        </td>
                    </tr>
                    @empty
                    <tr><td class="action" colspan="9">System doesn't have any records yet.</td></tr>
                    @endforelse
                </table>
            </div>
        </div>

        <div class="board-3">
            <div class="div">
                <h1>Machineries Availability</h1>
                <table>
                    <tr>
                        <th>Engine Make</th>
                        <th class="Hide">Location</th> 
                        <th>Status</th>
                        <th>Done By</th>
                        <th>Start Date</th>
                        <th>Start Time</th>
                        <th>End Date</th>
                        <th>End Time</th>
                     :: {{ count($GeneratorAvailability) }}</tr> 
                    @forelse ($GeneratorAvailability as $Availability)
                        @php
                            $_StartDateTime_ = \Carbon\Carbon::parse(($Availability->StartDate ?? $todayStr) . ' ' . ($Availability->StartTime ?? '00:00'));
                            $_EndDateTime_ = \Carbon\Carbon::parse(($Availability->EndDate ?? $todayStr) . ' ' . ($Availability->EndTime ?? '00:00'));
                            $_MinutesBetween_ = $_StartDateTime_->diffInMinutes($_EndDateTime_);
                            $_HoursBetween_ = intdiv($_MinutesBetween_, 60);
                            $_TotalDays_ = intdiv($_HoursBetween_, 24);
                        @endphp
                        <tr class="scheduled history Hide"></tr> 
                        <tr> 
                            <td>{{ $Availability->EngineMake }}</td> 
                            <td class="Hide">{{ $Availability->Location }}</td> 
                            <td>
                                {{ $Availability->Status == 'IDLE' ? 'READY' : ($Availability->Status == 'BUNKERY' ? 'BUNKERING' : $Availability->Status) }} 
                                <small>
                                    @if ($_MinutesBetween_ < 60)
                                        {{ $_MinutesBetween_ }} minutes
                                    @elseif($_HoursBetween_ < 24)
                                        {{ $_HoursBetween_ }} hour(s)
                                    @elseif($_TotalDays_ > 0)
                                        {{ $_TotalDays_ }} day(s)
                                    @endif
                                </small>
                            </td>
                            <td>{{ $Availability->DoneBy }}</td>
                            <td class="Hide">{{ $Availability->Remarks }}</td>
                            <td>{{ $Availability->StartDate }}</td>
                            <td>{{ $Availability->StartTime }} HRS</td>
                            <td>{{ $Availability->EndDate }}</td>
                            <td>{{ $Availability->EndTime }} HRS</td> 
                            <td class="Hide">{{ $Availability->TillNow }}</td>
                            <td class="action"> 
                                <span class="Hide">{{ $Availability->id }}</span> 
                                <span class="Hide">{{ $Availability->EngineMake }}</span> 
                                <img class="EditGeneratorAvailability_Icon" src="{{ asset('images/write.png') }}" alt=""> 
                                <span class="Hide">{{ $Availability->id }}</span> 
                                <span class="Hide">{{ $Availability->Status }}</span> 
                                <img class="DeleteGeneratorAvailabilityButton" src="{{ asset('images/delete.png') }}" alt="">
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="action">System don't have any records yet..</td>
                        </tr>
                    @endforelse
                </table>
                {{ $GeneratorAvailability->appends(request()->query())->links() }}
            </div> 
        </div>

        <div class="board-3">
            <div class="div">
                <h1>Handover statements, inspections and maintenance logs</h1>
                <table>
                    <tr>
                        <th>Vessel</th>
                        <th>Date</th> 
                        <th>#</th>
                     :: {{ count($Checklist1) }}</tr> 
                    @forelse ($Checklist1 as $Checklist)
                        @php
                            $Checklist1a = $availabilityChecklistRowsById->get('checklist_1a', collect())->get($Checklist->id);
                            $Checklist1b = $availabilityChecklistRowsById->get('checklist_1b', collect())->get($Checklist->id);
                            $Checklist1c = $availabilityChecklistRowsById->get('checklist_1c', collect())->get($Checklist->id);
                            $Checklist1d = $availabilityChecklistRowsById->get('checklist_1d', collect())->get($Checklist->id);
                            $Checklist1e = $availabilityChecklistRowsById->get('checklist_1e', collect())->get($Checklist->id);
                        @endphp
                        <tr class="scheduled history Hide"></tr> 
                        <tr> 
                            <td>{{ $Checklist->Boat }}</td> 
                            <td>{{ $Checklist->Date }}</td>
                            <td class="action"> 
                                <span class="Hide">{{ $Checklist->id }}</span> 
                                <span class="Hide">{{ $Checklist->Boat }}</span> 
                                <img class="EditChecklist1_Icon" src="{{ asset('images/write.png') }}" alt=""> 
                                <div class="Hide"></div>
                                <div class="Hide"></div>
                                @include('Components.Includes.Checklists.Checklist1_DATA')
                                <img class="DeleteChecklist1Button" src="{{ asset('images/delete.png') }}" alt="">
                                <img class="Checklist1_PdfIcon" src="{{ asset('images/pdf.png') }}" alt="">
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="action">System don't have any records yet..</td>
                        </tr>
                    @endforelse
                </table>
                {{ $Checklist1->appends(request()->query())->links() }}
            </div> 
        </div>

        <div class="board-2">
            @php
                // Fallback if controller hasn't passed $workflowStats yet (runs 1 query instead of 28)
                if (!isset($workflowStats)) {
                    $workflowStats = \Illuminate\Support\Facades\Cache::remember('availability_recent_workflow_stats', now()->addMinutes(10), function () {
                        $fourMonthsAgo = \Carbon\Carbon::now()->subMonths(4)->startOfMonth()->toDateString();
                        $lastMonthEnd  = \Carbon\Carbon::now()->subMonth()->endOfMonth()->toDateString();

                        $rows = App\Models\VesselAvailability::select('Status', 'Vessel', 'StartDate', 'EndDate')
                            ->whereIn('Status', ['IDLE', 'BUNKERY', 'INSPECTION', 'MAINTENANCE', 'OPERATION', 'BREAKDOWN', 'DOCKING'])
                            ->where(function ($q) use ($fourMonthsAgo, $lastMonthEnd) {
                                $q->whereBetween('StartDate', [$fourMonthsAgo, $lastMonthEnd])
                                  ->orWhereBetween('EndDate', [$fourMonthsAgo, $lastMonthEnd]);
                            })
                            ->get();

                        $months = [];
                        for ($i = 1; $i <= 4; $i++) {
                            $months[$i] = [
                                'start'   => \Carbon\Carbon::now()->subMonths($i)->startOfMonth()->toDateString(),
                                'end'     => \Carbon\Carbon::now()->subMonths($i)->endOfMonth()->toDateString(),
                                'vessels' => [],
                            ];
                        }

                        foreach ($rows as $row) {
                            foreach ($months as $i => &$m) {
                                if (($row->StartDate >= $m['start'] && $row->StartDate <= $m['end']) ||
                                    ($row->EndDate >= $m['start'] && $row->EndDate <= $m['end'])) {
                                    $m['vessels'][$row->Status][$row->Vessel] = true;
                                }
                            }
                        }

                        $counts = [];
                        foreach ($months as $i => $m) {
                            foreach (['IDLE', 'BUNKERY', 'INSPECTION', 'MAINTENANCE', 'OPERATION', 'BREAKDOWN', 'DOCKING'] as $status) {
                                $counts[$i][$status] = isset($m['vessels'][$status]) ? count($m['vessels'][$status]) : 0;
                            }
                        }
                        return $counts;
                    });
                }

                $workflowRows = [
                    1 => 'Last month ',
                    2 => '- 2 months ',
                    3 => '- 3 months ',
                    4 => '- 4 months ',
                ];
                $workflowBars = [
                    ['key' => 'DOCKING',     'color' => '#03AED2', 'class' => 'docking',     'label' => 'On docking'],
                    ['key' => 'OPERATION',   'color' => '#A87676', 'class' => 'operation',   'label' => 'On operation'],
                    ['key' => 'BREAKDOWN',   'color' => '#da1e28', 'class' => 'breakdown',   'label' => 'On breakdown'],
                    ['key' => 'MAINTENANCE', 'color' => '#52f781', 'class' => 'maintenance', 'label' => 'On maintenance'],
                    ['key' => 'INSPECTION',  'color' => '#ff832b', 'class' => 'inspection',  'label' => 'On inspection'],
                    ['key' => 'BUNKERY',     'color' => '#8a3ffc', 'class' => 'bunkery',     'label' => 'On bunkering'],
                    ['key' => 'IDLE',        'color' => '#fff',    'class' => 'idle',        'label' => 'On ready to go'],
                ];
            @endphp
            <div class="div recent-workflow" style="width: 100%">
                <h1>Recent Workflow</h1>  
                <div class="canvas"> 
                    @foreach ($workflowRows as $monthIdx => $monthLabel)
                        <div class="inner-x">
                            <span>{{ $monthLabel }}</span>
                            @foreach ($workflowBars as $bar)
                                @php $cnt = $workflowStats[$monthIdx][$bar['key']] ?? 0; @endphp
                                <span style="height: 1.5em; width: {{ $cnt * 10 }}%; background: {{ $bar['color'] }}" class="tooltip-x">
                                    <span class="Hide tooltip-x-span"><div class="{{ $bar['class'] }} tooltip-x-div"></div> {{ $bar['label'] }} ({{ $cnt }})</span>
                                </span>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div> 
        </div> 
    </div>
</div>   
@include('Partials.Scripts1')
@endsection