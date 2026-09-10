const AddRadioBroadcastButton = document.querySelector('.AddRadioBroadcastButton');
const AddRadioBroadcastForm = document.querySelector('.AddRadioBroadcastForm');

if (AddRadioBroadcastButton && AddRadioBroadcastForm) {
    const errorBox = AddRadioBroadcastForm.querySelector('.error-daily-report');

    const showError = (message) => {
        errorBox.textContent = message;
        errorBox.style.background = '';
        errorBox.style.color = '';
        errorBox.style.padding = '';
    };

    const showProcessing = () => {
        errorBox.textContent = 'Creating radio broadcast..';
        errorBox.style.backgroundColor = 'rgb(106, 97, 233)';
        errorBox.style.color = '#fff';
        errorBox.style.padding = '1em';
        AddRadioBroadcastButton.style.backgroundColor = '#1fb95e';
        AddRadioBroadcastButton.textContent = '+ Processing..';
    };

    const submitRadioBroadcast = (event) => {
        event.preventDefault();

        const doneBy = AddRadioBroadcastForm.querySelector('[name=DoneBy]').value.trim();
        const date = AddRadioBroadcastForm.querySelector('[name=Date]').value;
        const vesselRows = [...AddRadioBroadcastForm.querySelectorAll('select[name^="vessels["]')];

        if (!vesselRows.some((row) => row.value.trim())) return showError('Select at least one vessel.');
        if (!doneBy) return showError('Done by field is required.');
        if (!date) return showError('Date is required.');

        showProcessing();
        AddRadioBroadcastForm.action = '/Add/RadioBroadcastReport';
        HTMLFormElement.prototype.submit.call(AddRadioBroadcastForm);
    };

    AddRadioBroadcastButton.addEventListener('click', submitRadioBroadcast);
    AddRadioBroadcastForm.addEventListener('submit', submitRadioBroadcast);
}
