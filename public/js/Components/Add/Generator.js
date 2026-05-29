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

let ToggleGenerators_Icon = document.querySelectorAll('.ToggleGenerators_Icon');
let Generators_ = document.querySelectorAll('.generators_');

ToggleGenerators_Icon.forEach(Icon => {
    Icon.addEventListener('click', () => {
        Generators_.forEach(Generators => {
            Generators.classList.toggle('Hide');
        });
    })
});
let ToggleVessels_Icon = document.querySelectorAll('.ToggleVessels_Icon');
let Vessels_ = document.querySelectorAll('.vessels_');

ToggleVessels_Icon.forEach(Icon => {
    Icon.addEventListener('click', () => {
        Vessels_.forEach(Vessels => {
            Vessels.classList.toggle('Hide');
        });
    })
});
