let DeleteDailyReportButtons = document.querySelectorAll('.DeleteDailyReportButton');
let DailyReportName = document.querySelector('.daily-report-name');
let DeleteDailyReportModal = document.querySelector('.DeleteDailyReport');
let DeleteDailyReportX = document.querySelector('.DeleteDailyReportX');
let CancelButtonDeleteDailyReports = document.querySelectorAll('.cancel-button-delete-daily-report');
 
DeleteDailyReportButtons.forEach(DeleteDailyReportButton => {
    DeleteDailyReportButton.addEventListener('click', () => {
        DeleteDailyReportModal.style.display = 'flex'; 
        let DailyReportId = DeleteDailyReportButton.parentElement.parentElement.firstElementChild.textContent;
        DailyReportName.textContent = DeleteDailyReportButton.parentElement.parentElement.firstElementChild.nextElementSibling.textContent;

        DeleteDailyReportX.addEventListener('click', () => {
            DeleteDailyReportX.textContent = '+ Deleting..';
            window.location = '/Delete/DailyReport/' + DailyReportId;
        })

        CancelButtonDeleteDailyReports.forEach(CancelButtonDeleteDailyReport => {
            CancelButtonDeleteDailyReport.addEventListener('click', () => { 
                DeleteDailyReportModal.style.display = 'none';
            })
        });
    });
});