(() => {
    const form = document.querySelector('.UpdatePeriodicChecksForm');
    const button = document.querySelector('.UpdatePeriodicChecksButton');
    const modal = document.querySelector('.UpdatePeriodicChecks');
    if (!form || !button || !modal) return;
    const location = form.querySelector('[name="Location"]');
    const remarks = form.querySelector('[name="Remarks"]');
    location.addEventListener('change', () => { remarks.required = location.value === 'Others'; });

    document.querySelectorAll('.EditPeriodicChecksButton').forEach((editButton) => {
        editButton.addEventListener('click', () => {
            const row = editButton.closest('tr');
            if (!row) return;
            const report = JSON.parse(atob(row.dataset.report));
            ['Type', 'Equipment', 'Location', 'Date', 'Time', 'DoneBy', 'Remarks'].forEach((name) => {
                form.querySelector(`[name="${name}"]`).value = report[name] || '';
            });
            remarks.required = location.value === 'Others';
            button.dataset.id = report.id;
            modal.style.display = 'flex';
        });
    });

    button.addEventListener('click', () => {
        if (!form.reportValidity()) return;
        form.action = `/Edit/PeriodicCheck/${button.dataset.id}`;
        HTMLFormElement.prototype.submit.call(form);
    });
    document.querySelectorAll('.close-button-update-periodic-checks').forEach((closeButton) => {
        closeButton.addEventListener('click', () => { modal.style.display = 'none'; });
    });
})();