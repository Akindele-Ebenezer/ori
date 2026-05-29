let CreateAvailabilityButton = document.querySelector('.RecordAvailabilityButton');
let AddAvailabilityModal = document.querySelector('.AddAvailability');
let CancelButton_Availability = document.querySelector('.cancel-button-availability');
let NoDataSelectedModal_Availability = document.querySelector('.no-data-selected.moc');
let ContentData_Availability = document.querySelector('.content-data');
if (window.location.pathname === '/Availability' || window.location.pathname === '/Vessels') { 
    let AddAvailabilityWrapper = document.querySelector('.add-availabilty-wrapper');
    if (CreateAvailabilityButton !== null) {
        CreateAvailabilityButton.addEventListener('click', () => { 
            AddAvailabilityModal.style.display = 'flex';  
            // ContentData_Availability.style.background = 'linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab)'; 
        
            let StartTimeInput = document.querySelector('input[name=StartTime]');
            let EndTimeInput = document.querySelector('input[name=EndTime]');
            StartTimeInput.addEventListener('keyup', () => {
                if (!isNaN(parseFloat(StartTimeInput.value))) {
                    if (StartTimeInput.value.length == 2) { 
                        StartTimeInput.value += ':';  
                        if (StartTimeInput.value.substring(0, 2) > 23) { 
                            StartTimeInput.value = '';  
                        }
                    } 
                    if (StartTimeInput.value.length == 5) { 
                        if (StartTimeInput.value.substring(3, 5) > 59) { 
                            StartTimeInput.value = '';  
                        } else {
                            StartTimeInput.value += ' HRS';   
                        }
                    }
                } else {
                    StartTimeInput.value = '';   
                }
            });
            EndTimeInput.addEventListener('keyup', () => {
                if (!isNaN(parseFloat(EndTimeInput.value))) {
                    if (EndTimeInput.value.length == 2) { 
                        EndTimeInput.value += ':';
                        if (EndTimeInput.value.substring(0, 2) > 23) {
                            EndTimeInput.value = '';  
                        }  
                    } 
                    if (EndTimeInput.value.length == 5) { 
                        if (EndTimeInput.value.substring(3, 5) > 59) { 
                            EndTimeInput.value = '';  
                        } else {
                            EndTimeInput.value += ' HRS';
                        }
                    }
                } else {
                    EndTimeInput.value = '';  
                }
            });

            CancelButton_Availability.addEventListener('click', () => {
                AddAvailabilityModal.style.display = 'none';
                NoDataSelectedModal_Availability.style.display = 'flex';
                if (NoDataSelectedModal_HR !== null) {
                    NoDataSelectedModal_HR.style.display = 'flex'; 
                }
                if (window.location.pathname === '/Availability' || window.location.pathname === '/Vessels') { 
                    AddAvailabilityWrapper.style.height = 'unset'; 
                }
            }) 
        }); 
    }
}
 
if (CreateAvailabilityButton !== null) {
    CreateAvailabilityButton.addEventListener('click', () => { 
        if (window.location.pathname === '/Availability' || window.location.pathname === '/Vessels') { 
            AddAvailabilityWrapper.style.height = '100%';
            AddAvailabilityWrapper.style.display = 'flex'; 
        }
        AddAvailabilityModal.style.display = 'flex';  
        if (window.location.pathname === '/Availability' || window.location.pathname === '/Vessels') { 
            NoDataSelectedModal_Availability.style.display = 'none'; 
            ContentData_Availability.style.background = 'linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab)'; 
        }
        if (NoDataSelectedModal_HR !== null) {
            NoDataSelectedModal_HR.style.display = 'none';  
        }
        
        CancelButton_Availability.addEventListener('click', () => {
            AddAvailabilityModal.style.display = 'none';
            if (window.location.pathname === '/Availability' || window.location.pathname === '/Vessels') { 
                NoDataSelectedModal_Availability.style.display = 'flex';
                AddAvailabilityWrapper.style.height = 'unset'; 
            }
            if (NoDataSelectedModal_HR !== null) {
                NoDataSelectedModal_HR.style.display = 'flex';   
            }
        }) 
    }); 
}

const AddAvailabilityButton = document.querySelector('.AddAvailabilityButton');
const AddAvailabilityForm   = document.querySelector('.AddAvailabilityForm');

// if (!AddAvailabilityButton) return;

AddAvailabilityButton.addEventListener('click', () => {

    const el = {
        error: document.querySelector('.error-availability'),
        vessel: document.querySelector('[name=Vessel]'),
        status: document.querySelector('[name=Status]'),
        doneBy: document.querySelector('[name=DoneBy]'),
        attachment: document.querySelector('[name=Attachment]'),
        startTime: document.querySelector('[name=StartTime]'),
        endTime: document.querySelector('[name=EndTime]'),
        startDate: document.querySelector('[name=StartDate]'),
        endDate: document.querySelector('[name=EndDate]')
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
        el.error.textContent = 'Creating availability..';

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
        attachment: el.attachment.value.trim(),
        startTime: el.startTime.value.trim(),
        endTime: el.endTime.value.trim(),
        startDate: el.startDate.value,
        endDate: el.endDate.value
    };

    // =====================================================
    // =============== VALIDATION SECTION ==================
    // =====================================================

    // Attachment required only if manual entry empty
    if (!data.vessel && !data.attachment) {
        return showError('Attachment is required or fill other fields manually.');
    }

    // ---------- Manual Entry Mode ----------
    if (data.vessel) {

        if (!data.startTime) return showError('Start time cannot be empty.');
        if (!data.endTime)   return showError('End time cannot be empty.');
        if (!data.status)    return showError('Status is required.');
        if (!data.doneBy)    return showError('Done by field is required.');
        if (!data.startDate) return showError('Start date cannot be empty.');
        if (!data.endDate)   return showError('End date cannot be empty.');

        if (data.startDate > data.endDate)
            return showError('Start date cannot be greater than End date.');

        if (data.startTime.length < 5 || data.endTime.length < 5)
            return showError('Start/End Time format is invalid.');

        if (containsLetters(data.startTime) || containsLetters(data.endTime))
            return showError('Time cannot include alphabets.');
    }

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