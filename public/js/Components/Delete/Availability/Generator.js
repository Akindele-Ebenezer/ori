let DeleteGeneratorAvailabilityButtons = document.querySelectorAll('.DeleteGeneratorAvailabilityButton');
let GeneratorAvailabilityName = document.querySelector('.generator-availability-name');
let DeleteGeneratorAvailabilityModal = document.querySelector('.DeleteModal.DeleteGeneratorAvailability');
let DeleteGeneratorAvailabilityX = document.querySelector('.DeleteGeneratorAvailabilityX');
let CancelButtonDeleteGeneratorAvailabilitys = document.querySelectorAll('.cancel-button-delete-generator-availability');
 
DeleteGeneratorAvailabilityButtons.forEach(DeleteAvailabilityButton => {
    DeleteAvailabilityButton.addEventListener('click', () => {
        DeleteGeneratorAvailabilityModal.style.display = 'flex'; 
        let AvailabilityId = DeleteAvailabilityButton.parentElement.firstElementChild.textContent;
        GeneratorAvailabilityName.textContent = DeleteAvailabilityButton.parentElement.firstElementChild.nextElementSibling.textContent;

        DeleteGeneratorAvailabilityX.addEventListener('click', () => {
            DeleteGeneratorAvailabilityX.textContent = '+ Deleting..';
            window.location = '/Delete/Availability/Generator/' + AvailabilityId;
        })

        CancelButtonDeleteGeneratorAvailabilitys.forEach(CancelButtonDeleteAvailability => {
            CancelButtonDeleteAvailability.addEventListener('click', () => { 
                DeleteGeneratorAvailabilityModal.style.display = 'none';
            })
        });
    });
});