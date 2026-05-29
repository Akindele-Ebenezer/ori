let EditGeneratorAvailability_Icons = document.querySelectorAll('.EditGeneratorAvailability_Icon');
let UpdateGeneratorAvailabilityModal = document.querySelector('.UpdateGeneratorAvailability');
let UpdateGeneratorAvailabilityForm = document.querySelector('.UpdateGeneratorAvailabilityForm');
let CloseGeneratorAvailabilityButton_Edit = document.querySelector('.close-button-update-generator-availability');
let UpdateGeneratorAvailabilityButton = document.querySelector('.UpdateGeneratorAvailabilityButton');
let ErrorGeneratorAvailability_Edit = document.querySelector('.error-generator-availability.update');
let GeneratorInput_GeneratorAvailability_Edit = document.querySelector('.UpdateGeneratorAvailability input[name=EditGenerator]');
let StatusInput_GeneratorAvailability_Edit = document.querySelector('.UpdateGeneratorAvailability select[name=EditStatus]');
let DoneByInput_GeneratorAvailability_Edit = document.querySelector('.UpdateGeneratorAvailability input[name=EditDoneBy]');
let RemarksInput_GeneratorAvailability_Edit = document.querySelector('.UpdateGeneratorAvailability input[name=EditRemarks]');
let StartTimeInput_GeneratorAvailability_Edit = document.querySelector('.UpdateGeneratorAvailability input[name=EditStartTime]');
let EndTimeInput_GeneratorAvailability_Edit = document.querySelector('.UpdateGeneratorAvailability input[name=EditEndTime]');
let StartDateInput_GeneratorAvailability_Edit = document.querySelector('.UpdateGeneratorAvailability input[name=EditStartDate]');
let EndDateInput_GeneratorAvailability_Edit = document.querySelector('.UpdateGeneratorAvailability input[name=EditEndDate]');
let TillNowInput_GeneratorAvailability_Edit = document.querySelector('.UpdateGeneratorAvailability select[name=EditTillNow]');

