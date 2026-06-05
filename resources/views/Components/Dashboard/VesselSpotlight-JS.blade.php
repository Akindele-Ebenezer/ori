<script>
@php
        $iVessels = \DB::table('vessels_vessel_information as v')->select(['v.VesselName', 'v.Captain', 'v.NightDutyCaptain', 'v.VesselType', 'v.Company', 'v.ImoNumber', 's4.TankCapacity', 's4.ROB', 'va.Status', 's4.Area'])->join('vessels_section_4 as s4', 'v.VesselName', '=', 's4.VesselName')->join('vessel_availabilities as va', 'v.VesselName', '=', 'va.Vessel')->where('va.TillNow', 'YES')->get();

@endphp
const vessels = [
        @foreach ($iVessels as $Vessel)

        @php
        $capacity = ((float) ($Vessel->TankCapacity ?? 0)) / 1000;
        $rob = (float) ($Vessel->ROB ?? 0);

        // If ROB is a huge number (e.g., 40850), scale it down to match capacity (e.g., 40.85)
        if ($rob > 1000) {
            $rob = $rob / 1000;
        }

        // Prevent division by zero
        $fuelLevel = $capacity > 0 ? round(($rob / $capacity) * 100, 1) : 0;
        // Fuel Status + Tank Color
        if ($fuelLevel >= 70) {
                $fuelStatus = 'HIGH';
                $tankColor = 'bg-green-500';
        } elseif ($fuelLevel >= 40) {
                $fuelStatus = 'MEDIUM';
                $tankColor = 'bg-yellow-500';
        } else {
                $fuelStatus = 'LOW';
                $tankColor = 'bg-red-500';
        }
        $statusColor = match(strtoupper($Vessel->Status)) {
                'IDLE' => '#22c55e',
                'BREAKDOWN' => '#ef4444',
                'MAINTENANCE' => '#ffffff',
                'BUNKERY' => '#8a3ffc',
                'INSPECTION' => '#ff832b',
                'DOCKING' => '#03AED2',
                default => '#6b7280',
        }; 
        @endphp

        {
        name: "{{ $Vessel->VesselName }}",
        status: "{{ strtoupper($Vessel->Status) == 'IDLE' ? 'READY' : strtoupper($Vessel->Status) }}",
        location: "{{ $Vessel->Area }}",
        captain: "{{ $Vessel->Captain }}",
        nightCaptain: "{{ $Vessel->NightDutyCaptain }}",

        // Fuel Data
        fuelLevel: {{ $fuelLevel > 100 ? 100 : $fuelLevel }}, // Cap at 100%
        capacity: "{{ number_format($capacity, 2) }} M³",
        currentQty: "{{ number_format($rob, 2) }} M³",
        fuelStatus: "{{ $fuelStatus }}",

        // Colors
        statusColor: "{{ $statusColor }}",
        tankColor: "{{ $tankColor }}"
        }@if(!$loop->last),@endif

        @endforeach
];


let icurrentIndex = 0;
const displayDuration = 10000;
let lastUpdate = Date.now();

function updateClock() {
    const now = new Date();
    document.getElementById('clock').innerText = now.toLocaleTimeString();
}
function renderVesselList() {
    const listEl = document.getElementById('vessel-list');

    listEl.innerHTML = vessels.map((v, i) => `
        <div onclick="jumpToVessel(${i})"
            class="vessel-item p-3 rounded cursor-pointer transition-all hover:bg-white/10 flex items-center justify-between ${i === currentIndex ? 'active' : ''}">

            <div>
                <p class="text-xs font-bold"  style="font-weight: 900; font-size: 1.2rem;">
                    ${v.name}
                </p>

                <p class="text-[9px] uppercase tracking-wider"
                style="color:${v.statusColor}; padding-block: .5em">
                ${v.status === 'BUNKERY' ? 'BUNKERING' : v.status}
                </p>
            </div>

            <div class="text-[12px] font-mono text-slate-400">
                ${v.fuelLevel}%
            </div>

        </div>
    `).join('');
}

