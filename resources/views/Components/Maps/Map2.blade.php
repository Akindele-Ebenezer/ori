<div class="map2">
    <div id="mapContainer">
        <button class="close-map-btn">×</button>
        <h2>Dockyard Road, APAPA</h2>
        @php
            $vessels_map = \DB::table('vessels_section_4 as s4')
                        ->leftJoin('vessels_vessel_information as vi', 's4.VesselName', '=', 'vi.VesselName')
                        ->select(
                            's4.*',
                            'vi.VesselType', 
                        )->get();
            $vessel_status_colors = [
                'DOCKING'      => '#00CFFF',
                'INSPECTION'   => '#FFA500',
                'BUNKERY'    => '#8000FF',
                'BREAKDOWN'    => '#FF0000',
                'READY TO GO'  => '#00FF7F',
                'IDLE'         => '#00FF7F',
                'MAINTENANCE'  => '#AAA',
                'UNKNOWN'      => '#AAA',
            ]; 
        @endphp
        @foreach($vessels_map as $vessel)
            @php
                $tillNow = \DB::table('vessel_availabilities')
                            ->where('Vessel', $vessel->VesselName)
                            ->where('TillNow', 'YES')
                            ->select('Status')
                            ->first();
                $vessel_status = strtoupper(trim($tillNow->Status ?? 'UNKNOWN'));
                $indicatorColor = $vessel_status_colors[$vessel_status] 
                                ?? $vessel_status_colors['UNKNOWN'];
                $left = is_numeric($vessel->x_position)
                    ? $vessel->x_position . 'px'
                    : (50 + $loop->index * 80) . 'px';

                $top = is_numeric($vessel->y_position)
                    ? $vessel->y_position . 'px'
                    : '150px';
                $rotation = is_numeric($vessel->rotation_angle)
                    ? $vessel->rotation_angle
                    : 0;
                $vesselName = strtoupper(trim($vessel->VesselName ?? ''));
                $largeVessels = ['RIVER CHALAWA', 'S.D GUMEL'];
                $mediumVessels = ['WATER BARGE', 'BLUE LATITUDE', 'ANTELOPE'];
                if (in_array($vesselName, $largeVessels)) {
                    $imageWidth = '30em';
                } elseif (in_array($vesselName, $mediumVessels)) {
                    $imageWidth = '15em';
                } else {
                    $imageWidth = '8em';
                }
            @endphp
           <div class="vessel_map {{ str_replace(' ', '', trim($vessel->VesselType ?? 'default')) }} status-{{ strtolower($vessel->Status ?? 'active') }}"
                data-id="{{ $vessel->id }}" data-rotation="{{ $rotation }}"
                data-status="{{ strtolower($vessel->Status ?? 'active') }}"
                style="position:absolute; left: {{ $left }}; top: {{ $top }}; transform: rotate({{ $rotation }}deg);">
                <img src="/images/{{ $vessel->VesselType ?? 'default' }}.png" alt="{{ $vessel->VesselName }}" style="width: {{ $imageWidth }}; height: auto;">
                <div class="bridge"></div>
                <div class="mast"></div>
                <div class="flag"></div>
                <div class="status-indicator" style="background: {{ $indicatorColor }}"></div>
                <div class="vm">{{ strtoupper($vessel->VesselName ?? 'UNKNOWN') }}</div>
            </div>
        @endforeach
        <button class="save-positions-btn">Save Positions</button>
    </div>
</div>

