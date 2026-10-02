const reportEditButtons = document.querySelectorAll('.EditAvailabilityReportButton');
const reportDeleteButtons = document.querySelectorAll('.DeleteAvailabilityReportButton');
const reportForms = [...document.querySelectorAll('.UpdateAvailabilityReportForm')];
const deleteModalClasses = {
    incident: '.DeleteIncidentAccidentNearMiss',
    hospital: '.DeleteHospitalVisitCrewStaff',
    tugs: '.DeleteTugsAssignment',
    cctv: '.DeleteCctvPositioning',
};

const reportFromRow = (button) => {
    const row = button.closest('[data-availability-report]');
    return row ? JSON.parse(atob(row.dataset.availabilityReport)) : null;
};

reportEditButtons.forEach((button) => {
    button.addEventListener('click', () => {
        const report = reportFromRow(button);
        const form = reportForms.find((candidate) => candidate.querySelector('[name="ReportType"]')?.value === report?.ReportType);
        if (!report || !form) return;
        Object.entries(report).forEach(([name, value]) => {
            const input = form.querySelector(`[name="${name}"]`);
            if (input && !['id', 'ReportType', 'created_at', 'updated_at'].includes(name)) input.value = value ?? '';
        });
        form.action = `/Edit/AvailabilityReport/${report.ReportType}/${report.id}`;
        const modal = form.closest('.UpdateAvailabilityReport');
        modal.classList.remove('Hide');
        modal.style.display = 'flex';
    });
});

reportForms.forEach((form) => {
    const closeButton = form.closest('.UpdateAvailabilityReport')?.querySelector('.close-button-update-availability-report');
    if (closeButton) closeButton.addEventListener('click', () => { form.closest('.UpdateAvailabilityReport').style.display = 'none'; });
});

reportDeleteButtons.forEach((button) => {
    button.addEventListener('click', () => {
        const report = reportFromRow(button);
        const modal = document.querySelector(deleteModalClasses[report?.ReportType]);
        if (!report || !modal) return;
        modal.dataset.reportId = report.id;
        modal.dataset.reportType = report.ReportType;
        modal.classList.remove('Hide');
        modal.style.display = 'flex';
    });
});

Object.values(deleteModalClasses).forEach((selector) => {
    const modal = document.querySelector(selector);
    if (!modal) return;
    modal.querySelectorAll('.cancel-delete-availability-report').forEach((button) => {
        button.addEventListener('click', () => { modal.style.display = 'none'; });
    });
    modal.querySelector('.confirm-delete-availability-report')?.addEventListener('click', () => {
        window.location.href = `/Delete/AvailabilityReport/${modal.dataset.reportType}/${modal.dataset.reportId}`;
    });
});

let UpdateButtons = document.querySelectorAll('.UpdateButton');
UpdateButtons.forEach(button => {
    button.addEventListener('click', () => {
        const form = button.previousElementSibling;

        if (form && !form.checkValidity()) {
            form.reportValidity();  
            return;
        }

        button.style.backgroundColor = '#1fb95e';
        button.textContent = '+ Processing..';
    });
});
