const AddOthersButton = document.querySelector('.AddOthersButton');
const AddOthersForm = document.querySelector('.AddOthersForm');

if (AddOthersButton && AddOthersForm) {
    const errorBox = AddOthersForm.querySelector('.error-daily-report');

    const showError = (message) => {
        errorBox.textContent = message;
        errorBox.style.background = '';
        errorBox.style.color = '';
        errorBox.style.padding = '';
    };

    const showProcessing = () => {
        errorBox.textContent = 'Creating others report..';
        errorBox.style.backgroundColor = 'rgb(106, 97, 233)';
        errorBox.style.color = '#fff';
        errorBox.style.padding = '1em';
        AddOthersButton.style.backgroundColor = '#1fb95e';
        AddOthersButton.textContent = '+ Processing..';
    };

    const submitOthers = (event) => {
        event.preventDefault();

        const doneBy = AddOthersForm.querySelector('[name=DoneBy]').value.trim();
        const date = AddOthersForm.querySelector('[name=Date]').value;
        const vesselRows = [...AddOthersForm.querySelectorAll('select[name^="vessels["]')];

        if (!vesselRows.some((row) => row.value.trim())) return showError('Select at least one vessel.');
        if (!doneBy) return showError('Done by field is required.');
        if (!date) return showError('Date is required.');

        showProcessing();
        AddOthersForm.action = '/Add/OthersReport';
        HTMLFormElement.prototype.submit.call(AddOthersForm);
    };

    AddOthersButton.addEventListener('click', submitOthers);
    AddOthersForm.addEventListener('submit', submitOthers);
}
