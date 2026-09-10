(() => {
    const dashboard = document.querySelector('[data-daily-report-dashboard]');
    if (!dashboard) return;
    
    const search = dashboard.querySelector('[data-report-search]');
    const rows = [...dashboard.querySelectorAll('[data-report-row]')];
    if (!search) return;

    search.addEventListener('input', () => {
        const query = search.value.trim().toLowerCase();
        rows.forEach((row) => {
            const matches = !query || row.dataset.searchValue.includes(query);
            row.style.display = matches ? '' : 'none';
        });
    });
})();
let DisplayDailyReportButton = document.querySelector('.DisplayDailyReportButton');
let closeDailyReportBtn = document.querySelector('.deck-close');
let DailyReportDashboard = document.querySelector('.DailyVesselOperations');
if (DisplayDailyReportButton && DailyReportDashboard) {
    DisplayDailyReportButton.addEventListener('click', () => {
        DailyReportDashboard.style.display = 'flex';
    });
}
if (closeDailyReportBtn && DailyReportDashboard) {
    closeDailyReportBtn.addEventListener('click', () => {
        DailyReportDashboard.style.display = 'none';
    });
}
if (window.location.search.includes('DailyReportFilter_SpecificDay')) {
    document.querySelector('.chart-1').style.display = 'none';
    DailyReportDashboard.style.display = 'flex';
} 