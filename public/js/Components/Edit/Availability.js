const editButtons = document.querySelectorAll('.EditAvailabilityButton');
const updateButton = document.querySelector('.UpdateAvailabilityButton');
const updateForm = document.querySelector('.UpdateAvailabilityForm');
const modal = document.querySelector('.UpdateAvailability');
const cancelButton = document.querySelector('.close-button-update-availability');

const attachTimeFormatter = (input) => {
    input.addEventListener('input', () => {
        let value = input.value.replace(/[^0-9]/g, '');

        if (value.length >= 2) {
            const hours = value.substring(0, 2);
            if (parseInt(hours) > 23) {
                input.value = '';
                return;
            }
        }
        if (value.length >= 4) {
            const minutes = value.substring(2, 4);
            if (parseInt(minutes) > 59) {
                input.value = '';
                return;
            }
            input.value = `${value.substring(0, 2)}:${value.substring(2, 4)} HRS`;
        } else if (value.length > 2) {
            input.value = `${value.substring(0, 2)}:${value.substring(2)}`;
        } else {
            input.value = value;
        }
    });
};
 
editButtons.forEach(button => {
    button.addEventListener('click', () => {
        const row = button.parentElement.parentElement;
        if (!row) {
            console.warn('Edit button is not inside a .list container');
            return;
        }
        const cells = row.children; 
        const availabilityId = cells[0].textContent.trim();
        const form = updateForm;
        form.querySelector('[name=EditVessel]').value = cells[1].textContent.trim();
        form.querySelector('[name=EditStatus]').value = cells[2].textContent.trim();
        form.querySelector('[name=EditDoneBy]').value = cells[3].textContent.trim();
        form.querySelector('[name=EditStartTime]').value = cells[5].textContent.trim() + ' HRS';
        form.querySelector('[name=EditEndTime]').value = cells[6].textContent.trim() + ' HRS';
        form.querySelector('[name=EditStartDate]').value = cells[7].textContent.trim();
        form.querySelector('[name=EditEndDate]').value = cells[8].textContent.trim();
        form.querySelector('[name=EditTillNow]').value = cells[9].textContent.trim();
        form.querySelector('[name=EditComment]').value = cells[10].textContent.trim();
        form.querySelector('[name=EditLocation]').value = cells[13].textContent.trim();
 
        const vessel = cells[1].textContent.trim();
        const reportFile = cells[11].textContent.trim();
        const pictureFile = cells[12].textContent.trim();

        form.querySelector('.report-file').textContent = reportFile;
        form.querySelector('.report-file-link').href =
            `/Documents/Reports/Vessels/${vessel}/${reportFile}`;

        form.querySelector('.picture-file').textContent = pictureFile;
        form.querySelector('.picture-file-link').href =
            `/Documents/Pictures/Vessels/${vessel}/${pictureFile}`;

        modal.style.display = 'flex';

        updateButton.dataset.id = availabilityId;
    });
});
 
attachTimeFormatter(document.querySelector('[name=EditStartTime]'));
attachTimeFormatter(document.querySelector('[name=EditEndTime]'));
 
updateButton.addEventListener('click', () => {

    const errorBox = document.querySelector('.error-availability.update');

    const data = {
        vessel: updateForm.querySelector('[name=EditVessel]').value.trim(),
        status: updateForm.querySelector('[name=EditStatus]').value.trim(),
        doneBy: updateForm.querySelector('[name=EditDoneBy]').value.trim(),
        startTime: updateForm.querySelector('[name=EditStartTime]').value.trim(),
        endTime: updateForm.querySelector('[name=EditEndTime]').value.trim(),
        startDate: updateForm.querySelector('[name=EditStartDate]').value,
        endDate: updateForm.querySelector('[name=EditEndDate]').value
    };

    const showError = msg => errorBox.textContent = msg;

    if (!data.vessel) return showError('Vessel field cannot be empty.');
    if (!data.status) return showError('Status is required.');
    if (!data.doneBy) return showError('Done by field is required.');
    if (!data.startTime || !data.endTime)
        return showError('Start and End time cannot be empty.');
    if (data.startDate > data.endDate)
        return showError('Start date cannot be greater than End date.');
    if (!data.startDate || !data.endDate)
        return showError('Start and End date are required.');

    if (!/^(\d{2}:\d{2} HRS)$/i.test(data.startTime) ||
        !/^(\d{2}:\d{2} HRS)$/i.test(data.endTime)) {
        return showError('Time must be in HH:MM HRS format.');
    }

    updateButton.style.backgroundColor = '#1fb95e';
    updateButton.textContent = '+ Processing..';

    updateForm.action = `/Edit/Availability/${updateButton.dataset.id}`;
    updateForm.submit();
});
 
cancelButton.addEventListener('click', () => {
    modal.style.display = 'none';
});
