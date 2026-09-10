const editOfficersOnDutyButtons = document.querySelectorAll('.EditOfficersOnDutyButton');
const updateOfficersOnDutyButton = document.querySelector('.UpdateOfficersOnDutyButton');
const updateOfficersOnDutyForm = document.querySelector('.UpdateOfficersOnDutyForm');
const officersOnDutyModal = document.querySelector('.UpdateOfficersOnDuty');
const cancelOfficersOnDutyButton = document.querySelector('.close-button-update-officers-on-duty');

if (updateOfficersOnDutyButton && updateOfficersOnDutyForm) {
    editOfficersOnDutyButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const row = button.closest('tr');
            if (!row) return;
            const report = JSON.parse(atob(row.dataset.report));
            const supervisor = updateOfficersOnDutyForm.querySelector('[name="Supervisor"]');
            if (supervisor) supervisor.value = report.Supervisor || '';
            for (let index = 1; index <= 7; index += 1) {
                const suffix = index === 1 ? '' : index;
                ['Name', 'Morning', 'Afternoon', 'Night'].forEach((name) => {
                    const input = updateOfficersOnDutyForm.querySelector(`[name="${name}${suffix}"]`);
                    if (!input) return;
                    if (name === 'Name') input.value = report[`${name}${suffix}`] || '';
                    else input.checked = String(report[`${name}${suffix}`]).toLowerCase() === 'yes';
                });
            }
            updateOfficersOnDutyForm.querySelector('[name="Remarks"]').value = report.Remarks || '';
            updateOfficersOnDutyForm.querySelector('[name="Date"]').value = report.Date || '';
            updateOfficersOnDutyButton.dataset.id = report.id;
            officersOnDutyModal.style.display = 'flex';
        });
    });
    updateOfficersOnDutyButton.addEventListener('click', (event) => {
        event.preventDefault();
        updateOfficersOnDutyForm.action = `/Edit/OfficersOnDutyReport/${updateOfficersOnDutyButton.dataset.id}`;
        HTMLFormElement.prototype.submit.call(updateOfficersOnDutyForm);
    });
    if (cancelOfficersOnDutyButton) cancelOfficersOnDutyButton.addEventListener('click', () => { officersOnDutyModal.style.display = 'none'; });
}