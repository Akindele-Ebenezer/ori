const editRadioBroadcastButtons = document.querySelectorAll('.EditRadioBroadcastButton');
const updateRadioBroadcastButton = document.querySelector('.UpdateRadioBroadcastButton');
const updateRadioBroadcastForm = document.querySelector('.UpdateRadioBroadcastForm');
const radioBroadcastModal = document.querySelector('.UpdateRadioBroadcast');
const cancelRadioBroadcastButton = document.querySelector('.close-button-update-radio-broadcast');
const radioAlertFields = ['WatchKeepingAlert', 'RelatedDistress', 'FirstCallTime', 'SecondCallTime', 'Responders'];

if (updateRadioBroadcastButton && updateRadioBroadcastForm) {
    const field = (name) => updateRadioBroadcastForm.querySelector(`[name="${name}"]`);
    editRadioBroadcastButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const row = button.closest('tr');
            if (!row) return;
            const report = JSON.parse(atob(row.dataset.report));
            ['Vessel', 'DoneBy', 'Remarks', 'Date'].forEach((name) => { field(name).value = report[name] || ''; });
            ['FirstCallTime', 'SecondCallTime'].forEach((name) => {
                const value = ['Yes', 'No'].includes(String(report[name])) ? '' : (report[name] || '');
                field(name).value = value;
            });
            radioAlertFields.filter((name) => !['FirstCallTime', 'SecondCallTime'].includes(name)).forEach((name) => { field(name).checked = String(report[name]).toLowerCase() === 'yes'; });
            updateRadioBroadcastButton.dataset.id = report.id;
            radioBroadcastModal.style.display = 'flex';
        });
    });
    updateRadioBroadcastButton.addEventListener('click', (event) => {
        event.preventDefault();
        updateRadioBroadcastForm.action = `/Edit/RadioBroadcastReport/${updateRadioBroadcastButton.dataset.id}`;
        HTMLFormElement.prototype.submit.call(updateRadioBroadcastForm);
    });
    if (cancelRadioBroadcastButton) cancelRadioBroadcastButton.addEventListener('click', () => { radioBroadcastModal.style.display = 'none'; });
}