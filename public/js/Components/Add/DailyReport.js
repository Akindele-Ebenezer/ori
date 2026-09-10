let CreateDailyReportButton = document.querySelector('.RecordAvailabilityButton');
let AddDailyReportModal = document.querySelector('.AddDailyReport');
let CancelButton_DailyReport = document.querySelector('.cancel-button-daily-report');
let NoDataSelectedModal_DailyReport = document.querySelector('.no-data-selected.moc');
let ContentData_DailyReport = document.querySelector('.content-data');
 
const AddDailyReportButton = document.querySelector('.AddDailyReportButton');
const AddDailyReportForm   = document.querySelector('.AddDailyReportForm');

if (AddDailyReportButton && AddDailyReportForm) {
    const startTimeInput = AddDailyReportForm.querySelector('[name=StartTime]');
    const endTimeInput = AddDailyReportForm.querySelector('[name=EndTime]');

    const formatTime = (input) => {
        input.value = input.value.toUpperCase();

        if (!input.value || !/^\d/.test(input.value)) {
            input.value = '';
            return;
        }

        if (input.value.length === 2) {
            input.value += ':';

            if (Number(input.value.substring(0, 2)) > 23) {
                input.value = '';
            }
        }

        if (input.value.length === 5) {
            if (Number(input.value.substring(3, 5)) > 59) {
                input.value = '';
            } else {
                input.value += ' HRS';
            }
        }
    };

    [startTimeInput, endTimeInput].forEach((input) => {
        input.addEventListener('keyup', () => formatTime(input));
    });

    AddDailyReportButton.addEventListener('click', () => {

    const el = {
        error: AddDailyReportForm.querySelector('.error-daily-report'),
        vessel: AddDailyReportForm.querySelector('[name=Vessel]'),
        status: AddDailyReportForm.querySelector('[name=Status]'),
        doneBy: AddDailyReportForm.querySelector('[name=DoneBy]'),
        remarks: AddDailyReportForm.querySelector('[name=Remarks]'),
        startTime: startTimeInput,
        endTime: endTimeInput,
        startDate: AddDailyReportForm.querySelector('[name=StartDate]'),
        endDate: AddDailyReportForm.querySelector('[name=EndDate]')
    };

    const showError = (message) => {
        el.error.style.background = '';
        el.error.style.color = '';
        el.error.style.padding = '';
        el.error.textContent = message;
    };

    const showProcessing = () => {
        el.error.style.backgroundColor = 'rgb(106, 97, 233)';
        el.error.style.color = '#fff';
        el.error.style.padding = '1em';
        el.error.textContent = 'Creating daily report..';

        AddDailyReportButton.style.backgroundColor = '#1fb95e';
        AddDailyReportButton.textContent = '+ Processing..';
    };

    const containsLetters = (value) => {
        const cleaned = value.trim().toUpperCase(); 
        const withoutHRS = cleaned.replace(/\s?HRS$/, '');

        return /[A-Z]/.test(withoutHRS);
    };

    const isValidTime = (value) =>
        /^(?:[01]\d|2[0-3]):[0-5]\d(?: HRS)?$/i.test(value.trim());

    // ---------- Trimmed Values ----------
    const data = {
        vessel: el.vessel.value.trim(),
        status: el.status.value.trim(),
        doneBy: el.doneBy.value.trim(),
        startTime: el.startTime.value.trim(),
        endTime: el.endTime.value.trim(),
        startDate: el.startDate.value,
        endDate: el.endDate.value,
        remarks: el.remarks.value.trim()
    };

    // =====================================================
    // =============== VALIDATION SECTION ==================
    // =====================================================

    // ---------- Manual Entry Mode ----------
    // if (!data.vessel) {
    //     return showError('Vessel is required.');
    // }

    if (!data.startTime) return showError('Start time cannot be empty.');
    if (!data.endTime)   return showError('End time cannot be empty.');
    if (!data.status)    return showError('Status is required.');
    if (!data.doneBy)    return showError('Done by field is required.');
    if (!data.startDate) return showError('Start date cannot be empty.');
    if (!data.endDate)   return showError('End date cannot be empty.');

    if (data.startDate > data.endDate)
        return showError('Start date cannot be greater than End date.');

    if (!isValidTime(data.startTime) || !isValidTime(data.endTime))
        return showError('Start/End Time format is invalid.');

    if (containsLetters(data.startTime) || containsLetters(data.endTime))
        return showError('Time cannot include alphabets.');

    // =====================================================
    // ================== SUBMISSION =======================
    // =====================================================

    showProcessing();

    const params = new URLSearchParams(data).toString();
    AddDailyReportForm.setAttribute('action', `/Add/DailyReport`);

    AddDailyReportForm.submit();
    });

    AddDailyReportForm.addEventListener('submit', (event) => {
        event.preventDefault();
        AddDailyReportButton.click();
    });
}
    