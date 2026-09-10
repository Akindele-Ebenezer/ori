const AddOfficersOnDutyButton = document.querySelector('.AddOfficersOnDutyButton');
const AddOfficersOnDutyForm = document.querySelector('.AddOfficersOnDutyForm');

if (AddOfficersOnDutyButton && AddOfficersOnDutyForm) {
    const errorBox = AddOfficersOnDutyForm.querySelector('.error-daily-report');
    const officerNames = Array.from({ length: 7 }, (_, index) =>
        index === 0 ? 'Name' : `Name${index + 1}`
    );

    const showError = (message) => {
        errorBox.textContent = message;
        errorBox.style.background = '';
        errorBox.style.color = '';
        errorBox.style.padding = '';
    };

    const showProcessing = () => {
        errorBox.textContent = 'Creating officers on duty report..';
        errorBox.style.backgroundColor = 'rgb(106, 97, 233)';
        errorBox.style.color = '#fff';
        errorBox.style.padding = '1em';
        AddOfficersOnDutyButton.style.backgroundColor = '#1fb95e';
        AddOfficersOnDutyButton.textContent = '+ Processing..';
    };

    const submitOfficersOnDuty = (event) => {
        event.preventDefault();

        const date = AddOfficersOnDutyForm.querySelector('[name=Date]').value;
        let enteredOfficerCount = 0;

        for (const name of officerNames) {
            const nameInput = AddOfficersOnDutyForm.querySelector(`[name=${name}]`);
            const officerRow = nameInput.closest('section');
            const officerName = nameInput.value.trim();
            const hasShift = officerRow.querySelector('input[type=checkbox]:checked') !== null;

            if (!officerName && hasShift)
                return showError('Enter a name for every selected duty shift.');

            if (officerName) {
                enteredOfficerCount += 1;
                if (!hasShift)
                    return showError(`Select a duty shift for ${officerName}.`);
            }
        }

        if (!enteredOfficerCount) return showError('Enter at least one officer.');
        if (!date) return showError('Date is required.');

        showProcessing();
        AddOfficersOnDutyForm.action = '/Add/OfficersOnDutyReport';
        HTMLFormElement.prototype.submit.call(AddOfficersOnDutyForm);
    };

    AddOfficersOnDutyButton.addEventListener('click', submitOfficersOnDuty);
    AddOfficersOnDutyForm.addEventListener('submit', submitOfficersOnDuty);
}
