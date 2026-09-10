@extends('Layouts.Layout-2')
@section('Title', 'Availability - ' . session()->get('APP_NAME'))

@section('Content')
@include('Components.Dashboard.VesselSpotlight')
@include('Components.Dashboard.DailyReport')
@include('Partials.Components1')
<button class="DisplayDailyReportButton">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M480-80q-106 0-173-33.5T240-200q0-24 14.5-44.5T295-280l63 59q-9 4-19.5 9T322-200q13 16 60 28t98 12q51 0 98.5-12t60.5-28q-7-8-18-13t-21-9l62-60q28 16 43 36.5t15 45.5q0 53-67 86.5T480-80Zm1-220q99-73 149-146.5T680-594q0-102-65-154t-135-52q-70 0-135 52t-65 154q0 67 49 139.5T481-300Zm-1 100Q339-304 269.5-402T200-594q0-71 25.5-124.5T291-808q40-36 90-54t99-18q49 0 99 18t9₀-54q40 36 65.5 89.5T760-594q0 94-69.5 192T480-200Zm0-320q33 0 56.5-23.5T560-600q0-33-23.5-56.5T480-680q-33 0-56.5 23.5T400-600q0 33 23.5 56.5T480-520Zm0-80Z"/></svg>
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
    {{-- <h3>LIVE</h3> :: {{ count($Vessels) }} --}} 
    @unless (count($Vessels) > 0)
        <p class="empty-data">There's no vessel in the system..</p>
    @endunless
    @foreach (\DB::table('companies_')->get() as $Comapny)
        <h3 class="company-heading">
            <span>
                {{ $Comapny->Organization }}        
            </span>
        </h3>
        <h3 class="report-summary">Report summary <img class="report-summary ReportPdfButton" src="{{ asset('images/pdf.png') }}" alt=""></h3>
        @php
            $Dredgers = \DB::table('vessels_vessel_information as v')->select(['v.VesselName', 'v.Captain', 'v.NightDutyCaptain', 'v.VesselType', 'v.Company', 'v.ImoNumber', 'v.CallSign', 's4.Area'])->join('vessels_section_4 as s4', 'v.VesselName', '=', 's4.VesselName')->where('v.Company', $Comapny->Alias)->where('v.VesselType', 'DREDGER')->get();
        @endphp
        <h3 class="report-summary -x"><img class="ToggleVessels_Icon" src="{{ asset('/images/add (1).png') }}" alt="">Vessels</h3>
        <h3 class="vessel-type-heading vessels_">DREDGERS :: {{ count($Dredgers) }}
        </h3> 
        @unless (count($Dredgers) > 0)
            <span class="vessels_">
                No data available..
            </span>
        @endunless
        @foreach ($Dredgers as $Vessel)
        @php 
            if (isset($_GET['FromDate_FILTERBYDATE']) AND isset($_GET['EndDate_FILTERBYDATE']) AND empty($_GET['SpecificDay'])) {
                $Availability_STATUS = \DB::table('vessel_availabilities')->select(['Vessel', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName)
                                        ->whereBetween('StartDate', [$_GET['FromDate_FILTERBYDATE'], $_GET['EndDate_FILTERBYDATE']])
                                        ->whereNotNull('Status') 
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first(); 
                $Availability_STATUS_2 = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName) 
                                        ->whereBetween('StartDate', [$_GET['FromDate_FILTERBYDATE'], $_GET['EndDate_FILTERBYDATE']])
                                        ->whereNotNull('Status') 
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first();
            } elseif (!(empty($_GET['SpecificDay']))) {
                $Availability_STATUS = \DB::table('vessel_availabilities')->select(['Vessel', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName)
                                        ->where('StartDate', $_GET['SpecificDay'])
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first(); 
                $Availability_STATUS_2 = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName) 
                                        ->where('StartDate', $_GET['SpecificDay'])
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first();
            } else {
            $Availability_STATUS = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime', 'TillNow'])
                                    ->where('Vessel', $Vessel->VesselName) 
                                    ->where('EndDate', '>=', $STARTDATE) 
                                    ->orWhere(function($query) use ($Vessel) {
                                        $query->where('Vessel', $Vessel->VesselName) 
                                                ->where('TillNow', 'YES');
                                    })
                                    ->orderBy('StartDate', 'DESC') 
                                    ->orderBy('StartTime', 'DESC') 
                                    ->orderBy('EndTime', 'DESC')
                                    ->first(); 
            $Availability_STATUS_2 = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime', 'TillNow'])
                                    ->where('Vessel', $Vessel->VesselName)  
                                    ->where('EndDate', '>=', $STARTDATE) 
                                    ->orWhere(function($query) use ($Vessel) {
                                        $query->where('Vessel', $Vessel->VesselName) 
                                                ->where('TillNow', 'YES');
                                    })
                                    ->orderBy('StartDate', 'DESC') 
                                    ->orderBy('StartTime', 'DESC') 
                                    ->orderBy('EndTime', 'DESC')
                                    ->first();
            }
            $StartDate = $Availability_STATUS->StartDate ?? '00:00';
            $EndDate = $Availability_STATUS->EndDate ?? '00:00';
            if (!empty($Availability_STATUS->TillNow)) {
                if ($Availability_STATUS->TillNow == 'YES') {
                    $EndDate = date('Y-m-d');
                }   
            }
            $StartDate_2 = $Availability_STATUS_2->StartDate ?? '00:00';
            $EndDate_2 = $Availability_STATUS_2->EndDate ?? '00:00'; 
            $StartTime = \Carbon\Carbon::parse($Availability_STATUS->StartTime ?? '00:00')->format('H:i').' HRS'; 
            $EndTime = \Carbon\Carbon::parse($Availability_STATUS->EndTime ?? '00:00')->format('H:i').' HRS'; 
            $StartTime_2 = \Carbon\Carbon::parse($Availability_STATUS_2->StartTime ?? '00:00')->format('H:i').' HRS'; 
            $EndTime_2 = \Carbon\Carbon::parse($Availability_STATUS_2->EndTime ?? '00:00')->format('H:i').' HRS'; 
            if (!empty($Availability_STATUS_2->TillNow)) {
                if ($Availability_STATUS_2->TillNow == 'YES') {
                    $EndDate_2 = date('Y-m-d');
                    $EndTime_2 = \Carbon\Carbon::parse(date('H:i') ?? '00:00')->format('H:i').' HRS'; 
                }
            }
            $Dredgers_ROB = \DB::table('vessels_section_4')->select(['ROB'])->where('VesselName', $Vessel->VesselName)->first();
        @endphp
        <div class="list tooltip-x vessels_">
            @if ($EndDate === $StartDate)  
                <span class="Hide tooltip-x-span"><div class="{{ strtolower($Availability_STATUS_2->Status ?? 'READY TO GO') }} tooltip-x-div"></div> On {{ $Availability_STATUS_2->Status ?? 'READY TO GO' }} <br> {{ $StartTime_2 }} - {{ $EndTime_2 }}</span>
            @else
                <span class="Hide tooltip-x-span"><div class="{{ strtolower($Availability_STATUS->Status ?? '') }} tooltip-x-div"></div> On {{ $Availability_STATUS->Status ?? 'READY TO GO' }} <br> {{ $StartTime }} - {{ $EndTime_2 }}</span>
            @endif
            <div class="inner -x">  
                <img class="OpenMaintenanceInfoIcon" src="{{ asset('images/ship (2).png') }}" alt="">
                <div class="Hide">{{ strtolower($Availability_STATUS->Status ?? 'READY TO GO') }}</div>
                <div class="Hide"> {{ $Vessel->VesselName }}</div>
                <strong class="notification-wrapper"> 
                    @include('Components.Includes.VesselStats_DATA')
                    <span class="status-x {{ strtolower($Availability_STATUS->Status ?? 'READY TO GO') }}  
                    "></span>
                    <span class="vessel-name--">{{ $Vessel->VesselName }}</span>
                    <img class="captain--" src="/images/captain.png" alt=""> 
                    <span class="vessel-captain--">{{ $Vessel->Captain }}</span> 
                    <span class="vessel-night-duty-captain--">{{ $Vessel->NightDutyCaptain }}</span> 
                    <span class="vessel-area--">{{ $Vessel->Area ?? 'N/A' }}</span> 
                    <span class="vessel-rob--">{{ $Dredgers_ROB->ROB }}</span> 
                    <span class="imo availability-status vessels {{ strtolower($Availability_STATUS->Status ?? 'READY TO GO') }} status-1">
                        @if (!empty($Availability_STATUS->TillNow) == 'YES')
                            {{ (($Availability_STATUS->Status ?? 'READY') == 'IDLE' ? 'READY' : (($Availability_STATUS->Status ?? 'READY') == 'BUNKERY' ? 'BUNKERING' : $Availability_STATUS->Status ?? 'READY')) }}
                        @else
                            {{ (($Availability_STATUS->Status ?? 'READY TO GO') == 'IDLE' ? 'READY' : $Availability_STATUS->Status ?? 'READY') ?? 'READY TO GO' }}
                        @endif
                    </span>
                </strong>  
                <img class="ReportPdfButtonForVessels" src="{{ asset('images/pdf.png') }}">
                <span class="Hide">{{ $Vessel->VesselName }}</span>
            </div>
        </div> 
        @endforeach 
        @php
            $TugBoats = \DB::table('vessels_vessel_information as v')->select(['v.VesselName', 'v.Captain', 'v.NightDutyCaptain', 'v.VesselType', 'v.Company', 'v.ImoNumber', 'v.CallSign', 's4.Area'])->join('vessels_section_4 as s4', 'v.VesselName', '=', 's4.VesselName')->where('v.Company', $Comapny->Alias)->where('v.VesselType', 'TUG BOAT')->orderByRaw("FIELD(v.VesselName, 'MAJIYA', 'UBIMA', 'UROMI', 'DAURA', 'ZARANDA', 'ASAGA', 'EMEKUKU', 'GUSAU')")->get();
        @endphp
        @unless (count($TugBoats) > 0)
        <span class="vessels_">
            {{-- No data available.. --}}
        </span>
        @else
        <h3 class="vessel-type-heading vessels_">TUG BOATS :: {{ count($TugBoats) }}</h3> 
        @endunless
        @foreach ($TugBoats as $Vessel)
        @php 
            if (isset($_GET['FromDate_FILTERBYDATE']) AND isset($_GET['EndDate_FILTERBYDATE']) AND empty($_GET['SpecificDay'])) {
                $Availability_STATUS = \DB::table('vessel_availabilities')->select(['Vessel', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName)
                                        ->whereBetween('StartDate', [$_GET['FromDate_FILTERBYDATE'], $_GET['EndDate_FILTERBYDATE']])
                                        ->whereNotNull('Status') 
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first(); 
                $Availability_STATUS_2 = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName) 
                                        ->whereBetween('StartDate', [$_GET['FromDate_FILTERBYDATE'], $_GET['EndDate_FILTERBYDATE']])
                                        ->whereNotNull('Status') 
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first();
            } elseif (!(empty($_GET['SpecificDay']))) {
                $Availability_STATUS = \DB::table('vessel_availabilities')->select(['Vessel', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName)
                                        ->where('StartDate', $_GET['SpecificDay'])
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first(); 
                $Availability_STATUS_2 = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName) 
                                        ->where('StartDate', $_GET['SpecificDay'])
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first();
            } else {
            $Availability_STATUS = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime', 'TillNow'])
                                    ->where('Vessel', $Vessel->VesselName) 
                                    ->where('EndDate', '>=', $STARTDATE) 
                                    ->orWhere(function($query) use ($Vessel) {
                                        $query->where('Vessel', $Vessel->VesselName) 
                                                ->where('TillNow', 'YES');
                                    })
                                    ->orderBy('StartDate', 'DESC') 
                                    ->orderBy('StartTime', 'DESC') 
                                    ->orderBy('EndTime', 'DESC') 
                                    ->first(); 
            $Availability_STATUS_2 = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime', 'TillNow'])
                                    ->where('Vessel', $Vessel->VesselName) 
                                    ->where('EndDate', '>=', $STARTDATE)  
                                    ->orWhere(function($query) use ($Vessel) {
                                        $query->where('Vessel', $Vessel->VesselName) 
                                                ->where('TillNow', 'YES');
                                    })
                                    ->orderBy('StartDate', 'DESC') 
                                    ->orderBy('StartTime', 'DESC') 
                                    ->orderBy('EndTime', 'DESC') 
                                    ->first();
            }
            $StartDate = $Availability_STATUS->StartDate ?? '00:00';
            $EndDate = $Availability_STATUS->EndDate ?? '00:00'; 
            if (!empty($Availability_STATUS->TillNow)) {
                if ($Availability_STATUS->TillNow == 'YES') {
                    $EndDate = date('Y-m-d');
                }
            } 
            $StartDate_2 = $Availability_STATUS_2->StartDate ?? '00:00';
            $EndDate_2 = $Availability_STATUS_2->EndDate ?? '00:00'; 
            $StartTime = \Carbon\Carbon::parse($Availability_STATUS->StartTime ?? '00:00')->format('H:i').' HRS'; 
            $EndTime = \Carbon\Carbon::parse($Availability_STATUS->EndTime ?? '00:00')->format('H:i').' HRS'; 
            $StartTime_2 = \Carbon\Carbon::parse($Availability_STATUS_2->StartTime ?? '00:00')->format('H:i').' HRS'; 
            $EndTime_2 = \Carbon\Carbon::parse($Availability_STATUS_2->EndTime ?? '00:00')->format('H:i').' HRS'; 
            if (!empty($Availability_STATUS_2->TillNow)) {
                if ($Availability_STATUS_2->TillNow == 'YES') {
                    $EndDate_2 = date('Y-m-d');
                    $EndTime_2 = \Carbon\Carbon::parse(date('H:i') ?? '00:00')->format('H:i').' HRS'; 
                }
            }
            $TugBoats_ROB = \DB::table('vessels_section_4')->select(['ROB'])->where('VesselName', $Vessel->VesselName)->first();
        @endphp
        <div class="list tooltip-x vessels_"> 
            @if ($EndDate === $StartDate)  
                <span class="Hide tooltip-x-span"><div class="{{ strtolower($Availability_STATUS_2->Status ?? 'READY TO GO') }} tooltip-x-div"></div> On {{ $Availability_STATUS_2->Status ?? 'READY TO GO' }} <br> {{ $StartTime_2 }} - {{ $EndTime_2 }}</span>
            @else
                <span class="Hide tooltip-x-span"><div class="{{ strtolower($Availability_STATUS->Status ?? '') }} tooltip-x-div"></div> On {{ $Availability_STATUS->Status ?? 'READY TO GO' }} <br> {{ $StartTime }} - {{ $EndTime_2 }}</span>
            @endif
            <div class="inner -x">  
                <img class="OpenMaintenanceInfoIcon" src="{{ asset('images/ship (2).png') }}" alt="">
                <div class="Hide">{{ strtolower($Availability_STATUS->Status ?? 'READY TO GO') }}</div>
                <div class="Hide"> {{ $Vessel->VesselName }}</div>
                <strong class="notification-wrapper">
                    @include('Components.Includes.VesselStats_DATA')
                    <span class="status-x {{ strtolower($Availability_STATUS->Status ?? 'READY TO GO') }}
                    "></span>
                    <span class="vessel-name--">{{ $Vessel->VesselName }}</span>
                    <img class="captain--" src="/images/captain.png" alt="">  
                    <span class="vessel-captain--">{{ $Vessel->Captain }}</span>  
                    <span class="vessel-night-duty-captain--">{{ $Vessel->NightDutyCaptain }}</span> 
                    <span class="vessel-area--">{{ $Vessel->Area ?? 'N/A' }}</span> 
                    <span class="vessel-rob--">{{ $TugBoats_ROB->ROB }}</span> 
                    <span class="imo availability-status vessels {{ strtolower($Availability_STATUS->Status ?? 'READY TO GO') }} {{ $Availability_STATUS->Status ?? 'ready' == 'IDLE' ? 'ready' : $Availability_STATUS->Status ?? 'ready' }}
                        status-1">   
                        @if (!empty($Availability_STATUS->TillNow) == 'YES')
                            {{ (($Availability_STATUS->Status ?? 'READY') == 'IDLE' ? 'READY' : (($Availability_STATUS->Status ?? 'READY') == 'BUNKERY' ? 'BUNKERING' : $Availability_STATUS->Status ?? 'READY')) }}
                        @else
                            {{ (($Availability_STATUS->Status ?? 'READY TO GO') == 'IDLE' ? 'READY' : $Availability_STATUS->Status ?? 'READY') ?? 'READY TO GO' }}
                        @endif 
                    </span>
                </strong>  
                <img class="ReportPdfButtonForVessels" src="{{ asset('images/pdf.png') }}">
                <span class="Hide">{{ $Vessel->VesselName }}</span>
            </div>
        </div> 
        @endforeach
        @php
            $PilotCutters = \DB::table('vessels_vessel_information as v')->select(['v.VesselName', 'v.Captain', 'v.NightDutyCaptain', 'v.VesselType', 'v.Company', 'v.ImoNumber', 'v.CallSign', 's4.Area'])->join('vessels_section_4 as s4', 'v.VesselName', '=', 's4.VesselName')->where('v.Company', $Comapny->Alias)->where('v.VesselType', 'PILOT CUTTERS')->get();
        @endphp
        @unless (count($PilotCutters) > 0)
        <span class="vessels_">
            {{-- No data available.. --}}
        </span>
        @else
        <h3 class="vessel-type-heading vessels_">PILOT CUTTERS :: {{ count($PilotCutters) }}</h3> 
        @endunless
        @foreach ($PilotCutters as $Vessel)
        @php 
            if (isset($_GET['FromDate_FILTERBYDATE']) AND isset($_GET['EndDate_FILTERBYDATE']) AND empty($_GET['SpecificDay'])) {
                $Availability_STATUS = \DB::table('vessel_availabilities')->select(['Vessel', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName) 
                                        ->whereBetween('StartDate', [$_GET['FromDate_FILTERBYDATE'], $_GET['EndDate_FILTERBYDATE']])
                                        ->whereNotNull('Status') 
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first(); 
                $Availability_STATUS_2 = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName) 
                                        ->whereBetween('StartDate', [$_GET['FromDate_FILTERBYDATE'], $_GET['EndDate_FILTERBYDATE']])
                                        ->whereNotNull('Status') 
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first();
            } elseif (!(empty($_GET['SpecificDay']))) {
                $Availability_STATUS = \DB::table('vessel_availabilities')->select(['Vessel', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName)
                                        ->where('StartDate', $_GET['SpecificDay'])
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first(); 
                $Availability_STATUS_2 = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName) 
                                        ->where('StartDate', $_GET['SpecificDay'])
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first();
            } else {
            $Availability_STATUS = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime', 'TillNow'])
                                    ->where('Vessel', $Vessel->VesselName) 
                                    ->where('EndDate', '>=', $STARTDATE) 
                                    ->orWhere(function($query) use ($Vessel) {
                                        $query->where('Vessel', $Vessel->VesselName) 
                                                ->where('TillNow', 'YES');
                                    })
                                    ->orderBy('StartDate', 'DESC') 
                                    ->orderBy('StartTime', 'DESC') 
                                    ->orderBy('EndTime', 'DESC')
                                    ->first(); 
            $Availability_STATUS_2 = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime', 'TillNow'])
                                    ->where('Vessel', $Vessel->VesselName) 
                                    ->where('StartDate', $STARTDATE)
                                    ->orWhere(function($query) use ($Vessel) {
                                        $query->where('Vessel', $Vessel->VesselName) 
                                                ->where('TillNow', 'YES');
                                    })
                                    ->orderBy('StartDate', 'DESC') 
                                    ->orderBy('StartTime', 'DESC') 
                                    ->orderBy('EndTime', 'DESC') 
                                    ->first();
            }
            $StartDate = $Availability_STATUS->StartDate ?? '00:00';
            $EndDate = $Availability_STATUS->EndDate ?? '00:00';
            if (!empty($Availability_STATUS->TillNow)) {
                if ($Availability_STATUS->TillNow == 'YES') {
                    $EndDate = date('Y-m-d');
                }
            } 
            $StartDate_2 = $Availability_STATUS_2->StartDate ?? '00:00';
            $EndDate_2 = $Availability_STATUS_2->EndDate ?? '00:00'; 
            $StartTime = \Carbon\Carbon::parse($Availability_STATUS->StartTime ?? '00:00')->format('H:i').' HRS'; 
            $EndTime = \Carbon\Carbon::parse($Availability_STATUS->EndTime ?? '00:00')->format('H:i').' HRS'; 
            $StartTime_2 = \Carbon\Carbon::parse($Availability_STATUS_2->StartTime ?? '00:00')->format('H:i').' HRS'; 
            $EndTime_2 = \Carbon\Carbon::parse($Availability_STATUS_2->EndTime ?? '00:00')->format('H:i').' HRS';
            if (!empty($Availability_STATUS_2->TillNow)) {
                if ($Availability_STATUS_2->TillNow == 'YES') {
                    $EndDate_2 = date('Y-m-d');
                    $EndTime_2 = \Carbon\Carbon::parse(date('H:i') ?? '00:00')->format('H:i').' HRS'; 
                }
            }
            $PilotCutters_ROB = \DB::table('vessels_section_4')->select(['ROB'])->where('VesselName', $Vessel->VesselName)->first();
        @endphp
        <div class="list tooltip-x vessels_"> 
            @if ($EndDate === $StartDate)  
                <span class="Hide tooltip-x-span"><div class="{{ strtolower($Availability_STATUS_2->Status ?? 'READY TO GO') }} tooltip-x-div"></div> On {{ $Availability_STATUS_2->Status ?? 'READY TO GO' }} <br> {{ $StartTime_2 }} - {{ $EndTime_2 }}</span>
            @else
                <span class="Hide tooltip-x-span"><div class="{{ strtolower($Availability_STATUS->Status ?? '') }} tooltip-x-div"></div> On {{ $Availability_STATUS->Status ?? 'READY TO GO' }} <br> {{ $StartTime }} - {{ $EndTime_2 }}</span>
            @endif
            <div class="inner -x">  
                <img class="OpenMaintenanceInfoIcon" src="{{ asset('images/ship (2).png') }}" alt="">
                <div class="Hide">{{ strtolower($Availability_STATUS->Status ?? 'READY TO GO') }}</div>
                <div class="Hide">{{ $Vessel->VesselName }}</div>
                @php
                    $Checklist1a = \DB::table('checklist_1a')->where('Boat', $Vessel->VesselName)->orderBy('Date', 'DESC')->orderBy('TimeIn')->first();
                    $Checklist1b = \DB::table('checklist_1b')->where('Boat', $Vessel->VesselName)->orderBy('Date', 'DESC')->orderBy('TimeIn')->first();
                    $Checklist1c = \DB::table('checklist_1c')->where('Boat', $Vessel->VesselName)->orderBy('Date', 'DESC')->orderBy('TimeIn')->first();
                    $Checklist1d = \DB::table('checklist_1d')->where('Boat', $Vessel->VesselName)->orderBy('Date', 'DESC')->orderBy('TimeIn')->first();
                    $Checklist1e = \DB::table('checklist_1e')->where('Boat', $Vessel->VesselName)->orderBy('Date', 'DESC')->orderBy('TimeIn')->first();
                @endphp
                @include('Components.Includes.Checklists.Checklist1_DATA')
                <strong class="notification-wrapper">
                    @include('Components.Includes.VesselStats_DATA')
                    <span class="status-x  {{ strtolower($Availability_STATUS->Status ?? 'READY TO GO') }}
                    "></span>
                    <span class="vessel-name--">{{ $Vessel->VesselName }}</span>
                    <img class="captain--" src="/images/captain.png" alt="">  
                    <span class="vessel-captain--">{{ $Vessel->Captain }}</span>  
                    <span class="vessel-night-duty-captain--">{{ $Vessel->NightDutyCaptain }}</span> 
                    <span class="vessel-area--">{{ $Vessel->Area ?? 'N/A' }}</span> 
                    <span class="vessel-rob--">{{ $PilotCutters_ROB->ROB }}</span> 
                    <span class="imo availability-status vessels {{ strtolower($Availability_STATUS->Status ?? 'READY TO GO') }} {{ $Availability_STATUS->Status ?? 'ready' == 'IDLE' ? 'ready' : $Availability_STATUS->Status ?? 'ready' }}
                        status-1">
                        @if (!empty($Availability_STATUS->TillNow) == 'YES')
                            {{ (($Availability_STATUS->Status ?? 'READY') == 'IDLE' ? 'READY' : (($Availability_STATUS->Status ?? 'READY') == 'BUNKERY' ? 'BUNKERING' : $Availability_STATUS->Status ?? 'READY')) }}
                        @else
                            {{ (($Availability_STATUS->Status ?? 'READY TO GO') == 'IDLE' ? 'READY' : $Availability_STATUS->Status ?? 'READY') ?? 'READY TO GO' }}
                        @endif
                    </span>
                </strong>  
                <img class="ReportPdfButtonForVessels" src="{{ asset('images/pdf.png') }}">
                <span class="Hide">{{ $Vessel->VesselName }}</span>
            </div>
        </div> 
        @endforeach
        @php
            $Mooring = \DB::table('vessels_vessel_information as v')->select(['v.VesselName', 'v.Captain', 'v.NightDutyCaptain', 'v.VesselType', 'v.Company', 'v.ImoNumber', 'v.CallSign', 's4.Area'])->join('vessels_section_4 as s4', 'v.VesselName', '=', 's4.VesselName')->where('v.Company', $Comapny->Alias)->where('v.VesselType', 'MOORING')->get();
        @endphp
        @unless (count($Mooring) > 0)
        <span class="vessels_">
            {{-- No data available.. --}}
        </span>
        @else
        <h3 class="vessel-type-heading vessels_">MOORINGS :: {{ count($Mooring) }}</h3> 
        @endunless
        @foreach ($Mooring as $Vessel)
        @php 
            if (isset($_GET['FromDate_FILTERBYDATE']) AND isset($_GET['EndDate_FILTERBYDATE']) AND empty($_GET['SpecificDay'])) {
                $Availability_STATUS = \DB::table('vessel_availabilities')->select(['Vessel', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName)
                                        ->whereBetween('StartDate', [$_GET['FromDate_FILTERBYDATE'], $_GET['EndDate_FILTERBYDATE']])
                                        ->whereNotNull('Status') 
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first(); 
                $Availability_STATUS_2 = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName) 
                                        ->whereBetween('StartDate', [$_GET['FromDate_FILTERBYDATE'], $_GET['EndDate_FILTERBYDATE']])
                                        ->whereNotNull('Status') 
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first();
            } elseif (!(empty($_GET['SpecificDay']))) {
                $Availability_STATUS = \DB::table('vessel_availabilities')->select(['Vessel', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName)
                                        ->where('StartDate', $_GET['SpecificDay'])
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first(); 
                $Availability_STATUS_2 = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName) 
                                        ->where('StartDate', $_GET['SpecificDay'])
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first();
            } else {
            $Availability_STATUS = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime', 'TillNow'])
                                    ->where('Vessel', $Vessel->VesselName) 
                                    ->where('EndDate', '>=', $STARTDATE) 
                                    ->orWhere(function($query) use ($Vessel) {
                                        $query->where('Vessel', $Vessel->VesselName) 
                                                ->where('TillNow', 'YES');
                                    })
                                    ->orderBy('StartDate', 'DESC') 
                                    ->orderBy('StartTime', 'DESC') 
                                    ->orderBy('EndTime', 'DESC')
                                    ->first(); 
            $Availability_STATUS_2 = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime', 'TillNow'])
                                    ->where('Vessel', $Vessel->VesselName)  
                                    ->where('EndDate', '>=', $STARTDATE) 
                                    ->orWhere(function($query) use ($Vessel) {
                                        $query->where('Vessel', $Vessel->VesselName) 
                                                ->where('TillNow', 'YES');
                                    })
                                    ->orderBy('StartDate', 'DESC') 
                                    ->orderBy('StartTime', 'DESC') 
                                    ->orderBy('EndTime', 'DESC')
                                    ->first();
            }
            $StartDate = $Availability_STATUS->StartDate ?? '00:00';
            $EndDate = $Availability_STATUS->EndDate ?? '00:00';
            if (!empty($Availability_STATUS->TillNow)) {
                if ($Availability_STATUS->TillNow == 'YES') {
                    $EndDate = date('Y-m-d');
                }
            } 
            $StartDate_2 = $Availability_STATUS_2->StartDate ?? '00:00';
            $EndDate_2 = $Availability_STATUS_2->EndDate ?? '00:00';  
            $StartTime = \Carbon\Carbon::parse($Availability_STATUS->StartTime ?? '00:00')->format('H:i').' HRS'; 
            $EndTime = \Carbon\Carbon::parse($Availability_STATUS->EndTime ?? '00:00')->format('H:i').' HRS'; 
            $StartTime_2 = \Carbon\Carbon::parse($Availability_STATUS_2->StartTime ?? '00:00')->format('H:i').' HRS'; 
            $EndTime_2 = \Carbon\Carbon::parse($Availability_STATUS_2->EndTime ?? '00:00')->format('H:i').' HRS'; 
            if (!empty($Availability_STATUS_2->TillNow)) {
                if ($Availability_STATUS_2->TillNow == 'YES') {
                    $EndDate_2 = date('Y-m-d');
                    $EndTime_2 = \Carbon\Carbon::parse(date('H:i') ?? '00:00')->format('H:i').' HRS'; 
                }
            }
            $Mooring_ROB = \DB::table('vessels_section_4')->select(['ROB'])->where('VesselName', $Vessel->VesselName)->first();
        @endphp
        <div class="list tooltip-x vessels_"> 
            @if ($EndDate === $StartDate)  
                <span class="Hide tooltip-x-span"><div class="{{ strtolower($Availability_STATUS_2->Status ?? 'READY TO GO') }} tooltip-x-div"></div> On {{ $Availability_STATUS_2->Status ?? 'READY TO GO' }} <br> {{ $StartTime_2 }} - {{ $EndTime_2 }}</span>
            @else
                <span class="Hide tooltip-x-span"><div class="{{ strtolower($Availability_STATUS->Status ?? '') }} tooltip-x-div"></div> On {{ $Availability_STATUS->Status ?? 'READY TO GO' }} <br> {{ $StartTime }} - {{ $EndTime_2 }}</span>
            @endif
            <div class="inner -x">  
                <img class="OpenMaintenanceInfoIcon" src="{{ asset('images/ship (2).png') }}" alt="">
                <div class="Hide">{{ strtolower($Availability_STATUS->Status ?? 'READY TO GO') }}</div>
                <div class="Hide"> {{ $Vessel->VesselName }}</div>
                <strong class="notification-wrapper">
                    @include('Components.Includes.VesselStats_DATA')
                    <span class="status-x  {{ strtolower($Availability_STATUS->Status ?? 'READY TO GO') }}
                    "></span>
                    <span class="vessel-name--">{{ $Vessel->VesselName }}</span>
                    <img class="captain--" src="/images/captain.png" alt="">  
                    <span class="vessel-captain--">{{ $Vessel->Captain }}</span> 
                    <span class="vessel-night-duty-captain--">{{ $Vessel->NightDutyCaptain }}</span>  
                    <span class="vessel-area--">{{ $Vessel->Area ?? 'N/A' }}</span> 
                    <span class="vessel-rob--">{{ $Mooring_ROB->ROB }}</span> 
                    <span class="imo availability-status vessels {{ strtolower($Availability_STATUS->Status ?? 'READY TO GO') }} {{ $Availability_STATUS->Status ?? 'ready' == 'IDLE' ? 'ready' : $Availability_STATUS->Status ?? 'ready' }}
                        status-1">
                        @if (!empty($Availability_STATUS->TillNow) == 'YES')
                            {{ (($Availability_STATUS->Status ?? 'READY') == 'IDLE' ? 'READY' : (($Availability_STATUS->Status ?? 'READY') == 'BUNKERY' ? 'BUNKERING' : $Availability_STATUS->Status ?? 'READY')) }}
                        @else
                            {{ (($Availability_STATUS->Status ?? 'READY TO GO') == 'IDLE' ? 'READY' : $Availability_STATUS->Status ?? 'READY') ?? 'READY TO GO' }}
                        @endif
                    </span>
                </strong>  
                <img class="ReportPdfButtonForVessels" src="{{ asset('images/pdf.png') }}">
                <span class="Hide">{{ $Vessel->VesselName }}</span>
            </div>
        </div> 
        @endforeach
        @php
            $Multicat = \DB::table('vessels_vessel_information as v')->select(['v.VesselName', 'v.Captain', 'v.NightDutyCaptain', 'v.VesselType', 'v.Company', 'v.ImoNumber', 'v.CallSign', 's4.Area'])->join('vessels_section_4 as s4', 'v.VesselName', '=', 's4.VesselName')->where('v.Company', $Comapny->Alias)->where('v.VesselType', 'MULTICAT')->get();
        @endphp
        @unless (count($Multicat) > 0)
        <span class="vessels_">
            {{-- No data available.. --}}
        </span>
        @else
        <h3 class="vessel-type-heading vessels_">MULTICATS :: {{ count($Multicat) }}</h3> 
        @endunless
        @foreach ($Multicat as $Vessel)
        @php 
            if (isset($_GET['FromDate_FILTERBYDATE']) AND isset($_GET['EndDate_FILTERBYDATE']) AND empty($_GET['SpecificDay'])) {
                $Availability_STATUS = \DB::table('vessel_availabilities')->select(['Vessel', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName)
                                        ->whereBetween('StartDate', [$_GET['FromDate_FILTERBYDATE'], $_GET['EndDate_FILTERBYDATE']])
                                        ->whereNotNull('Status') 
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first(); 
                $Availability_STATUS_2 = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName) 
                                        ->whereBetween('StartDate', [$_GET['FromDate_FILTERBYDATE'], $_GET['EndDate_FILTERBYDATE']])
                                        ->whereNotNull('Status') 
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first();
            } elseif (!(empty($_GET['SpecificDay']))) {
                $Availability_STATUS = \DB::table('vessel_availabilities')->select(['Vessel', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName)
                                        ->where('StartDate', $_GET['SpecificDay'])
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first(); 
                $Availability_STATUS_2 = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName) 
                                        ->where('StartDate', $_GET['SpecificDay'])
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first();
            } else {
            $Availability_STATUS = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime', 'TillNow'])
                                    ->where('Vessel', $Vessel->VesselName) 
                                    ->where('EndDate', '>=', $STARTDATE) 
                                    ->orWhere(function($query) use ($Vessel) {
                                        $query->where('Vessel', $Vessel->VesselName) 
                                                ->where('TillNow', 'YES');
                                    })
                                    ->orderBy('StartDate', 'DESC') 
                                    ->orderBy('StartTime', 'DESC') 
                                    ->orderBy('EndTime', 'DESC')
                                    ->first(); 
            $Availability_STATUS_2 = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime', 'TillNow'])
                                    ->where('Vessel', $Vessel->VesselName) 
                                    ->where('EndDate', '>=', $STARTDATE) 
                                    ->orWhere(function($query) use ($Vessel) {
                                        $query->where('Vessel', $Vessel->VesselName) 
                                                ->where('TillNow', 'YES');
                                    })
                                    ->orderBy('StartDate', 'DESC') 
                                    ->orderBy('StartTime', 'DESC') 
                                    ->orderBy('EndTime', 'DESC')
                                    ->first();
            }
            $StartDate = $Availability_STATUS->StartDate ?? '00:00';
            $EndDate = $Availability_STATUS->EndDate ?? '00:00';
            if (!empty($Availability_STATUS->TillNow)) {
                if ($Availability_STATUS->TillNow == 'YES') {
                    $EndDate = date('Y-m-d');
                }
            } 
            $StartDate_2 = $Availability_STATUS_2->StartDate ?? '00:00';
            $EndDate_2 = $Availability_STATUS_2->EndDate ?? '00:00';  
            $StartTime = \Carbon\Carbon::parse($Availability_STATUS->StartTime ?? '00:00')->format('H:i').' HRS'; 
            $EndTime = \Carbon\Carbon::parse($Availability_STATUS->EndTime ?? '00:00')->format('H:i').' HRS'; 
            $StartTime_2 = \Carbon\Carbon::parse($Availability_STATUS_2->StartTime ?? '00:00')->format('H:i').' HRS'; 
            $EndTime_2 = \Carbon\Carbon::parse($Availability_STATUS_2->EndTime ?? '00:00')->format('H:i').' HRS'; 
            if (!empty($Availability_STATUS_2->TillNow)) {
                if ($Availability_STATUS_2->TillNow == 'YES') {
                    $EndDate_2 = date('Y-m-d');
                    $EndTime_2 = \Carbon\Carbon::parse(date('H:i') ?? '00:00')->format('H:i').' HRS'; 
                }
            }
            $Multicat_ROB = \DB::table('vessels_section_4')->select(['ROB'])->where('VesselName', $Vessel->VesselName)->first();
        @endphp
        <div class="list tooltip-x vessels_"> 
            @if ($EndDate === $StartDate)  
                <span class="Hide tooltip-x-span"><div class="{{ strtolower($Availability_STATUS_2->Status ?? 'READY TO GO') }} tooltip-x-div"></div> On {{ $Availability_STATUS_2->Status ?? 'READY TO GO' }} <br> {{ $StartTime_2 }} - {{ $EndTime_2 }}</span>
            @else
                <span class="Hide tooltip-x-span"><div class="{{ strtolower($Availability_STATUS->Status ?? '') }} tooltip-x-div"></div> On {{ $Availability_STATUS->Status ?? 'READY TO GO' }} <br> {{ $StartTime }} - {{ $EndTime_2 }}</span>
            @endif
            <div class="inner -x">  
                <img class="OpenMaintenanceInfoIcon" src="{{ asset('images/ship (2).png') }}" alt="">
                <div class="Hide">{{ strtolower($Availability_STATUS->Status ?? 'READY TO GO') }}</div>
                <div class="Hide"> {{ $Vessel->VesselName }}</div>
                <strong class="notification-wrapper">
                    @include('Components.Includes.VesselStats_DATA')
                    <span class="status-x  {{ strtolower($Availability_STATUS->Status ?? 'READY TO GO') }}
                    "></span>
                    <span class="vessel-name--">{{ $Vessel->VesselName }}</span>
                    <img class="captain--" src="/images/captain.png" alt="">  
                    <span class="vessel-captain--">{{ $Vessel->Captain }}</span>  
                    <span class="vessel-night-duty-captain--">{{ $Vessel->NightDutyCaptain }}</span> 
                    <span class="vessel-area--">{{ $Vessel->Area ?? 'N/A' }}</span> 
                    <span class="vessel-rob--">{{ $Multicat_ROB->ROB }}</span> 
                    <span class="imo availability-status vessels {{ strtolower($Availability_STATUS->Status ?? 'READY TO GO') }} {{ $Availability_STATUS->Status ?? 'ready' == 'IDLE' ? 'ready' : $Availability_STATUS->Status ?? 'ready' }}
                        status-1">
                        @if (!empty($Availability_STATUS->TillNow) == 'YES')
                            {{ (($Availability_STATUS->Status ?? 'READY') == 'IDLE' ? 'READY' : (($Availability_STATUS->Status ?? 'READY') == 'BUNKERY' ? 'BUNKERING' : $Availability_STATUS->Status ?? 'READY')) }}
                        @else
                            {{ (($Availability_STATUS->Status ?? 'READY TO GO') == 'IDLE' ? 'READY' : $Availability_STATUS->Status ?? 'READY') ?? 'READY TO GO' }}
                        @endif
                    </span>
                </strong>  
                <img class="ReportPdfButtonForVessels" src="{{ asset('images/pdf.png') }}">
                <span class="Hide">{{ $Vessel->VesselName }}</span>
            </div>
        </div> 
        @endforeach
        @php
            $Survey = \DB::table('vessels_vessel_information as v')->select(['v.VesselName', 'v.Captain', 'v.NightDutyCaptain', 'v.VesselType', 'v.Company', 'v.ImoNumber', 'v.CallSign', 's4.Area'])->join('vessels_section_4 as s4', 'v.VesselName', '=', 's4.VesselName')->where('v.Company', $Comapny->Alias)->where('v.VesselType', 'SURVEY')->get();
        @endphp
        @unless (count($Survey) > 0)
        <span class="vessels_">
            {{-- No data available.. --}}
        </span>
        @else
        <h3 class="vessel-type-heading vessels_">SURVEY :: {{ count($Survey) }}</h3> 
        @endunless
        @foreach ($Survey as $Vessel)
        @php 
            if (isset($_GET['FromDate_FILTERBYDATE']) AND isset($_GET['EndDate_FILTERBYDATE']) AND empty($_GET['SpecificDay'])) {
                $Availability_STATUS = \DB::table('vessel_availabilities')->select(['Vessel', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName)
                                        ->whereBetween('StartDate', [$_GET['FromDate_FILTERBYDATE'], $_GET['EndDate_FILTERBYDATE']])
                                        ->whereNotNull('Status') 
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first(); 
                $Availability_STATUS_2 = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName) 
                                        ->whereBetween('StartDate', [$_GET['FromDate_FILTERBYDATE'], $_GET['EndDate_FILTERBYDATE']])
                                        ->whereNotNull('Status') 
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first();
            } elseif (!(empty($_GET['SpecificDay']))) {
                $Availability_STATUS = \DB::table('vessel_availabilities')->select(['Vessel', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName)
                                        ->where('StartDate', $_GET['SpecificDay'])
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first(); 
                $Availability_STATUS_2 = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName) 
                                        ->where('StartDate', $_GET['SpecificDay'])
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first();
            } else {
            $Availability_STATUS = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime', 'TillNow'])
                                    ->where('Vessel', $Vessel->VesselName) 
                                    ->where('EndDate', '>=', $STARTDATE) 
                                    ->orWhere(function($query) use ($Vessel) {
                                        $query->where('Vessel', $Vessel->VesselName) 
                                                ->where('TillNow', 'YES');
                                    })
                                    ->orderBy('StartDate', 'DESC') 
                                    ->orderBy('StartTime', 'DESC') 
                                    ->orderBy('EndTime', 'DESC')
                                    ->first(); 
            $Availability_STATUS_2 = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime', 'TillNow'])
                                    ->where('Vessel', $Vessel->VesselName)  
                                    ->where('EndDate', '>=', $STARTDATE)
                                    ->orWhere(function($query) use ($Vessel) {
                                        $query->where('Vessel', $Vessel->VesselName) 
                                                ->where('TillNow', 'YES');
                                    })
                                    ->orderBy('StartDate', 'DESC') 
                                    ->orderBy('StartTime', 'DESC') 
                                    ->orderBy('EndTime', 'DESC')
                                    ->first();
            }
            $StartDate = $Availability_STATUS->StartDate ?? '00:00';
            $EndDate = $Availability_STATUS->EndDate ?? '00:00';
            if (!empty($Availability_STATUS->TillNow)) {
                if ($Availability_STATUS->TillNow == 'YES') {
                    $EndDate = date('Y-m-d');
                }
            } 
            $StartDate_2 = $Availability_STATUS_2->StartDate ?? '00:00';
            $EndDate_2 = $Availability_STATUS_2->EndDate ?? '00:00';  
            $StartTime = \Carbon\Carbon::parse($Availability_STATUS->StartTime ?? '00:00')->format('H:i').' HRS'; 
            $EndTime = \Carbon\Carbon::parse($Availability_STATUS->EndTime ?? '00:00')->format('H:i').' HRS'; 
            $StartTime_2 = \Carbon\Carbon::parse($Availability_STATUS_2->StartTime ?? '00:00')->format('H:i').' HRS'; 
            $EndTime_2 = \Carbon\Carbon::parse($Availability_STATUS_2->EndTime ?? '00:00')->format('H:i').' HRS'; 
            if (!empty($Availability_STATUS_2->TillNow)) {
                if ($Availability_STATUS_2->TillNow == 'YES') {
                    $EndDate_2 = date('Y-m-d');
                    $EndTime_2 = \Carbon\Carbon::parse(date('H:i') ?? '00:00')->format('H:i').' HRS'; 
                }
            }
            $Survey_ROB = \DB::table('vessels_section_4')->select(['ROB'])->where('VesselName', $Vessel->VesselName)->first();
        @endphp
        <div class="list tooltip-x vessels_"> 
            @if ($EndDate === $StartDate)  
                <span class="Hide tooltip-x-span"><div class="{{ strtolower($Availability_STATUS_2->Status ?? 'READY TO GO') }} tooltip-x-div"></div> On {{ $Availability_STATUS_2->Status ?? 'READY TO GO' }} <br> {{ $StartTime_2 }} - {{ $EndTime_2 }}</span>
            @else
                <span class="Hide tooltip-x-span"><div class="{{ strtolower($Availability_STATUS->Status ?? '') }} tooltip-x-div"></div> On {{ $Availability_STATUS->Status ?? 'READY TO GO' }} <br> {{ $StartTime }} - {{ $EndTime_2 }}</span>
            @endif
            <div class="inner -x">  
                <img class="OpenMaintenanceInfoIcon" src="{{ asset('images/ship (2).png') }}" alt="">
                <div class="Hide">{{ strtolower($Availability_STATUS->Status ?? 'READY TO GO') }}</div>
                <div class="Hide"> {{ $Vessel->VesselName }}</div>
                <strong class="notification-wrapper">
                    @include('Components.Includes.VesselStats_DATA')
                    <span class="status-x  {{ strtolower($Availability_STATUS->Status ?? 'READY TO GO') }}
                    "></span>
                    <span class="vessel-name--">{{ $Vessel->VesselName }}</span>
                    <img class="captain--" src="/images/captain.png" alt="">  
                    <span class="vessel-captain--">{{ $Vessel->Captain }}</span>  
                    <span class="vessel-night-duty-captain--">{{ $Vessel->NightDutyCaptain }}</span> 
                    <span class="vessel-area--">{{ $Vessel->Area ?? 'N/A' }}</span> 
                    <span class="vessel-rob--">{{ $Survey_ROB->ROB }}</span> 
                    <span class="imo availability-status vessels {{ strtolower($Availability_STATUS->Status ?? 'READY TO GO') }} {{ $Availability_STATUS->Status ?? 'ready' == 'IDLE' ? 'ready' : $Availability_STATUS->Status ?? 'ready' }}
                        status-1">
                        @if (!empty($Availability_STATUS->TillNow) == 'YES')
                            {{ (($Availability_STATUS->Status ?? 'READY') == 'IDLE' ? 'READY' : (($Availability_STATUS->Status ?? 'READY') == 'BUNKERY' ? 'BUNKERING' : $Availability_STATUS->Status ?? 'READY')) }}
                        @else
                            {{ (($Availability_STATUS->Status ?? 'READY TO GO') == 'IDLE' ? 'READY' : $Availability_STATUS->Status ?? 'READY') ?? 'READY TO GO' }}
                        @endif
                    </span>
                </strong>  
                <img class="ReportPdfButtonForVessels" src="{{ asset('images/pdf.png') }}">
                <span class="Hide">{{ $Vessel->VesselName }}</span>
            </div>
        </div> 
        @endforeach 
        @php
            $SpeedBoats = \DB::table('vessels_vessel_information as v')->select(['v.VesselName', 'v.Captain', 'v.NightDutyCaptain', 'v.VesselType', 'v.Company', 'v.ImoNumber', 'v.CallSign', 's4.Area'])->join('vessels_section_4 as s4', 'v.VesselName', '=', 's4.VesselName')->where('v.Company', $Comapny->Alias)->where('v.VesselType', 'SPEED BOAT')->get();
        @endphp
        @unless (count($SpeedBoats) > 0)
        <span class="vessels_">
            {{-- No data available.. --}}
        </span>
        @else
        <h3 class="vessel-type-heading vessels_">SPEED BOATS :: {{ count($SpeedBoats) }}</h3> 
        @endunless
        @foreach ($SpeedBoats as $Vessel)
        @php 
            if (isset($_GET['FromDate_FILTERBYDATE']) AND isset($_GET['EndDate_FILTERBYDATE']) AND empty($_GET['SpecificDay'])) {
                $Availability_STATUS = \DB::table('vessel_availabilities')->select(['Vessel', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName)
                                        ->whereBetween('StartDate', [$_GET['FromDate_FILTERBYDATE'], $_GET['EndDate_FILTERBYDATE']])
                                        ->whereNotNull('Status') 
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first(); 
                $Availability_STATUS_2 = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName) 
                                        ->whereBetween('StartDate', [$_GET['FromDate_FILTERBYDATE'], $_GET['EndDate_FILTERBYDATE']])
                                        ->whereNotNull('Status') 
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first();
            } elseif (!(empty($_GET['SpecificDay']))) {
                $Availability_STATUS = \DB::table('vessel_availabilities')->select(['Vessel', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName)
                                        ->where('StartDate', $_GET['SpecificDay'])
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first(); 
                $Availability_STATUS_2 = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName) 
                                        ->where('StartDate', $_GET['SpecificDay'])
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first();
            } else {
            $Availability_STATUS = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime', 'TillNow'])
                                    ->where('Vessel', $Vessel->VesselName) 
                                    ->where('EndDate', '>=', $STARTDATE) 
                                    ->orWhere(function($query) use ($Vessel) {
                                        $query->where('Vessel', $Vessel->VesselName) 
                                                ->where('TillNow', 'YES');
                                    })
                                    ->orderBy('StartDate', 'DESC') 
                                    ->orderBy('StartTime', 'DESC') 
                                    ->orderBy('EndTime', 'DESC')
                                    ->first(); 
            $Availability_STATUS_2 = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime', 'TillNow'])
                                    ->where('Vessel', $Vessel->VesselName) 
                                    ->where('EndDate', '>=', $STARTDATE) 
                                    ->orWhere(function($query) use ($Vessel) {
                                        $query->where('Vessel', $Vessel->VesselName) 
                                                ->where('TillNow', 'YES');
                                    })
                                    ->orderBy('StartDate', 'DESC') 
                                    ->orderBy('StartTime', 'DESC') 
                                    ->orderBy('EndTime', 'DESC')
                                    ->first();
            }
            $StartDate = $Availability_STATUS->StartDate ?? '00:00';
            $EndDate = $Availability_STATUS->EndDate ?? '00:00';
            if (!empty($Availability_STATUS->TillNow)) {
                if ($Availability_STATUS->TillNow == 'YES') {
                    $EndDate = date('Y-m-d');
                }
            } 
            $StartDate_2 = $Availability_STATUS_2->StartDate ?? '00:00';
            $EndDate_2 = $Availability_STATUS_2->EndDate ?? '00:00';  
            $StartTime = \Carbon\Carbon::parse($Availability_STATUS->StartTime ?? '00:00')->format('H:i').' HRS'; 
            $EndTime = \Carbon\Carbon::parse($Availability_STATUS->EndTime ?? '00:00')->format('H:i').' HRS'; 
            $StartTime_2 = \Carbon\Carbon::parse($Availability_STATUS_2->StartTime ?? '00:00')->format('H:i').' HRS'; 
            $EndTime_2 = \Carbon\Carbon::parse($Availability_STATUS_2->EndTime ?? '00:00')->format('H:i').' HRS'; 
            if (!empty($Availability_STATUS_2->TillNow)) {
                if ($Availability_STATUS_2->TillNow == 'YES') {
                    $EndDate_2 = date('Y-m-d');
                    $EndTime_2 = \Carbon\Carbon::parse(date('H:i') ?? '00:00')->format('H:i').' HRS'; 
                }
            }
            $SpeedBoats_ROB = \DB::table('vessels_section_4')->select(['ROB'])->where('VesselName', $Vessel->VesselName)->first();
        @endphp
        <div class="list tooltip-x vessels_"> 
            @if ($EndDate === $StartDate)  
                <span class="Hide tooltip-x-span"><div class="{{ strtolower($Availability_STATUS_2->Status ?? 'READY TO GO') }} tooltip-x-div"></div> On {{ $Availability_STATUS_2->Status ?? 'READY TO GO' }} <br> {{ $StartTime_2 }} - {{ $EndTime_2 }}</span>
            @else
                <span class="Hide tooltip-x-span"><div class="{{ strtolower($Availability_STATUS->Status ?? '') }} tooltip-x-div"></div> On {{ $Availability_STATUS->Status ?? 'READY TO GO' }} <br> {{ $StartTime }} - {{ $EndTime_2 }}</span>
            @endif
            <div class="inner -x">  
                <img class="OpenMaintenanceInfoIcon" src="{{ asset('images/ship (2).png') }}" alt="">
                <div class="Hide">{{ strtolower($Availability_STATUS->Status ?? 'READY TO GO') }}</div>
                <div class="Hide"> {{ $Vessel->VesselName }}</div>
                <strong class="notification-wrapper">
                    @include('Components.Includes.VesselStats_DATA')
                    <span class="status-x  {{ strtolower($Availability_STATUS->Status ?? 'READY TO GO') }}
                    "></span>
                    <span class="vessel-name--">{{ $Vessel->VesselName }}</span>
                    <img class="captain--" src="/images/captain.png" alt="">  
                    <span class="vessel-captain--">{{ $Vessel->Captain }}</span>  
                    <span class="vessel-night-duty-captain--">{{ $Vessel->NightDutyCaptain }}</span> 
                    <span class="vessel-area--">{{ $Vessel->Area ?? 'N/A' }}</span> 
                    <span class="vessel-rob--">{{ $SpeedBoats_ROB->ROB }}</span> 
                    <span class="imo availability-status vessels {{ strtolower($Availability_STATUS->Status ?? 'READY TO GO') }} {{ $Availability_STATUS->Status ?? 'ready' == 'IDLE' ? 'ready' : $Availability_STATUS->Status ?? 'ready' }}
                        status-1">
                        @if (!empty($Availability_STATUS->TillNow) == 'YES')
                            {{ (($Availability_STATUS->Status ?? 'READY') == 'IDLE' ? 'READY' : (($Availability_STATUS->Status ?? 'READY') == 'BUNKERY' ? 'BUNKERING' : $Availability_STATUS->Status ?? 'READY')) }}
                        @else
                            {{ (($Availability_STATUS->Status ?? 'READY TO GO') == 'IDLE' ? 'READY' : $Availability_STATUS->Status ?? 'READY') ?? 'READY TO GO' }}
                        @endif
                    </span>
                </strong>  
                <img class="ReportPdfButtonForVessels" src="{{ asset('images/pdf.png') }}">
                <span class="Hide">{{ $Vessel->VesselName }}</span>
            </div>
        </div> 
        @endforeach
        @php
            $Ploughing = \DB::table('vessels_vessel_information as v')->select(['v.VesselName', 'v.Captain', 'v.NightDutyCaptain', 'v.VesselType', 'v.Company', 'v.ImoNumber', 'v.CallSign', 's4.Area'])->join('vessels_section_4 as s4', 'v.VesselName', '=', 's4.VesselName')->where('v.Company', $Comapny->Alias)->where('v.VesselType', 'PLOUGHING')->get();
        @endphp
        @unless (count($Ploughing) > 0)
        <span class="vessels_">
            {{-- No data available.. --}}
        </span>
        @else
        <h3 class="vessel-type-heading vessels_">PLOUGHING :: {{ count($Ploughing) }}</h3> 
        @endunless
        @foreach ($Ploughing as $Vessel)
        @php 
            if (isset($_GET['FromDate_FILTERBYDATE']) AND isset($_GET['EndDate_FILTERBYDATE']) AND empty($_GET['SpecificDay'])) {
                $Availability_STATUS = \DB::table('vessel_availabilities')->select(['Vessel', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName)
                                        ->whereBetween('StartDate', [$_GET['FromDate_FILTERBYDATE'], $_GET['EndDate_FILTERBYDATE']])
                                        ->whereNotNull('Status') 
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first(); 
                $Availability_STATUS_2 = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName) 
                                        ->whereBetween('StartDate', [$_GET['FromDate_FILTERBYDATE'], $_GET['EndDate_FILTERBYDATE']])
                                        ->whereNotNull('Status') 
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first();
            } elseif (!(empty($_GET['SpecificDay']))) {
                $Availability_STATUS = \DB::table('vessel_availabilities')->select(['Vessel', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName)
                                        ->where('StartDate', $_GET['SpecificDay'])
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first(); 
                $Availability_STATUS_2 = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName) 
                                        ->where('StartDate', $_GET['SpecificDay'])
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first();
            } else {
            $Availability_STATUS = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime', 'TillNow'])
                                    ->where('Vessel', $Vessel->VesselName) 
                                    ->where('EndDate', '>=', $STARTDATE) 
                                    ->orWhere(function($query) use ($Vessel) {
                                        $query->where('Vessel', $Vessel->VesselName) 
                                                ->where('TillNow', 'YES');
                                    })
                                    ->orderBy('StartDate', 'DESC') 
                                    ->orderBy('StartTime', 'DESC') 
                                    ->orderBy('EndTime', 'DESC')
                                    ->first(); 
            $Availability_STATUS_2 = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime', 'TillNow'])
                                    ->where('Vessel', $Vessel->VesselName)  
                                    ->where('EndDate', '>=', $STARTDATE) 
                                    ->orWhere(function($query) use ($Vessel) {
                                        $query->where('Vessel', $Vessel->VesselName) 
                                                ->where('TillNow', 'YES');
                                    })
                                    ->orderBy('StartDate', 'DESC') 
                                    ->orderBy('StartTime', 'DESC') 
                                    ->orderBy('EndTime', 'DESC')
                                    ->first();
            }
            $StartDate = $Availability_STATUS->StartDate ?? '00:00';
            $EndDate = $Availability_STATUS->EndDate ?? '00:00';
            if (!empty($Availability_STATUS->TillNow)) {
                if ($Availability_STATUS->TillNow == 'YES') {
                    $EndDate = date('Y-m-d');
                }
            } 
            $StartDate_2 = $Availability_STATUS_2->StartDate ?? '00:00';
            $EndDate_2 = $Availability_STATUS_2->EndDate ?? '00:00'; 
            $StartTime = \Carbon\Carbon::parse($Availability_STATUS->StartTime ?? '00:00')->format('H:i').' HRS'; 
            $EndTime = \Carbon\Carbon::parse($Availability_STATUS->EndTime ?? '00:00')->format('H:i').' HRS'; 
            $StartTime_2 = \Carbon\Carbon::parse($Availability_STATUS_2->StartTime ?? '00:00')->format('H:i').' HRS'; 
            $EndTime_2 = \Carbon\Carbon::parse($Availability_STATUS_2->EndTime ?? '00:00')->format('H:i').' HRS'; 
            if (!empty($Availability_STATUS_2->TillNow)) {
                if ($Availability_STATUS_2->TillNow == 'YES') {
                    $EndDate_2 = date('Y-m-d');
                    $EndTime_2 = \Carbon\Carbon::parse(date('H:i') ?? '00:00')->format('H:i').' HRS'; 
                }
            }
            $Ploughing_ROB = \DB::table('vessels_section_4')->select(['ROB'])->where('VesselName', $Vessel->VesselName)->first();
        @endphp
        <div class="list tooltip-x vessels_"> 
            @if ($EndDate === $StartDate)  
                <span class="Hide tooltip-x-span"><div class="{{ strtolower($Availability_STATUS_2->Status ?? 'READY TO GO') }} tooltip-x-div"></div> On {{ $Availability_STATUS_2->Status ?? 'READY TO GO' }} <br> {{ $StartTime_2 }} - {{ $EndTime_2 }}</span>
            @else
                <span class="Hide tooltip-x-span"><div class="{{ strtolower($Availability_STATUS->Status ?? '') }} tooltip-x-div"></div> On {{ $Availability_STATUS->Status ?? 'READY TO GO' }} <br> {{ $StartTime }} - {{ $EndTime_2 }}</span>
            @endif
            <div class="inner -x">  
                <img class="OpenMaintenanceInfoIcon" src="{{ asset('images/ship (2).png') }}" alt="">
                <div class="Hide">{{ strtolower($Availability_STATUS->Status ?? 'READY TO GO') }}</div>
                <div class="Hide"> {{ $Vessel->VesselName }}</div>
                <strong class="notification-wrapper">
                    @include('Components.Includes.VesselStats_DATA')
                    <span class="status-x  {{ strtolower($Availability_STATUS->Status ?? 'READY TO GO') }}
                    "></span>
                    <span class="vessel-name--">{{ $Vessel->VesselName }}</span>
                    <img class="captain--" src="/images/captain.png" alt="">  
                    <span class="vessel-captain--">{{ $Vessel->Captain }}</span>  
                    <span class="vessel-night-duty-captain--">{{ $Vessel->NightDutyCaptain }}</span> 
                    <span class="vessel-area--">{{ $Vessel->Area ?? 'N/A' }}</span> 
                    <span class="vessel-rob--">{{ $Ploughing_ROB->ROB }}</span> 
                    <span class="imo availability-status vessels {{ strtolower($Availability_STATUS->Status ?? 'READY TO GO') }} {{ $Availability_STATUS->Status ?? 'ready' == 'IDLE' ? 'ready' : $Availability_STATUS->Status ?? 'ready' }}
                        status-1">
                        @if (!empty($Availability_STATUS->TillNow) == 'YES')
                            {{ (($Availability_STATUS->Status ?? 'READY') == 'IDLE' ? 'READY' : (($Availability_STATUS->Status ?? 'READY') == 'BUNKERY' ? 'BUNKERING' : $Availability_STATUS->Status ?? 'READY')) }}
                        @else
                            {{ (($Availability_STATUS->Status ?? 'READY TO GO') == 'IDLE' ? 'READY' : $Availability_STATUS->Status ?? 'READY') ?? 'READY TO GO' }}
                        @endif
                    </span>
                </strong>  
                <img class="ReportPdfButtonForVessels" src="{{ asset('images/pdf.png') }}">
                <span class="Hide">{{ $Vessel->VesselName }}</span>
            </div>
        </div> 
        @endforeach  
        @php
            $Others = \DB::table('vessels_vessel_information as v')->select(['v.VesselName', 'v.Captain', 'v.NightDutyCaptain', 'v.VesselType', 'v.Company', 'v.ImoNumber', 'v.CallSign', 's4.Area'])->join('vessels_section_4 as s4', 'v.VesselName', '=', 's4.VesselName')->where('v.Company', $Comapny->Alias)->where('v.VesselType', 'OTHERS')->get();
        @endphp
        @unless (count($Others) > 0)
        <span class="vessels_">
            {{-- No data available.. --}}
        </span>
        @else
        <h3 class="vessel-type-heading vessels_">OTHERS :: {{ count($Others) }}</h3> 
        @endunless
        @foreach ($Others as $Vessel)
        @php 
            if (isset($_GET['FromDate_FILTERBYDATE']) AND isset($_GET['EndDate_FILTERBYDATE']) AND empty($_GET['SpecificDay'])) {
                $Availability_STATUS = \DB::table('vessel_availabilities')->select(['Vessel', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName)
                                        ->whereBetween('StartDate', [$_GET['FromDate_FILTERBYDATE'], $_GET['EndDate_FILTERBYDATE']])
                                        ->whereNotNull('Status') 
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first(); 
                $Availability_STATUS_2 = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName) 
                                        ->whereBetween('StartDate', [$_GET['FromDate_FILTERBYDATE'], $_GET['EndDate_FILTERBYDATE']])
                                        ->whereNotNull('Status') 
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first();
            } elseif (!(empty($_GET['SpecificDay']))) {
                $Availability_STATUS = \DB::table('vessel_availabilities')->select(['Vessel', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName)
                                        ->where('StartDate', $_GET['SpecificDay'])
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first(); 
                $Availability_STATUS_2 = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime'])
                                        ->where('Vessel', $Vessel->VesselName) 
                                        ->where('StartDate', $_GET['SpecificDay'])
                                        ->orderBy('EndTime', 'DESC') 
                                        ->first();
            } else {
            $Availability_STATUS = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime', 'TillNow'])
                                    ->where('Vessel', $Vessel->VesselName) 
                                    ->where('EndDate', '>=', $STARTDATE) 
                                    ->orWhere(function($query) use ($Vessel) {
                                        $query->where('Vessel', $Vessel->VesselName) 
                                                ->where('TillNow', 'YES');
                                    })
                                    ->orderBy('StartDate', 'DESC') 
                                    ->orderBy('StartTime', 'DESC') 
                                    ->orderBy('EndTime', 'DESC')
                                    ->first(); 
            $Availability_STATUS_2 = \DB::table('vessel_availabilities')->select(['Vessel', 'Comment', 'StartDate', 'EndDate', 'Status', 'StartTime', 'EndTime', 'TillNow'])
                                    ->where('Vessel', $Vessel->VesselName)  
                                    ->where('EndDate', '>=', $STARTDATE) 
                                    ->orWhere(function($query) use ($Vessel) {
                                        $query->where('Vessel', $Vessel->VesselName) 
                                                ->where('TillNow', 'YES');
                                    })
                                    ->orderBy('StartDate', 'DESC') 
                                    ->orderBy('StartTime', 'DESC') 
                                    ->orderBy('EndTime', 'DESC')
                                    ->first();
            }
            $StartDate = $Availability_STATUS->StartDate ?? '00:00';
            $EndDate = $Availability_STATUS->EndDate ?? '00:00';
            if (!empty($Availability_STATUS->TillNow)) {
                if ($Availability_STATUS->TillNow == 'YES') {
                    $EndDate = date('Y-m-d');
                }
            } 
            $StartDate_2 = $Availability_STATUS_2->StartDate ?? '00:00';
            $EndDate_2 = $Availability_STATUS_2->EndDate ?? '00:00';  
            $StartTime = \Carbon\Carbon::parse($Availability_STATUS->StartTime ?? '00:00')->format('H:i').' HRS'; 
            $EndTime = \Carbon\Carbon::parse($Availability_STATUS->EndTime ?? '00:00')->format('H:i').' HRS'; 
            $StartTime_2 = \Carbon\Carbon::parse($Availability_STATUS_2->StartTime ?? '00:00')->format('H:i').' HRS'; 
            $EndTime_2 = \Carbon\Carbon::parse($Availability_STATUS_2->EndTime ?? '00:00')->format('H:i').' HRS'; 
            if (!empty($Availability_STATUS_2->TillNow)) {
                if ($Availability_STATUS_2->TillNow == 'YES') {
                    $EndDate_2 = date('Y-m-d');
                    $EndTime_2 = \Carbon\Carbon::parse(date('H:i') ?? '00:00')->format('H:i').' HRS'; 
                }
            }
            $Others_ROB = \DB::table('vessels_section_4')->select(['ROB'])->where('VesselName', $Vessel->VesselName)->first();
        @endphp
        <div class="list tooltip-x vessels_"> 
            @if ($EndDate === $StartDate)  
                <span class="Hide tooltip-x-span"><div class="{{ strtolower($Availability_STATUS_2->Status ?? 'READY TO GO') }} tooltip-x-div"></div> On {{ $Availability_STATUS_2->Status ?? 'READY TO GO' }} <br> {{ $StartTime_2 }} - {{ $EndTime_2 }}</span>
            @else
                <span class="Hide tooltip-x-span"><div class="{{ strtolower($Availability_STATUS->Status ?? '') }} tooltip-x-div"></div> On {{ $Availability_STATUS->Status ?? 'READY TO GO' }} <br> {{ $StartTime }} - {{ $EndTime_2 }}</span>
            @endif
            <div class="inner -x">  
                <img class="OpenMaintenanceInfoIcon" src="{{ asset('images/ship (2).png') }}" alt="">
                <div class="Hide">{{ strtolower($Availability_STATUS->Status ?? 'READY TO GO') }}</div>
                <div class="Hide"> {{ $Vessel->VesselName }}</div>
                <strong class="notification-wrapper">
                    @include('Components.Includes.VesselStats_DATA')
                    <span class="status-x  {{ strtolower($Availability_STATUS->Status ?? 'READY TO GO') }}
                    "></span>
                    <span class="vessel-name--">{{ $Vessel->VesselName }}</span>
                    <img class="captain--" src="/images/captain.png" alt="">  
                    <span class="vessel-captain--">{{ $Vessel->Captain }}</span>  
                    <span class="vessel-night-duty-captain--">{{ $Vessel->NightDutyCaptain }}</span> 
                    <span class="vessel-area--">{{ $Vessel->Area ?? 'N/A' }}</span> 
                    <span class="vessel-rob--">{{ $Others_ROB->ROB }}</span> 
                    <span class="imo availability-status vessels {{ strtolower($Availability_STATUS->Status ?? 'READY TO GO') }} {{ $Availability_STATUS->Status ?? 'ready' == 'IDLE' ? 'ready' : $Availability_STATUS->Status ?? 'ready' }}
                        status-1">
                        @if (!empty($Availability_STATUS->TillNow) == 'YES')
                            {{ (($Availability_STATUS->Status ?? 'READY') == 'IDLE' ? 'READY' : (($Availability_STATUS->Status ?? 'READY') == 'BUNKERY' ? 'BUNKERING' : $Availability_STATUS->Status ?? 'READY')) }}
                        @else
                            {{ (($Availability_STATUS->Status ?? 'READY TO GO') == 'IDLE' ? 'READY' : $Availability_STATUS->Status ?? 'READY') ?? 'READY TO GO' }}
                        @endif
                    </span>
                </strong>  
                <img class="ReportPdfButtonForVessels" src="{{ asset('images/pdf.png') }}">
                <span class="Hide">{{ $Vessel->VesselName }}</span>
            </div>
        </div> 
        @endforeach  
        {{--  --}}
        @php
            $NumberOfGenerators = \DB::table('generators')->select('id')->where('Company', $Comapny->Alias)->whereRaw('LOWER(MachineType) = ?', ['generator'])->get();
            $NumberOfCompressors = \DB::table('generators')->select('id')->where('Company', $Comapny->Alias)->whereRaw('LOWER(MachineType) = ?', ['compressor'])->get();
            $NumberOfPumps = \DB::table('generators')->select('id')->where('Company', $Comapny->Alias)->whereRaw('LOWER(MachineType) = ?', ['pump'])->get();
            $NumberOfEngines = \DB::table('generators')->select('id')->where('Company', $Comapny->Alias)->whereRaw('LOWER(MachineType) = ?', ['engine'])->get();
        @endphp
        <h3 class="report-summary -x"><img class="ToggleGenerators_Icon" src="{{ asset('/images/add (1).png') }}" alt="">Pumps ({{ count($NumberOfPumps)  }}) :: Generators ({{ count($NumberOfGenerators)  }}) :: Engines ({{ count($NumberOfEngines)  }}) :: Compressors ({{ count($NumberOfCompressors)  }})</h3>
        @php
            $OfficeGenerators1 = \DB::table('generators')->where('Company', $Comapny->Alias)->where('Class', 'ENGINES IN STOCK')->get();
        @endphp
            @unless (count($OfficeGenerators1) > 0)
            <span class="generators_">
                {{-- No data available.. --}}
            </span>
            @else
            <h3 class="vessel-type-heading generators_">ENGINES IN STOCK :: {{ count($OfficeGenerators1) }}
            </h3> 
        @endunless
        @foreach ($OfficeGenerators1 as $Generator) 
        @php
            $OfficeGenerators1_InStock = \DB::table('generator_availability')
            ->where('GeneratorId', $Generator->id)
            ->orderBy('EndDate', 'DESC')
            ->orderBy('StartTime', 'DESC')
            ->first();
        @endphp
        <div class="list tooltip-x generators_">
            <span class="Hide tooltip-x-span"><div class="{{ ($OfficeGenerators1_InStock->Status ?? 'READY') }} tooltip-x-div"></div> On {{ ($OfficeGenerators1_InStock->Status ?? 'READY') == 'IDLE' ? 'READY' : ($OfficeGenerators1_InStock->Status ?? 'READY') }}
                 <br> {{ ($OfficeGenerators1_InStock->StartDate ?? date('Y-m-d')) }} <br> {{ ($OfficeGenerators1_InStock->EndDate ?? date('Y-m-d')) }} 
                 <br> {{ ($OfficeGenerators1_InStock->StartTime ?? '00:00') }} HRS - {{ ($OfficeGenerators1_InStock->EndTime ?? '00:00') }} HRS
            </span> 
            <div class="inner -x">  
                <img class="" src="{{ asset('images/' . ($Generator->MachineType ?? 'Generator') . '.png') }}" alt="">
                <div class="Hide">{{ strtolower(($OfficeGenerators1_InStock->Status ?? 'READY')) }}</div>
                <div class="Hide"> {{ $Generator->EngineMake }}</div>
                <strong class="notification-wrapper _generator_"> 
                    {{-- @include('Components.Includes.VesselStats_DATA') --}}
                    <span class="status-x {{ strtolower(($OfficeGenerators1_InStock->Status ?? 'READY')) }}  
                    "></span>
                    <span class="vessel-name--">{{ $Generator->EngineMake }} - {{ $Generator->UsedBy }}</span> 
                    <span class="imo availability-status generators {{ strtolower(($OfficeGenerators1_InStock->Status ?? 'READY')) }} status-1">
                        {{ (($OfficeGenerators1_InStock->Status ?? 'READY') == 'IDLE' ? 'READY' : ($OfficeGenerators1_InStock->Status ?? 'READY')) }}
                    </span>
                </strong> 
                <span class="Hide">{{ ($Generator->Priority_InternalNo ?? '-') }}</span>
                <span class="Hide">{{ ($Generator->EngineMake ?? '-') }}</span>
                <span class="Hide">{{ ($Generator->Model ?? '-') }}</span>
                <span class="Hide">{{ ($Generator->SN ?? '-') }}</span>
                <span class="Hide">{{ ($Generator->EngineType ?? '-') }}</span>
                <span class="Hide">{{ ($Generator->Location ?? '-') }}</span>
                <span class="Hide">{{ ($Generator->Remarks ?? '-') }}</span>
                <span class="Hide">{{ ($Generator->Company ?? '-') }}</span> 
                <span class="Hide">{{ ($Generator->Class ?? '-') }}</span> 
                <span class="Hide">{{ ($Generator->UsedBy ?? '-') }}</span> 
                <span class="Hide">{{ ($Generator->Power ?? '-') }}</span> 
                <span class="Hide">{{ ($Generator->id ?? '-') }}</span> 
                <span class="Hide">{{ ($Generator->MachineType ?? '-') }}</span> 
                <img class="ReportPdfButtonForVessels" src="{{ asset('images/pdf.png') }}">
                <span class="Hide">{{ $Generator->EngineMake }}</span>
            </div>
        </div> 
        @endforeach 
        @php
            $AshoreGenerators = \DB::table('generators')->where('Company', $Comapny->Alias)->where('Class', 'ASHORE MACHINERY')->get();
        @endphp
            @unless (count($AshoreGenerators) > 0)
            <span class="generators_">
                {{-- No data available.. --}}
            </span>
            @else
            <h3 class="vessel-type-heading generators_">ASHORE MACHINERY :: {{ count($AshoreGenerators) }}
            </h3> 
        @endunless
        @foreach ($AshoreGenerators as $Generator) 
        @php
            $AshoreGenerators_Availability = \DB::table('generator_availability')
            ->where('GeneratorId', $Generator->id)
            ->orderBy('EndDate', 'DESC')
            ->orderBy('StartTime', 'DESC')
            ->first();
        @endphp
        <div class="list tooltip-x generators_">
            <span class="Hide tooltip-x-span"><div class="{{ ($AshoreGenerators_Availability->Status ?? 'READY') }} tooltip-x-div"></div> On {{ (($AshoreGenerators_Availability->Status ?? 'READY') == 'IDLE' ? 'READY' : ($AshoreGenerators_Availability->Status ?? 'READY')) }}
                 <br> {{ ($AshoreGenerators_Availability->StartDate ?? date('Y-m-d')) }} <br> {{ ($AshoreGenerators_Availability->EndDate ?? date('Y-m-d')) }} 
                 <br> {{ ($AshoreGenerators_Availability->StartTime ?? '00:00') }} HRS - {{ ($AshoreGenerators_Availability->EndTime ?? '00:00') }} HRS
            </span> 
            <div class="inner -x">  
                <img class="" src="{{ asset('images/' . ($Generator->MachineType ?? 'Generator') . '.png') }}" alt="">
                <div class="Hide">{{ strtolower(($AshoreGenerators_Availability->Status ?? 'READY')) }}</div>
                <div class="Hide"> {{ $Generator->EngineMake }}</div>
                <strong class="notification-wrapper _generator_"> 
                    {{-- @include('Components.Includes.VesselStats_DATA') --}}
                    <span class="status-x {{ strtolower(($AshoreGenerators_Availability->Status ?? 'READY')) }}  
                    "></span>
                    <span class="vessel-name--">{{ $Generator->EngineMake }} - {{ $Generator->UsedBy }}</span> 
                    <span class="imo availability-status generators {{ strtolower(($AshoreGenerators_Availability->Status ?? 'READY')) }} status-1">
                        {{ (($AshoreGenerators_Availability->Status ?? 'READY') == 'IDLE' ? 'READY' : ($AshoreGenerators_Availability->Status ?? 'READY')) }}
                    </span>
                </strong>  
                <span class="Hide">{{ ($Generator->Priority_InternalNo ?? '-') }}</span>
                <span class="Hide">{{ ($Generator->EngineMake ?? '-') }}</span>
                <span class="Hide">{{ ($Generator->Model ?? '-') }}</span>
                <span class="Hide">{{ ($Generator->SN ?? '-') }}</span>
                <span class="Hide">{{ ($Generator->EngineType ?? '-') }}</span>
                <span class="Hide">{{ ($Generator->Location ?? '-') }}</span>
                <span class="Hide">{{ ($Generator->Remarks ?? '-') }}</span>
                <span class="Hide">{{ ($Generator->Company ?? '-') }}</span> 
                <span class="Hide">{{ ($Generator->Class ?? '-') }}</span> 
                <span class="Hide">{{ ($Generator->UsedBy ?? '-') }}</span> 
                <span class="Hide">{{ ($Generator->Power ?? '-') }}</span> 
                <span class="Hide">{{ ($Generator->id ?? '-') }}</span> 
                <span class="Hide">{{ ($Generator->MachineType ?? '-') }}</span> 
                <img class="ReportPdfButtonForVessels" src="{{ asset('images/pdf.png') }}">
                <span class="Hide">{{ $Generator->EngineMake }}</span>
            </div>
        </div> 
        @endforeach 
        {{--  --}}
    @endforeach
</div>
<div class="content-data availability dashboard"> 
    <div class="dashboard-inner"> 
        <h1 class="dashboard-heading"><svg class="-x" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m136-240-56-56 296-298 160 160 208-206H640v-80h240v240h-80v-104L536-320 376-480 136-240Z"/></svg>Availability Dashboard</h1>
        <button class="RecordAvailabilityButton">+ Record/Schedule Availability</button>
        <button class="FilterByDateButton">+ Filter</button>
        {{-- <a href="www.windy.com">WINDY</a> --}}
        <div class="upper-links">
            <a href="/Portfolio" class="portfolio-link">Videos</a>
            <div class="open-idashboard">iDashboard</div>
        </div>
    <a class="weatherwidget-io" href="https://forecast7.com/en/6d523d38/lagos/" data-label_1="LAGOS" data-label_2="WEATHER" data-icons="Climacons" data-theme="original" >LAGOS WEATHER</a>
    <script>
        !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
    </script>
        <div class="board-1">
            <div class="div">
                <h1>
                    Vessels/Machineries <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M192 32c0-17.7 14.3-32 32-32H352c17.7 0 32 14.3 32 32V64h48c26.5 0 48 21.5 48 48V240l44.4 14.8c23.1 7.7 29.5 37.5 11.5 53.9l-101 92.6c-16.2 9.4-34.7 15.1-50.9 15.1c-19.6 0-40.8-7.7-59.2-20.3c-22.1-15.5-51.6-15.5-73.7 0c-17.1 11.8-38 20.3-59.2 20.3c-16.2 0-34.7-5.7-50.9-15.1l-101-92.6c-18-16.5-11.6-46.2 11.5-53.9L96 240V112c0-26.5 21.5-48 48-48h48V32zM160 218.7l107.8-35.9c13.1-4.4 27.3-4.4 40.5 0L416 218.7V128H160v90.7zM306.5 421.9C329 437.4 356.5 448 384 448c26.9 0 55.4-10.8 77.4-26.1l0 0c11.9-8.5 28.1-7.8 39.2 1.7c14.4 11.9 32.5 21 50.6 25.2c17.2 4 27.9 21.2 23.9 38.4s-21.2 27.9-38.4 23.9c-24.5-5.7-44.9-16.5-58.2-25C449.5 501.7 417 512 384 512c-31.9 0-60.6-9.9-80.4-18.9c-5.8-2.7-11.1-5.3-15.6-7.7c-4.5 2.4-9.7 5.1-15.6 7.7c-19.8 9-48.5 18.9-80.4 18.9c-33 0-65.5-10.3-94.5-25.8c-13.4 8.4-33.7 19.3-58.2 25c-17.2 4-34.4-6.7-38.4-23.9s6.7-34.4 23.9-38.4c18.1-4.2 36.2-13.3 50.6-25.2c11.1-9.4 27.3-10.1 39.2-1.7l0 0C136.7 437.2 165.1 448 192 448c27.5 0 55-10.6 77.5-26.1c11.1-7.9 25.9-7.9 37 0z"></path></svg>
                </h1>
                <h2 class="sub-heading">
                    @php
                        $Companies = \DB::table('companies_')->get();
                    @endphp
                    @foreach ($Companies as $Company)
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
                    Other  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M192 32c0-17.7 14.3-32 32-32H352c17.7 0 32 14.3 32 32V64h48c26.5 0 48 21.5 48 48V240l44.4 14.8c23.1 7.7 29.5 37.5 11.5 53.9l-101 92.6c-16.2 9.4-34.7 15.1-50.9 15.1c-19.6 0-40.8-7.7-59.2-20.3c-22.1-15.5-51.6-15.5-73.7 0c-17.1 11.8-38 20.3-59.2 20.3c-16.2 0-34.7-5.7-50.9-15.1l-101-92.6c-18-16.5-11.6-46.2 11.5-53.9L96 240V112c0-26.5 21.5-48 48-48h48V32zM160 218.7l107.8-35.9c13.1-4.4 27.3-4.4 40.5 0L416 218.7V128H160v90.7zM306.5 421.9C329 437.4 356.5 448 384 448c26.9 0 55.4-10.8 77.4-26.1l0 0c11.9-8.5 28.1-7.8 39.2 1.7c14.4 11.9 32.5 21 50.6 25.2c17.2 4 27.9 21.2 23.9 38.4s-21.2 27.9-38.4 23.9c-24.5-5.7-44.9-16.5-58.2-25C449.5 501.7 417 512 384 512c-31.9 0-60.6-9.9-80.4-18.9c-5.8-2.7-11.1-5.3-15.6-7.7c-4.5 2.4-9.7 5.1-15.6 7.7c-19.8 9-48.5 18.9-80.4 18.9c-33 0-65.5-10.3-94.5-25.8c-13.4 8.4-33.7 19.3-58.2 25c-17.2 4-34.4-6.7-38.4-23.9s6.7-34.4 23.9-38.4c18.1-4.2 36.2-13.3 50.6-25.2c11.1-9.4 27.3-10.1 39.2-1.7l0 0C136.7 437.2 165.1 448 192 448c27.5 0 55-10.6 77.5-26.1c11.1-7.9 25.9-7.9 37 0z"></path></svg>
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
                        @if ($STARTDATE == date('Y-m-d'))
                        TODAY
                        @elseif ($STARTDATE == date('Y-m-d', strtotime('yesterday')))
                        YESTERDAY 
                        @elseif (isset($_GET['SpecificDay']) AND !(empty($_GET['SpecificDay'])))
                        {{ $_GET['SpecificDay'] }} 
                        @elseif (isset($_GET['FromDate_FILTERBYDATE']) AND isset($_GET['EndDate_FILTERBYDATE']) AND empty($_GET['SpecificDay']))
                        {{ $_GET['FromDate_FILTERBYDATE'] }} to {{ $_GET['EndDate_FILTERBYDATE'] }}
                        @endif 
                    </span>
                </h2>
            </div> 
            @include('Components.Charts.Chart2') 
            @include('Components.Charts.Chart1-JS') 
            {{-- @include('Components.Charts.Chart3-JS')  --}}
            @include('Components.Charts.Chart4-JS') 
            @include('Components.Charts.Chart5-JS') 
            @include('Components.Charts.Chart6-JS') 
            {{-- <div class="div"> --}}
                {{-- <h1>
                    Operation <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M352 124.5l-51.9-13c-6.5-1.6-11.3-7.1-12-13.8s2.8-13.1 8.7-16.1l40.8-20.4L294.4 28.8c-5.5-4.1-7.8-11.3-5.6-17.9S297.1 0 304 0H416h32 16c30.2 0 58.7 14.2 76.8 38.4l57.6 76.8c6.2 8.3 9.6 18.4 9.6 28.8c0 26.5-21.5 48-48 48H538.5c-17 0-33.3-6.7-45.3-18.7L480 160H448v21.5c0 24.8 12.8 47.9 33.8 61.1l106.6 66.6c32.1 20.1 51.6 55.2 51.6 93.1C640 462.9 590.9 512 530.2 512H496 432 32.3c-3.3 0-6.6-.4-9.6-1.4C13.5 507.8 6 501 2.4 492.1C1 488.7 .2 485.2 0 481.4c-.2-3.7 .3-7.3 1.3-10.7c2.8-9.2 9.6-16.7 18.6-20.4c3-1.2 6.2-2 9.5-2.2L433.3 412c8.3-.7 14.7-7.7 14.7-16.1c0-4.3-1.7-8.4-4.7-11.4l-44.4-44.4c-30-30-46.9-70.7-46.9-113.1V181.5v-57zM512 72.3c0-.1 0-.2 0-.3s0-.2 0-.3v.6zm-1.3 7.4L464.3 68.1c-.2 1.3-.3 2.6-.3 3.9c0 13.3 10.7 24 24 24c10.6 0 19.5-6.8 22.7-16.3zM130.9 116.5c16.3-14.5 40.4-16.2 58.5-4.1l130.6 87V227c0 32.8 8.4 64.8 24 93H112c-6.7 0-12.7-4.2-15-10.4s-.5-13.3 4.6-17.7L171 232.3 18.4 255.8c-7 1.1-13.9-2.6-16.9-9s-1.5-14.1 3.8-18.8L130.9 116.5z"></path></svg>
                </h1>
                <h2 class="sub-heading">Activities</h2>
                <strong>{{ $NumberOfVessels_OPERATION }}</strong> <br>
                <h2>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m136-240-56-56 296-298 160 160 208-206H640v-80h240v240h-80v-104L536-320 376-480 136-240Z"/></svg> N.C.V 
                    </span> 
                    <span>Since 12:00AM</span>
                </h2> --}}
            {{-- </div>   --}}
        </div>  
        <div class="board-1 board-x">
            <div class="div indicators">
                <h1>
                    Indicators <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M352 124.5l-51.9-13c-6.5-1.6-11.3-7.1-12-13.8s2.8-13.1 8.7-16.1l40.8-20.4L294.4 28.8c-5.5-4.1-7.8-11.3-5.6-17.9S297.1 0 304 0H416h32 16c30.2 0 58.7 14.2 76.8 38.4l57.6 76.8c6.2 8.3 9.6 18.4 9.6 28.8c0 26.5-21.5 48-48 48H538.5c-17 0-33.3-6.7-45.3-18.7L480 160H448v21.5c0 24.8 12.8 47.9 33.8 61.1l106.6 66.6c32.1 20.1 51.6 55.2 51.6 93.1C640 462.9 590.9 512 530.2 512H496 432 32.3c-3.3 0-6.6-.4-9.6-1.4C13.5 507.8 6 501 2.4 492.1C1 488.7 .2 485.2 0 481.4c-.2-3.7 .3-7.3 1.3-10.7c2.8-9.2 9.6-16.7 18.6-20.4c3-1.2 6.2-2 9.5-2.2L433.3 412c8.3-.7 14.7-7.7 14.7-16.1c0-4.3-1.7-8.4-4.7-11.4l-44.4-44.4c-30-30-46.9-70.7-46.9-113.1V181.5v-57zM512 72.3c0-.1 0-.2 0-.3s0-.2 0-.3v.6zm-1.3 7.4L464.3 68.1c-.2 1.3-.3 2.6-.3 3.9c0 13.3 10.7 24 24 24c10.6 0 19.5-6.8 22.7-16.3zM130.9 116.5c16.3-14.5 40.4-16.2 58.5-4.1l130.6 87V227c0 32.8 8.4 64.8 24 93H112c-6.7 0-12.7-4.2-15-10.4s-.5-13.3 4.6-17.7L171 232.3 18.4 255.8c-7 1.1-13.9-2.6-16.9-9s-1.5-14.1 3.8-18.8L130.9 116.5z"></path></svg>
                </h1> 
                <div class="indicators-wrapper">
                    <div class="indicators-inner">
                        <div class="indicators-inner-x">
                            <span class="docking"></span> 
                            <span class="FilterDocking">DOCKING</span>
                        </div>
                        <div class="indicators-inner-x">
                            <span class="inspection"></span> 
                            <span class="FilterInspection">INSPECTION</span>
                        </div>
                        <div class="indicators-inner-x">
                            <span class="bunkery"></span> 
                            <span class="FilterBunkering">BUNKERING</span>
                        </div>
                    </div>
                    <div class="indicators-inner">
                        <div class="indicators-inner-x">
                            <span class="breakdown"></span> 
                            <span class="FilterBreakdown">BREAKDOWN</span>
                        </div>
                        <div class="indicators-inner-x">
                            <span class="idle"></span> 
                            <span class="FilterReady">READY TO GO</span>
                        </div> 
                        <div class="indicators-inner-x">
                            <span class="maintenance"></span> 
                            <span class="FilterMaintenance">MAINTENANCE</span>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="div tracking">
                <h1>
                    Tracking (Status)  
                </h1>  
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
                        $Vessel_ = \DB::table('vessel_availabilities')->where('Vessel', $Vessel->VesselName)->first();
                        if (isset($_GET['FromDate_FILTERBYDATE']) AND isset($_GET['EndDate_FILTERBYDATE']) AND empty($_GET['SpecificDay'])) {
                            $Vessel_STARTIME = \DB::table('vessel_availabilities') 
                                                ->where('Vessel', $Vessel->VesselName)
                                                // ->whereBetween('StartDate', [$_GET['FromDate_FILTERBYDATE'], $_GET['EndDate_FILTERBYDATE']])
                                                ->whereBetween('EndDate', [$_GET['FromDate_FILTERBYDATE'], $_GET['EndDate_FILTERBYDATE']])
                                                ->orderBy('DateIn', 'DESC')
                                                ->orderBy('TimeIn', 'DESC')
                                                ->get();
                        } elseif (!(empty($_GET['SpecificDay']))) {
                            $Vessel_STARTIME = \DB::table('vessel_availabilities') 
                                                ->where('Vessel', $Vessel->VesselName)
                                                ->where('StartDate', '<=', $_GET['SpecificDay'])
                                                ->where('EndDate', '>=', $_GET['SpecificDay']) 
                                                ->orderBy('DateIn', 'DESC')
                                                ->orderBy('TimeIn', 'DESC')
                                                ->get();
                        } else {
                            $Vessel_STARTIME = \DB::table('vessel_availabilities') 
                                            ->where('Vessel', $Vessel->VesselName)
                                            ->where('StartDate', '<=', date('Y-m-d'))
                                            ->where('EndDate', '>=', date('Y-m-d')) 
                                            ->orWhere(function($query) use ($Vessel) {
                                                $query->where('Vessel', $Vessel->VesselName)
                                                        ->where('TillNow', 'YES');
                                            })
                                            ->orderBy('DateIn', 'DESC')
                                            ->orderBy('TimeIn', 'DESC')
                                            ->paginate(30);
                        }
                    @endphp
                    <tr>
                        <td>{{ $Vessel_->Vessel ?? '-' }}</td>
                        <td> 
                            <div class="flex">  
                                @foreach ($Vessel_STARTIME as $Vessel)    
                                    @php 
                                        $StartTime = \Carbon\Carbon::parse($Vessel->StartDate . ' ' . $Vessel->StartTime);
                                        $EndTime = \Carbon\Carbon::parse($Vessel->EndDate . ' ' . $Vessel->EndTime);
                                        $Status = strtolower($Vessel->Status); 
                                        if (!empty($Vessel->TillNow)) {
                                            if ($Vessel->TillNow == 'YES') {
                                                $EndTime = (($Vessel->EndDate == $Vessel->StartDate) AND ($EndTime <= date('H:i'))) ? $EndTime : \Carbon\Carbon::parse(date('Y-m-d') . ' ' . date('H:i'));
                                            }   
                                        }
                                    @endphp 
                                    @if (
                                        ($StartTime >= \Carbon\Carbon::parse($STARTDATE . ' 00:00') AND 
                                        $StartTime < \Carbon\Carbon::parse($STARTDATE . ' 03:00')) ||
                                        ($EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 00:00') AND 
                                        $EndTime < \Carbon\Carbon::parse($STARTDATE . ' 03:00')) ||
                                        ($StartTime < \Carbon\Carbon::parse($STARTDATE . ' 00:00') AND 
                                        $EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 03:00'))
                                    )
                                        <div class="{{ $Status }} status tooltip-x">
                                            <span class="Hide tooltip-x-span"><div class="{{ $Status }} tooltip-x-div"></div> On {{ $Status }} <br> {{ $StartTime->format('H:i').' HRS' }} - {{ $EndTime->format('H:i').' HRS' }}
                                            @if (isset($_GET['FromDate_FILTERBYDATE']))
                                                <br>
                                                @ {{ $Vessel->StartDate }} 
                                                @if ($Vessel->EndDate > $Vessel->StartDate)
                                                    <br> &nbsp;&nbsp;&nbsp; {{ $Vessel->EndDate }}
                                                @endif
                                            @endif
                                         </span>
                                        </div>
                                    @endif  
                                @endforeach
                            </div>
                        </td>
                        <td>  
                            <div class="flex">
                                @foreach ($Vessel_STARTIME as $Vessel) 
                                    @php 
                                        $StartTime = \Carbon\Carbon::parse($Vessel->StartDate . ' ' . $Vessel->StartTime);
                                        $EndTime = \Carbon\Carbon::parse($Vessel->EndDate . ' ' . $Vessel->EndTime);
                                        $Status = strtolower($Vessel->Status);
                                        if (!empty($Vessel->TillNow)) {
                                            if ($Vessel->TillNow == 'YES') {
                                                $EndTime = (($Vessel->EndDate == $Vessel->StartDate) AND ($EndTime <= date('H:i'))) ? $EndTime : \Carbon\Carbon::parse(date('Y-m-d') . ' ' . date('H:i'));
                                            }   
                                        }
                                    @endphp  
                                    @if (
                                        ($StartTime >= \Carbon\Carbon::parse($STARTDATE . ' 03:00') AND 
                                        $StartTime < \Carbon\Carbon::parse($STARTDATE . ' 06:00')) ||
                                        ($EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 03:00') AND 
                                        $EndTime < \Carbon\Carbon::parse($STARTDATE . ' 06:00')) ||
                                        ($StartTime < \Carbon\Carbon::parse($STARTDATE . ' 03:00') AND 
                                        $EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 06:00'))
                                    )
                                        <div class="{{ $Status }} status tooltip-x">
                                            <span class="Hide tooltip-x-span"><div class="{{ $Status }} tooltip-x-div"></div> On {{ $Status }} <br> {{ $StartTime->format('H:i').' HRS' }} - {{ $EndTime->format('H:i').' HRS' }}
                                            @if (isset($_GET['FromDate_FILTERBYDATE']))
                                                <br>
                                                @ {{ $Vessel->StartDate }} 
                                                @if ($Vessel->EndDate > $Vessel->StartDate)
                                                    <br> &nbsp;&nbsp;&nbsp; {{ $Vessel->EndDate }}
                                                @endif
                                            @endif
                                         </span>
                                        </div>
                                    @endif  
                                @endforeach 
                            </div>
                        </td> 
                        <td>
                            <div class="flex">
                                @foreach ($Vessel_STARTIME as $Vessel) 
                                    @php 
                                        $StartTime = \Carbon\Carbon::parse($Vessel->StartDate . ' ' . $Vessel->StartTime);
                                        $EndTime = \Carbon\Carbon::parse($Vessel->EndDate . ' ' . $Vessel->EndTime);
                                        $Status = strtolower($Vessel->Status);
                                        if (!empty($Vessel->TillNow)) {
                                            if ($Vessel->TillNow == 'YES') {
                                                $EndTime = (($Vessel->EndDate == $Vessel->StartDate) AND ($EndTime <= date('H:i'))) ? $EndTime : \Carbon\Carbon::parse(date('Y-m-d') . ' ' . date('H:i'));
                                            }   
                                        }
                                    @endphp  
                                    @if (
                                        ($StartTime >= \Carbon\Carbon::parse($STARTDATE . ' 06:00') AND 
                                        $StartTime < \Carbon\Carbon::parse($STARTDATE . ' 09:00')) ||
                                        ($EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 06:00') AND 
                                        $EndTime < \Carbon\Carbon::parse($STARTDATE . ' 09:00')) ||
                                        ($StartTime < \Carbon\Carbon::parse($STARTDATE . ' 06:00') AND 
                                        $EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 09:00'))
                                    )
                                        <div class="{{ $Status }} status tooltip-x">
                                            <span class="Hide tooltip-x-span"><div class="{{ $Status }} tooltip-x-div"></div> On {{ $Status }} <br> {{ $StartTime->format('H:i').' HRS' }} - {{ $EndTime->format('H:i').' HRS' }}
                                            @if (isset($_GET['FromDate_FILTERBYDATE']))
                                                <br>
                                                @ {{ $Vessel->StartDate }} 
                                                @if ($Vessel->EndDate > $Vessel->StartDate)
                                                    <br> &nbsp;&nbsp;&nbsp; {{ $Vessel->EndDate }}
                                                @endif
                                            @endif
                                         </span>
                                        </div>
                                    @endif  
                                @endforeach
                            </div> 
                        </td>
                        <td>
                            <div class="flex">
                                @foreach ($Vessel_STARTIME as $Vessel) 
                                    @php 
                                        $StartTime = \Carbon\Carbon::parse($Vessel->StartDate . ' ' . $Vessel->StartTime);
                                        $EndTime = \Carbon\Carbon::parse($Vessel->EndDate . ' ' . $Vessel->EndTime);
                                        $Status = strtolower($Vessel->Status);
                                        if (!empty($Vessel->TillNow)) {
                                            if ($Vessel->TillNow == 'YES') {
                                                $EndTime = (($Vessel->EndDate == $Vessel->StartDate) AND ($EndTime <= date('H:i'))) ? $EndTime : \Carbon\Carbon::parse(date('Y-m-d') . ' ' . date('H:i'));
                                            }   
                                        }
                                    @endphp
                                    @if (
                                        ($StartTime >= \Carbon\Carbon::parse($STARTDATE . ' 09:00') AND 
                                        $StartTime < \Carbon\Carbon::parse($STARTDATE . ' 12:00')) ||
                                        ($EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 09:00') AND 
                                        $EndTime < \Carbon\Carbon::parse($STARTDATE . ' 12:00')) ||
                                        ($StartTime < \Carbon\Carbon::parse($STARTDATE . ' 09:00') AND 
                                        $EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 12:00'))
                                    )
                                        <div class="{{ $Status }} status tooltip-x">
                                            <span class="Hide tooltip-x-span"><div class="{{ $Status }} tooltip-x-div"></div> On {{ $Status }} <br> {{ $StartTime->format('H:i').' HRS' }} - {{ $EndTime->format('H:i').' HRS' }}
                                            @if (isset($_GET['FromDate_FILTERBYDATE']))
                                                <br>
                                                @ {{ $Vessel->StartDate }} 
                                                @if ($Vessel->EndDate > $Vessel->StartDate)
                                                    <br> &nbsp;&nbsp;&nbsp; {{ $Vessel->EndDate }}
                                                @endif
                                            @endif
                                         </span>
                                        </div>
                                    @endif  
                                @endforeach
                            </div>  
                        </td>
                        <td>
                            <div class="flex">
                                @foreach ($Vessel_STARTIME as $Vessel) 
                                    @php 
                                        $StartTime = \Carbon\Carbon::parse($Vessel->StartDate . ' ' . $Vessel->StartTime);
                                        $EndTime = \Carbon\Carbon::parse($Vessel->EndDate . ' ' . $Vessel->EndTime);
                                        $Status = strtolower($Vessel->Status);
                                        if (!empty($Vessel->TillNow)) {
                                            if ($Vessel->TillNow == 'YES') {
                                                $EndTime = (($Vessel->EndDate == $Vessel->StartDate) AND ($EndTime <= date('H:i'))) ? $EndTime : \Carbon\Carbon::parse(date('Y-m-d') . ' ' . date('H:i'));
                                            }   
                                        }
                                    @endphp   
                                    @if (
                                        ($StartTime >= \Carbon\Carbon::parse($STARTDATE . ' 12:00') AND 
                                        $StartTime < \Carbon\Carbon::parse($STARTDATE . ' 15:00')) ||
                                        ($EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 12:00') AND 
                                        $EndTime < \Carbon\Carbon::parse($STARTDATE . ' 15:00')) ||
                                        ($StartTime < \Carbon\Carbon::parse($STARTDATE . ' 12:00') AND 
                                        $EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 15:00'))
                                    )
                                        <div class="{{ $Status }} status tooltip-x">
                                            <span class="Hide tooltip-x-span"><div class="{{ $Status }} tooltip-x-div"></div> On {{ $Status }} <br> {{ $StartTime->format('H:i').' HRS' }} - {{ $EndTime->format('H:i').' HRS' }}
                                            @if (isset($_GET['FromDate_FILTERBYDATE']))
                                                <br>
                                                @ {{ $Vessel->StartDate }} 
                                                @if ($Vessel->EndDate > $Vessel->StartDate)
                                                    <br> &nbsp;&nbsp;&nbsp; {{ $Vessel->EndDate }}
                                                @endif
                                            @endif
                                         </span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>   
                        </td>
                        <td>
                            <div class="flex">
                                @foreach ($Vessel_STARTIME as $Vessel) 
                                    @php 
                                        $StartTime = \Carbon\Carbon::parse($Vessel->StartDate . ' ' . $Vessel->StartTime);
                                        $EndTime = \Carbon\Carbon::parse($Vessel->EndDate . ' ' . $Vessel->EndTime);
                                        $Status = strtolower($Vessel->Status);
                                        if (!empty($Vessel->TillNow)) {
                                            if ($Vessel->TillNow == 'YES') {
                                                $EndTime = (($Vessel->EndDate == $Vessel->StartDate) AND ($EndTime <= date('H:i'))) ? $EndTime : \Carbon\Carbon::parse(date('Y-m-d') . ' ' . date('H:i'));
                                            }   
                                        }
                                    @endphp  
                                    @if (
                                        ($StartTime >= \Carbon\Carbon::parse($STARTDATE . ' 15:00') AND 
                                        $StartTime < \Carbon\Carbon::parse($STARTDATE . ' 18:00')) ||
                                        ($EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 15:00') AND 
                                        $EndTime < \Carbon\Carbon::parse($STARTDATE . ' 18:00')) ||
                                        ($StartTime < \Carbon\Carbon::parse($STARTDATE . ' 15:00') AND 
                                        $EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 18:00'))
                                    )
                                        <div class="{{ $Status }} status tooltip-x">
                                            <span class="Hide tooltip-x-span"><div class="{{ $Status }} tooltip-x-div"></div> On {{ $Status }} <br> {{ $StartTime->format('H:i').' HRS' }} - {{ $EndTime->format('H:i').' HRS' }}
                                            @if (isset($_GET['FromDate_FILTERBYDATE']))
                                                <br>
                                                @ {{ $Vessel->StartDate }} 
                                                @if ($Vessel->EndDate > $Vessel->StartDate)
                                                    <br> &nbsp;&nbsp;&nbsp; {{ $Vessel->EndDate }}
                                                @endif
                                            @endif
                                         </span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>    
                        </td>
                        <td>
                            <div class="flex">
                                @foreach ($Vessel_STARTIME as $Vessel) 
                                    @php 
                                        $StartTime = \Carbon\Carbon::parse($Vessel->StartDate . ' ' . $Vessel->StartTime);
                                        $EndTime = \Carbon\Carbon::parse($Vessel->EndDate . ' ' . $Vessel->EndTime);
                                        $Status = strtolower($Vessel->Status);
                                        if (!empty($Vessel->TillNow)) {
                                            if ($Vessel->TillNow == 'YES') {
                                                $EndTime = (($Vessel->EndDate == $Vessel->StartDate) AND ($EndTime <= date('H:i'))) ? $EndTime : \Carbon\Carbon::parse(date('Y-m-d') . ' ' . date('H:i'));
                                            }   
                                        }
                                    @endphp   
                                    @if (
                                        ($StartTime >= \Carbon\Carbon::parse($STARTDATE . ' 18:00') AND 
                                        $StartTime < \Carbon\Carbon::parse($STARTDATE . ' 21:00')) ||
                                        ($EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 18:00') AND 
                                        $EndTime < \Carbon\Carbon::parse($STARTDATE . ' 21:00')) ||
                                        ($StartTime < \Carbon\Carbon::parse($STARTDATE . ' 18:00') AND 
                                        $EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 21:00'))
                                    )
                                        <div class="{{ $Status }} status tooltip-x">
                                            <span class="Hide tooltip-x-span"><div class="{{ $Status }} tooltip-x-div"></div> On {{ $Status }} <br> {{ $StartTime->format('H:i').' HRS' }} - {{ $EndTime->format('H:i').' HRS' }}
                                            @if (isset($_GET['FromDate_FILTERBYDATE']))
                                                <br>
                                                @ {{ $Vessel->StartDate }} 
                                                @if ($Vessel->EndDate > $Vessel->StartDate)
                                                    <br> &nbsp;&nbsp;&nbsp; {{ $Vessel->EndDate }}
                                                @endif
                                            @endif
                                         </span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>     
                        </td>
                        <td>
                            <div class="flex">
                                @foreach ($Vessel_STARTIME as $Vessel) 
                                    @php 
                                        $StartTime = \Carbon\Carbon::parse($Vessel->StartDate . ' ' . $Vessel->StartTime);
                                        $EndTime = \Carbon\Carbon::parse($Vessel->EndDate . ' ' . $Vessel->EndTime);
                                        $Status = strtolower($Vessel->Status);
                                        if (!empty($Vessel->TillNow)) {
                                            if ($Vessel->TillNow == 'YES') {
                                                $EndTime = (($Vessel->EndDate == $Vessel->StartDate) AND ($EndTime <= date('H:i'))) ? $EndTime : \Carbon\Carbon::parse(date('Y-m-d') . ' ' . date('H:i'));
                                            }   
                                        }
                                    @endphp   
                                    @if (
                                        ($StartTime >= \Carbon\Carbon::parse($STARTDATE . ' 21:00') AND 
                                        $StartTime < \Carbon\Carbon::parse($STARTDATE . ' 23:59')) ||
                                        ($EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 21:00') AND 
                                        $EndTime < \Carbon\Carbon::parse($STARTDATE . ' 23:59')) ||
                                        ($StartTime < \Carbon\Carbon::parse($STARTDATE . ' 21:00') AND 
                                        $EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 23:59'))
                                    )
                                        <div class="{{ $Status }} status tooltip-x">
                                            <span class="Hide tooltip-x-span"><div class="{{ $Status }} tooltip-x-div"></div> On {{ $Status }} <br> {{ $StartTime->format('H:i').' HRS' }} - {{ $EndTime->format('H:i').' HRS' }}
                                            @if (isset($_GET['FromDate_FILTERBYDATE']))
                                                <br>
                                                @ {{ $Vessel->StartDate }} 
                                                @if ($Vessel->EndDate > $Vessel->StartDate)
                                                    <br> &nbsp;&nbsp;&nbsp; {{ $Vessel->EndDate }}
                                                @endif
                                            @endif
                                         </span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>      
                        </td>
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
                    @php
                        $Machineries = \DB::table('generators')->select('EngineMake')->get()
                    @endphp
                    @foreach ($Machineries as $Machinery)
                    @php
                        $Machinery_STARTIME = \DB::table('generator_availability') 
                                            ->where('EngineMake', $Machinery->EngineMake)
                                            ->where('StartDate', '<=', date('Y-m-d'))
                                            ->where('EndDate', '>=', date('Y-m-d')) 
                                            ->orWhere(function($query) use ($Machinery) {
                                                $query->where('EngineMake', $Machinery->EngineMake)
                                                        ->where('TillNow', 'YES');
                                            })
                                            ->orderBy('DateIn', 'DESC')
                                            ->orderBy('TimeIn', 'DESC')
                                            ->paginate(30);
                    @endphp
                    <tr>
                        <td>{{ $Machinery->EngineMake ?? '-' }}</td>
                        <td>
                            <div class="flex">  
                                @foreach ($Machinery_STARTIME as $Machinery)    
                                    @php 
                                        $StartTime = \Carbon\Carbon::parse($Machinery->StartDate . ' ' . $Machinery->StartTime);
                                        $EndTime = \Carbon\Carbon::parse($Machinery->EndDate . ' ' . $Machinery->EndTime);
                                        $Status = strtolower($Machinery->Status); 
                                        if (!empty($Machinery->TillNow)) {
                                            if ($Machinery->TillNow == 'YES') {
                                                $EndTime = (($Machinery->EndDate == $Machinery->StartDate) AND ($EndTime <= date('H:i'))) ? $EndTime : \Carbon\Carbon::parse(date('Y-m-d') . ' ' . date('H:i'));
                                            }   
                                        }
                                    @endphp 
                                    @if (
                                        ($StartTime >= \Carbon\Carbon::parse($STARTDATE . ' 00:00') AND 
                                        $StartTime < \Carbon\Carbon::parse($STARTDATE . ' 03:00')) ||
                                        ($EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 00:00') AND 
                                        $EndTime < \Carbon\Carbon::parse($STARTDATE . ' 03:00')) ||
                                        ($StartTime < \Carbon\Carbon::parse($STARTDATE . ' 00:00') AND 
                                        $EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 03:00'))
                                    )
                                        <div class="{{ $Status }} status tooltip-x">
                                            <span class="Hide tooltip-x-span"><div class="{{ $Status }} tooltip-x-div"></div> On {{ $Status }} <br> {{ $StartTime->format('H:i').' HRS' }} - {{ $EndTime->format('H:i').' HRS' }}
                                            @if (isset($_GET['FromDate_FILTERBYDATE']))
                                                <br>
                                                @ {{ $Machinery->StartDate }} 
                                                @if ($Machinery->EndDate > $Machinery->StartDate)
                                                    <br> &nbsp;&nbsp;&nbsp; {{ $Machinery->EndDate }}
                                                @endif
                                            @endif
                                         </span>
                                        </div>
                                    @endif  
                                @endforeach
                            </div>
                        </td>
                        <td>  
                            <div class="flex">
                                @foreach ($Machinery_STARTIME as $Machinery) 
                                    @php 
                                        $StartTime = \Carbon\Carbon::parse($Machinery->StartDate . ' ' . $Machinery->StartTime);
                                        $EndTime = \Carbon\Carbon::parse($Machinery->EndDate . ' ' . $Machinery->EndTime);
                                        $Status = strtolower($Machinery->Status);
                                        if (!empty($Machinery->TillNow)) {
                                            if ($Machinery->TillNow == 'YES') {
                                                $EndTime = (($Machinery->EndDate == $Machinery->StartDate) AND ($EndTime <= date('H:i'))) ? $EndTime : \Carbon\Carbon::parse(date('Y-m-d') . ' ' . date('H:i'));
                                            }   
                                        }
                                    @endphp  
                                    @if (
                                        ($StartTime >= \Carbon\Carbon::parse($STARTDATE . ' 03:00') AND 
                                        $StartTime < \Carbon\Carbon::parse($STARTDATE . ' 06:00')) ||
                                        ($EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 03:00') AND 
                                        $EndTime < \Carbon\Carbon::parse($STARTDATE . ' 06:00')) ||
                                        ($StartTime < \Carbon\Carbon::parse($STARTDATE . ' 03:00') AND 
                                        $EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 06:00'))
                                    )
                                        <div class="{{ $Status }} status tooltip-x">
                                            <span class="Hide tooltip-x-span"><div class="{{ $Status }} tooltip-x-div"></div> On {{ $Status }} <br> {{ $StartTime->format('H:i').' HRS' }} - {{ $EndTime->format('H:i').' HRS' }}
                                            @if (isset($_GET['FromDate_FILTERBYDATE']))
                                                <br>
                                                @ {{ $Machinery->StartDate }} 
                                                @if ($Machinery->EndDate > $Machinery->StartDate)
                                                    <br> &nbsp;&nbsp;&nbsp; {{ $Machinery->EndDate }}
                                                @endif
                                            @endif
                                         </span>
                                        </div>
                                    @endif  
                                @endforeach 
                            </div>
                        </td>
                        <td>
                            <div class="flex">
                                @foreach ($Machinery_STARTIME as $Machinery) 
                                    @php 
                                        $StartTime = \Carbon\Carbon::parse($Machinery->StartDate . ' ' . $Machinery->StartTime);
                                        $EndTime = \Carbon\Carbon::parse($Machinery->EndDate . ' ' . $Machinery->EndTime);
                                        $Status = strtolower($Machinery->Status);
                                        if (!empty($Machinery->TillNow)) {
                                            if ($Machinery->TillNow == 'YES') {
                                                $EndTime = (($Machinery->EndDate == $Machinery->StartDate) AND ($EndTime <= date('H:i'))) ? $EndTime : \Carbon\Carbon::parse(date('Y-m-d') . ' ' . date('H:i'));
                                            }   
                                        }
                                    @endphp  
                                    @if (
                                        ($StartTime >= \Carbon\Carbon::parse($STARTDATE . ' 06:00') AND 
                                        $StartTime < \Carbon\Carbon::parse($STARTDATE . ' 09:00')) ||
                                        ($EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 06:00') AND 
                                        $EndTime < \Carbon\Carbon::parse($STARTDATE . ' 09:00')) ||
                                        ($StartTime < \Carbon\Carbon::parse($STARTDATE . ' 06:00') AND 
                                        $EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 09:00'))
                                    )
                                        <div class="{{ $Status }} status tooltip-x">
                                            <span class="Hide tooltip-x-span"><div class="{{ $Status }} tooltip-x-div"></div> On {{ $Status }} <br> {{ $StartTime->format('H:i').' HRS' }} - {{ $EndTime->format('H:i').' HRS' }}
                                            @if (isset($_GET['FromDate_FILTERBYDATE']))
                                                <br>
                                                @ {{ $Machinery->StartDate }} 
                                                @if ($Machinery->EndDate > $Machinery->StartDate)
                                                    <br> &nbsp;&nbsp;&nbsp; {{ $Machinery->EndDate }}
                                                @endif
                                            @endif
                                         </span>
                                        </div>
                                    @endif  
                                @endforeach
                            </div> 
                        </td>
                        <td>
                            <div class="flex">
                                @foreach ($Machinery_STARTIME as $Machinery) 
                                    @php 
                                        $StartTime = \Carbon\Carbon::parse($Machinery->StartDate . ' ' . $Machinery->StartTime);
                                        $EndTime = \Carbon\Carbon::parse($Machinery->EndDate . ' ' . $Machinery->EndTime);
                                        $Status = strtolower($Machinery->Status);
                                        if (!empty($Machinery->TillNow)) {
                                            if ($Machinery->TillNow == 'YES') {
                                                $EndTime = (($Machinery->EndDate == $Machinery->StartDate) AND ($EndTime <= date('H:i'))) ? $EndTime : \Carbon\Carbon::parse(date('Y-m-d') . ' ' . date('H:i'));
                                            }   
                                        }
                                    @endphp
                                    @if (
                                        ($StartTime >= \Carbon\Carbon::parse($STARTDATE . ' 09:00') AND 
                                        $StartTime < \Carbon\Carbon::parse($STARTDATE . ' 12:00')) ||
                                        ($EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 09:00') AND 
                                        $EndTime < \Carbon\Carbon::parse($STARTDATE . ' 12:00')) ||
                                        ($StartTime < \Carbon\Carbon::parse($STARTDATE . ' 09:00') AND 
                                        $EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 12:00'))
                                    )
                                        <div class="{{ $Status }} status tooltip-x">
                                            <span class="Hide tooltip-x-span"><div class="{{ $Status }} tooltip-x-div"></div> On {{ $Status }} <br> {{ $StartTime->format('H:i').' HRS' }} - {{ $EndTime->format('H:i').' HRS' }}
                                            @if (isset($_GET['FromDate_FILTERBYDATE']))
                                                <br>
                                                @ {{ $Machinery->StartDate }} 
                                                @if ($Machinery->EndDate > $Machinery->StartDate)
                                                    <br> &nbsp;&nbsp;&nbsp; {{ $Machinery->EndDate }}
                                                @endif
                                            @endif
                                         </span>
                                        </div>
                                    @endif  
                                @endforeach
                            </div>  
                        </td>
                        <td>
                            <div class="flex">
                                @foreach ($Machinery_STARTIME as $Machinery) 
                                    @php 
                                        $StartTime = \Carbon\Carbon::parse($Machinery->StartDate . ' ' . $Machinery->StartTime);
                                        $EndTime = \Carbon\Carbon::parse($Machinery->EndDate . ' ' . $Machinery->EndTime);
                                        $Status = strtolower($Machinery->Status);
                                        if (!empty($Machinery->TillNow)) {
                                            if ($Machinery->TillNow == 'YES') {
                                                $EndTime = (($Machinery->EndDate == $Machinery->StartDate) AND ($EndTime <= date('H:i'))) ? $EndTime : \Carbon\Carbon::parse(date('Y-m-d') . ' ' . date('H:i'));
                                            }   
                                        }
                                    @endphp   
                                    @if (
                                        ($StartTime >= \Carbon\Carbon::parse($STARTDATE . ' 12:00') AND 
                                        $StartTime < \Carbon\Carbon::parse($STARTDATE . ' 15:00')) ||
                                        ($EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 12:00') AND 
                                        $EndTime < \Carbon\Carbon::parse($STARTDATE . ' 15:00')) ||
                                        ($StartTime < \Carbon\Carbon::parse($STARTDATE . ' 12:00') AND 
                                        $EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 15:00'))
                                    )
                                        <div class="{{ $Status }} status tooltip-x">
                                            <span class="Hide tooltip-x-span"><div class="{{ $Status }} tooltip-x-div"></div> On {{ $Status }} <br> {{ $StartTime->format('H:i').' HRS' }} - {{ $EndTime->format('H:i').' HRS' }}
                                            @if (isset($_GET['FromDate_FILTERBYDATE']))
                                                <br>
                                                @ {{ $Machinery->StartDate }} 
                                                @if ($Machinery->EndDate > $Machinery->StartDate)
                                                    <br> &nbsp;&nbsp;&nbsp; {{ $Machinery->EndDate }}
                                                @endif
                                            @endif
                                         </span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>   
                        </td>
                        <td>
                            <div class="flex">
                                @foreach ($Machinery_STARTIME as $Machinery) 
                                    @php 
                                        $StartTime = \Carbon\Carbon::parse($Machinery->StartDate . ' ' . $Machinery->StartTime);
                                        $EndTime = \Carbon\Carbon::parse($Machinery->EndDate . ' ' . $Machinery->EndTime);
                                        $Status = strtolower($Machinery->Status);
                                        if (!empty($Machinery->TillNow)) {
                                            if ($Machinery->TillNow == 'YES') {
                                                $EndTime = (($Machinery->EndDate == $Machinery->StartDate) AND ($EndTime <= date('H:i'))) ? $EndTime : \Carbon\Carbon::parse(date('Y-m-d') . ' ' . date('H:i'));
                                            }   
                                        }
                                    @endphp  
                                    @if (
                                        ($StartTime >= \Carbon\Carbon::parse($STARTDATE . ' 15:00') AND 
                                        $StartTime < \Carbon\Carbon::parse($STARTDATE . ' 18:00')) ||
                                        ($EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 15:00') AND 
                                        $EndTime < \Carbon\Carbon::parse($STARTDATE . ' 18:00')) ||
                                        ($StartTime < \Carbon\Carbon::parse($STARTDATE . ' 15:00') AND 
                                        $EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 18:00'))
                                    )
                                        <div class="{{ $Status }} status tooltip-x">
                                            <span class="Hide tooltip-x-span"><div class="{{ $Status }} tooltip-x-div"></div> On {{ $Status }} <br> {{ $StartTime->format('H:i').' HRS' }} - {{ $EndTime->format('H:i').' HRS' }}
                                            @if (isset($_GET['FromDate_FILTERBYDATE']))
                                                <br>
                                                @ {{ $Machinery->StartDate }} 
                                                @if ($Machinery->EndDate > $Machinery->StartDate)
                                                    <br> &nbsp;&nbsp;&nbsp; {{ $Machinery->EndDate }}
                                                @endif
                                            @endif
                                         </span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>    
                        </td>
                        <td>
                            <div class="flex">
                                @foreach ($Machinery_STARTIME as $Machinery) 
                                    @php 
                                        $StartTime = \Carbon\Carbon::parse($Machinery->StartDate . ' ' . $Machinery->StartTime);
                                        $EndTime = \Carbon\Carbon::parse($Machinery->EndDate . ' ' . $Machinery->EndTime);
                                        $Status = strtolower($Machinery->Status);
                                        if (!empty($Machinery->TillNow)) {
                                            if ($Machinery->TillNow == 'YES') {
                                                $EndTime = (($Machinery->EndDate == $Machinery->StartDate) AND ($EndTime <= date('H:i'))) ? $EndTime : \Carbon\Carbon::parse(date('Y-m-d') . ' ' . date('H:i'));
                                            }   
                                        }
                                    @endphp   
                                    @if (
                                        ($StartTime >= \Carbon\Carbon::parse($STARTDATE . ' 18:00') AND 
                                        $StartTime < \Carbon\Carbon::parse($STARTDATE . ' 21:00')) ||
                                        ($EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 18:00') AND 
                                        $EndTime < \Carbon\Carbon::parse($STARTDATE . ' 21:00')) ||
                                        ($StartTime < \Carbon\Carbon::parse($STARTDATE . ' 18:00') AND 
                                        $EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 21:00'))
                                    )
                                        <div class="{{ $Status }} status tooltip-x">
                                            <span class="Hide tooltip-x-span"><div class="{{ $Status }} tooltip-x-div"></div> On {{ $Status }} <br> {{ $StartTime->format('H:i').' HRS' }} - {{ $EndTime->format('H:i').' HRS' }}
                                            @if (isset($_GET['FromDate_FILTERBYDATE']))
                                                <br>
                                                @ {{ $Machinery->StartDate }} 
                                                @if ($Machinery->EndDate > $Machinery->StartDate)
                                                    <br> &nbsp;&nbsp;&nbsp; {{ $Machinery->EndDate }}
                                                @endif
                                            @endif
                                         </span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>     
                        </td>
                        <td>
                            <div class="flex">
                                @foreach ($Machinery_STARTIME as $Machinery) 
                                    @php 
                                        $StartTime = \Carbon\Carbon::parse($Machinery->StartDate . ' ' . $Machinery->StartTime);
                                        $EndTime = \Carbon\Carbon::parse($Machinery->EndDate . ' ' . $Machinery->EndTime);
                                        $Status = strtolower($Machinery->Status);
                                        if (!empty($Machinery->TillNow)) {
                                            if ($Machinery->TillNow == 'YES') {
                                                $EndTime = (($Machinery->EndDate == $Machinery->StartDate) AND ($EndTime <= date('H:i'))) ? $EndTime : \Carbon\Carbon::parse(date('Y-m-d') . ' ' . date('H:i'));
                                            }   
                                        }
                                    @endphp   
                                    @if (
                                        ($StartTime >= \Carbon\Carbon::parse($STARTDATE . ' 21:00') AND 
                                        $StartTime < \Carbon\Carbon::parse($STARTDATE . ' 23:59')) ||
                                        ($EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 21:00') AND 
                                        $EndTime < \Carbon\Carbon::parse($STARTDATE . ' 23:59')) ||
                                        ($StartTime < \Carbon\Carbon::parse($STARTDATE . ' 21:00') AND 
                                        $EndTime >= \Carbon\Carbon::parse($STARTDATE . ' 23:59'))
                                    )
                                        <div class="{{ $Status }} status tooltip-x">
                                            <span class="Hide tooltip-x-span"><div class="{{ $Status }} tooltip-x-div"></div> On {{ $Status }} <br> {{ $StartTime->format('H:i').' HRS' }} - {{ $EndTime->format('H:i').' HRS' }}
                                            @if (isset($_GET['FromDate_FILTERBYDATE']))
                                                <br>
                                                @ {{ $Machinery->StartDate }} 
                                                @if ($Machinery->EndDate > $Machinery->StartDate)
                                                    <br> &nbsp;&nbsp;&nbsp; {{ $Machinery->EndDate }}
                                                @endif
                                            @endif
                                         </span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>      
                        </td>
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
                        {{-- <th>Attachment</th> --}}
                        <th>Start date</th>
                        <th>Start time</th>
                        <th>End date</th>
                        <th>End time</th>
                        <th>Source</th>
                        <th>#</th>
                     :: {{ count($VesselAvailability) }}</tr> 
                    @unless (count($VesselAvailability) > 0)
                    <tr>
                        <td class="action">System don't have any records yet..</td>
                    </tr>
                    @endunless
                    @foreach ($VesselAvailability as $Availabilty)
                    @php
                       $StartTime = $Availabilty->StartTime;
                       $StartDate = $Availabilty->StartDate;
                       $EndDate = $Availabilty->EndDate;
                       $Date = $Availabilty->StartDate;
                       $Scheduled_COUNT = \App\Models\VesselAvailability::where('StartDate', '>', date('Y-m-d'))
                                                                            ->orWhere(function($query) {
                                                                                $query->where('StartDate', date('Y-m-d'))
                                                                                        ->where('StartTime', '>', \Carbon\Carbon::now());
                                                                            })->get();
                       $Today_COUNT = \App\Models\VesselAvailability::where('StartDate', date('Y-m-d'))->get();
                       $ThisWeek_COUNT = \App\Models\VesselAvailability::where('StartDate', '>=', date('Y-m-d', strtotime('last Sunday')))->get();
                       $LastWeek_COUNT = \App\Models\VesselAvailability::where('StartDate', '>=', date('Y-m-d', strtotime('last week Monday')))->where('StartDate', '<', date('Y-m-d', strtotime('last Sunday')))->get();
                       $Older_COUNT = \App\Models\VesselAvailability::where('StartDate', '<', date('Y-m-d', strtotime('last week Monday')))->get();
                    @endphp
                    @if (
                            $StartTime > \Carbon\Carbon::now() ||
                            $StartDate > date('Y-m-d') ||
                            $EndDate > date('Y-m-d')
                        )
                    <tr class="scheduled history Hide">
                        <td>Scheduled :: {{ count($Scheduled_COUNT) }}</td> 
                    </tr>
                    @endif
                    @include('Components.History.History') 
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
                        <td>{{ $Availabilty->Vessel }}</td> 
                        @php
                            $_StartDateTime = \Carbon\Carbon::parse(($Availabilty->StartDate ?? date('Y-m-d')) . ' ' . ($Availabilty->StartTime ?? '00:00'));
                            $_EndDateTime = \Carbon\Carbon::parse(($Availabilty->EndDate ?? date('Y-m-d')) . ' ' . ($Availabilty->EndTime ?? '00:00'));
                            $_HoursBetween = $_EndDateTime->diffInHours($_StartDateTime);
                            $_MinutesBetween = $_StartDateTime->diffInMinutes($_EndDateTime); 
                            $_TotalDays = $_EndDateTime->diffInDays($_StartDateTime); 
                        @endphp
                        <td>
                            {{ $Availabilty->Status == 'IDLE' ? 'READY' : ($Availabilty->Status == 'BUNKERY' ? 'BUNKERING' : $Availabilty->Status) }} 
                            <small>
                                @if ($_MinutesBetween < 60)
                                    {{ $_EndDateTime->diffInMinutes($_StartDateTime) }} minutes
                                @elseif($_HoursBetween < 24)
                                    {{ $_EndDateTime->diffInHours($_StartDateTime) }} hour(s)
                                @elseif($_TotalDays > 0)
                                    {{ $_EndDateTime->diffInDays($_StartDateTime) }} day(s)
                                @endif
                            </small>
                        </td>
                        <td>{{ strtoupper($Availabilty->DoneBy) }}</td>
                        {{-- <td>{{ $Availabilty->Attachment }}</td> --}}
                        <td>{{ $Availabilty->StartDate }}</td>
                        <td>{{ date('H:i', strtotime($Availabilty->StartTime)).' HRS' }}</td>
                        <td>{{ $Availabilty->EndDate }}</td> 
                        <td>{{ date('H:i', strtotime($Availabilty->EndTime)).' HRS' }}</td> 
                        <td>{{ $Availabilty->Source }}</td>
                        <td class="action"> 
                            {{-- @if ($Availabilty->TillNow == 'YES') --}}
                                <img class="EditAvailabilityButton" src="{{ asset('images/write.png') }}" alt=""> 
                                <img class="DeleteAvailabilityButton" src="{{ asset('images/delete.png') }}" alt="">
                            {{-- @endif --}}
                        </td>
                    </tr>
                    @endforeach
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
                        <th>Status</th>
                        <th>Done by</th>
                        <th>Start date</th>
                        <th>Start time</th>
                        <th>End date</th>
                        <th>End time</th> 
                        <th>#</th>
                    </tr>
                    @forelse ($DailyReports as $DailyReport)
                    <tr data-report="{{ base64_encode(json_encode($DailyReport)) }}">
                        <td class="Hide">{{ $DailyReport->id }}</td>
                        <td>{{ $DailyReport->Vessel }}</td>
                        <td>{{ $DailyReport->Status }}</td>
                        <td>{{ $DailyReport->DoneBy }}</td>
                        <td>{{ $DailyReport->StartDate }}</td>
                        <td>{{ $DailyReport->StartTime }}</td>
                        <td>{{ $DailyReport->EndDate }}</td>
                        <td>{{ $DailyReport->EndTime }}</td>
                        <td class="action">  
                            <img class="EditDailyReportButton" src="{{ asset('images/write.png') }}" alt="Edit">
                            <img class="DeleteDailyReportButton" src="{{ asset('images/delete.png') }}" alt="Delete">
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
                <h1>Radio Broadcast</h1>
                <table>
                    <tr>
                        <th class="Hide">ID</th>
                        <th>Date</th> 
                        <th>Remarks</th>
                        <th>Done by</th>
                        <th>#</th>
                    </tr>
                    @forelse ($RadioBroadcastReports as $RadioBroadcast)
                    <tr data-report="{{ base64_encode(json_encode($RadioBroadcast)) }}">
                        <td class="Hide">{{ $RadioBroadcast->id }}</td>
                        <td>{{ $RadioBroadcast->Date }}</td>
                        <td>{{ $RadioBroadcast->Remarks }}</td>
                        <td>{{ $RadioBroadcast->DoneBy }}</td>
                        <td class="action">  
                            <img class="EditRadioBroadcastButton" src="{{ asset('images/write.png') }}" alt="Edit">
                            <img class="DeleteRadioBroadcastButton" src="{{ asset('images/delete.png') }}" alt="Delete">
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
                <h1>Officers On Duty</h1>
                <table>
                    <tr>
                        <th class="Hide">ID</th>
                        <th>Date</th>
                        <th>Done by</th>  
                        <th>Remarks</th> 
                        <th>#</th>
                    </tr>
                    @forelse ($OfficerOnDutyReports as $OfficersOnDuty)
                    <tr data-report="{{ base64_encode(json_encode($OfficersOnDuty)) }}">
                        <td class="Hide">{{ $OfficersOnDuty->id }}</td>
                        <td>{{ $OfficersOnDuty->Date }}</td>
                        <td>{{ $OfficersOnDuty->Name }}</td>
                        <td>{{ $OfficersOnDuty->Remarks }}</td>
                        <td class="action">  
                            <img class="EditOfficersOnDutyButton" src="{{ asset('images/write.png') }}" alt="Edit">
                            <img class="DeleteOfficersOnDutyButton" src="{{ asset('images/delete.png') }}" alt="Delete">
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
                        <td>{{ $Others->ROB }}</td>
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
            $GeneratorAvailability = \DB::table('generator_availability')
                                            ->orderBy('StartDate', 'DESC')
                                            ->orderBy('StartTime', 'DESC')->paginate(10);
        @endphp
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
                    @unless (count($GeneratorAvailability) > 0)
                    <tr>
                        <td class="action">System don't have any records yet..</td>
                    </tr>
                    @endunless
                    @foreach ($GeneratorAvailability as $Availability) 
                    <tr class="scheduled history Hide">
                        {{-- <td>Scheduled :: {{ 2 }}</td>  --}}
                    </tr> 
                    {{-- @include('Components.History.History')  --}}
                    <tr> 
                        <td>{{ $Availability->EngineMake }}</td> 
                        <td class="Hide">{{ $Availability->Location }}</td> 
                        @php
                            $_StartDateTime_ = \Carbon\Carbon::parse(($Availability->StartDate ?? date('Y-m-d')) . ' ' . ($Availability->StartTime ?? '00:00'));
                            $_EndDateTime_ = \Carbon\Carbon::parse(($Availability->EndDate ?? date('Y-m-d')) . ' ' . ($Availability->EndTime ?? '00:00'));
                            $_HoursBetween_ = $_EndDateTime_->diffInHours($_StartDateTime_);
                            $_MinutesBetween_ = $_StartDateTime_->diffInMinutes($_EndDateTime_); 
                            $_TotalDays_ = $_EndDateTime_->diffInDays($_StartDateTime_); 
                        @endphp
                        <td>
                            {{ $Availability->Status == 'IDLE' ? 'READY' : ($Availability->Status == 'BUNKERY' ? 'BUNKERING' : $Availability->Status) }} 
                            <small>
                                @if ($_MinutesBetween_ < 60)
                                    {{ $_EndDateTime_->diffInMinutes($_StartDateTime_) }} minutes
                                @elseif($_HoursBetween_ < 24)
                                    {{ $_EndDateTime_->diffInHours($_StartDateTime_) }} hour(s)
                                @elseif($_TotalDays_ > 0)
                                    {{ $_EndDateTime_->diffInDays($_StartDateTime_) }} day(s)
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
                    @endforeach
                </table>
                {{ $GeneratorAvailability->appends(request()->query())->links() }}
            </div> 
        </div>
        @php
            if (isset($_GET['Vessel_FILTER'])) { 
                $Checklist1 = \DB::table('checklist_1a')->select(['id', 'Boat', 'Date'])->where('Boat', $_GET['Vessel_FILTER'])->whereBetween('Date', [$_GET['FromDate_FILTERBYDATE'], $_GET['EndDate_FILTERBYDATE']])->orderBy('Date', 'DESC')->orderBy('TimeIn', 'DESC')->paginate(20);
            } else if (isset($_GET['SpecificDay'])) { 
                $Checklist1 = \DB::table('checklist_1a')->select(['id', 'Boat', 'Date'])->where('Boat', $_GET['Vessel_FILTER'])->where('Date', $_GET['SpecificDay'])->orderBy('Date', 'DESC')->orderBy('TimeIn', 'DESC')->paginate(20);
            } else {
                $Checklist1 = \DB::table('checklist_1a')->select(['id', 'Boat', 'Date'])->orderBy('Date', 'DESC')->orderBy('TimeIn', 'DESC')->paginate(20);
            }
        @endphp
        <div class="board-3">
            <div class="div">
                <h1>Handover statements, inspections and maintenance logs</h1>
                <table>
                    <tr>
                        <th>Vessel</th>
                        <th>Date</th> 
                        <th>#</th>
                     :: {{ count($Checklist1) }}</tr> 
                    @unless (count($Checklist1) > 0)
                    <tr>
                        <td class="action">System don't have any records yet..</td>
                    </tr>
                    @endunless
                    @foreach ($Checklist1 as $Checklist) 
                    <tr class="scheduled history Hide">
                        {{-- <td>Scheduled :: {{ 2 }}</td>  --}}
                    </tr> 
                    {{-- @include('Components.History.History')  --}}
                    <tr> 
                        <td>{{ $Checklist->Boat }}</td> 
                        <td>{{ $Checklist->Date }}</td>
                        @php
                            $Checklist1a = \DB::table('checklist_1a')->where('id', $Checklist->id)->first();
                            $Checklist1b = \DB::table('checklist_1b')->where('id', $Checklist->id)->first();
                            $Checklist1c = \DB::table('checklist_1c')->where('id', $Checklist->id)->first();
                            $Checklist1d = \DB::table('checklist_1d')->where('id', $Checklist->id)->first();
                            $Checklist1e = \DB::table('checklist_1e')->where('id', $Checklist->id)->first();
                        @endphp
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
                    @endforeach
                </table>
                {{ $Checklist1->appends(request()->query())->links() }}
            </div> 
        </div>
        <div class="board-2">
            @php 
                $NumberOfVessels_IDLE_LASTMONTH = App\Models\VesselAvailability::select('Vessel')
                                                    ->where('Status', 'IDLE')
                                                    ->where(function($query) {
                                                        $query->whereBetween('StartDate', [date('Y-m-01', strtotime('last month')), date('Y-m-t', strtotime('last month'))])
                                                                ->orWhereBetween('EndDate', [date('Y-m-01', strtotime('last month')), date('Y-m-t', strtotime('last month'))]);
                                                    })->groupBy('Vessel')->get();
                $NumberOfVessels_BUNKERY_LASTMONTH = App\Models\VesselAvailability::select('Vessel')
                                                    ->where('Status', 'BUNKERY')
                                                    ->where(function($query) {
                                                        $query->whereBetween('StartDate', [date('Y-m-01', strtotime('last month')), date('Y-m-t', strtotime('last month'))])
                                                                ->orWhereBetween('EndDate', [date('Y-m-01', strtotime('last month')), date('Y-m-t', strtotime('last month'))]);
                                                    })->groupBy('Vessel')->get();
                $NumberOfVessels_INSPECTION_LASTMONTH = App\Models\VesselAvailability::select('Vessel')  
                                                    ->where('Status', 'INSPECTION')
                                                    ->where(function($query) {
                                                        $query->whereBetween('StartDate', [date('Y-m-01', strtotime('last month')), date('Y-m-t', strtotime('last month'))])
                                                                ->orWhereBetween('EndDate', [date('Y-m-01', strtotime('last month')), date('Y-m-t', strtotime('last month'))]);
                                                    })->groupBy('Vessel')->get(); 
                $NumberOfVessels_MAINTENANCE_LASTMONTH = App\Models\VesselAvailability::select('Vessel')   
                                                    ->where('Status', 'MAINTENANCE')
                                                    ->where(function($query) {
                                                        $query->whereBetween('StartDate', [date('Y-m-01', strtotime('last month')), date('Y-m-t', strtotime('last month'))])
                                                                ->orWhereBetween('EndDate', [date('Y-m-01', strtotime('last month')), date('Y-m-t', strtotime('last month'))]);
                                                    })->groupBy('Vessel')->get(); 
                $NumberOfVessels_OPERATION_LASTMONTH = App\Models\VesselAvailability::select('Vessel') 
                                                    ->where('Status', 'OPERATION')
                                                    ->where(function($query) {
                                                        $query->whereBetween('StartDate', [date('Y-m-01', strtotime('last month')), date('Y-m-t', strtotime('last month'))])
                                                                ->orWhereBetween('EndDate', [date('Y-m-01', strtotime('last month')), date('Y-m-t', strtotime('last month'))]);
                                                    })->groupBy('Vessel')->get(); 
                $NumberOfVessels_BREAKDOWN_LASTMONTH = App\Models\VesselAvailability::select('Vessel') 
                                                    ->where('Status', 'BREAKDOWN')
                                                    ->where(function($query) {
                                                        $query->whereBetween('StartDate', [date('Y-m-01', strtotime('last month')), date('Y-m-t', strtotime('last month'))])
                                                                ->orWhereBetween('EndDate', [date('Y-m-01', strtotime('last month')), date('Y-m-t', strtotime('last month'))]);
                                                    })->groupBy('Vessel')->get();  
                $NumberOfVessels_DOCKING_LASTMONTH = App\Models\VesselAvailability::select('Vessel')  
                                                    ->where('Status', 'DOCKING')
                                                    ->where(function($query) {
                                                        $query->whereBetween('StartDate', [date('Y-m-01', strtotime('last month')), date('Y-m-t', strtotime('last month'))])
                                                                ->orWhereBetween('EndDate', [date('Y-m-01', strtotime('last month')), date('Y-m-t', strtotime('last month'))]);
                                                    })->groupBy('Vessel')->get(); 
      
                for ($i=2; $i <= 4; $i++) { 
                    ${'NumberOfVessels_IDLE_LAST' . $i . 'MONTHS'} = App\Models\VesselAvailability::select('Vessel')  
                                                                    ->where('Status', 'IDLE')
                                                                    ->where(function($query) use ($i) {
                                                                        $query->whereBetween('StartDate', [date('Y-m-01', strtotime('-' . $i . ' months')), date('Y-m-t', strtotime('-' . $i . ' months'))])
                                                                                ->orWhereBetween('EndDate', [date('Y-m-01', strtotime('-' . $i . ' months')), date('Y-m-t', strtotime('-' . $i . ' months'))]);
                                                                    })->groupBy('Vessel')->get();
                    ${'NumberOfVessels_BUNKERY_LAST' . $i . 'MONTHS'} = App\Models\VesselAvailability::select('Vessel')  
                                                                    ->where('Status', 'BUNKERY')
                                                                    ->where(function($query) use ($i) {
                                                                        $query->whereBetween('StartDate', [date('Y-m-01', strtotime('-' . $i . ' months')), date('Y-m-t', strtotime('-' . $i . ' months'))])
                                                                                ->orWhereBetween('EndDate', [date('Y-m-01', strtotime('-' . $i . ' months')), date('Y-m-t', strtotime('-' . $i . ' months'))]);
                                                                    })->groupBy('Vessel')->get();
                    ${'NumberOfVessels_INSPECTION_LAST' . $i . 'MONTHS'} = App\Models\VesselAvailability::select('Vessel')  
                                                                    ->where('Status', 'INSPECTION')
                                                                    ->where(function($query) use ($i) {
                                                                        $query->whereBetween('StartDate', [date('Y-m-01', strtotime('-' . $i . ' months')), date('Y-m-t', strtotime('-' . $i . ' months'))])
                                                                                ->orWhereBetween('EndDate', [date('Y-m-01', strtotime('-' . $i . ' months')), date('Y-m-t', strtotime('-' . $i . ' months'))]);
                                                                    })->groupBy('Vessel')->get();
                    ${'NumberOfVessels_MAINTENANCE_LAST' . $i . 'MONTHS'} = App\Models\VesselAvailability::select('Vessel')  
                                                                    ->where('Status', 'MAINTENANCE')
                                                                    ->where(function($query) use ($i) {
                                                                        $query->whereBetween('StartDate', [date('Y-m-01', strtotime('-' . $i . ' months')), date('Y-m-t', strtotime('-' . $i . ' months'))])
                                                                                ->orWhereBetween('EndDate', [date('Y-m-01', strtotime('-' . $i . ' months')), date('Y-m-t', strtotime('-' . $i . ' months'))]);
                                                                    })->groupBy('Vessel')->get();
                    ${'NumberOfVessels_OPERATION_LAST' . $i . 'MONTHS'} = App\Models\VesselAvailability::select('Vessel')  
                                                                    ->where('Status', 'OPERATION')
                                                                    ->where(function($query) use ($i) {
                                                                        $query->whereBetween('StartDate', [date('Y-m-01', strtotime('-' . $i . ' months')), date('Y-m-t', strtotime('-' . $i . ' months'))])
                                                                                ->orWhereBetween('EndDate', [date('Y-m-01', strtotime('-' . $i . ' months')), date('Y-m-t', strtotime('-' . $i . ' months'))]);
                                                                    })->groupBy('Vessel')->get();
                    ${'NumberOfVessels_BREAKDOWN_LAST' . $i . 'MONTHS'} = App\Models\VesselAvailability::select('Vessel')  
                                                                    ->where('Status', 'BREAKDOWN')
                                                                    ->where(function($query) use ($i) {
                                                                        $query->whereBetween('StartDate', [date('Y-m-01', strtotime('-' . $i . ' months')), date('Y-m-t', strtotime('-' . $i . ' months'))])
                                                                                ->orWhereBetween('EndDate', [date('Y-m-01', strtotime('-' . $i . ' months')), date('Y-m-t', strtotime('-' . $i . ' months'))]);
                                                                    })->groupBy('Vessel')->get();
                    ${'NumberOfVessels_DOCKING_LAST' . $i . 'MONTHS'} = App\Models\VesselAvailability::select(['Vessel'])  
                                                                    ->where('Status', 'DOCKING')
                                                                    ->where(function($query) use ($i) {
                                                                        $query->whereBetween('StartDate', [date('Y-m-01', strtotime('-' . $i . ' months')), date('Y-m-t', strtotime('-' . $i . ' months'))])
                                                                                ->orWhereBetween('EndDate', [date('Y-m-01', strtotime('-' . $i . ' months')), date('Y-m-t', strtotime('-' . $i . ' months'))]);
                                                                    })->groupBy('Vessel')->get();
                } 
            @endphp
            <div class="div recent-workflow" style="width: 100%">
                <h1>Recent Workflow</h1>  
                <div class="canvas"> 
                    <div class="inner-x">
                        <span>Last month </span>
                        <span style="height: 1.5em; width: {{ count($NumberOfVessels_DOCKING_LASTMONTH) * 10 }}%; background: #03AED2" class="tooltip-x"><span class="Hide tooltip-x-span"><div class="docking tooltip-x-div"></div> On docking ({{ count($NumberOfVessels_DOCKING_LASTMONTH) }})</span></span>
                        <span style="height: 1.5em; width: {{ count($NumberOfVessels_OPERATION_LASTMONTH) * 10 }}%; background: #A87676" class="tooltip-x"><span class="Hide tooltip-x-span"><div class="operation tooltip-x-div"></div> On operation ({{ count($NumberOfVessels_OPERATION_LASTMONTH) }})</span></span>
                        <span style="height: 1.5em; width: {{ count($NumberOfVessels_BREAKDOWN_LASTMONTH) * 10 }}%; background: #da1e28" class="tooltip-x"><span class="Hide tooltip-x-span"><div class="breakdown tooltip-x-div"></div> On breakdown ({{ count($NumberOfVessels_BREAKDOWN_LASTMONTH) }})</span></span>
                        <span style="height: 1.5em; width: {{ count($NumberOfVessels_MAINTENANCE_LASTMONTH) * 10 }}%; background: #52f781" class="tooltip-x"><span class="Hide tooltip-x-span"><div class="maintenance tooltip-x-div"></div> On maintenance ({{ count($NumberOfVessels_MAINTENANCE_LASTMONTH) }})</span></span>
                        <span style="height: 1.5em; width: {{ count($NumberOfVessels_INSPECTION_LASTMONTH) * 10 }}%; background: #ff832b" class="tooltip-x"><span class="Hide tooltip-x-span"><div class="inspection tooltip-x-div"></div> On inspection ({{ count($NumberOfVessels_INSPECTION_LASTMONTH) }})</span></span>
                        <span style="height: 1.5em; width: {{ count($NumberOfVessels_BUNKERY_LASTMONTH) * 10 }}%; background: #8a3ffc" class="tooltip-x"><span class="Hide tooltip-x-span"><div class="bunkery tooltip-x-div"></div> On bunkering ({{ count($NumberOfVessels_BUNKERY_LASTMONTH) }})</span></span>
                        <span style="height: 1.5em; width: {{ count($NumberOfVessels_IDLE_LASTMONTH) * 10 }}%; background: #fff" class="tooltip-x"><span class="Hide tooltip-x-span"><div class="idle tooltip-x-div"></div> On ready to go ({{ count($NumberOfVessels_IDLE_LASTMONTH) }})</span></span>
                    </div>
                    <div class="inner-x">
                        <span>- 2 months </span>
                        <span style="height: 1.5em; width: {{ count($NumberOfVessels_DOCKING_LAST2MONTHS) * 10 }}%; background: #03AED2"  class="tooltip-x"><span class="Hide tooltip-x-span"><div class="docking tooltip-x-div"></div> On docking ({{ count($NumberOfVessels_DOCKING_LAST2MONTHS) }})</span></span>
                        <span style="height: 1.5em; width: {{ count($NumberOfVessels_OPERATION_LAST2MONTHS) * 10 }}%; background: #A87676"  class="tooltip-x"><span class="Hide tooltip-x-span"><div class="operation tooltip-x-div"></div> On operation ({{ count($NumberOfVessels_OPERATION_LAST2MONTHS) }})</span></span>
                        <span style="height: 1.5em; width: {{ count($NumberOfVessels_BREAKDOWN_LAST2MONTHS) * 10 }}%; background: #da1e28"  class="tooltip-x"><span class="Hide tooltip-x-span"><div class="breakdown tooltip-x-div"></div> On breakdown ({{ count($NumberOfVessels_BREAKDOWN_LAST2MONTHS) }})</span></span>
                        <span style="height: 1.5em; width: {{ count($NumberOfVessels_MAINTENANCE_LAST2MONTHS) * 10 }}%; background: #52f781"  class="tooltip-x"><span class="Hide tooltip-x-span"><div class="maintenance tooltip-x-div"></div> On maintenance ({{ count($NumberOfVessels_MAINTENANCE_LAST2MONTHS) }})</span></span>
                        <span style="height: 1.5em; width: {{ count($NumberOfVessels_INSPECTION_LAST2MONTHS) * 10 }}%; background: #ff832b"  class="tooltip-x"><span class="Hide tooltip-x-span"><div class="inspection tooltip-x-div"></div> On inspection ({{ count($NumberOfVessels_INSPECTION_LAST2MONTHS) }})</span></span>
                        <span style="height: 1.5em; width: {{ count($NumberOfVessels_BUNKERY_LAST2MONTHS) * 10 }}%; background: #8a3ffc"  class="tooltip-x"><span class="Hide tooltip-x-span"><div class="bunkery tooltip-x-div"></div> On bunkering ({{ count($NumberOfVessels_BUNKERY_LAST2MONTHS) }})</span></span>
                        <span style="height: 1.5em; width: {{ count($NumberOfVessels_IDLE_LAST2MONTHS) * 10 }}%; background: #fff"  class="tooltip-x"><span class="Hide tooltip-x-span"><div class="idle tooltip-x-div"></div> On ready to go ({{ count($NumberOfVessels_IDLE_LAST2MONTHS) }})</span></span>
                    </div>
                    <div class="inner-x">
                        <span>- 3 months </span>
                        <span style="height: 1.5em; width: {{ count($NumberOfVessels_DOCKING_LAST3MONTHS) * 10 }}%; background: #03AED2"  class="tooltip-x"><span class="Hide tooltip-x-span"><div class="docking tooltip-x-div"></div> On docking ({{ count($NumberOfVessels_DOCKING_LAST3MONTHS) }})</span></span>
                        <span style="height: 1.5em; width: {{ count($NumberOfVessels_OPERATION_LAST3MONTHS) * 10 }}%; background: #A87676"  class="tooltip-x"><span class="Hide tooltip-x-span"><div class="operation tooltip-x-div"></div> On operation ({{ count($NumberOfVessels_OPERATION_LAST3MONTHS) }})</span></span>
                        <span style="height: 1.5em; width: {{ count($NumberOfVessels_BREAKDOWN_LAST3MONTHS) * 10 }}%; background: #da1e28"  class="tooltip-x"><span class="Hide tooltip-x-span"><div class="breakdown tooltip-x-div"></div> On breakdown ({{ count($NumberOfVessels_BREAKDOWN_LAST3MONTHS) }})</span></span>
                        <span style="height: 1.5em; width: {{ count($NumberOfVessels_MAINTENANCE_LAST3MONTHS) * 10 }}%; background: #52f781"  class="tooltip-x"><span class="Hide tooltip-x-span"><div class="maintenance tooltip-x-div"></div> On maintenance ({{ count($NumberOfVessels_MAINTENANCE_LAST3MONTHS) }})</span></span>
                        <span style="height: 1.5em; width: {{ count($NumberOfVessels_INSPECTION_LAST3MONTHS) * 10 }}%; background: #ff832b"  class="tooltip-x"><span class="Hide tooltip-x-span"><div class="inspection tooltip-x-div"></div> On inspection ({{ count($NumberOfVessels_INSPECTION_LAST3MONTHS) }})</span></span>
                        <span style="height: 1.5em; width: {{ count($NumberOfVessels_BUNKERY_LAST3MONTHS) * 10 }}%; background: #8a3ffc"  class="tooltip-x"><span class="Hide tooltip-x-span"><div class="bunkery tooltip-x-div"></div> On bunkering ({{ count($NumberOfVessels_BUNKERY_LAST3MONTHS) }})</span></span>
                        <span style="height: 1.5em; width: {{ count($NumberOfVessels_IDLE_LAST3MONTHS) * 10 }}%; background: #fff"  class="tooltip-x"><span class="Hide tooltip-x-span"><div class="idle tooltip-x-div"></div> On ready to go ({{ count($NumberOfVessels_IDLE_LAST3MONTHS) }})</span></span>
                    </div>
                    <div class="inner-x">
                        <span>- 4 months </span>
                        <span style="height: 1.5em; width: {{ count($NumberOfVessels_DOCKING_LAST4MONTHS) * 10 }}%; background: #03AED2" class="tooltip-x"><span class="Hide tooltip-x-span"><div class="docking tooltip-x-div"></div> On docking ({{ count($NumberOfVessels_DOCKING_LAST4MONTHS) }})</span></span>
                        <span style="height: 1.5em; width: {{ count($NumberOfVessels_OPERATION_LAST4MONTHS) * 10 }}%; background: #A87676" class="tooltip-x"><span class="Hide tooltip-x-span"><div class="operation tooltip-x-div"></div> On operation ({{ count($NumberOfVessels_OPERATION_LAST4MONTHS) }})</span></span>
                        <span style="height: 1.5em; width: {{ count($NumberOfVessels_BREAKDOWN_LAST4MONTHS) * 10 }}%; background: #da1e28" class="tooltip-x"><span class="Hide tooltip-x-span"><div class="breakdown tooltip-x-div"></div> On breakdown ({{ count($NumberOfVessels_BREAKDOWN_LAST4MONTHS) }})</span></span>
                        <span style="height: 1.5em; width: {{ count($NumberOfVessels_MAINTENANCE_LAST4MONTHS) * 10 }}%; background: #52f781" class="tooltip-x"><span class="Hide tooltip-x-span"><div class="maintenance tooltip-x-div"></div> On maintenance ({{ count($NumberOfVessels_MAINTENANCE_LAST4MONTHS) }})</span></span>
                        <span style="height: 1.5em; width: {{ count($NumberOfVessels_INSPECTION_LAST4MONTHS) * 10 }}%; background: #ff832b" class="tooltip-x"><span class="Hide tooltip-x-span"><div class="inspection tooltip-x-div"></div> On inspection ({{ count($NumberOfVessels_INSPECTION_LAST4MONTHS) }})</span></span>
                        <span style="height: 1.5em; width: {{ count($NumberOfVessels_BUNKERY_LAST4MONTHS) * 10 }}%; background: #8a3ffc" class="tooltip-x"><span class="Hide tooltip-x-span"><div class="bunkery tooltip-x-div"></div> On bunkering ({{ count($NumberOfVessels_BUNKERY_LAST4MONTHS) }})</span></span>
                        <span style="height: 1.5em; width: {{ count($NumberOfVessels_IDLE_LAST4MONTHS) * 10 }}%; background: #fff" class="tooltip-x"><span class="Hide tooltip-x-span"><div class="idle tooltip-x-div"></div> On ready to go ({{ count($NumberOfVessels_IDLE_LAST4MONTHS) }})</span></span>
                    </div>
                </div>
            </div> 
        </div> 
    </div>
</div>   
@include('Partials.Scripts1')
@endsection