function renderVessel(index) {
    icurrentIndex = index;
    const v = vessels[index];
    const nextV = vessels[(index + 1) % vessels.length];
    const area = document.getElementById('content-area');
    
    area.innerHTML = `
        <div class="slide-up flex items-center justify-center gap-20">
            <div class="flex flex-col items-center">
                <div class="tank-container mb-4 scale-90">
                    <div class="tank-fill ${v.tankColor}" style="height: ${v.fuelLevel}%">
                        <div class="tank-waves"></div>
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-xl font-black text-white mix-difference">${v.fuelLevel}%</span>
                    </div>
                </div>
                <div class="text-center">
                    <span class="block text-[10px] text-slate-500 uppercase font-black tracking-widest">Fuel Status</span>
                    <span class="text-lg font-bold uppercase ${v.tankColor.replace('bg-', 'text-')}">${v.fuelStatus}</span>
                </div>
            </div>

            <div class="flex-grow max-w-3xl">
            <div class="mb-4 inline-block px-5 py-1.5 rounded-full status-glow font-black text-[10px] tracking-widest pulse-soft"
            style="color:${v.statusColor}; border:1px solid ${v.statusColor}; font-size: 2rem;">
            ${v.status === 'BUNKERY' ? 'BUNKERING' : v.status}
            </div>
                <h2 class="vessel-namei text-[9rem] leading-none mb-4 uppercase">${v.name}</h2>
                <div class="grid grid-cols-3 gap-6 mt-8">
                    <div class="text-left border-l border-white/10 pl-3">
                        <p class="text-slate-500 text-[9px] uppercase tracking-widest mb-1 font-black">Location</p>
                        <p class="text-2xl font-bold uppercase">${v.location}</p>
                    </div>
                    <div class="text-left border-l border-white/10 pl-3">
                        <p class="text-slate-500 text-[9px] uppercase tracking-widest mb-1 font-black">Day Captain</p>
                        <p class="text-2xl font-bold uppercase">${v.captain}</p>
                    </div>
                    <div class="text-left border-l border-white/10 pl-3">
                        <p class="text-slate-500 text-[9px] uppercase tracking-widest mb-1 font-black">Night Duty</p>
                        <p class="text-2xl font-bold text-slate-400 uppercase">${v.nightCaptain}</p>
                    </div>
                </div>
            </div>

            <div class="w-64 text-right space-y-6" style="translate: 5em">
                <div>
                    <p class="text-slate-500 text-[9px] uppercase tracking-widest font-black mb-1">Capacity</p>
                    <p class="text-3xl font-bold">${v.capacity}</p>
                </div>
                <div>
                    <p class="text-slate-500 text-[9px] uppercase tracking-widest font-black mb-1 text-blue-400">Current ROB</p>
                    <p class="text-3xl font-bold text-blue-400">${v.currentQty}</p>
                </div>
            </div>
        </div>
    `;

    document.getElementById('vessel-count').innerText = `VESSEL ${index + 1} OF ${vessels.length}`;
    document.getElementById('next-vessel-name').innerText = `NEXT: ${nextV.name}`;
    renderVesselList();
}

function jumpToVessel(index) {
    renderVessel(index);
    lastUpdate = Date.now();
}

function nextVessel() {
    icurrentIndex = (icurrentIndex + 1) % vessels.length;
    jumpToVessel(icurrentIndex);
}

function prevVessel() {
    icurrentIndex = (icurrentIndex - 1 + vessels.length) % vessels.length;
    jumpToVessel(icurrentIndex);
}

function updateProgress() {
    const now = Date.now();
    const elapsed = now - lastUpdate;
    const percent = (elapsed / displayDuration) * 100;
    document.getElementById('timer-bar').style.width = Math.min(percent, 100) + '%';
    
    if (elapsed >= displayDuration) {
        nextVessel();
    }
    requestAnimationFrame(updateProgress);
}

// Initialize
setInterval(updateClock, 1000);
updateClock();
renderVessel(0);
updateProgress();

let icancel_button = document.querySelector('.icancel-button');
icancel_button.addEventListener('click', () => {
    document.querySelector('.VesselSpotlight').style.display = 'none';
});
</script>