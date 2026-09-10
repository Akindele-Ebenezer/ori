const AddDevicesButton = document.querySelector('.AddDevicesButton');
const AddDevicesForm = document.querySelector('.AddDevicesForm');

if (AddDevicesButton && AddDevicesForm) {
    const errorBox = AddDevicesForm.querySelector('.error-daily-report');
    const deviceFields = [
        'VhfBaseRadio',
        'VhfHandHeld',
        'Ais',
        'VhfRecorder',
        'WindDetector',
        'StormDetector',
        'ComputerSystem',
        'PublicAddressSystem',
        'FireAlarmSystem',
        'VoltageRegulator',
        'VhfRepeater',
        'MobilePhone',
        'Intercomm',
        'CCTV',
        'Internet'
    ];

    const showError = (message) => {
        errorBox.textContent = message;
        errorBox.style.background = '';
        errorBox.style.color = '';
        errorBox.style.padding = '';
    };

    const showProcessing = () => {
        errorBox.textContent = 'Creating devices report..';
        errorBox.style.backgroundColor = 'rgb(106, 97, 233)';
        errorBox.style.color = '#fff';
        errorBox.style.padding = '1em';
        AddDevicesButton.style.backgroundColor = '#1fb95e';
        AddDevicesButton.textContent = '+ Processing..';
    };

    const submitDevices = (event) => {
        event.preventDefault();

        const doneBy = AddDevicesForm.querySelector('[name=DoneBy]').value.trim();
        const date = AddDevicesForm.querySelector('[name=Date]').value;
        const missingDevice = deviceFields.find((name) => {
            return !AddDevicesForm.querySelector(`[name=${name}]:checked`);
        });

        if (missingDevice) return showError('Select Working or Not Working for all devices.');
        if (!doneBy) return showError('Done by field is required.');
        if (!date) return showError('Date is required.');

        showProcessing();
        AddDevicesForm.action = '/Add/DevicesReport';
        HTMLFormElement.prototype.submit.call(AddDevicesForm);
    };

    AddDevicesButton.addEventListener('click', submitDevices);
    AddDevicesForm.addEventListener('submit', submitDevices);
}
