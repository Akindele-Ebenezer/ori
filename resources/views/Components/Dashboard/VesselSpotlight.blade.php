<script src="https://cdn.tailwindcss.com"></script>
<div class="VesselSpotlight">
        <div class="icancel-button">✖</div>
        <img src="{{ asset('images/company-logo.jpeg') }}">
        <div class="chart-header">LIVE DATA</div>
        <div class="body">
                <!-- Background Decorative Element -->
                <i class="fa-solid fa-ship background-vessel-icon"></i>

                <div id="app" class="h-full flex flex-col justify-between p-8">
                        
                        <!-- Header Section -->
                        <header class="flex justify-between items-center border-b border-white/10 pb-4">
                        <div class="flex items-center gap-4">
                                <div class="bg-blue-600 p-2 rounded-lg">
                                <i class="fa-solid fa-anchor text-2xl"></i>
                                </div>
                                <div>
                                <h1 class="text-[2.2em] font-black tracking-tighter">ORI NEXT-GEN</h1>
                                <p class="text-[15px] text-slate-400 uppercase tracking-widest">Real-time Fleet Monitoring</p>
                                </div>
                        </div>
                        <div class="flex items-center gap-8">
                                <div class="flex gap-2">
                                <button onclick="prevVessel()" class="bg-white/5 hover:bg-white/10 p-3 rounded-lg transition-colors border border-white/10">
                                        <i class="fa-solid fa-chevron-left"></i>
                                </button>
                                <button onclick="nextVessel()" class="bg-white/5 hover:bg-white/10 p-3 rounded-lg transition-colors border border-white/10">
                                        <i class="fa-solid fa-chevron-right"></i>
                                </button>
                                </div>
                                <div class="text-right">
                                <div id="clock" class="text-2xl font-bold font-mono">00:00:00</div>
                                <div class="text-blue-400 text-[10px] font-semibold uppercase tracking-widest">System Online</div>
                                </div>
                        </div>
                        </header>

                        <!-- Main Display Content Layout -->
                        <div class="flex-grow flex gap-8 py-8 overflow-hidden">
                        
                        <!-- SIDEBAR: Vessel List -->
                        <aside class="w-64 border-r border-white/5 pr-4 flex flex-col">
                                <h3 class="text-[10px] uppercase tracking-[0.2em] font-black text-slate-500 mb-4">Fleet Overview</h3>
                                <div id="vessel-list" class="VesselSpotlight-Data space-y-1 overflow-y-auto pr-2 flex-grow">
                                <!-- Sidebar list injected here -->
                                </div>
                        </aside>

                        <!-- MAIN: Focused Vessel -->
                        <main class="flex-grow flex flex-col justify-center items-center text-center relative">
                                <div id="content-area" class="w-full ">
                                <!-- Data injected here by JS -->
                                </div>
                        </main>
                        </div>

                        <!-- Footer / Navigation Progress -->
                        <footer class="w-full">
                        <div class="flex justify-between items-center mb-4 text-[10px] uppercase tracking-widest text-slate-500 font-bold">
                                <span id="vessel-count">VESSEL 1 OF 8</span>
                                <span id="next-vessel-name">NEXT: ASAGA</span>
                        </div>
                        <div class="w-full h-1.5 bg-white/5 rounded-full overflow-hidden">
                                <div id="timer-bar" class="h-full bg-blue-500 progress-bar-fill" style="width: 0%"></div>
                        </div>
                        </footer>
                </div> 
        @include('Components.Dashboard.VesselSpotlight-JS')
        </div>
</div>

