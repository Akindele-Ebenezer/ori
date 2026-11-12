let AddGeneratorButton = document.querySelector('.AddGeneratorButton');
let AddGeneratorButtonX = document.querySelector('.AddGeneratorButtonX');
let AddGeneratorModal = document.querySelector('.AddGenerator');
let AddGeneratorForm = document.querySelector('.AddGeneratorForm');
let CancelGeneratorFormButton = document.querySelector('.close-generator-form-button');
 
AddGeneratorButton.addEventListener('click', () => {
    AddGeneratorModal.style.display = 'flex';

    AddGeneratorButtonX.addEventListener('click', () => {
        let ErrorGenerator = document.querySelector('.error-generator');
        let EngineMakeInput = document.querySelector('input[name=EngineMake]');
    
        if (EngineMakeInput.value.trim() == '') { 
            ErrorGenerator.textContent =  'Generator\'s engine make field cannot be empty';
        } else { 
            AddGeneratorButtonX.style.backgroundColor = '#1fb95e';
            AddGeneratorButtonX.textContent = '+ Creating..';
            AddGeneratorForm.setAttribute('action', '/Add/Generator');
            AddGeneratorForm.submit();
        }
    })

    CancelGeneratorFormButton.addEventListener('click', () => {
        AddGeneratorModal.style.display = 'none';
    })
});

document.addEventListener('click', (event) => {
    if (!(event.target instanceof Element)) return;

    if (event.target.closest('.ToggleGenerators_Icon')) {
        document.querySelectorAll('.generators_').forEach((generator) => {
            generator.classList.toggle('Hide');
        });
    }

    if (event.target.closest('.ToggleVessels_Icon')) {
        document.querySelectorAll('.vessels_').forEach((vessel) => {
            vessel.classList.toggle('Hide');
        });
    }
});
