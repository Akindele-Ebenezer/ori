<script>
    const states = ['radar', 'compass', 'sonar', 'wave'];
    let currentIndex = 0;
    let intervalId = null;

    function show(id) {
        document.querySelectorAll('svg').forEach(s => s.classList.remove('active'));
        document.getElementById(id).classList.add('active');
        
        document.querySelectorAll('.controls button').forEach(b => b.classList.remove('active'));
        const btn = document.getElementById('btn-' + id);
        if (btn) btn.classList.add('active');
        
        currentIndex = states.indexOf(id);
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
        
        show(states[currentIndex]);

        intervalId = setInterval(() => {
            currentIndex = (currentIndex + 1) % states.length;
            show(states[currentIndex]);
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

    window.onload = startAuto;
</script>