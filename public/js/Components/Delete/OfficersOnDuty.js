let DeleteOfficersOnDutyButtons = document.querySelectorAll('.DeleteOfficersOnDutyButton');
let OfficersOnDutyName = document.querySelector('.officers-on-duty-name');
let DeleteOfficersOnDutyModal = document.querySelector('.DeleteOfficersOnDuty');
let DeleteOfficersOnDutyX = document.querySelector('.DeleteOfficersOnDutyX');
let CancelButtonDeleteOfficersOnDuties = document.querySelectorAll('.cancel-button-delete-officers-on-duty');
 
DeleteOfficersOnDutyButtons.forEach(DeleteOfficersOnDutyButton => {
    DeleteOfficersOnDutyButton.addEventListener('click', () => {
        DeleteOfficersOnDutyModal.style.display = 'flex'; 
        let OfficersOnDutyId = DeleteOfficersOnDutyButton.parentElement.parentElement.firstElementChild.textContent;
        OfficersOnDutyName.textContent =  DeleteOfficersOnDutyButton.parentElement.parentElement.children[1].textContent;

        DeleteOfficersOnDutyX.addEventListener('click', () => {
            DeleteOfficersOnDutyX.textContent = '+ Deleting..';
            window.location = '/Delete/OfficersOnDutyReport/' + OfficersOnDutyId;
        })

        CancelButtonDeleteOfficersOnDuties.forEach(CancelButtonDeleteOfficersOnDuty => {
            CancelButtonDeleteOfficersOnDuty.addEventListener('click', () => { 
                DeleteOfficersOnDutyModal.style.display = 'none';
            })
        });
    });
});