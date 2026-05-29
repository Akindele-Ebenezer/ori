let DisplayGeneratorAvailabilityFormButton = document.querySelector('.DisplayGeneratorAvailabilityFormButton');
let AddGeneratorAvailabilityModal = document.querySelector('.AddGeneratorAvailability');
let AddGeneratorAvailabilityForm = document.querySelector('.AddGeneratorAvailabilityForm');
let CloseGeneratorAvailabilityButton = document.querySelector('.cancel-button-generator-availability');
let AddGeneratorAvailabilityButton = document.querySelector('.AddGeneratorAvailabilityButton');
let ErrorGeneratorAvailability = document.querySelector('.error-generator-availability');
let GeneratorInput_GeneratorAvailability = document.querySelector('.AddGeneratorAvailability input[name=Generator]');
let StatusInput_GeneratorAvailability = document.querySelector('.AddGeneratorAvailability select[name=Status]');
let DoneByInput_GeneratorAvailability = document.querySelector('.AddGeneratorAvailability input[name=DoneBy]');
let RemarksInput_GeneratorAvailability = document.querySelector('.AddGeneratorAvailability input[name=Remarks]');
let StartTimeInput_GeneratorAvailability = document.querySelector('.AddGeneratorAvailability input[name=StartTime]');
let EndTimeInput_GeneratorAvailability = document.querySelector('.AddGeneratorAvailability input[name=EndTime]');
let StartDateInput_GeneratorAvailability = document.querySelector('.AddGeneratorAvailability input[name=StartDate]');
let EndDateInput_GeneratorAvailability = document.querySelector('.AddGeneratorAvailability input[name=EndDate]');
let TillNowInput_GeneratorAvailability = document.querySelector('.AddGeneratorAvailability select[name=TillNow]');

DisplayGeneratorAvailabilityFormButton.addEventListener('click', () => {
    AddGeneratorAvailabilityModal.style.display = 'flex';
    AddGeneratorAvailabilityModal.style.zIndex = '210';

    AddGeneratorAvailabilityButton.addEventListener('click', () => {
        if (GeneratorInput_GeneratorAvailability.value == '') {
            ErrorGeneratorAvailability.textContent =  'Generator field cannot be empty..';
        } else if ((StartTimeInput_GeneratorAvailability.value.length < 9) || (EndTimeInput_GeneratorAvailability.value.length < 9)) {
            ErrorGeneratorAvailability.textContent =  'Value of Start/End Time not correct.. kindly clear and re-enter correct value';
        } else if (StatusInput_GeneratorAvailability.value.trim() == '') { 
            ErrorGeneratorAvailability.textContent =  'Status is required';
        } else if (DoneByInput_GeneratorAvailability.value.trim() == '') { 
            ErrorGeneratorAvailability.textContent =  'Done by field is required';
        } else if (StartTimeInput_GeneratorAvailability.value == '') { 
            ErrorGeneratorAvailability.textContent =  'Start time cannot be empty';
        } else if (EndTimeInput_GeneratorAvailability.value == '') { 
            ErrorGeneratorAvailability.textContent =  'End time cannot be empty';
        } else if (StartDateInput_GeneratorAvailability.value > EndDateInput_GeneratorAvailability.value) { 
            ErrorGeneratorAvailability.textContent =  'Start date cannot be greater than End date';
        } else if (StartDateInput_GeneratorAvailability.value == '') { 
            ErrorGeneratorAvailability.textContent =  'Start date cannot be empty';
        } else if (EndDateInput_GeneratorAvailability.value == '') { 
            ErrorGeneratorAvailability.textContent =  'End date cannot be empty';
        } else if (
            /[a-zA-Z]/.test(StartTimeInput_GeneratorAvailability.value.substring(0, 6)) ||
            /[a-zA-Z]/.test(EndTimeInput_GeneratorAvailability.value.substring(0, 6))
        ) {
            ErrorGeneratorAvailability.textContent =  'Time cannot include alphabets';
        // } else if (dateToCheck < today) { 
        //     ErrorGeneratorAvailability.textContent =  'Start Date is not today.. Contact the administrator to add this availability from the database.';
        } else {
            ErrorGeneratorAvailability.style.backgroundColor =  'rgb(106, 97, 233)';
            ErrorGeneratorAvailability.style.color =  '#fff';
            ErrorGeneratorAvailability.style.padding =  '1em';
            ErrorGeneratorAvailability.textContent = 'Creating availability..';
            AddGeneratorAvailabilityButton.style.backgroundColor = '#1fb95e';
            AddGeneratorAvailabilityButton.textContent = '+ Processing..'; 
            AddGeneratorAvailabilityForm.setAttribute('action', '/Add/Availability/Generator');
            AddGeneratorAvailabilityForm.submit();
        }
    })
    
    let StartTimeInput_GeneratorAvailability_GeneratorAvailability = document.querySelector('.AddGeneratorAvailabilityForm input[name=StartTime]');
    let EndTimeInput_GeneratorAvailability_GeneratorAvailability = document.querySelector('.AddGeneratorAvailabilityForm input[name=EndTime]');
    StartTimeInput_GeneratorAvailability_GeneratorAvailability.addEventListener('keyup', () => {
        if (!isNaN(parseFloat(StartTimeInput_GeneratorAvailability_GeneratorAvailability.value))) {
            if (StartTimeInput_GeneratorAvailability_GeneratorAvailability.value.length == 2) { 
                StartTimeInput_GeneratorAvailability_GeneratorAvailability.value += ':';  
                if (StartTimeInput_GeneratorAvailability_GeneratorAvailability.value.substring(0, 2) > 23) { 
                    StartTimeInput_GeneratorAvailability_GeneratorAvailability.value = '';  
                }
            } 
            if (StartTimeInput_GeneratorAvailability_GeneratorAvailability.value.length == 5) { 
                if (StartTimeInput_GeneratorAvailability_GeneratorAvailability.value.substring(3, 5) > 59) { 
                    StartTimeInput_GeneratorAvailability_GeneratorAvailability.value = '';  
                } else {
                    StartTimeInput_GeneratorAvailability_GeneratorAvailability.value += ' HRS';   
                }
            }
        } else {
            StartTimeInput_GeneratorAvailability_GeneratorAvailability.value = '';   
        }
    });
    EndTimeInput_GeneratorAvailability_GeneratorAvailability.addEventListener('keyup', () => {
        if (!isNaN(parseFloat(EndTimeInput_GeneratorAvailability_GeneratorAvailability.value))) {
            if (EndTimeInput_GeneratorAvailability_GeneratorAvailability.value.length == 2) { 
                EndTimeInput_GeneratorAvailability_GeneratorAvailability.value += ':';
                if (EndTimeInput_GeneratorAvailability_GeneratorAvailability.value.substring(0, 2) > 23) {
                    EndTimeInput_GeneratorAvailability_GeneratorAvailability.value = '';  
                }  
            } 
            if (EndTimeInput_GeneratorAvailability_GeneratorAvailability.value.length == 5) { 
                if (EndTimeInput_GeneratorAvailability_GeneratorAvailability.value.substring(3, 5) > 59) { 
                    EndTimeInput_GeneratorAvailability_GeneratorAvailability.value = '';  
                } else {
                    EndTimeInput_GeneratorAvailability_GeneratorAvailability.value += ' HRS';
                }
            }
        } else {
            EndTimeInput_GeneratorAvailability_GeneratorAvailability.value = '';  
        }
    });

    CloseGeneratorAvailabilityButton.addEventListener('click', () => {
        AddGeneratorAvailabilityModal.style.display = 'none';
    })
})

