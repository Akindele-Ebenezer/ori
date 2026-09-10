let DeleteDevicesButtons = document.querySelectorAll('.DeleteDevicesButton');
let DevicesName = document.querySelector('.devices-name');
let DeleteDevicesModal = document.querySelector('.DeleteDevices');
let DeleteDevicesX = document.querySelector('.DeleteDevicesX');
let CancelButtonDeleteDevices = document.querySelectorAll('.cancel-button-delete-devices');
 
DeleteDevicesButtons.forEach(DeleteDevicesButton => {
    DeleteDevicesButton.addEventListener('click', () => {
        DeleteDevicesModal.style.display = 'flex'; 
        let DevicesId = DeleteDevicesButton.parentElement.parentElement.firstElementChild.textContent;
        DevicesName.textContent = DeleteDevicesButton.parentElement.parentElement.children[1].textContent; 

        DeleteDevicesX.addEventListener('click', () => {
            DeleteDevicesX.textContent = '+ Deleting..';
            window.location = '/Delete/DevicesReport/' + DevicesId;
        })

        CancelButtonDeleteDevices.forEach(CancelButtonDeleteDevices => {
            CancelButtonDeleteDevices.addEventListener('click', () => { 
                DeleteDevicesModal.style.display = 'none';
            })
        });
    });
});