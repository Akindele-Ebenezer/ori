let EditGeneratorButtons = document.querySelectorAll('._generator_');
let EditGeneratorButtonX = document.querySelector('.EditGeneratorButtonX');
let EditGeneratorModal = document.querySelector('.EditGenerator');
let EditGeneratorForm = document.querySelector('.EditGeneratorForm');
let CancelEditGeneratorFormButton = document.querySelector('.close-edit-generator-form-button');
 
EditGeneratorButtons.forEach(EditGeneratorButton => {
    EditGeneratorButton.addEventListener('click', () => {
        document.querySelector('.chart-4').style.display = 'none';
        EditGeneratorModal.style.display = 'flex';

        document.querySelector('.EditGenerator input[name=Priority_InternalNo]').value = EditGeneratorButton.nextElementSibling.textContent;
        document.querySelector('.EditGenerator input[name=EngineMake]').value = EditGeneratorButton.nextElementSibling.nextElementSibling.textContent;
        document.querySelector('.EditGenerator input[name=Model]').value = EditGeneratorButton.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
        document.querySelector('.EditGenerator input[name=SN]').value = EditGeneratorButton.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
        document.querySelector('.EditGenerator input[name=EngineType]').value = EditGeneratorButton.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
        document.querySelector('.EditGenerator input[name=Location]').value = EditGeneratorButton.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
        document.querySelector('.EditGenerator input[name=Remarks]').value = EditGeneratorButton.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
        document.querySelector('.EditGenerator select[name=Company]').value = EditGeneratorButton.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
        document.querySelector('.EditGenerator select[name=Class]').value = EditGeneratorButton.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
        document.querySelector('.EditGenerator input[name=UsedBy]').value = EditGeneratorButton.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
        document.querySelector('.EditGenerator input[name=Power]').value = EditGeneratorButton.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
        document.querySelector('.EditGenerator select[name=MachineType]').value = EditGeneratorButton.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
        let EditGeneratorId = EditGeneratorButton.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent;
 
        EditGeneratorButtonX.addEventListener('click', () => {
            let ErrorEditGenerator = document.querySelector('.EditGenerator .error-generator');
            let EngineMakeInput = document.querySelector('.EditGenerator input[name=EngineMake]');
        
            if (EngineMakeInput.value.trim() == '') { 
                ErrorEditGenerator.textContent =  'Generator\'s engine make field cannot be empty';
            } else { 
                EditGeneratorButtonX.style.backgroundColor = '#1fb95e';
                EditGeneratorButtonX.textContent = '+ Updating..';
                EditGeneratorForm.setAttribute('action', '/Edit/Generator/' + EditGeneratorId);
                EditGeneratorForm.submit();
            }
        })
    
        CancelEditGeneratorFormButton.addEventListener('click', () => {
            EditGeneratorModal.style.display = 'none';
        })
    }); 
});