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

        const doneByInput = AddRadioBroadcastForm.querySelector('[name="DoneBy"]');
        const dateInput = AddRadioBroadcastForm.querySelector('[name="Date"]');
        const firstCallTimeInput = AddRadioBroadcastForm.querySelector('[name="FirstCallTime"]');
        const secondCallTimeInput = AddRadioBroadcastForm.querySelector('[name="SecondCallTime"]');

        const doneBy = doneByInput?.value.trim();
        const date = dateInput?.value;
        const firstCallTime = firstCallTimeInput?.value;
        const secondCallTime = secondCallTimeInput?.value;
 
        const vesselRows = [
            ...AddRadioBroadcastForm.querySelectorAll(
                'select[name^="vessels["][name$="[Vessel]"]'
            )
        ];

        // Check whether at least one row has a selected value
        const selectedRows = vesselRows.filter(
            row => row.value.trim() !== ''
        );

        const firstCallSelected = AddRadioBroadcastForm.querySelector(
            'input[name$="[FirstCallTimeEnabled]"]:checked'
        );

        const secondCallSelected = AddRadioBroadcastForm.querySelector(
            'input[name$="[SecondCallTimeEnabled]"]:checked'
        );
 
        if (!selectedRows.length) {
            return showError('Select at least one vessel.');
        }

        if (firstCallSelected && !firstCallTime) {
            return showError(
                'Enter the 1st call time for the selected vessel(s).'
            );
        }
 
        if (secondCallSelected && !secondCallTime) {
            return showError(
                'Enter the 2nd call time for the selected vessel(s).'
            );
        }

        if (!doneBy) {
            return showError('Done by field is required.');
        }

        if (!date) {
            return showError('Date is required.');
        }

        showProcessing();

        AddRadioBroadcastForm.action = '/Add/RadioBroadcastReport';

        HTMLFormElement.prototype.submit.call(AddRadioBroadcastForm);
    };

    AddRadioBroadcastButton.addEventListener('click', submitRadioBroadcast);
    AddRadioBroadcastForm.addEventListener('submit', submitRadioBroadcast);
}