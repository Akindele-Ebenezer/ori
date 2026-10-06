let CreateAvailabilityButton = document.querySelector('.RecordAvailabilityButton');
let AddAvailabilityModal = document.querySelector('.AddAvailability');
let CancelButton_Availability = document.querySelector('.cancel-button-availability');
let NoDataSelectedModal_Availability = document.querySelector('.no-data-selected.moc');
let NoDataSelectedModal_HR = document.querySelector('.no-data-selected.hr');
let ContentData_Availability = document.querySelector('.content-data');
let AddAvailabilityWrapper = document.querySelector('.add-availabilty-wrapper');
const availabilityPath = /\/(Availability|Vessels)\/?$/.test(window.location.pathname);
const startTimeInput = document.querySelector('.AddAvailabilityForm [name="StartTime"]');
const endTimeInput = document.querySelector('.AddAvailabilityForm [name="EndTime"]');

const formatAvailabilityTime = (input) => {
    if (!input || !input.value) return;
    const digits = input.value.replace(/\D/g, '').slice(0, 4);
    if (digits.length < 2) {
        input.value = digits;
        return;
    }
    const hours = Number(digits.slice(0, 2));
    if (hours > 23) {
        input.value = '';
        return;
    }
    if (digits.length < 4) {
        input.value = `${digits.slice(0, 2)}:${digits.slice(2)}`;
        return;
    }
    const minutes = Number(digits.slice(2, 4));
    input.value = minutes > 59 ? '' : `${digits.slice(0, 2)}:${digits.slice(2, 4)} HRS`;
};

[startTimeInput, endTimeInput].forEach((input) => {
    if (input) input.addEventListener('input', () => formatAvailabilityTime(input));
});

const openAvailabilityModal = () => {
    if (!AddAvailabilityModal) return;
    if (AddAvailabilityWrapper && availabilityPath) {
        AddAvailabilityWrapper.style.height = '100%';
        AddAvailabilityWrapper.style.display = 'flex';
    }
    AddAvailabilityModal.style.display = 'flex';
    AddAvailabilityModal.classList.add('is-open');
    if (NoDataSelectedModal_Availability && availabilityPath) {
        NoDataSelectedModal_Availability.style.display = 'none';
    }
    if (NoDataSelectedModal_HR) NoDataSelectedModal_HR.style.display = 'none';
    if (/\/Vessels\/?$/.test(window.location.pathname) && ContentData_Availability) {
        ContentData_Availability.style.background = 'linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab)';
    }
};

const closeAvailabilityModal = (event) => {
    if (event) event.preventDefault();
    if (!AddAvailabilityModal) return;
    AddAvailabilityModal.classList.remove('is-open');
    AddAvailabilityModal.style.display = 'none';
    if (NoDataSelectedModal_Availability && availabilityPath) {
        NoDataSelectedModal_Availability.style.display = 'flex';
    }
    if (NoDataSelectedModal_HR) NoDataSelectedModal_HR.style.display = 'flex';
    if (AddAvailabilityWrapper && availabilityPath) {
        AddAvailabilityWrapper.style.height = 'unset';
        AddAvailabilityWrapper.style.display = 'none';
    }
};

if (CreateAvailabilityButton) CreateAvailabilityButton.addEventListener('click', openAvailabilityModal);
if (CancelButton_Availability) CancelButton_Availability.addEventListener('click', closeAvailabilityModal);

const AddAvailabilityButton = document.querySelector('.AddAvailabilityButton');
const AddAvailabilityForm   = document.querySelector('.AddAvailabilityForm');

// if (!AddAvailabilityButton) return;

