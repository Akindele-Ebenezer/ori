const editDailyReportButtons = document.querySelectorAll('.EditDailyReportButton');
const updateDailyReportButton = document.querySelector('.UpdateDailyReportButton');
const updateDailyReportForm = document.querySelector('.UpdateDailyReportForm');
const dailyReportModal = document.querySelector('.UpdateDailyReport');
const cancelDailyReportButton = document.querySelector('.close-button-update-daily-report');

if (updateDailyReportButton && updateDailyReportForm) {
    const errorBox = updateDailyReportForm.querySelector('.error-daily-report');
    const field = (name) => updateDailyReportForm.querySelector(`[name="${name}"]`);

    const showError = (message) => {
        errorBox.textContent = message;
        errorBox.style.background = '';
        errorBox.style.color = '';
        errorBox.style.padding = '';
    };

    editDailyReportButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const row = button.closest('tr');
            if (!row) return;
            const report = JSON.parse(atob(row.dataset.report));
            Object.entries({ Vessel: report.Vessel || '', Status: report.Status || '', DoneBy: report.DoneBy || '', Remarks: report.Remarks || '', StartTime: report.StartTime || '', EndTime: report.EndTime || '', StartDate: report.StartDate || '', EndDate: report.EndDate || '' }).forEach(([name, value]) => {
                const input = field(name);
                if (input) input.value = value;
            });
            updateDailyReportButton.dataset.id = report.id;
            dailyReportModal.style.display = 'flex';
        });
    });

    const submitDailyReportUpdate = (event) => {
        event.preventDefault();
        if (!updateDailyReportButton.dataset.id) return showError('Unable to identify the daily report record.');
        const vessel = field('Vessel');
        if (vessel.disabled) vessel.disabled = false;
        updateDailyReportForm.action = `/Edit/DailyReport/${updateDailyReportButton.dataset.id}`;
        HTMLFormElement.prototype.submit.call(updateDailyReportForm);
    };

    updateDailyReportButton.addEventListener('click', submitDailyReportUpdate);
    updateDailyReportForm.addEventListener('submit', submitDailyReportUpdate);
    if (cancelDailyReportButton) cancelDailyReportButton.addEventListener('click', () => { dailyReportModal.style.display = 'none'; });
}