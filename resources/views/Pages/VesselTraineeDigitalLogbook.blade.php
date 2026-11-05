<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maritime Trainee Digital Logbook</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        ocean: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            900: '#0c4a6e'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
        }
        .office-filter-input {
            width: 100%;
            min-height: 2.75rem;
            border: 1px solid #cbd5e1;
            border-radius: 0.75rem;
            background: #fff;
            padding: 0.625rem 0.75rem;
            color: #0f172a;
            font: inherit;
            font-size: 0.875rem;
        }
        .office-filter-input:focus {
            outline: 2px solid transparent;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.14);
        }
        @media (max-width: 480px) {
            .logbook-header { align-items: flex-start; }
            .logbook-brand { min-width: 0; flex: 1 1 100%; }
            .logbook-brand-copy { min-width: 0; }
            .logbook-title { font-size: 0.9rem; gap: 0.35rem; flex-wrap: wrap; }
            .logbook-subtitle { display: none; }
            #userProfileBadge { margin-left: auto; max-width: 100%; }
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-full flex flex-col antialiased selection:bg-ocean-500 selection:text-white">

    <header class="logbook-header bg-white border-b border-slate-200 sticky top-0 z-50 px-4 sm:px-6 py-3 sm:py-3.5 flex flex-wrap items-center justify-between gap-3 shadow-sm">
        <div class="logbook-brand flex items-center space-x-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-ocean-600 to-ocean-500 flex items-center justify-center text-white shadow-md shadow-ocean-600/20 flex-shrink-0">
                <i class="fa-solid fa-ship text-lg"></i>
            </div>
            <div class="logbook-brand-copy">
                <h1 class="logbook-title font-bold text-base sm:text-lg text-slate-900 tracking-tight flex items-center gap-2">
                    MARITIME LOGBOOK <span class="text-[10px] sm:text-xs px-2 py-0.5 rounded-full bg-ocean-50 text-ocean-700 font-semibold border border-ocean-200">v2.5 Light</span>
                </h1>
                <p class="logbook-subtitle text-[11px] sm:text-xs text-slate-500 hidden sm:block">Professional Vessel Operations Tracking System</p>
            </div>
        </div>
        <div id="userProfileBadge" class="hidden items-center space-x-3 bg-slate-100 px-3 py-1.5 rounded-full border border-slate-200">
            <div class="w-7 h-7 rounded-full bg-ocean-100 text-ocean-700 flex items-center justify-center font-bold text-xs" id="userInitials"></div>
            <div class="text-xs max-w-[120px] sm:max-w-none truncate">
                <p class="font-semibold text-slate-900 truncate" id="navCandidateName"></p>
                <p class="text-[10px] text-slate-500 truncate" id="navCandidateRank"></p>
            </div>
            <button onclick="logoutCandidate()" title="Switch Profile" class="ml-1 sm:ml-2 text-slate-400 hover:text-rose-600 transition-colors p-1">
                <i class="fa-solid fa-right-from-bracket"></i>
            </button>
        </div>
    </header>

    <main class="flex-1 max-w-7xl w-full mx-auto p-3 sm:p-6 lg:p-8 flex flex-col">

        <!-- SIGN UP VIEW -->
        <section id="signupView" class="max-w-xl mx-auto w-full my-auto py-6">
            <div class="bg-white border border-slate-200 rounded-2xl shadow-xl overflow-hidden p-5 sm:p-8 relative">
                <div class="absolute top-0 right-0 w-32 h-32 bg-ocean-100 rounded-full blur-3xl pointer-events-none"></div>
                
                <div class="text-center mb-6 sm:mb-8">
                    <div class="inline-flex p-3 rounded-2xl bg-ocean-50 text-ocean-600 mb-3 border border-ocean-100 shadow-sm">
                        <i class="fa-solid fa-id-card text-2xl"></i>
                    </div>
                    <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-slate-900">Trainee Candidate Registration</h2>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1">Please enter your personal data to initiate your digital training logbook.</p>
                </div>

                <form id="signupForm" onsubmit="handleSignUp(event)" class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">Full Name *</label>
                            <input type="text" id="regName" required placeholder="e.g. Capt. Alex Mercer" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm text-slate-900 focus:outline-none focus:border-ocean-500 focus:bg-white transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">Rank / Position *</label>
                            <input type="text" id="regRank" required placeholder="e.g. Deck Cadet / Trainee" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm text-slate-900 focus:outline-none focus:border-ocean-500 focus:bg-white transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">Seaman Book / ID No. *</label>
                            <input type="text" id="regIdNo" required placeholder="e.g. SB-984210" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm text-slate-900 focus:outline-none focus:border-ocean-500 focus:bg-white transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">Contact Email / Phone *</label>
                            <input type="text" id="regContact" required placeholder="e.g. alex@maritime.org" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm text-slate-900 focus:outline-none focus:border-ocean-500 focus:bg-white transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">Prior Experience & Background Details</label>
                        <textarea id="regExperience" rows="3" placeholder="Summary of previous sea time, certifications (STCW, STCW-F)..." class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-sm text-slate-900 focus:outline-none focus:border-ocean-500 focus:bg-white transition-all resize-none"></textarea>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full bg-gradient-to-r from-ocean-600 to-ocean-500 hover:from-ocean-700 hover:to-ocean-600 text-white font-semibold py-3.5 px-6 rounded-xl shadow-md shadow-ocean-600/20 transition-all flex items-center justify-center space-x-2 text-sm sm:text-base">
                            <span>Initialize Logbook Profile</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <!-- MAIN DASHBOARD & LOG ENTRY FORM VIEW -->
        <section id="dashboardView" class="hidden space-y-5">
            <!-- Top Controls / Stats Banner -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                <div class="bg-white border border-slate-200 rounded-2xl p-4 flex items-center space-x-3.5 shadow-sm">
                    <div class="p-3 bg-ocean-50 text-ocean-600 rounded-xl border border-ocean-100 flex-shrink-0">
                        <i class="fa-solid fa-book-open text-lg sm:text-xl"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[11px] sm:text-xs text-slate-500 font-semibold uppercase truncate">Total Entries</p>
                        <h3 class="text-xl sm:text-2xl font-bold text-slate-900" id="statTotalEntries">0</h3>
                    </div>
                </div>
                <div class="bg-white border border-slate-200 rounded-2xl p-4 flex items-center space-x-3.5 shadow-sm">
                    <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl border border-emerald-100 flex-shrink-0">
                        <i class="fa-solid fa-list-check text-lg sm:text-xl"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[11px] sm:text-xs text-slate-500 font-semibold uppercase truncate">Total Jobs</p>
                        <h3 class="text-xl sm:text-2xl font-bold text-slate-900" id="statTotalJobs">0</h3>
                    </div>
                </div>
                <div class="bg-white border border-slate-200 rounded-2xl p-4 flex items-center space-x-3.5 shadow-sm">
                    <div class="p-3 bg-amber-50 text-amber-600 rounded-xl border border-amber-100 flex-shrink-0">
                        <i class="fa-solid fa-anchor text-lg sm:text-xl"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[11px] sm:text-xs text-slate-500 font-semibold uppercase truncate">Docking Ops</p>
                        <h3 class="text-xl sm:text-2xl font-bold text-slate-900" id="statDocking">0</h3>
                    </div>
                </div>
                <div class="bg-white border border-slate-200 rounded-2xl p-4 flex items-center space-x-3.5 shadow-sm col-span-2 lg:col-span-1">
                    <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl border border-indigo-100 flex-shrink-0">
                        <i class="fa-solid fa-sun-moon text-lg sm:text-xl"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[11px] sm:text-xs text-slate-500 font-semibold uppercase truncate">Day / Night Split</p>
                        <h3 class="text-sm sm:text-base font-bold text-slate-900 truncate"><span id="statDayCount">0</span> Day / <span id="statNightCount">0</span> Night</h3>
                    </div>
                </div>
            </div>

            <!-- Action Bar -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 bg-white p-4 rounded-2xl border border-slate-200 shadow-sm">
                <div class="flex flex-wrap items-center gap-2.5">
                    <button onclick="openEntryModal()" class="bg-ocean-600 hover:bg-ocean-700 text-white text-sm font-semibold py-3 px-5 rounded-xl shadow-md shadow-ocean-600/20 transition-all flex items-center justify-center space-x-2">
                        <i class="fa-solid fa-plus"></i>
                        <span>New Training Log Entry</span>
                    </button>
                    <button onclick="openExportModal()" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold py-3 px-5 rounded-xl shadow-md shadow-emerald-600/20 transition-all flex items-center justify-center space-x-2">
                        <i class="fa-solid fa-share-nodes text-xs"></i>
                        <span>Export / Send</span>
                    </button>
                    <button onclick="openOfficePortal()" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold py-3 px-5 rounded-xl shadow-md shadow-indigo-600/20 transition-all flex items-center justify-center space-x-2">
                        <i class="fa-solid fa-building-user"></i>
                        <span>Port Captain Office Portal</span>
                    </button>
                </div>
                <div class="text-xs text-slate-500 flex items-center justify-center sm:justify-start space-x-2">
                    <i class="fa-solid fa-laptop-code text-ocean-500"></i>
                    <span>Local Office Client & JSON Import Ready</span>
                </div>
            </div>

            <!-- Log Entries Table / Card List -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="p-4 sm:p-5 border-b border-slate-200 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3">
                    <h3 class="font-bold text-slate-900 text-base flex items-center gap-2">
                        <i class="fa-solid fa-clipboard-list text-ocean-600"></i> Training Log Records
                    </h3>
                    <div class="w-full sm:w-72">
                        <input type="text" id="searchInput" oninput="renderLogEntries()" placeholder="Search vessel, trainer, status..." class="w-full bg-slate-50 border border-slate-300 text-xs text-slate-900 rounded-xl px-3.5 py-2.5 focus:outline-none focus:border-ocean-500 focus:bg-white">
                    </div>
                </div>
                <div id="logEntriesContainer" class="divide-y divide-slate-100">
                    <!-- Dynamic Log Entries populated via JS -->
                </div>
            </div>
        </section>

    </main>

    <div id="entryModal" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm hidden flex items-center justify-center p-3 sm:p-4 overflow-y-auto">
        <div class="bg-white border border-slate-200 rounded-2xl max-w-3xl w-full shadow-2xl overflow-hidden my-auto max-h-[95vh] flex flex-col">
            <!-- Modal Header -->
            <div class="p-4 sm:p-5 border-b border-slate-200 flex items-center justify-between bg-slate-50/80">
                <div class="flex items-center space-x-3">
                    <div class="p-2.5 bg-ocean-50 text-ocean-600 rounded-xl border border-ocean-100">
                        <i class="fa-solid fa-pen-nib"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-900 text-base sm:text-lg" id="modalTitle">New Training Log Entry</h3>
                        <p class="text-xs text-slate-500">Record mooring, docking, and vessel operations</p>
                    </div>
                </div>
                <button onclick="closeEntryModal()" class="w-9 h-9 rounded-xl bg-slate-100 text-slate-500 hover:text-slate-900 hover:bg-slate-200 flex items-center justify-center transition-colors">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
            </div>

            <!-- Modal Body (Form) -->
            <div class="p-4 sm:p-6 overflow-y-auto flex-1 space-y-4 sm:space-y-5">
                <form id="logForm" onsubmit="saveLogEntry(event)" class="space-y-4 sm:space-y-5">
                    <input type="hidden" id="editIndex" value="-1">

                    <!-- Row 1: Date & Status & Vessel Type -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">Date of Training *</label>
                            <input type="date" id="logDate" required class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-ocean-500 focus:bg-white">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">Status *</label>
                            <select id="logStatus" required class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-ocean-500 focus:bg-white">
                                <option value="Docking">Docking</option>
                                <option value="Undocking">Undocking</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">Vessel Type *</label>
                            <select id="logVesselType" required class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-ocean-500 focus:bg-white">
                                <option value="RORO">RORO</option>
                                <option value="Container Vessel">Container Vessel</option>
                                <option value="Bulcario">Bulcario</option>
                                <option value="Cargo">Cargo</option>
                                <option value="River">River</option>
                            </select>
                        </div>
                    </div>

                    <!-- Row 2: Vessel Name, Trainer Name, Period -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">Vessel Name *</label>
                            <input type="text" id="logVesselName" required placeholder="e.g. MV Ocean Spirit" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-ocean-500 focus:bg-white">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">Trainer Name *</label>
                            <input type="text" id="logTrainerName" required placeholder="e.g. Capt. John Doe" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-ocean-500 focus:bg-white">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">Period *</label>
                            <select id="logPeriod" required class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-ocean-500 focus:bg-white">
                                <option value="Day">Day</option>
                                <option value="Night">Night</option>
                            </select>
                        </div>
                    </div>

                    <!-- Position of Making Fast Checkboxes -->
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
                        <label class="block text-xs font-semibold text-ocean-700 uppercase tracking-wider mb-3 flex items-center gap-2">
                            <i class="fa-solid fa-anchor"></i> Position of Making Fast (Check all applicable)
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5">
                            <label class="flex items-center space-x-3 text-xs font-medium text-slate-700 cursor-pointer bg-white p-3 rounded-xl border border-slate-200 hover:border-ocean-300 shadow-sm transition-all">
                                <input type="checkbox" name="makingFast" value="Port Side Forward" class="w-4 h-4 rounded text-ocean-600 focus:ring-ocean-500 border-slate-300">
                                <span>Port Side Forward</span>
                            </label>
                            <label class="flex items-center space-x-3 text-xs font-medium text-slate-700 cursor-pointer bg-white p-3 rounded-xl border border-slate-200 hover:border-ocean-300 shadow-sm transition-all">
                                <input type="checkbox" name="makingFast" value="Port Side Aft" class="w-4 h-4 rounded text-ocean-600 focus:ring-ocean-500 border-slate-300">
                                <span>Port Side Aft</span>
                            </label>
                            <label class="flex items-center space-x-3 text-xs font-medium text-slate-700 cursor-pointer bg-white p-3 rounded-xl border border-slate-200 hover:border-ocean-300 shadow-sm transition-all">
                                <input type="checkbox" name="makingFast" value="Starboard Side Forward" class="w-4 h-4 rounded text-ocean-600 focus:ring-ocean-500 border-slate-300">
                                <span>Starboard Side Forward</span>
                            </label>
                            <label class="flex items-center space-x-3 text-xs font-medium text-slate-700 cursor-pointer bg-white p-3 rounded-xl border border-slate-200 hover:border-ocean-300 shadow-sm transition-all">
                                <input type="checkbox" name="makingFast" value="Starboard Side Aft" class="w-4 h-4 rounded text-ocean-600 focus:ring-ocean-500 border-slate-300">
                                <span>Starboard Side Aft</span>
                            </label>
                            <label class="flex items-center space-x-3 text-xs font-medium text-slate-700 cursor-pointer bg-white p-3 rounded-xl border border-slate-200 hover:border-ocean-300 shadow-sm transition-all">
                                <input type="checkbox" name="makingFast" value="Center Left Forward" class="w-4 h-4 rounded text-ocean-600 focus:ring-ocean-500 border-slate-300">
                                <span>Center Left Forward</span>
                            </label>
                            <label class="flex items-center space-x-3 text-xs font-medium text-slate-700 cursor-pointer bg-white p-3 rounded-xl border border-slate-200 hover:border-ocean-300 shadow-sm transition-all">
                                <input type="checkbox" name="makingFast" value="Center Left Aft" class="w-4 h-4 rounded text-ocean-600 focus:ring-ocean-500 border-slate-300">
                                <span>Center Left Aft</span>
                            </label>
                        </div>
                    </div>

                    <!-- Job 1 to 7 / Specific Tasks -->
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <label class="block text-xs font-semibold text-ocean-700 uppercase tracking-wider flex items-center gap-2">
                                <i class="fa-solid fa-tasks"></i> Operational Jobs Performed (Job 1 - Job 7)
                            </label>
                            <span class="text-xs font-medium text-slate-500">Total Jobs: <strong id="dynamicTotalJobs" class="text-slate-900 font-bold">0</strong></span>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <input type="text" id="job1" placeholder="Job 1: e.g. Heaving line passing" oninput="updateJobCount()" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 focus:outline-none focus:border-ocean-500 focus:bg-white">
                            </div>
                            <div>
                                <input type="text" id="job2" placeholder="Job 2: e.g. Secure spring line on bitt" oninput="updateJobCount()" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 focus:outline-none focus:border-ocean-500 focus:bg-white">
                            </div>
                            <div>
                                <input type="text" id="job3" placeholder="Job 3: e.g. Operate winches / capstan" oninput="updateJobCount()" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 focus:outline-none focus:border-ocean-500 focus:bg-white">
                            </div>
                            <div>
                                <input type="text" id="job4" placeholder="Job 4: e.g. Monitor fender placement" oninput="updateJobCount()" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 focus:outline-none focus:border-ocean-500 focus:bg-white">
                            </div>
                            <div>
                                <input type="text" id="job5" placeholder="Job 5: e.g. Gangway rigging inspection" oninput="updateJobCount()" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 focus:outline-none focus:border-ocean-500 focus:bg-white">
                            </div>
                            <div>
                                <input type="text" id="job6" placeholder="Job 6: e.g. Communication with bridge" oninput="updateJobCount()" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 focus:outline-none focus:border-ocean-500 focus:bg-white">
                            </div>
                        </div>
                        <div>
                            <input type="text" id="job7" placeholder="Job 7: e.g. Final checklist verification" oninput="updateJobCount()" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 focus:outline-none focus:border-ocean-500 focus:bg-white">
                        </div>
                    </div>

                    <!-- Remarks -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-1.5">Trainer Remarks & Evaluation</label>
                        <textarea id="logRemarks" rows="2.5" placeholder="Notes on performance, safety awareness, weather conditions..." class="w-full bg-slate-50 border border-slate-300 rounded-xl px-3.5 py-2.5 text-sm text-slate-900 focus:outline-none focus:border-ocean-500 focus:bg-white transition-all resize-none"></textarea>
                    </div>

                    <!-- Modal Footer Buttons -->
                    <div class="flex flex-col-reverse sm:flex-row items-center justify-end gap-2.5 pt-2">
                        <button type="button" onclick="closeEntryModal()" class="w-full sm:w-auto bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium text-sm py-3 px-5 rounded-xl transition-colors">
                            Cancel
                        </button>
                        <button type="submit" class="w-full sm:w-auto bg-gradient-to-r from-ocean-600 to-ocean-500 hover:from-ocean-700 hover:to-ocean-600 text-white font-semibold text-sm py-3 px-6 rounded-xl shadow-md shadow-ocean-600/20 transition-all">
                            Save Log Entry
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- EXPORT AND SHARE MODAL -->
    <div id="exportModal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center p-3 sm:p-4 overflow-y-auto">
        <div class="bg-white border border-slate-200 rounded-2xl max-w-xl w-full shadow-2xl overflow-hidden my-auto">
            <div class="p-4 sm:p-5 border-b border-slate-200 flex items-center justify-between gap-3 bg-gradient-to-r from-emerald-50 via-white to-sky-50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center shadow-md shadow-emerald-600/20">
                        <i class="fa-solid fa-file-export"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-900 text-base sm:text-lg">Export &amp; Send Logbook</h3>
                        <p class="text-xs text-slate-500">Choose a file format and destination</p>
                    </div>
                </div>
                <button type="button" onclick="closeExportModal()" aria-label="Close export dialog" class="w-9 h-9 rounded-xl bg-white text-slate-500 hover:text-slate-900 hover:bg-slate-100 border border-slate-200 flex items-center justify-center">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="p-4 sm:p-6 space-y-5">
                <fieldset>
                    <legend class="text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">File format</legend>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <label class="flex items-start gap-3 rounded-xl border border-slate-200 p-3.5 cursor-pointer hover:border-emerald-300 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50/60">
                            <input type="radio" name="exportFormat" value="json" checked class="mt-0.5 accent-emerald-600">
                            <span>
                                <span class="block text-sm font-semibold text-slate-900">JSON</span>
                                <span class="block text-xs text-slate-500 mt-0.5">Original logbook export</span>
                            </span>
                        </label>
                        <label class="flex items-start gap-3 rounded-xl border border-slate-200 p-3.5 cursor-pointer hover:border-indigo-300 has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50/60">
                            <input type="radio" name="exportFormat" value="sql" class="mt-0.5 accent-indigo-600">
                            <span>
                                <span class="block text-sm font-semibold text-slate-900">MySQL SQL</span>
                                <span class="block text-xs text-slate-500 mt-0.5">Table setup and INSERT statements</span>
                            </span>
                        </label>
                    </div>
                </fieldset>

                <fieldset>
                    <legend class="text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Send to</legend>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <label class="flex items-center gap-3 rounded-xl border border-slate-200 p-3.5 cursor-pointer hover:border-green-300 has-[:checked]:border-green-500 has-[:checked]:bg-green-50/60">
                            <input type="radio" name="exportDestination" value="whatsapp" checked class="accent-green-600">
                            <span class="w-9 h-9 rounded-lg bg-green-100 text-green-700 flex items-center justify-center"><i class="fa-brands fa-whatsapp"></i></span>
                            <span class="min-w-0">
                                <span class="block text-sm font-semibold text-slate-900">WhatsApp</span>
                                <span class="block text-xs text-slate-500 truncate">+234 905 275 7805</span>
                            </span>
                        </label>
                        <label class="flex items-center gap-3 rounded-xl border border-slate-200 p-3.5 cursor-pointer hover:border-sky-300 has-[:checked]:border-sky-500 has-[:checked]:bg-sky-50/60">
                            <input type="radio" name="exportDestination" value="email" class="accent-sky-600">
                            <span class="w-9 h-9 rounded-lg bg-sky-100 text-sky-700 flex items-center justify-center"><i class="fa-solid fa-envelope"></i></span>
                            <span class="min-w-0">
                                <span class="block text-sm font-semibold text-slate-900">Email</span>
                                <span class="block text-xs text-slate-500 truncate">ebenezer.akindele@lttcoastalmarine.com</span>
                            </span>
                        </label>
                    </div>
                </fieldset>

                <div class="rounded-xl border border-amber-200 bg-amber-50 p-3.5 flex items-start gap-3">
                    <i class="fa-solid fa-circle-info text-amber-600 mt-0.5"></i>
                    <p class="text-xs leading-relaxed text-amber-900">The selected file will download and the recipient will open in a new tab or app. Attach the downloaded file to your message before sending; browsers do not allow this page to attach files automatically.</p>
                </div>

                <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-2.5">
                    <button type="button" onclick="closeExportModal()" class="w-full sm:w-auto rounded-xl bg-slate-100 px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-200">Cancel</button>
                    <button type="button" onclick="prepareAndShareExport()" class="w-full sm:w-auto rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-md shadow-emerald-600/20 hover:bg-emerald-700">
                        <i class="fa-solid fa-download mr-1.5"></i> Download &amp; Open Recipient
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- PORT CAPTAIN OFFICE PORTAL MODAL -->
    <div id="officeModal" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm hidden flex items-center justify-center p-3 sm:p-4 overflow-y-auto">
        <div class="bg-white border border-slate-200 rounded-2xl max-w-6xl w-full shadow-2xl overflow-hidden my-auto max-h-[95vh] flex flex-col">
            <div class="p-4 sm:p-5 border-b border-slate-200 flex items-center justify-between gap-3 bg-gradient-to-r from-indigo-50 via-white to-sky-50">
                <div class="flex items-center space-x-3">
                    <div class="p-2.5 bg-indigo-600 text-white rounded-xl shadow-md shadow-indigo-600/20 flex-shrink-0">
                        <i class="fa-solid fa-building-user"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-900 text-sm sm:text-lg">Port Captain & IT Office Dashboard</h3>
                        <p class="text-xs text-slate-500">Upload trainee JSON exports to review fleet training records</p>
                    </div>
                </div>
                <button onclick="closeOfficePortal()" aria-label="Close office dashboard" class="w-9 h-9 rounded-xl bg-white text-slate-500 hover:text-slate-900 hover:bg-slate-100 border border-slate-200 flex items-center justify-center transition-colors flex-shrink-0">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
            </div>
            
            <div class="p-4 sm:p-6 overflow-y-auto flex-1 space-y-4">
                <!-- IT Officer File Upload Section -->
                <div class="bg-gradient-to-br from-indigo-50 to-white p-4 sm:p-5 rounded-2xl border border-indigo-100 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 shadow-sm">
                    <div class="flex items-center space-x-3">
                        <div class="w-11 h-11 rounded-xl bg-indigo-600 text-white flex items-center justify-center font-bold flex-shrink-0 shadow-md shadow-indigo-600/20">
                            <i class="fa-solid fa-file-arrow-up"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">IT Officer / Port Captain JSON Upload</h4>
                            <p class="text-xs leading-relaxed text-slate-500">Select trainee JSON export file(s) to update the fleet dashboard and its statistics.</p>
                        </div>
                    </div>
                    <div>
                        <input type="file" id="jsonUploadInput" accept=".json" multiple onchange="handleOfficeJSONImport(event)" class="hidden">
                        <button onclick="document.getElementById('jsonUploadInput').click()" class="bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white text-xs font-semibold py-3 px-5 rounded-xl transition-all flex items-center justify-center gap-2 w-full sm:w-auto shadow-lg shadow-indigo-600/20">
                            <i class="fa-solid fa-upload"></i>
                            <span>Upload Trainee JSON</span>
                        </button>
                    </div>
                </div>

                <section class="bg-white border border-slate-200 rounded-2xl p-4 sm:p-5 shadow-sm" aria-labelledby="officeFiltersHeading">
                    <div class="flex items-start gap-3 mb-4">
                        <div class="w-9 h-9 rounded-xl bg-sky-50 text-sky-700 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-filter"></i>
                        </div>
                        <div>
                            <h4 id="officeFiltersHeading" class="text-sm font-bold text-slate-900">Filter reporting period</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Choose an optional start and end date. Statistics and records update together.</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-[1fr_1fr_auto_auto] items-end gap-3">
                        <label class="block text-xs font-semibold text-slate-600">
                            From
                            <input id="officeDateFrom" class="office-filter-input mt-1" type="date" onchange="applyOfficeFilters()">
                        </label>
                        <label class="block text-xs font-semibold text-slate-600">
                            To
                            <input id="officeDateTo" class="office-filter-input mt-1" type="date" onchange="applyOfficeFilters()">
                        </label>
                        <button type="button" onclick="applyOfficeFilters()" class="min-h-11 rounded-xl bg-slate-900 px-4 text-xs font-semibold text-white transition hover:bg-slate-700">
                            <i class="fa-solid fa-magnifying-glass mr-1"></i> Apply
                        </button>
                        <button type="button" onclick="clearOfficeFilters()" class="min-h-11 rounded-xl border border-slate-200 bg-white px-4 text-xs font-semibold text-slate-600 transition hover:border-slate-300 hover:bg-slate-50">
                            Clear dates
                        </button>
                    </div>
                    <p id="officeFilterError" class="hidden mt-3 text-xs font-medium text-rose-700" role="alert"></p>
                </section>

                <section aria-labelledby="officeStatsHeading">
                    <div class="flex flex-wrap items-end justify-between gap-2 mb-3">
                        <div>
                            <h4 id="officeStatsHeading" class="text-sm font-bold text-slate-900">Fleet training overview</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Live breakdown for the records in the selected date range.</p>
                        </div>
                        <span id="officeStatsSummary" class="rounded-full bg-indigo-50 px-3 py-1 text-[11px] font-semibold text-indigo-700">0 of 0 records</span>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-3">
                        <article class="rounded-2xl border border-sky-100 bg-gradient-to-br from-sky-50 to-white p-4 shadow-sm">
                            <div class="flex items-center justify-between gap-2">
                                <h5 class="text-xs font-bold uppercase tracking-wider text-sky-900">Jobs performed</h5>
                                <span id="officeJobsTotal" class="text-2xl font-bold text-sky-700">0</span>
                            </div>
                            <div id="officeJobsBreakdown" class="mt-3 max-h-32 space-y-2 overflow-y-auto pr-1"></div>
                        </article>
                        <article class="rounded-2xl border border-violet-100 bg-gradient-to-br from-violet-50 to-white p-4 shadow-sm">
                            <div class="flex items-center justify-between gap-2">
                                <h5 class="text-xs font-bold uppercase tracking-wider text-violet-900">Vessel types</h5>
                                <span id="officeVesselTypesTotal" class="text-2xl font-bold text-violet-700">0</span>
                            </div>
                            <div id="officeVesselTypesBreakdown" class="mt-3 max-h-32 space-y-2 overflow-y-auto pr-1"></div>
                        </article>
                        <article class="rounded-2xl border border-amber-100 bg-gradient-to-br from-amber-50 to-white p-4 shadow-sm">
                            <div class="flex items-center justify-between gap-2">
                                <h5 class="text-xs font-bold uppercase tracking-wider text-amber-900">Trainers</h5>
                                <span id="officeTrainersTotal" class="text-2xl font-bold text-amber-700">0</span>
                            </div>
                            <div id="officeTrainersBreakdown" class="mt-3 max-h-32 space-y-2 overflow-y-auto pr-1"></div>
                        </article>
                        <article class="rounded-2xl border border-indigo-100 bg-gradient-to-br from-indigo-50 to-white p-4 shadow-sm">
                            <div class="flex items-center justify-between gap-2">
                                <h5 class="text-xs font-bold uppercase tracking-wider text-indigo-900">Trainees</h5>
                                <span id="officeTraineesTotal" class="text-2xl font-bold text-indigo-700">0</span>
                            </div>
                            <div id="officeTraineesBreakdown" class="mt-3 max-h-32 space-y-2 overflow-y-auto pr-1"></div>
                        </article>
                        <article class="rounded-2xl border border-emerald-100 bg-gradient-to-br from-emerald-50 to-white p-4 shadow-sm sm:col-span-2">
                            <div class="flex items-center justify-between gap-2">
                                <h5 class="text-xs font-bold uppercase tracking-wider text-emerald-900">Training statuses</h5>
                                <span id="officeStatusTotal" class="text-2xl font-bold text-emerald-700">0</span>
                            </div>
                            <div id="officeStatusBreakdown" class="mt-3 grid max-h-32 grid-cols-1 gap-2 overflow-y-auto pr-1 sm:grid-cols-2"></div>
                        </article>
                    </div>
                </section>

                <section class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm" aria-labelledby="officeRecordsHeading">
                    <div class="p-4 bg-slate-50/80 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                        <div>
                            <h4 id="officeRecordsHeading" class="text-sm font-bold text-slate-800">Loaded office records</h4>
                            <p id="officeTotalCount" class="text-xs text-slate-500 mt-0.5">0 records loaded</p>
                        </div>
                        <button onclick="clearOfficeRecords()" class="self-start sm:self-auto text-xs font-semibold text-rose-600 hover:text-rose-800 hover:underline">Clear office list</button>
                    </div>
                    <div id="officeLogsContainer" class="divide-y divide-slate-100 max-h-[50vh] overflow-y-auto">
                        <!-- Populated via uploaded JSON -->
                    </div>
                </section>
            </div>
        </div>
    </div>

    <div id="toastNotification" class="fixed bottom-5 right-5 z-50 transform translate-y-20 opacity-0 transition-all duration-300 bg-slate-900 text-white px-4 py-3 rounded-xl shadow-xl flex items-center space-x-3">
        <div class="w-6 h-6 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center flex-shrink-0">
            <i class="fa-solid fa-check text-xs"></i>
        </div>
        <span id="toastMessage" class="text-sm font-medium">Notification message</span>
    </div>

    <script>
        // State variables
        let candidateProfile = null;
        let logEntries = [];
        let officeAllLogs = [];

        // On Load initialization
        window.onload = function() {
            // Set today's date as default in modal
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('logDate').value = today;

            // Check localStorage for trainee profile & logs
            const savedProfile = localStorage.getItem('vessel_candidate_profile');
            const savedLogs = localStorage.getItem('vessel_log_entries');
            const savedOfficeLogs = localStorage.getItem('vessel_office_all_logs');

            if (savedProfile) {
                candidateProfile = JSON.parse(savedProfile);
                document.getElementById('signupView').classList.add('hidden');
                document.getElementById('dashboardView').classList.remove('hidden');
                document.getElementById('userProfileBadge').classList.remove('hidden');
                document.getElementById('userProfileBadge').classList.add('flex');
                
                // Set nav badge
                const initials = candidateProfile.name.split(' ').map(n => n[0]).join('').substring(0,2).toUpperCase();
                document.getElementById('userInitials').innerText = initials;
                document.getElementById('navCandidateName').innerText = candidateProfile.name;
                document.getElementById('navCandidateRank').innerText = candidateProfile.rank;
            }

            if (savedLogs) {
                logEntries = JSON.parse(savedLogs);
            }

            if (savedOfficeLogs) {
                officeAllLogs = JSON.parse(savedOfficeLogs);
            }

            renderLogEntries();
            updateDashboardStats();
        };

        // Open Port Captain Office Portal
        function openOfficePortal() {
            document.getElementById('officeModal').classList.remove('hidden');
            renderOfficeLogsList(officeAllLogs);
        }

        function closeOfficePortal() {
            document.getElementById('officeModal').classList.add('hidden');
        }

        function getOfficeDate(value) {
            if (typeof value !== 'string' || !value.trim()) return '';

            const isoDate = value.trim().match(/^(\d{4}-\d{2}-\d{2})(?:$|T|\s)/);
            if (isoDate) {
                const date = new Date(`${isoDate[1]}T00:00:00Z`);
                return !Number.isNaN(date.getTime()) && date.toISOString().slice(0, 10) === isoDate[1]
                    ? isoDate[1]
                    : '';
            }

            const parsedDate = new Date(value);
            return Number.isNaN(parsedDate.getTime()) ? '' : parsedDate.toISOString().slice(0, 10);
        }

        function applyOfficeFilters() {
            const from = document.getElementById('officeDateFrom').value;
            const to = document.getElementById('officeDateTo').value;
            const error = document.getElementById('officeFilterError');

            if (from && to && from > to) {
                error.innerText = 'The start date must be on or before the end date.';
                error.classList.remove('hidden');
                return;
            }

            error.innerText = '';
            error.classList.add('hidden');
            renderOfficeLogsList(officeAllLogs);
        }

        function clearOfficeFilters() {
            document.getElementById('officeDateFrom').value = '';
            document.getElementById('officeDateTo').value = '';
            document.getElementById('officeFilterError').innerText = '';
            document.getElementById('officeFilterError').classList.add('hidden');
            renderOfficeLogsList(officeAllLogs);
        }

        function countOfficeValues(entries, getValue) {
            const counts = new Map();
            entries.forEach(entry => {
                const value = getValue(entry);
                const label = typeof value === 'string' && value.trim() ? value.trim() : 'Not specified';
                counts.set(label, (counts.get(label) || 0) + 1);
            });
            return Array.from(counts.entries()).sort((left, right) =>
                right[1] - left[1] || left[0].localeCompare(right[0])
            );
        }

        function renderOfficeBreakdown(containerId, counts, emptyText) {
            const container = document.getElementById(containerId);
            if (counts.length === 0) {
                container.innerHTML = `<p class="text-xs text-slate-400">${emptyText}</p>`;
                return;
            }

            container.innerHTML = counts.map(([label, count]) => `
                <div class="flex items-center justify-between gap-3 text-xs">
                    <span class="truncate text-slate-600" title="${escapeOfficeHTML(label)}">${escapeOfficeHTML(label)}</span>
                    <span class="flex-shrink-0 rounded-full bg-white/80 px-2 py-0.5 font-bold text-slate-700 shadow-sm">${count}</span>
                </div>
            `).join('');
        }

        function updateOfficeStatistics(entries, totalEntries) {
            let totalJobs = 0;
            const jobCounts = new Map();
            entries.forEach(entry => {
                const jobs = Array.isArray(entry.jobs)
                    ? entry.jobs.filter(job => typeof job === 'string' && job.trim())
                    : [];
                if (jobs.length) {
                    totalJobs += jobs.length;
                    jobs.forEach(job => {
                        const label = job.trim();
                        jobCounts.set(label, (jobCounts.get(label) || 0) + 1);
                    });
                    return;
                }

                const reportedTotal = Number(entry.totalJobs);
                if (Number.isFinite(reportedTotal) && reportedTotal > 0) {
                    totalJobs += reportedTotal;
                    jobCounts.set('Job details unavailable', (jobCounts.get('Job details unavailable') || 0) + reportedTotal);
                }
            });

            const sortedJobCounts = Array.from(jobCounts.entries()).sort((left, right) =>
                right[1] - left[1] || left[0].localeCompare(right[0])
            );
            const vesselTypes = countOfficeValues(entries, entry => entry.vesselType);
            const trainers = countOfficeValues(entries, entry => entry.trainerName);
            const trainees = countOfficeValues(entries, entry => entry.candidateName || entry.traineeName);
            const statuses = countOfficeValues(entries, entry => entry.status);

            document.getElementById('officeJobsTotal').innerText = totalJobs;
            document.getElementById('officeVesselTypesTotal').innerText = vesselTypes.length;
            document.getElementById('officeTrainersTotal').innerText = trainers.length;
            document.getElementById('officeTraineesTotal').innerText = trainees.length;
            document.getElementById('officeStatusTotal').innerText = statuses.length;
            document.getElementById('officeStatsSummary').innerText = `${entries.length} of ${totalEntries} records`;

            renderOfficeBreakdown('officeJobsBreakdown', sortedJobCounts, 'No job details available.');
            renderOfficeBreakdown('officeVesselTypesBreakdown', vesselTypes, 'No vessel types available.');
            renderOfficeBreakdown('officeTrainersBreakdown', trainers, 'No trainer details available.');
            renderOfficeBreakdown('officeTraineesBreakdown', trainees, 'No trainee details available.');
            renderOfficeBreakdown('officeStatusBreakdown', statuses, 'No status details available.');
        }

        // Handle IT Officer uploading Trainee JSON files
        async function handleOfficeJSONImport(event) {
            const input = event.target;
            const files = Array.from(input.files || []);
            input.value = '';
            if (files.length === 0) return;

            const updatedLogs = [...officeAllLogs];
            const seenLogKeys = new Set(updatedLogs.map(getOfficeLogKey));
            const errors = [];
            let importedCount = 0;
            let duplicateCount = 0;
            let invalidRecordCount = 0;

            for (const file of files) {
                try {
                    const parsedData = JSON.parse(await file.text());
                    const logs = Array.isArray(parsedData) ? parsedData : parsedData?.logs;
                    if (!Array.isArray(logs)) {
                        throw new Error('Expected a JSON array or an object containing a logs array.');
                    }

                    const candidate = Array.isArray(parsedData) ? null : parsedData.candidate;
                    const candidateName = typeof candidate?.name === 'string'
                        ? candidate.name
                        : 'Unknown Trainee';
                    const candidateRank = typeof candidate?.rank === 'string'
                        ? candidate.rank
                        : 'Trainee';

                    logs.forEach(log => {
                        if (!log || typeof log !== 'object' || Array.isArray(log)) {
                            invalidRecordCount++;
                            return;
                        }

                        const record = {
                            ...log,
                            candidateName: log.candidateName || log.traineeName || candidateName,
                            candidateRank: log.candidateRank || candidateRank
                        };
                        const logKey = getOfficeLogKey(record);
                        if (seenLogKeys.has(logKey)) {
                            duplicateCount++;
                            return;
                        }

                        seenLogKeys.add(logKey);
                        updatedLogs.unshift(record);
                        importedCount++;
                    });
                } catch (error) {
                    console.error(`Unable to import ${file.name}:`, error);
                    errors.push(file.name);
                }
            }

            try {
                localStorage.setItem('vessel_office_all_logs', JSON.stringify(updatedLogs));
            } catch (error) {
                console.error('Unable to save office records in browser storage:', error);
                showToast('Could not save uploaded records. Check available browser storage.');
                return;
            }

            officeAllLogs = updatedLogs;
            renderOfficeLogsList(officeAllLogs);

            const result = `${importedCount} record(s) added from ${files.length - errors.length} file(s).`;
            const details = [
                duplicateCount ? `${duplicateCount} duplicate(s) skipped.` : '',
                invalidRecordCount ? `${invalidRecordCount} invalid record(s) skipped.` : '',
                errors.length ? `Could not read: ${errors.join(', ')}.` : ''
            ].filter(Boolean).join(' ');
            showToast([result, details].filter(Boolean).join(' '));
        }

        function getOfficeLogKey(log) {
            if (log.timestamp) {
                return JSON.stringify([log.candidateName, log.timestamp, log.vesselName]);
            }
            const { candidateName, candidateRank, ...recordData } = log;
            return JSON.stringify(recordData);
        }

        function escapeOfficeHTML(value) {
            return String(value ?? '').replace(/[&<>"']/g, character => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;'
            })[character]);
        }

        function clearOfficeRecords() {
            if (confirm('Clear all uploaded logs from office dashboard?')) {
                officeAllLogs = [];
                localStorage.removeItem('vessel_office_all_logs');
                renderOfficeLogsList(officeAllLogs);
                showToast('Office dashboard records cleared.');
            }
        }

        function renderOfficeLogsList(entries) {
            const container = document.getElementById('officeLogsContainer');
            const from = document.getElementById('officeDateFrom').value;
            const to = document.getElementById('officeDateTo').value;
            const filteredEntries = entries.filter(entry => {
                if (!from && !to) return true;
                const date = getOfficeDate(entry.date);
                if (!date) return false;
                return (!from || date >= from) && (!to || date <= to);
            });

            updateOfficeStatistics(filteredEntries, entries.length);
            document.getElementById('officeTotalCount').innerText = filteredEntries.length === entries.length
                ? `${entries.length} record(s)`
                : `${filteredEntries.length} of ${entries.length} record(s) in range`;

            if (filteredEntries.length === 0) {
                const hasDateFilter = Boolean(from || to);
                container.innerHTML = `
                    <div class="p-8 sm:p-12 text-center text-slate-400">
                        <i class="fa-solid ${hasDateFilter ? 'fa-calendar-xmark' : 'fa-file-circle-plus'} text-3xl mb-3 opacity-40"></i>
                        <p class="text-sm font-medium text-slate-600">${hasDateFilter ? 'No records match this date range.' : 'No trainee logs uploaded yet.'}</p>
                        <p class="text-xs text-slate-400 mt-1">${hasDateFilter ? 'Adjust or clear the date filters to see more records.' : 'Upload trainee JSON exports above to populate this dashboard.'}</p>
                    </div>
                `;
                return;
            }

            let html = '';
            filteredEntries.forEach(entry => {
                const statusColor = entry.status === 'Docking' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-amber-50 text-amber-700 border-amber-200';
                const activeJobs = Array.isArray(entry.jobs)
                    ? entry.jobs.filter(job => typeof job === 'string' && job.trim() !== '')
                    : [];
                
                html += `
                    <div class="p-4 hover:bg-slate-50 transition-colors flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                        <div class="space-y-1">
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200">${escapeOfficeHTML(entry.candidateName || 'Trainee')}</span>
                                <span class="px-2 py-0.5 rounded text-[10px] font-semibold border ${statusColor}">${escapeOfficeHTML(entry.status || 'Unknown')}</span>
                                <span class="text-xs font-semibold text-slate-900">${escapeOfficeHTML(entry.vesselName || 'Unknown vessel')}</span>
                            </div>
                            <p class="text-xs text-slate-500">Date: ${escapeOfficeHTML(entry.date || 'N/A')} | Vessel Type: ${escapeOfficeHTML(entry.vesselType || 'N/A')} | Trainer: ${escapeOfficeHTML(entry.trainerName || 'N/A')}</p>
                            <p class="text-[11px] text-slate-600">Jobs Performed (${activeJobs.length}): ${activeJobs.map(escapeOfficeHTML).join(', ')}</p>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <span class="text-[10px] text-slate-400 block">Period: ${escapeOfficeHTML(entry.period || 'N/A')}</span>
                            <span class="text-[10px] font-medium text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200 inline-block mt-1">Verified Record</span>
                        </div>
                    </div>
                `;
            });
            container.innerHTML = html;
        }

        // Handle Sign Up
        function handleSignUp(e) {
            e.preventDefault();
            candidateProfile = {
                name: document.getElementById('regName').value.trim(),
                rank: document.getElementById('regRank').value.trim(),
                idNo: document.getElementById('regIdNo').value.trim(),
                contact: document.getElementById('regContact').value.trim(),
                experience: document.getElementById('regExperience').value.trim()
            };

            localStorage.setItem('vessel_candidate_profile', JSON.stringify(candidateProfile));

            document.getElementById('signupView').classList.add('hidden');
            document.getElementById('dashboardView').classList.remove('hidden');
            document.getElementById('userProfileBadge').classList.remove('hidden');
            document.getElementById('userProfileBadge').classList.add('flex');

            const initials = candidateProfile.name.split(' ').map(n => n[0]).join('').substring(0,2).toUpperCase();
            document.getElementById('userInitials').innerText = initials;
            document.getElementById('navCandidateName').innerText = candidateProfile.name;
            document.getElementById('navCandidateRank').innerText = candidateProfile.rank;

            showToast('Candidate profile created successfully!');
        }

        // Logout / Switch Candidate
        function logoutCandidate() {
            if (confirm('Switching profile will clear current local session view. Proceed?')) {
                localStorage.removeItem('vessel_candidate_profile');
                location.reload();
            }
        }

        // Modal Controls
        function openEntryModal(editId = -1) {
            document.getElementById('entryModal').classList.remove('hidden');
            if (editId === -1) {
                document.getElementById('modalTitle').innerText = "New Training Log Entry";
                document.getElementById('logForm').reset();
                document.getElementById('editIndex').value = -1;
                document.getElementById('logDate').value = new Date().toISOString().split('T')[0];
                document.getElementById('dynamicTotalJobs').innerText = "0";
            } else {
                document.getElementById('modalTitle').innerText = "Edit Training Log Entry";
                const entry = logEntries[editId];
                document.getElementById('editIndex').value = editId;
                document.getElementById('logDate').value = entry.date;
                document.getElementById('logStatus').value = entry.status;
                document.getElementById('logVesselType').value = entry.vesselType;
                document.getElementById('logVesselName').value = entry.vesselName;
                document.getElementById('logTrainerName').value = entry.trainerName;
                document.getElementById('logPeriod').value = entry.period;
                document.getElementById('logRemarks').value = entry.remarks;

                // Checkboxes
                const checkboxes = document.querySelectorAll('input[name="makingFast"]');
                checkboxes.forEach(cb => {
                    cb.checked = entry.makingFast && entry.makingFast.includes(cb.value);
                });

                // Jobs
                for (let i = 1; i <= 7; i++) {
                    document.getElementById(`job${i}`).value = entry.jobs && entry.jobs[i-1] ? entry.jobs[i-1] : '';
                }
                updateJobCount();
            }
        }

        function closeEntryModal() {
            document.getElementById('entryModal').classList.add('hidden');
        }

        // Update Job Count live as user types
        function updateJobCount() {
            let count = 0;
            for (let i = 1; i <= 7; i++) {
                const val = document.getElementById(`job${i}`).value.trim();
                if (val.length > 0) count++;
            }
            document.getElementById('dynamicTotalJobs').innerText = count;
        }

        // Save Log Entry
        function saveLogEntry(e) {
            e.preventDefault();
            const editIndex = parseInt(document.getElementById('editIndex').value);

            // Gather checkboxes
            const makingFast = [];
            document.querySelectorAll('input[name="makingFast"]:checked').forEach(cb => {
                makingFast.push(cb.value);
            });

            // Gather jobs
            const jobs = [];
            let totalJobsCount = 0;
            for (let i = 1; i <= 7; i++) {
                const jobVal = document.getElementById(`job${i}`).value.trim();
                jobs.push(jobVal);
                if (jobVal) totalJobsCount++;
            }

            const entryData = {
                date: document.getElementById('logDate').value,
                status: document.getElementById('logStatus').value,
                vesselType: document.getElementById('logVesselType').value,
                vesselName: document.getElementById('logVesselName').value.trim(),
                traineeName: candidateProfile ? candidateProfile.name : 'Trainee',
                trainerName: document.getElementById('logTrainerName').value.trim(),
                traineeDetails: candidateProfile ? `${candidateProfile.rank} | ID: ${candidateProfile.idNo}` : '',
                makingFast: makingFast,
                jobs: jobs,
                totalJobs: totalJobsCount,
                period: document.getElementById('logPeriod').value,
                remarks: document.getElementById('logRemarks').value.trim(),
                timestamp: new Date().toISOString()
            };

            if (editIndex === -1) {
                logEntries.unshift(entryData);
                showToast('Log entry added successfully!');
            } else {
                logEntries[editIndex] = entryData;
                showToast('Log entry updated successfully!');
            }

            localStorage.setItem('vessel_log_entries', JSON.stringify(logEntries));
            closeEntryModal();
            renderLogEntries();
            updateDashboardStats();
        }

        // Delete Log Entry
        function deleteLogEntry(index) {
            if (confirm('Are you sure you want to delete this log entry?')) {
                logEntries.splice(index, 1);
                localStorage.setItem('vessel_log_entries', JSON.stringify(logEntries));
                renderLogEntries();
                updateDashboardStats();
                showToast('Log entry deleted.');
            }
        }

        // Render Entries List
        function renderLogEntries() {
            const container = document.getElementById('logEntriesContainer');
            const searchVal = document.getElementById('searchInput') ? document.getElementById('searchInput').value.toLowerCase() : '';
            
            const filtered = logEntries.filter(e => {
                return e.vesselName.toLowerCase().includes(searchVal) ||
                       e.trainerName.toLowerCase().includes(searchVal) ||
                       e.vesselType.toLowerCase().includes(searchVal) ||
                       e.status.toLowerCase().includes(searchVal);
            });

            if (filtered.length === 0) {
                container.innerHTML = `
                    <div class="p-12 text-center text-slate-400">
                        <i class="fa-solid fa-folder-open text-3xl mb-3 opacity-40"></i>
                        <p class="text-sm font-medium text-slate-600">No training log records found.</p>
                        <p class="text-xs text-slate-400 mt-1">Click "New Training Log Entry" to record your first session.</p>
                    </div>
                `;
                return;
            }

            let html = '';
            filtered.forEach((entry, idx) => {
                const originalIndex = logEntries.indexOf(entry);
                const statusColor = entry.status === 'Docking' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-amber-50 text-amber-700 border-amber-200';
                const periodIcon = entry.period === 'Day' ? 'fa-sun text-amber-500' : 'fa-moon text-indigo-500';

                // Format jobs list
                const activeJobs = entry.jobs ? entry.jobs.filter(j => j && j.trim() !== '') : [];
                let jobsHtml = activeJobs.map((j, i) => `<span class="inline-block bg-slate-50 text-slate-700 text-[11px] px-2 py-0.5 rounded border border-slate-200 mr-1 mb-1">Job ${i+1}: ${j}</span>`).join('');
                if (!jobsHtml) jobsHtml = '<span class="text-xs text-slate-400 italic">No specific jobs noted</span>';

                // Format making fast
                let fastHtml = entry.makingFast && entry.makingFast.length > 0 ? entry.makingFast.map(f => `<span class="inline-flex items-center gap-1 text-[11px] bg-ocean-50 text-ocean-700 px-2.5 py-0.5 rounded-full border border-ocean-200 mr-1 mb-1 font-medium"><i class="fa-solid fa-anchor text-[9px]"></i> ${f}</span>`).join('') : '<span class="text-xs text-slate-400 italic">None specified</span>';

                html += `
                    <div class="p-4 sm:p-5 hover:bg-slate-50/60 transition-colors flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                        <div class="space-y-2.5 flex-1 min-w-0">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold border ${statusColor}">${entry.status}</span>
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">${entry.vesselType}</span>
                                <span class="text-xs text-slate-500 flex items-center gap-1"><i class="fa-solid fa-calendar text-[10px]"></i> ${entry.date}</span>
                                <span class="text-xs text-slate-500 flex items-center gap-1"><i class="fa-solid ${periodIcon}"></i> ${entry.period}</span>
                            </div>
                            
                            <div>
                                <h4 class="text-base font-bold text-slate-900 flex flex-wrap items-center gap-x-2 gap-y-1">
                                    <span class="truncate">${entry.vesselName}</span>
                                    <span class="text-xs font-normal text-slate-500">Trainer: <strong class="text-slate-700">${entry.trainerName}</strong></span>
                                </h4>
                            </div>

                            <div class="space-y-1 pt-0.5">
                                <div class="text-xs"><strong class="text-slate-500">Positions Fast:</strong> ${fastHtml}</div>
                                <div class="text-xs"><strong class="text-slate-500">Jobs Performed (${entry.totalJobs || activeJobs.length}):</strong> ${jobsHtml}</div>
                                ${entry.remarks ? `<p class="text-xs text-slate-600 italic bg-slate-50 p-2.5 rounded-xl border border-slate-200 mt-1.5"><strong class="not-italic text-slate-800 font-medium">Remarks:</strong> ${entry.remarks}</p>` : ''}
                            </div>
                        </div>

                        <div class="flex items-center space-x-2 self-end lg:self-center flex-shrink-0 pt-2 lg:pt-0 border-t lg:border-t-0 border-slate-100 w-full lg:w-auto justify-end">
                            <button onclick="openEntryModal(${originalIndex})" title="Edit Entry" class="px-3 py-2 rounded-xl bg-slate-100 text-slate-700 hover:bg-ocean-600 hover:text-white transition-colors text-xs font-medium flex items-center gap-1.5">
                                <i class="fa-solid fa-pen text-[10px]"></i> Edit
                            </button>
                            <button onclick="deleteLogEntry(${originalIndex})" title="Delete Entry" class="px-3 py-2 rounded-xl bg-slate-100 text-slate-700 hover:bg-rose-600 hover:text-white transition-colors text-xs font-medium flex items-center gap-1.5">
                                <i class="fa-solid fa-trash text-[10px]"></i> Delete
                            </button>
                        </div>
                    </div>
                `;
            });

            container.innerHTML = html;
        }

        // Update Stats Bar
        function updateDashboardStats() {
            document.getElementById('statTotalEntries').innerText = logEntries.length;
            
            let totalJobsSum = 0;
            let dockingCount = 0;
            let dayCount = 0;
            let nightCount = 0;

            logEntries.forEach(e => {
                totalJobsSum += (e.totalJobs || 0);
                if (e.status === 'Docking') dockingCount++;
                if (e.period === 'Day') dayCount++;
                if (e.period === 'Night') nightCount++;
            });

            document.getElementById('statTotalJobs').innerText = totalJobsSum;
            document.getElementById('statDocking').innerText = dockingCount;
            document.getElementById('statDayCount').innerText = dayCount;
            document.getElementById('statNightCount').innerText = nightCount;
        }

        function openExportModal() {
            document.getElementById('exportModal').classList.remove('hidden');
            document.getElementById('exportModal').classList.add('flex');
        }

        function closeExportModal() {
            document.getElementById('exportModal').classList.add('hidden');
            document.getElementById('exportModal').classList.remove('flex');
        }

        function getLogbookExportData() {
            return {
                candidate: candidateProfile,
                logs: logEntries,
                exportedAt: new Date().toISOString()
            };
        }

        function getExportFileName(extension) {
            const candidateName = candidateProfile && typeof candidateProfile.name === 'string'
                ? candidateProfile.name
                : 'Trainee';
            const safeName = candidateName.normalize('NFKD')
                .replace(/[^a-zA-Z0-9_-]+/g, '_')
                .replace(/^_+|_+$/g, '') || 'Trainee';
            return `Vessel_Logbook_${safeName}.${extension}`;
        }

        function downloadExportFile(content, fileName, mimeType) {
            const file = new Blob([content], { type: mimeType });
            const fileUrl = URL.createObjectURL(file);
            const downloadAnchor = document.createElement('a');
            downloadAnchor.href = fileUrl;
            downloadAnchor.download = fileName;
            document.body.appendChild(downloadAnchor);
            downloadAnchor.click();
            downloadAnchor.remove();
            setTimeout(() => URL.revokeObjectURL(fileUrl), 1000);
        }

        function sqlTextLiteral(value) {
            if (value === null || value === undefined) return 'NULL';
            const text = typeof value === 'string' ? value : JSON.stringify(value);
            const hex = Array.from(new TextEncoder().encode(text), byte => byte.toString(16).padStart(2, '0')).join('');
            return `CONVERT(X'${hex}' USING utf8mb4)`;
        }

        function sqlNumberLiteral(value) {
            if (value === null || value === undefined || value === '') return 'NULL';
            const number = Number(value);
            return Number.isSafeInteger(number) && number >= 0 && number <= 4294967295
                ? String(number)
                : 'NULL';
        }

        function createLogbookSQL(exportData) {
            const columns = [
                'candidate_name', 'candidate_rank', 'candidate_id_no', 'candidate_contact',
                'candidate_experience', 'log_date', 'status', 'vessel_type', 'vessel_name',
                'trainee_name', 'trainee_details', 'trainer_name', 'making_fast', 'jobs',
                'total_jobs', 'period', 'remarks', 'log_timestamp', 'exported_at'
            ];
            const statements = [
                '-- MySQL export for the Maritime Trainee Digital Logbook.',
                '-- Create this table once, then run the INSERT statements to import these records.',
                'CREATE TABLE IF NOT EXISTS `vessel_trainee_log_entries` (',
                '    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,',
                '    `candidate_name` VARCHAR(255) NULL,',
                '    `candidate_rank` VARCHAR(255) NULL,',
                '    `candidate_id_no` VARCHAR(100) NULL,',
                '    `candidate_contact` VARCHAR(255) NULL,',
                '    `candidate_experience` TEXT NULL,',
                '    `log_date` VARCHAR(32) NULL,',
                '    `status` VARCHAR(100) NULL,',
                '    `vessel_type` VARCHAR(150) NULL,',
                '    `vessel_name` VARCHAR(255) NULL,',
                '    `trainee_name` VARCHAR(255) NULL,',
                '    `trainee_details` TEXT NULL,',
                '    `trainer_name` VARCHAR(255) NULL,',
                '    `making_fast` LONGTEXT NULL,',
                '    `jobs` LONGTEXT NULL,',
                '    `total_jobs` INT UNSIGNED NULL,',
                '    `period` VARCHAR(50) NULL,',
                '    `remarks` LONGTEXT NULL,',
                '    `log_timestamp` VARCHAR(64) NULL,',
                '    `exported_at` VARCHAR(64) NULL,',
                '    PRIMARY KEY (`id`)',
                ') ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;',
                ''
            ];
            const candidate = exportData.candidate || {};

            exportData.logs.forEach(log => {
                const jobs = Array.isArray(log.jobs) ? log.jobs : [];
                const makingFast = Array.isArray(log.makingFast) ? log.makingFast : [];
                const values = [
                    candidate.name,
                    candidate.rank,
                    candidate.idNo,
                    candidate.contact,
                    candidate.experience,
                    log.date,
                    log.status,
                    log.vesselType,
                    log.vesselName,
                    log.traineeName || candidate.name,
                    log.traineeDetails,
                    log.trainerName,
                    JSON.stringify(makingFast),
                    JSON.stringify(jobs),
                    sqlNumberLiteral(log.totalJobs ?? jobs.filter(job => typeof job === 'string' && job.trim()).length),
                    log.period,
                    log.remarks,
                    log.timestamp,
                    exportData.exportedAt
                ];
                statements.push(
                    `INSERT INTO \`vessel_trainee_log_entries\` (${columns.map(column => `\`${column}\``).join(', ')})\n` +
                    `VALUES (${values.map((value, index) => index === 14 ? value : sqlTextLiteral(value)).join(', ')});`
                );
            });

            if (exportData.logs.length === 0) {
                statements.push('-- No training log entries were present in this export.');
            }
            return statements.join('\n');
        }

        function prepareAndShareExport() {
            const format = document.querySelector('input[name="exportFormat"]:checked')?.value;
            const destination = document.querySelector('input[name="exportDestination"]:checked')?.value;
            if (!['json', 'sql'].includes(format) || !['whatsapp', 'email'].includes(destination)) {
                showToast('Choose a valid file format and destination.');
                return;
            }

            const exportData = getLogbookExportData();
            const isSql = format === 'sql';
            const fileName = getExportFileName(isSql ? 'sql' : 'json');
            const fileContent = isSql
                ? createLogbookSQL(exportData)
                : JSON.stringify(exportData, null, 2);
            const message = `Hello, I am sharing my maritime trainee logbook export (${isSql ? 'MySQL SQL' : 'JSON'}). Please find the downloaded ${fileName} file attached.`;
            const shareUrl = destination === 'whatsapp'
                ? `https://wa.me/2349052757805?text=${encodeURIComponent(message)}`
                : `mailto:ebenezer.akindele@lttcoastalmarine.com?subject=${encodeURIComponent(`Maritime Logbook ${isSql ? 'SQL' : 'JSON'} Export`)}&body=${encodeURIComponent(message)}`;
            const shareAnchor = document.createElement('a');
            shareAnchor.href = shareUrl;
            shareAnchor.target = '_blank';
            shareAnchor.rel = 'noopener noreferrer';
            document.body.appendChild(shareAnchor);
            shareAnchor.click();
            shareAnchor.remove();

            downloadExportFile(
                fileContent,
                fileName,
                isSql ? 'application/sql;charset=utf-8' : 'application/json;charset=utf-8'
            );
            closeExportModal();
            showToast('Export downloaded. Attach the file in the opened WhatsApp or email before sending.');
        }

        // Toast Helper
        function showToast(message) {
            const toast = document.getElementById('toastNotification');
            document.getElementById('toastMessage').innerText = message;
            toast.classList.remove('translate-y-20', 'opacity-0');
            setTimeout(() => {
                toast.classList.add('translate-y-20', 'opacity-0');
            }, 3500);
        }
    </script>
</body>
</html>