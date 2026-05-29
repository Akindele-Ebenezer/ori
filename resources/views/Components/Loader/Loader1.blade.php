<div class="loader-x">
    <div class="inner">
        <div class="controls">
            <button onclick="manualShow('radar')" id="btn-radar">Radar</button>
            <button onclick="manualShow('compass')" id="btn-compass">Compass</button>
            <button onclick="manualShow('sonar')" id="btn-sonar">Sonar</button>
            <button onclick="manualShow('wave')" id="btn-wave">Wave</button>
            <div style="width: 1px; height: 25px; background: rgba(255,255,255,0.2); margin: 0 10px;"></div>
            <button onclick="toggleAuto()" id="btn-auto">Auto Alternate</button>
        </div>

        <div class="stage">
            <!-- RADAR SWEEP -->
            <svg id="radar" viewBox="0 0 400 150" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#00e5e5;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#0077be;stop-opacity:1" />
                    </linearGradient>
                </defs>
                <circle class="radar-pulse" cx="60" cy="60" r="45" fill="none" stroke="url(#grad1)" stroke-width="8" />
                <g class="sweep-arm">
                    <path d="M 60 60 L 60 15 A 45 45 0 0 1 105 60 Z" fill="url(#grad1)" opacity="0.3" />
                    <line x1="60" y1="60" x2="60" y2="15" stroke="var(--marine-glow)" stroke-width="2" />
                </g>
                <text x="120" y="85" class="logo-text">ORI</text>
                <text x="123" y="110" class="subtitle-text">MARINE PLATFORM</text>
            </svg>

            <!-- NAUTICAL COMPASS -->
            <svg id="compass" viewBox="0 0 400 150" xmlns="http://www.w3.org/2000/svg">
                <circle cx="60" cy="60" r="45" fill="none" stroke="white" stroke-width="2" opacity="0.2" />
                <g class="compass-spin">
                    <path d="M 60 20 L 70 60 L 60 100 L 50 60 Z" fill="var(--marine-glow)" />
                    <path d="M 20 60 L 60 50 L 100 60 L 60 70 Z" fill="white" opacity="0.5" />
                </g>
                <text x="120" y="85" class="logo-text">ORI</text>
                <text x="123" y="110" class="subtitle-text">MARINE PLATFORM</text>
            </svg>

            <!-- SONAR PULSE -->
            <svg id="sonar" viewBox="0 0 400 150" xmlns="http://www.w3.org/2000/svg">
                <circle class="sonar-ring" cx="60" cy="60" r="45" fill="none" stroke="var(--marine-glow)" />
                <circle class="sonar-ring delay-1" cx="60" cy="60" r="45" fill="none" stroke="var(--marine-glow)" />
                <circle class="sonar-ring delay-2" cx="60" cy="60" r="45" fill="none" stroke="var(--marine-glow)" />
                <circle cx="60" cy="60" r="10" fill="var(--marine-glow)" />
                <text x="120" y="85" class="logo-text">ORI</text>
                <text x="123" y="110" class="subtitle-text">MARINE PLATFORM</text>
            </svg>

            <!-- HORIZON WAVE -->
            <svg id="wave" viewBox="0 0 400 150" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <clipPath id="waveClip">
                        <circle cx="60" cy="60" r="45" />
                    </clipPath>
                </defs>
                <circle cx="60" cy="60" r="45" fill="none" stroke="white" stroke-width="2" opacity="0.2" />
                <g clip-path="url(#waveClip)">
                    <path class="wave-clip" d="M0 60 Q 25 50 50 60 T 100 60 T 150 60 T 200 60 V 120 H 0 Z" fill="var(--marine-glow)" opacity="0.6">
                        <animateTransform attributeName="transform" type="translate" from="0,0" to="-100,0" dur="2s" repeatCount="indefinite" />
                    </path>
                </g>
                <text x="120" y="85" class="logo-text">ORI</text>
                <text x="123" y="110" class="subtitle-text">MARINE PLATFORM</text>
            </svg>

            <div class="progress-block">
                <div class="progress-left">
                    <span id="progressText">0%</span>
                </div>

                <div class="progress-divider"></div>

                <div class="progress-right">
                    <div class="progress-title">MARINE SERVICE</div>
                    <div class="progress-subtitle">software solutions</div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('Components.Loader.Loader1-JS')