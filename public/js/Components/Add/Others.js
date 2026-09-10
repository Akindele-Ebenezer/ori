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

        const vessel = AddOthersForm.querySelector('[name=Vessel]').value.trim();
        const rob = AddOthersForm.querySelector('[name=ROB]').value.trim();
        const freshWater = AddOthersForm.querySelector('[name=FreshWater]').value.trim();
        const doneBy = AddOthersForm.querySelector('[name=DoneBy]').value.trim();
        const date = AddOthersForm.querySelector('[name=Date]').value;

        if (!vessel) return showError('Vessel is required.');
        if (!rob) return showError('ROB is required.');
        if (!freshWater) return showError('Fresh water is required.');
        if (!doneBy) return showError('Done by field is required.');
        if (!date) return showError('Date is required.');

        showProcessing();
        AddOthersForm.action = '/Add/OthersReport';
        HTMLFormElement.prototype.submit.call(AddOthersForm);
    };

    AddOthersButton.addEventListener('click', submitOthers);
    AddOthersForm.addEventListener('submit', submitOthers);
}