if (AddAvailabilityButton && AddAvailabilityForm) {
const fields = ['Vessel', 'Status', 'DoneBy', 'StartTime', 'EndTime', 'StartDate', 'EndDate'];
fields.forEach((name) => {
    const input = AddAvailabilityForm.querySelector(`[name="${name}"]`);
    if (!input) return;
    ['input', 'change'].forEach((eventName) => input.addEventListener(eventName, () => {
        input.closest('.input')?.classList.remove('is-invalid');
    }));
});

AddAvailabilityButton.addEventListener('click', () => {

    const el = {
        error: AddAvailabilityForm.querySelector('.error-availability'),
        vessel: AddAvailabilityForm.querySelector('[name=Vessel]'),
        status: AddAvailabilityForm.querySelector('[name=Status]'),
        doneBy: AddAvailabilityForm.querySelector('[name=DoneBy]'),
        attachment: AddAvailabilityForm.querySelector('[name=Attachment]'),
        startTime: AddAvailabilityForm.querySelector('[name=StartTime]'),
        endTime: AddAvailabilityForm.querySelector('[name=EndTime]'),
        startDate: AddAvailabilityForm.querySelector('[name=StartDate]'),
        endDate: AddAvailabilityForm.querySelector('[name=EndDate]')
    };

    const showError = (message, input = null) => {
        el.error.style.background = '';
        el.error.style.color = '';
        el.error.style.padding = '';
        el.error.textContent = message;
        if (input) {
            const fieldWrapper = input.closest('.input');
            if (fieldWrapper) {
                fieldWrapper.classList.remove('is-invalid');
                void fieldWrapper.offsetWidth;
                fieldWrapper.classList.add('is-invalid');
            }
            input.focus();
        }
    };

    const showProcessing = () => {
        el.error.style.backgroundColor = 'rgb(106, 97, 233)';
        el.error.style.color = '#fff';
        el.error.style.padding = '1em';
        el.error.textContent = 'Creating availability..';

        AddAvailabilityButton.classList.add('is-processing');
        AddAvailabilityButton.disabled = true;
        AddAvailabilityButton.style.backgroundColor = '#1fb95e';
        AddAvailabilityButton.textContent = '+ Processing..';
    };

    const isExcelFile = (filename) =>
        /\.(xlsx|xls|csv)$/i.test(filename);

    const containsLetters = (value) => {
        const cleaned = value.trim().toUpperCase(); 
        const withoutHRS = cleaned.replace(/\s?HRS$/, '');

        return /[A-Z]/.test(withoutHRS);
    };

    // ---------- Trimmed Values ----------
    const data = {
        vessel: el.vessel.value.trim(),
        status: el.status.value.trim(),
        doneBy: el.doneBy.value.trim(),
        attachment: el.attachment.files.length > 0 ? el.attachment.files[0].name : '',
        startTime: el.startTime.value.trim(),
        endTime: el.endTime.value.trim(),
        startDate: el.startDate.value,
        endDate: el.endDate.value
    };

    // =====================================================
    // =============== VALIDATION SECTION ==================
    // =====================================================

    // ---------- Manual Entry Validation ----------
    if (!data.vessel) return showError('Vessel is required.', el.vessel);
    if (!data.doneBy) return showError('Done by field is required.', el.doneBy);
    if (!data.startTime) return showError('Start time cannot be empty.', el.startTime);
    if (!data.endTime) return showError('End time cannot be empty.', el.endTime);
    if (!data.startDate) return showError('Start date cannot be empty.', el.startDate);
    if (!data.endDate) return showError('End date cannot be empty.', el.endDate);
    if (!data.status) return showError('Status is required.', el.status);

    if (data.startDate > data.endDate)
        return showError('Start date cannot be greater than End date.', el.endDate);

    if (data.startTime.length < 5 || data.endTime.length < 5)
        return showError('Start/End Time format is invalid.', data.startTime.length < 5 ? el.startTime : el.endTime);

    if (containsLetters(data.startTime) || containsLetters(data.endTime))
        return showError('Time cannot include alphabets.', containsLetters(data.startTime) ? el.startTime : el.endTime);

    // ---------- File Upload Mode ----------
    if (!data.vessel && data.attachment) {
        if (!isExcelFile(data.attachment))
            return showError('File format must be .xlsx, .xls, or .csv.');
    }

    // =====================================================
    // ================== SUBMISSION =======================
    // =====================================================

    showProcessing();

    const params = new URLSearchParams(data).toString();
    AddAvailabilityForm.setAttribute('action', `/Add/Availability?${params}`);

    AddAvailabilityForm.submit();
});
}
   
    
const TrackingContainer = document.querySelector('.tracking');
 
