(() => {
    const dashboard = document.querySelector(
        '[data-daily-report-dashboard]'
    );

    if (!dashboard) return;

    const searchInputs = dashboard.querySelectorAll(
        '[data-report-search]'
    );

    searchInputs.forEach((search) => {
        // Find the section containing this search input.
        const panel = search.closest(
            '.deck-panel, .deck-log-panel'
        );

        if (!panel) return;

        // Only select rows within this particular panel.
        const rows = Array.from(
            panel.querySelectorAll('[data-report-row]')
        );

        if (!rows.length) return;

        const visibleCount = panel.querySelector(
            '[data-report-visible-count]'
        );

        const filterRows = () => {
            const query = search.value.trim().toLowerCase();
            let count = 0;

            rows.forEach((row) => {
                const searchText = (
                    row.dataset.searchValue ||
                    row.textContent ||
                    ''
                ).toLowerCase();

                const matches = searchText.includes(query);

                row.style.display = matches ? '' : 'none';

                if (matches) count++;
            });

            if (visibleCount) {
                visibleCount.textContent = count;
            }
        };

        search.addEventListener('input', filterRows);

        // Initialize the count for this section.
        filterRows();
    });
})();
let DisplayDailyReportButton = document.querySelector('.DisplayDailyReportButton');
let closeDailyReportBtn = document.querySelector('.deck-close');
let DailyReportDashboard = document.querySelector('.DailyVesselOperations');
const openDailyReportDashboard = () => {
    if (!DailyReportDashboard) return;
    DailyReportDashboard.classList.remove('is-open');
    DailyReportDashboard.style.display = 'flex';
    requestAnimationFrame(() => DailyReportDashboard.classList.add('is-open'));
};

if (DisplayDailyReportButton && DailyReportDashboard) {
    DisplayDailyReportButton.addEventListener('click', openDailyReportDashboard);
}
if (closeDailyReportBtn && DailyReportDashboard) {
    closeDailyReportBtn.addEventListener('click', () => {
        DailyReportDashboard.classList.remove('is-open');
        DailyReportDashboard.style.display = 'none';
    });
}
if (window.location.search.includes('DailyReportFilter_SpecificDay')) {
    document.querySelector('.chart-1')?.style.setProperty('display', 'none');
    openDailyReportDashboard();
} 