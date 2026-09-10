let DeleteRadioBroadcastButtons = document.querySelectorAll('.DeleteRadioBroadcastButton');
let RadioBroadcastName = document.querySelector('.radio-broadcast-name');
let DeleteRadioBroadcastModal = document.querySelector('.DeleteRadioBroadcast');
let DeleteRadioBroadcastX = document.querySelector('.DeleteRadioBroadcastX');
let CancelButtonDeleteRadioBroadcasts = document.querySelectorAll('.cancel-button-delete-radio-broadcast');
 
DeleteRadioBroadcastButtons.forEach(DeleteRadioBroadcastButton => {
    DeleteRadioBroadcastButton.addEventListener('click', () => {
        DeleteRadioBroadcastModal.style.display = 'flex'; 
        let RadioBroadcastId = DeleteRadioBroadcastButton.parentElement.parentElement.firstElementChild.textContent;
        RadioBroadcastName.textContent = DeleteRadioBroadcastButton.parentElement.parentElement.firstElementChild.nextElementSibling.textContent;

        DeleteRadioBroadcastX.addEventListener('click', () => {
            DeleteRadioBroadcastX.textContent = '+ Deleting..';
            window.location = '/Delete/RadioBroadcastReport/' + RadioBroadcastId;
        })

        CancelButtonDeleteRadioBroadcasts.forEach(CancelButtonDeleteRadioBroadcast => {
            CancelButtonDeleteRadioBroadcast.addEventListener('click', () => { 
                DeleteRadioBroadcastModal.style.display = 'none';
            })
        });
    });
});