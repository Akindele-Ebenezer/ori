<script>
    (() => {
        const chart = document.querySelector('.chart-4 .pieID.pie');
        const legend = document.querySelector('.chart-4 .pieID.legend');

        if (!chart || !legend) {
            return;
        }

        const colors = ['#03AED2', '#8a3ffc', '#ff832b', '#ccc', '#da1e28', '#52f781'];
        const items = Array.from(legend.querySelectorAll(':scope > li'));

        function renderPie() {
            const values = items.map((item) => {
                const text = item.querySelector('span small')?.textContent ?? '';
                const percentage = text.match(/\(([\d.]+)%\)/);
                return percentage ? Number(percentage[1]) : 0;
            });
            const total = values.reduce((sum, value) => sum + (Number.isFinite(value) ? value : 0), 0);

            items.forEach((item, index) => {
                item.style.borderColor = colors[index % colors.length];
            });

            if (total <= 0) {
                chart.style.background = '';
                return;
            }

            let currentPercentage = 0;
            const stops = values.map((value, index) => {
                const start = currentPercentage;
                currentPercentage += (value / total) * 100;
                return `${colors[index % colors.length]} ${start}% ${currentPercentage}%`;
            });

            chart.style.background = `conic-gradient(${stops.join(', ')})`;
        }

        document.addEventListener('click', (event) => {
            if (event.target instanceof Element && event.target.closest('.availability .notification-wrapper')) {
                window.requestAnimationFrame(renderPie);
            }
        });

        renderPie();
    })();
</script>