setInterval(function() { 
    TrackingContainer.scrollTop += 33; 
}, 2000); 
setInterval(function() { 
    if (TrackingContainer.scrollTop + TrackingContainer.clientHeight >= TrackingContainer.scrollHeight) { 
      TrackingContainer.scrollTop = 0;
    }
  }, 2000);

  let Chart4Modal = document.querySelector('.chart-4');
  let Chart4Modal_CloseButton = document.querySelector('.chart-4 .Close');
  let Chart4Modal_Title = document.querySelector('.chart-4 .chart-4-wrapper h2');
  let Chart4Modal_DockingCount = document.querySelector('.chart-4 .chart-4-wrapper .DockingCount small');
  let Chart4Modal_BunkeringCount = document.querySelector('.chart-4 .chart-4-wrapper .BunkeringCount small');
  let Chart4Modal_InspectionCount = document.querySelector('.chart-4 .chart-4-wrapper .InspectionCount small');
  let Chart4Modal_MaintenanceCount = document.querySelector('.chart-4 .chart-4-wrapper .MaintenanceCount small');
  let Chart4Modal_BreakdownCount = document.querySelector('.chart-4 .chart-4-wrapper .BreakdownCount small');
  let Chart4Modal_ReadyCount = document.querySelector('.chart-4 .chart-4-wrapper .ReadyCount small');
  let Chart4Modal_Comment = document.querySelector('.chart-4 .Comment');
  let Chart4Modal_Indicator = document.querySelector('.chart-4 .indicator');
  let __Vessels__ = document.querySelectorAll('.availability .notification-wrapper'); 
 
  __Vessels__.forEach(Vessel => {
    Vessel.addEventListener('click', () => { 
        Chart4Modal.classList.remove('Hide');
        Chart4Modal.style.display = 'flex';
        Chart4Modal_Title.textContent = Vessel.firstElementChild.textContent;
        document.querySelector('.OpenChart4Filter').nextElementSibling.textContent = Chart4Modal_Title.textContent;
        Chart4Modal_DockingCount.textContent = Vessel.firstElementChild.nextElementSibling.textContent + ' day(s) : ' + Vessel.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent  + ' (' + Vessel.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent + '%)';
        Chart4Modal_BunkeringCount.textContent = Vessel.firstElementChild.nextElementSibling.nextElementSibling.textContent + ' day(s) : ' + Vessel.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent  + ' (' + Vessel.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent + '%)';
        Chart4Modal_InspectionCount.textContent = Vessel.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.textContent + ' day(s) : ' + Vessel.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent  + ' (' + Vessel.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent + '%)';
        Chart4Modal_MaintenanceCount.textContent = Vessel.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent + ' day(s) : ' + Vessel.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent  + ' (' + Vessel.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent + '%)';
        Chart4Modal_BreakdownCount.textContent = Vessel.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent + ' day(s) : ' + Vessel.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent  + ' (' + Vessel.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent + '%)';
        Chart4Modal_ReadyCount.textContent = Vessel.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent + ' day(s) : ' + Vessel.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent  + ' (' + Vessel.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent + '%)';
        Chart4Modal_Comment.textContent = Vessel.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
        Chart4Modal_Indicator.firstElementChild.classList.add('status-x');
        console.log(Chart4Modal_InspectionCount)
        Chart4Modal_Indicator.firstElementChild.classList.add(Vessel.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent);
        document.querySelector('.OpenChart4Filter').nextElementSibling.nextElementSibling.textContent = Vessel.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
    })
    Chart4Modal_CloseButton.addEventListener('click', () => {
        Chart4Modal.style.display = 'none';
        Chart4Modal_Indicator.firstElementChild.className = '';
    })
  });
 
  
let open_idashboard = document.querySelector('.open-idashboard');
open_idashboard.addEventListener('click', () => {   
    console.log('Opening Vessel Spotlight Dashboard');
    document.querySelector('.VesselSpotlight').style.display = 'flex';
});