const editDevicesButtons = document.querySelectorAll('.EditDevicesButton');
const updateDevicesButton = document.querySelector('.UpdateDevicesButton');
const updateDevicesForm = document.querySelector('.UpdateDevicesForm');
const devicesModal = document.querySelector('.UpdateDevices');
const cancelDevicesButton = document.querySelector('.close-button-update-devices');
const deviceFields = ['VhfBaseRadio', 'VhfHandHeld', 'Ais', 'VhfRecorder', 'WindDetector', 'StormDetector', 'ComputerSystem', 'PublicAddressSystem', 'FireAlarmSystem', 'VoltageRegulator', 'VhfRepeater', 'MobilePhone', 'Intercomm', 'CCTV', 'Internet'];

if (updateDevicesButton && updateDevicesForm) {
    editDevicesButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const row = button.closest('tr');
            if (!row) return;
            const report = JSON.parse(atob(row.dataset.report));
            ['DoneBy', 'Remarks', 'Date'].forEach((name) => { updateDevicesForm.querySelector(`[name="${name}"]`).value = report[name] || ''; });
            deviceFields.forEach((name) => {
                const radio = updateDevicesForm.querySelector(`[name="${name}"][value="${report[name] || 'No'}"]`);
                if (radio) radio.checked = true;
            });
            updateDevicesButton.dataset.id = report.id;
            devicesModal.style.display = 'flex';
        });
    });
    updateDevicesButton.addEventListener('click', (event) => {
        event.preventDefault();
        updateDevicesForm.action = `/Edit/DevicesReport/${updateDevicesButton.dataset.id}`;
        HTMLFormElement.prototype.submit.call(updateDevicesForm);
    });
    if (cancelDevicesButton) cancelDevicesButton.addEventListener('click', () => { devicesModal.style.display = 'none'; });
}