EditGeneratorAvailability_Icons.forEach(Icon => {
    Icon.addEventListener('click', () => {
        UpdateGeneratorAvailabilityModal.style.display = 'flex';
        UpdateGeneratorAvailabilityModal.style.zIndex = '210';

        let GeneratorAvailabilityId = Icon.parentElement.firstElementChild.textContent;
        document.querySelector('.UpdateGeneratorAvailability input[name=EditEngineMake]').value = Icon.parentElement.parentElement.firstElementChild.textContent;
        document.querySelector('.UpdateGeneratorAvailability input[name=EditGenerator]').value = Icon.parentElement.parentElement.firstElementChild.textContent;
        document.querySelector('.UpdateGeneratorAvailability select[name=EditStatus]').value = Icon.nextElementSibling.nextElementSibling.textContent;
        document.querySelector('.UpdateGeneratorAvailability input[name=EditDoneBy]').value = Icon.parentElement.parentElement.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
        document.querySelector('.UpdateGeneratorAvailability input[name=EditRemarks]').value = Icon.parentElement.parentElement.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
        document.querySelector('.UpdateGeneratorAvailability input[name=EditStartDate]').value = Icon.parentElement.parentElement.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
        document.querySelector('.UpdateGeneratorAvailability input[name=EditStartTime]').value = Icon.parentElement.parentElement.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent + ' HRS';
        document.querySelector('.UpdateGeneratorAvailability input[name=EditEndDate]').value = Icon.parentElement.parentElement.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
        document.querySelector('.UpdateGeneratorAvailability input[name=EditEndTime]').value = Icon.parentElement.parentElement.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent + ' HRS';
        document.querySelector('.UpdateGeneratorAvailability select[name=EditTillNow]').value = Icon.parentElement.parentElement.firstElementChild.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;

        UpdateGeneratorAvailabilityButton.addEventListener('click', () => {
            if (GeneratorInput_GeneratorAvailability_Edit.value == '') {
                ErrorGeneratorAvailability_Edit.textContent =  'Generator field cannot be empty..';
            } else if ((StartTimeInput_GeneratorAvailability_Edit.value.length < 9) || (EndTimeInput_GeneratorAvailability_Edit.value.length < 9)) {
                ErrorGeneratorAvailability_Edit.textContent =  'Value of Start/End Time not correct.. kindly clear and re-enter correct value';
            } else if (StatusInput_GeneratorAvailability_Edit.value.trim() == '') { 
                ErrorGeneratorAvailability_Edit.textContent =  'Status is required';
            } else if (DoneByInput_GeneratorAvailability_Edit.value.trim() == '') { 
                ErrorGeneratorAvailability_Edit.textContent =  'Done by field is required';
            } else if (StartTimeInput_GeneratorAvailability_Edit.value == '') { 
                ErrorGeneratorAvailability_Edit.textContent =  'Start time cannot be empty';
            } else if (EndTimeInput_GeneratorAvailability_Edit.value == '') { 
                ErrorGeneratorAvailability_Edit.textContent =  'End time cannot be empty';
            } else if (StartDateInput_GeneratorAvailability_Edit.value > EndDateInput_GeneratorAvailability_Edit.value) { 
                ErrorGeneratorAvailability_Edit.textContent =  'Start date cannot be greater than End date';
            } else if (StartDateInput_GeneratorAvailability_Edit.value == '') { 
                ErrorGeneratorAvailability_Edit.textContent =  'Start date cannot be empty';
            } else if (EndDateInput_GeneratorAvailability_Edit.value == '') { 
                ErrorGeneratorAvailability_Edit.textContent =  'End date cannot be empty';
            } else if (
                /[a-zA-Z]/.test(StartTimeInput_GeneratorAvailability_Edit.value.substring(0, 6)) ||
                /[a-zA-Z]/.test(EndTimeInput_GeneratorAvailability_Edit.value.substring(0, 6))
            ) {
                ErrorGeneratorAvailability_Edit.textContent =  'Time cannot include alphabets';
            // } else if (dateToCheck < today) { 
            //     ErrorGeneratorAvailability_Edit.textContent =  'Start Date is not today.. Contact the administrator to add this availability from the database.';
            } else {
                ErrorGeneratorAvailability_Edit.style.backgroundColor =  'rgb(106, 97, 233)';
                ErrorGeneratorAvailability_Edit.style.color =  '#fff';
                ErrorGeneratorAvailability_Edit.style.padding =  '1em';
                ErrorGeneratorAvailability_Edit.textContent = 'Updating availability..';
                UpdateGeneratorAvailabilityButton.style.backgroundColor = '#1fb95e';
                UpdateGeneratorAvailabilityButton.textContent = '+ Processing..'; 
                UpdateGeneratorAvailabilityForm.setAttribute('action', '/Edit/Availability/Generator/' + GeneratorAvailabilityId);
                UpdateGeneratorAvailabilityForm.submit();
            }
        })
        
        // let StartTimeInput_GeneratorAvailability_Edit = document.querySelector('.UpdateGeneratorAvailabilityForm input[name=StartTime]');
        // let EndTimeInput_GeneratorAvailability_Edit = document.querySelector('.UpdateGeneratorAvailabilityForm input[name=EndTime]');
        StartTimeInput_GeneratorAvailability_Edit.addEventListener('keyup', () => {
            if (!isNaN(parseFloat(StartTimeInput_GeneratorAvailability_Edit.value))) {
                if (StartTimeInput_GeneratorAvailability_Edit.value.length == 2) { 
                    StartTimeInput_GeneratorAvailability_Edit.value += ':';  
                    if (StartTimeInput_GeneratorAvailability_Edit.value.substring(0, 2) > 23) { 
                        StartTimeInput_GeneratorAvailability_Edit.value = '';  
                    }
                } 
                if (StartTimeInput_GeneratorAvailability_Edit.value.length == 5) { 
                    if (StartTimeInput_GeneratorAvailability_Edit.value.substring(3, 5) > 59) { 
                        StartTimeInput_GeneratorAvailability_Edit.value = '';  
                    } else {
                        StartTimeInput_GeneratorAvailability_Edit.value += ' HRS';   
                    }
                }
            } else {
                StartTimeInput_GeneratorAvailability_Edit.value = '';   
            }
        });
        EndTimeInput_GeneratorAvailability_Edit.addEventListener('keyup', () => {
            if (!isNaN(parseFloat(EndTimeInput_GeneratorAvailability_Edit.value))) {
                if (EndTimeInput_GeneratorAvailability_Edit.value.length == 2) { 
                    EndTimeInput_GeneratorAvailability_Edit.value += ':';
                    if (EndTimeInput_GeneratorAvailability_Edit.value.substring(0, 2) > 23) {
                        EndTimeInput_GeneratorAvailability_Edit.value = '';  
                    }  
                } 
                if (EndTimeInput_GeneratorAvailability_Edit.value.length == 5) { 
                    if (EndTimeInput_GeneratorAvailability_Edit.value.substring(3, 5) > 59) { 
                        EndTimeInput_GeneratorAvailability_Edit.value = '';  
                    } else {
                        EndTimeInput_GeneratorAvailability_Edit.value += ' HRS';
                    }
                }
            } else {
                EndTimeInput_GeneratorAvailability_Edit.value = '';  
            }
        });

        CloseGeneratorAvailabilityButton_Edit.addEventListener('click', () => {
            UpdateGeneratorAvailabilityModal.style.display = 'none';
        })
    })
});


