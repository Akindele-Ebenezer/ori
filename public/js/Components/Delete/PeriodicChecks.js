(() => {
    const modal = document.querySelector('.DeletePeriodicChecks');
    const dateLabel = document.querySelector('.periodic-check-date');
    const confirmButton = document.querySelector('.DeletePeriodicChecksButton');
    if (!modal || !dateLabel || !confirmButton) return;

    let reportId;
    document.querySelectorAll('.DeletePeriodicChecksRowButton').forEach((deleteButton) => {
        deleteButton.addEventListener('click', () => {
            const row = deleteButton.closest('tr');
            if (!row) return;
            const report = JSON.parse(atob(row.dataset.report));
            reportId = report.id;
            dateLabel.textContent = report.Date;
            modal.style.display = 'flex';
        });
    });
    confirmButton.addEventListener('click', () => {
        if (reportId) window.location.assign(`/Delete/PeriodicCheck/${reportId}`);
    });
    document.querySelectorAll('.cancel-button-delete-periodic-checks').forEach((button) => {
        button.addEventListener('click', () => { modal.style.display = 'none'; });
    });
})();