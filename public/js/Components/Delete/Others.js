let DeleteOthersButtons = document.querySelectorAll('.DeleteOthersButton');
let OthersName = document.querySelector('.others-name');
let DeleteOthersModal = document.querySelector('.DeleteOthers');
let DeleteOthersX = document.querySelector('.DeleteOthersX');
let CancelButtonDeleteOthers = document.querySelectorAll('.cancel-button-delete-others');
 
DeleteOthersButtons.forEach(DeleteOthersButton => {
    DeleteOthersButton.addEventListener('click', () => {
        DeleteOthersModal.style.display = 'flex'; 
        let OthersId = DeleteOthersButton.parentElement.parentElement.firstElementChild.textContent;
        OthersName.textContent =  DeleteOthersButton.parentElement.parentElement.children[1].textContent;

        DeleteOthersX.addEventListener('click', () => {
            DeleteOthersX.textContent = '+ Deleting..';
            window.location = '/Delete/OthersReport/' + OthersId;
        })

        CancelButtonDeleteOthers.forEach(CancelButtonDeleteOther => {
            CancelButtonDeleteOther.addEventListener('click', () => { 
                DeleteOthersModal.style.display = 'none';
            })
        });
    });
});