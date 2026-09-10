let DeleteOfficersOnDutyButtons = document.querySelectorAll('.DeleteOfficersOnDutyButton');
let OfficersOnDutyName = document.querySelector('.officers-on-duty-name');
let DeleteOfficersOnDutyModal = document.querySelector('.DeleteOfficersOnDuty');
let DeleteOfficersOnDutyX = document.querySelector('.DeleteOfficersOnDutyX');
let CancelButtonDeleteOfficersOnDuties = document.querySelectorAll('.cancel-button-delete-officers-on-duty');
let selectedOfficersOnDutyId = null;
 
DeleteOfficersOnDutyButtons.forEach(DeleteOfficersOnDutyButton => {
    DeleteOfficersOnDutyButton.addEventListener('click', () => {
        DeleteOfficersOnDutyModal.style.display = 'flex'; 
        selectedOfficersOnDutyId = DeleteOfficersOnDutyButton.parentElement.parentElement.firstElementChild.textContent.trim();
        OfficersOnDutyName.textContent = DeleteOfficersOnDutyButton.parentElement.parentElement.children[3].textContent;
    });
});

DeleteOfficersOnDutyX.addEventListener('click', () => {
    if (!selectedOfficersOnDutyId) return;
    DeleteOfficersOnDutyX.textContent = '+ Deleting..';
    window.location = '/Delete/OfficersOnDutyReport/' + encodeURIComponent(selectedOfficersOnDutyId);
});

CancelButtonDeleteOfficersOnDuties.forEach((button) => {
    button.addEventListener('click', () => {
        selectedOfficersOnDutyId = null;
        DeleteOfficersOnDutyModal.style.display = 'none';
    });
});