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

        const vessel = AddRadioBroadcastForm.querySelector('[name=Vessel]').value.trim();
        const doneBy = AddRadioBroadcastForm.querySelector('[name=DoneBy]').value.trim();
        const date = AddRadioBroadcastForm.querySelector('[name=Date]').value;
        const alertFields = [
            'WatchKeepingAlert',
            'RelatedDistress',
            'FirstCallTime',
            'SecondCallTime',
            'Responders'
        ];
        const hasAlert = alertFields.some((name) =>
            AddRadioBroadcastForm.querySelector(`[name=${name}]`).checked
        );

        if (!vessel) return showError('Vessel is required.');
        if (!hasAlert) return showError('Select at least one radio broadcast alert.');
        if (!doneBy) return showError('Done by field is required.');
        if (!date) return showError('Date is required.');

        showProcessing();
        AddRadioBroadcastForm.action = '/Add/RadioBroadcastReport';
        HTMLFormElement.prototype.submit.call(AddRadioBroadcastForm);
    };

    AddRadioBroadcastButton.addEventListener('click', submitRadioBroadcast);
    AddRadioBroadcastForm.addEventListener('submit', submitRadioBroadcast);
}
