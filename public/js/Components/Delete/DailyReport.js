let DeleteDailyReportButtons = document.querySelectorAll('.DeleteDailyReportButton');
let DailyReportName = document.querySelector('.daily-report-name');
let DeleteDailyReportModal = document.querySelector('.DeleteDailyReport');
let DeleteDailyReportX = document.querySelector('.DeleteDailyReportX');
let CancelButtonDeleteDailyReports = document.querySelectorAll('.cancel-button-delete-daily-report');
let selectedDailyReportId = null;
 
DeleteDailyReportButtons.forEach(DeleteDailyReportButton => {
    DeleteDailyReportButton.addEventListener('click', () => {
        DeleteDailyReportModal.style.display = 'flex'; 
        selectedDailyReportId = DeleteDailyReportButton.parentElement.parentElement.firstElementChild.textContent.trim();
        DailyReportName.textContent = DeleteDailyReportButton.parentElement.parentElement.firstElementChild.nextElementSibling.textContent;
    });
});

DeleteDailyReportX.addEventListener('click', () => {
    if (!selectedDailyReportId) return;
    DeleteDailyReportX.textContent = '+ Deleting..';
    window.location = '/Delete/DailyReport/' + encodeURIComponent(selectedDailyReportId);
});

CancelButtonDeleteDailyReports.forEach((button) => {
    button.addEventListener('click', () => {
        selectedDailyReportId = null;
        DeleteDailyReportModal.style.display = 'none';
    });
});