const editDailyReportButtons = document.querySelectorAll('.EditDailyReportButton');
const dailyReportRows = document.querySelectorAll('[data-report-row]');
const updateDailyReportButton = document.querySelector('.UpdateDailyReportButton');
const updateDailyReportForm = document.querySelector('.UpdateDailyReportForm');
const dailyReportModal = document.querySelector('.UpdateDailyReport');
const cancelDailyReportButton = document.querySelector('.close-button-update-daily-report');

if (updateDailyReportButton && updateDailyReportForm) {
    const errorBox = updateDailyReportForm.querySelector('.error-daily-report');
    const field = (name) => updateDailyReportForm.querySelector(`[name="${name}"]`);

    const formatTime = (input) => {
        const digits = input.value.replace(/\D/g, '').slice(0, 4);
        if (digits.length < 2) {
            input.value = digits;
            return;
        }
        const hours = Number(digits.slice(0, 2));
        if (hours > 23) {
            input.value = '';
            return;
        }
        if (digits.length < 4) {
            input.value = `${digits.slice(0, 2)}:${digits.slice(2)}`;
            return;
        }
        const minutes = Number(digits.slice(2, 4));
        if (minutes > 59) {
            input.value = '';
            return;
        }
        input.value = `${digits.slice(0, 2)}:${digits.slice(2, 4)} HRS`;
    };

    ['StartTime', 'EndTime'].forEach((name) => {
        const input = field(name);
        if (input) input.addEventListener('input', () => formatTime(input));
    });

    const showError = (message) => {
        errorBox.textContent = message;
        errorBox.style.background = '';
        errorBox.style.color = '';
        errorBox.style.padding = '';
    };

    const openReport = (row) => {
            if (!row || !row.dataset.report) return;
            const report = JSON.parse(atob(row.dataset.report));
            const status = report.Status === 'DEPARTURE_ARRIVAL' ? 'DEPARTURE' : (report.Status || '');
            const vessel = field('Vessel');
            if (![...vessel.options].some((option) => option.value === (report.Vessel || ''))) {
                const option = new Option(report.Vessel || '', report.Vessel || '');
                vessel.add(option);
            }
            Object.entries({ Vessel: report.Vessel || '', DeployedVessel1: report.DeployedVessel1 || '', DeployedVessel2: report.DeployedVessel2 || '', DeployedVessel3: report.DeployedVessel3 || '', Status: status, DoneBy: report.DoneBy || '', Remarks: report.Remarks || '', StartTime: report.StartTime || '', EndTime: report.EndTime || '', StartDate: report.StartDate || '', EndDate: report.EndDate || '', BerthingDate: report.BerthingDate || '', BerthingTime: (report.BerthingTime || '').slice(0, 5), UnberthingDate: report.UnberthingDate || '', UnberthingTime: (report.UnberthingTime || '').slice(0, 5), ShiftingDate: report.ShiftingDate || '', ShiftingTime: (report.ShiftingTime || '').slice(0, 5) }).forEach(([name, value]) => {
                const input = field(name);
                if (input) input.value = value;
            });
            updateDailyReportButton.dataset.id = report.id;
            dailyReportModal.style.display = 'flex';
    };

    editDailyReportButtons.forEach((button) => button.addEventListener('click', () => openReport(button.closest('tr'))));
    dailyReportRows.forEach((row) => row.addEventListener('click', () => openReport(row)));

    const submitDailyReportUpdate = (event) => {
        event.preventDefault();
        if (!updateDailyReportButton.dataset.id) return showError('Unable to identify the daily report record.');
        updateDailyReportForm.action = `/Edit/DailyReport/${updateDailyReportButton.dataset.id}`;
        HTMLFormElement.prototype.submit.call(updateDailyReportForm);
    };

    updateDailyReportButton.addEventListener('click', submitDailyReportUpdate);
    updateDailyReportForm.addEventListener('submit', submitDailyReportUpdate);
    if (cancelDailyReportButton) cancelDailyReportButton.addEventListener('click', () => { dailyReportModal.style.display = 'none'; });
}