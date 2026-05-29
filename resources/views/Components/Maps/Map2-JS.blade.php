<script>
document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('mapContainer');
    let activeVessel = null;
    let offsetX = 0;
    let offsetY = 0;

    document.querySelectorAll('.vessel_map')
        .forEach(v => v.addEventListener('dragstart', e => e.preventDefault()));

    container.addEventListener('pointerdown', e => {

        const vessel = e.target.closest('.vessel_map');
        if (!vessel) return;

        activeVessel = vessel;

        const rect = activeVessel.getBoundingClientRect();
        const containerRect = container.getBoundingClientRect();

        offsetX = e.clientX - rect.left;
        offsetY = e.clientY - rect.top;

        activeVessel.setPointerCapture(e.pointerId);
        activeVessel.style.cursor = 'grabbing';
        activeVessel.style.zIndex = 1000;
    });

    document.addEventListener('pointermove', e => {
        if (!activeVessel) return;
        const containerRect = container.getBoundingClientRect();
        let left = e.clientX - containerRect.left - offsetX;
        let top = e.clientY - containerRect.top - offsetY;
        left = Math.max(0, Math.min(left, containerRect.width - activeVessel.offsetWidth));
        top  = Math.max(0, Math.min(top,  containerRect.height - activeVessel.offsetHeight));
        activeVessel.style.left = left + 'px';
        activeVessel.style.top  = top + 'px';
    });

    document.addEventListener('pointerup', e => {
        if (!activeVessel) return;

        activeVessel.style.cursor = 'grab';
        activeVessel.style.zIndex = '';
        activeVessel.releasePointerCapture(e.pointerId);

        activeVessel = null;
    });

    container.addEventListener('wheel', function(e) {
        if (!e.shiftKey) return;
        const vessel = e.target.closest('.vessel_map');
        if (!vessel) return;
        e.preventDefault();

        let currentRotation = parseFloat(vessel.dataset.rotation) || 0;
        currentRotation += (e.deltaY > 0 ? 5 : -5);

        vessel.dataset.rotation = currentRotation;
        vessel.style.transform = `rotate(${currentRotation}deg)`;
    }, { passive: false });

    const SaveButton = document.querySelector('.save-positions-btn');
    SaveButton.addEventListener('click', function () {
        SaveButton.textContent = 'Saving Positions...';
        SaveButton.style.backgroundColor = '#4CAF50';
        let vessels = document.querySelectorAll('.vessel_map');
        let params = [];
        vessels.forEach(v => {
            let x = Math.round(parseFloat(v.style.left)) || 0;
            let y = Math.round(parseFloat(v.style.top)) || 0;
            let rotation = parseFloat(v.dataset.rotation) || 0;

            params.push(`vessels[${v.dataset.id}][x]=${x}`);
            params.push(`vessels[${v.dataset.id}][y]=${y}`);
            params.push(`vessels[${v.dataset.id}][rotation]=${rotation}`);
        });

        let url = "/save-vessel-position?" + params.join("&");
        document.location.href = url;
    });
    
    let closeMapBtn = document.querySelector('.close-map-btn');
    let map2 = document.querySelector('.map2');
    let displayMapBtn = document.querySelector('.DisplayMapButton');
    displayMapBtn.addEventListener('click', () => {
        map2.style.display = 'flex';
    });
    closeMapBtn.addEventListener('click', () => {
        map2.style.display = 'none';
    });
});
</script>
