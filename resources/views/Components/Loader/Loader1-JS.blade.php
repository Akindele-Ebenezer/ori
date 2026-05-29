<script> 
const states = ['radar', 'compass', 'sonar', 'wave'];
let currentIndex_ = 0;
let intervalId = null;

function show(id) {
    // Update SVGs
    document.querySelectorAll('svg').forEach(s => s.classList.remove('active'));
    document.getElementById(id).classList.add('active');
    
    // Update Buttons
    document.querySelectorAll('.controls button').forEach(b => b.classList.remove('active'));
    const btn = document.getElementById('btn-' + id);
    if (btn) btn.classList.add('active');
    
    currentIndex_ = states.indexOf(id);
 
}

function manualShow(id) {
    stopAuto();
    show(id);
}

function toggleAuto() {
    if (intervalId) {
        stopAuto();
    } else {
        startAuto();
    }
}

function startAuto() {
    const btn = document.getElementById('btn-auto');
    btn.classList.add('cycling');
    btn.innerText = 'Stop Cycling';

    // Start progress ONLY once
    startGlobalProgress();

    show(states[currentIndex_]);

    intervalId = setInterval(() => {
        currentIndex_ = (currentIndex_ + 1) % states.length;
        show(states[currentIndex_]);
    }, 3000);
}

function stopAuto() {
    if (intervalId) {
        clearInterval(intervalId);
        intervalId = null;
        const btn = document.getElementById('btn-auto');
        btn.classList.remove('cycling');
        btn.innerText = 'Auto Alternate';
    }
}

// Start autoplay on load
window.onload = startAuto;

let progressInterval = null;
let progressValue = 0;

const totalDuration = states.length * 3000;
const stepTime = totalDuration / 100;

function startGlobalProgress() {
    const progressText = document.getElementById('progressText');

    if (progressValue >= 100) return;

    progressInterval = setInterval(() => {
        progressValue++;

        if (progressValue >= 100) {
            progressValue = 100;
            progressText.innerText = "100%";
            clearInterval(progressInterval);
            return;
        }

        progressText.innerText = progressValue + "%";

    }, stepTime);
}
let loader_x = document.querySelector('.loader-x'); 
    setTimeout(() => {
        loader_x.style.display = 'none';
    }, 15000);
</script>