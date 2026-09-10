const dailyReportFilterButton = document.querySelector('.DailyReportFilterButton');
const dailyReportFilterModal = document.querySelector('.DailyReportFilter');
const dailyReportFilterForm = document.querySelector('.DailyReportFilterForm');
const dailyReportFilterGoButton = document.querySelector('.DailyReportFilter_GoButton');
const dailyReportFilterError = document.querySelector('.error-daily-report-filter');

if (dailyReportFilterButton && dailyReportFilterModal && dailyReportFilterForm) {
    const fromDate = dailyReportFilterForm.querySelector('[name="FromDate_DAILYREPORTFILTER"]');
    const endDate = dailyReportFilterForm.querySelector('[name="EndDate_DAILYREPORTFILTER"]');
    const specificDay = dailyReportFilterForm.querySelector('[name="DailyReportFilter_SpecificDay"]');

    dailyReportFilterButton.addEventListener('click', () => {
        dailyReportFilterModal.style.display = 'flex';
    });

    dailyReportFilterModal.querySelectorAll('.cancel-button-filter-by-date').forEach((button) => {
        button.addEventListener('click', () => {
            dailyReportFilterModal.style.display = 'none';
        });
    });

    dailyReportFilterGoButton.addEventListener('click', (event) => {
        event.preventDefault();
        dailyReportFilterError.textContent = '';

        if (specificDay.value) {
            fromDate.value = '';
            endDate.value = '';
        } else if (!fromDate.value || !endDate.value) {
            dailyReportFilterError.textContent = 'Select a specific day or both date fields.';
            return;
        } else if (fromDate.value > endDate.value) {
            dailyReportFilterError.textContent = 'From date cannot be greater than end date.';
            return;
        }

        dailyReportFilterGoButton.disabled = true;
        dailyReportFilterGoButton.textContent = '+ Processing..';
        dailyReportFilterForm.method = 'GET';
        dailyReportFilterForm.action = window.location.pathname;
        dailyReportFilterForm.submit();
    });
}