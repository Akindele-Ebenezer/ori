<div class="form-1 Tanks">
    <div class="inner">
        <div class="inner-xx">
            <div class="close-button-tanks">
                <button>✖</button>
            </div>
            <h1 class="tank-levels-title">TANK LEVELS</h1>
            @php
                $VesselTypes = ['TUG BOAT', 'PILOT CUTTERS', 'DREDGER', 'FUEL STATION', 'MULTICAT', 'SURVEY', 'PLOUGHING', 'OTHERS', 'MOORING', 'SPEED BOAT'];
            @endphp
            @foreach ($VesselTypes as $Vessel) 
                <h1 class="section-title">{{ $Vessel }}</h1>
                @php
                    $vessels = \DB::table('vessels_section_4 as s4')
                        ->whereRaw("s4.id = ( SELECT MAX(id) FROM vessels_section_4 WHERE VesselName = s4.VesselName )")
                        ->join('vessels_vessel_information as vi', 's4.VesselName', '=', 'vi.VesselName')
                        ->where('vi.VesselType', $Vessel)
                        ->select(
                            's4.*',
                            'vi.VesselType',
                            'vi.Captain',
                            'vi.NightDutyCaptain'
                        )
                        ->get();
                @endphp
                <div class="inner-x">
                    @forelse ($vessels as $Tank)
                        @php  
                            $tugs_capacity = $Tank->TankCapacity ?? 100000;
                            $capacity_m3 = $tugs_capacity / 1000;
                            $currentLevel = $Tank->ROB ?? 0;
                            $currentLevel_m3 = $currentLevel / 1000;
                            if (floor($currentLevel) != $currentLevel) {
                                $currentLevel *= 1000;
                            }
                            $percentage = $tugs_capacity > 0 
                                ? min(($currentLevel / $tugs_capacity) * 100, 100)
                                : 0;
                            [$status, $color] = match (true) {
                                $percentage <= 10 => ['Critical', 'red'],
                                $percentage <= 25 => ['Very Low', 'orange'],
                                $percentage <= 50 => ['Low', 'gold'],
                                $percentage <= 75 => ['Normal', 'green'],
                                $percentage <= 90 => ['High', 'blue'],
                                default => ['Full', 'darkgreen'],
                            };
                            $vessel_status = \DB::table('vessel_availabilities')
                                ->where('Vessel', $Tank->VesselName) 
                                ->where('TillNow', 'YES')
                                ->value('Status') ?? 'UNKNOWN';                          
                                $vessel_status_colors = [
                                    'DOCKING'      => '#00CFFF', // Blue
                                    'INSPECTION'   => '#FFA500', // Orange
                                    'BUNKERING'    => '#8000FF', // Purple
                                    'BREAKDOWN'    => '#FF0000', // Red
                                    'READY TO GO'  => '#00FF7F', // Green
                                    'IDLE'  => '#00FF7F', // Green
                                    'MAINTENANCE'  => '#AAA', // Grey
                                    'UNKNOWN'      => '#00FF7F', // Gray fallback
                                ];
                            $indicatorColor = $vessel_status_colors[$vessel_status] ?? $vessel_status_colors['UNKNOWN'];
                        @endphp
                        <div class="tank-section">
                            <div class="tank-header">
                                <span class="bracket left"></span>
                                <span class="tank-title">{{ $Tank->VesselName }}<span class="indicator" style="background-color: {{ $indicatorColor }};"></span></span>
                                <span class="bracket right"></span>
                            </div>
                            <div class="tank-row">
                                <div class="tank-box">
                                    <div class="tank-liquid" style="height: {{ round($percentage, 1) }}%; background-color: {{ $color }};">
                                        <div class="tank-bars"></div>
                                        <span class="tank-percent">{{ number_format($percentage, 1) }}%</span>
                                    </div>
                                </div>
                                <div class="tank-info">
                                    <h2>Fuel Remaining (ROB)</h2>
                                    <p class="tank-capacity"><strong>Capacity:</strong> {{ number_format($capacity_m3, 2) }} m³ <span class="secondary-unit"> ({{ number_format($tugs_capacity) }} L)</span></p>
                                    <p class="tank-current"><strong>Current Level:</strong> {{ number_format($currentLevel_m3, 2) }} m³ <span class="secondary-unit"> ({{ number_format($currentLevel) }} L • {{ number_format($percentage, 1) }}%)</span></p>                                    <div class="tank-status">
                                        Status: <span style="color: {{ $color }}; font-weight: bold;">{{ $status }}</span>
                                    </div>
                                    <p><strong>Captain:</strong> {{ $Tank->Captain ?? 'N/A' }}</p>
                                    <p><strong>Night Duty Captain:</strong> {{ $Tank->NightDutyCaptain ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p style="opacity:.5">No vessels in this category</p>
                    @endforelse
                </div>
            @endforeach
        </div>
    </div>
</div>
