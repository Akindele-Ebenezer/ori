let EditVesselButtons = document.querySelectorAll('.EditVesselButton'); 
let EditVesselModal = document.querySelector('.EditVessel');
let UpdateVesselButton = document.querySelector('.UpdateVesselButton');
let EditVesselForm = document.querySelector('.EditVesselForm');
let CancelButtonUpdate = document.querySelector('.cancel-button-update-vessel');
 
EditVesselButtons.forEach(EditVesselButton => {
    EditVesselButton.addEventListener('click', () => {
        let ERROR_X_Wrapper = document.querySelector('.error-x-wrapper');
        let ERROR_X = document.querySelector('.error-x');
        if (EditVesselButton.classList.contains("update-vessel-privilege-denied")) {
            
            ERROR_X_Wrapper.style.display = 'flex';  
            ERROR_X.textContent = 'Access denied to update a vessel.. contact an administrator!';
            setTimeout(() => {
                ERROR_X_Wrapper.style.display = 'none';  
            }, 3000);
        } else {
            EditVesselModal.style.display = 'flex';
        }
        const H = EditVesselButton.parentElement.parentElement.parentElement.getElementsByClassName('Hide');

        document.querySelector('.EditVessel input[name=EditVesselName]').value = H[0].textContent;
        document.querySelector('.EditVessel input[name=EditImoNumber]').value  = H[1].textContent;
        document.querySelector('.EditVessel input[name=EditCallSign]').value   = H[2].textContent;
        document.querySelector('.EditVessel input[name=EditFlag]').value       = H[3].textContent;
        document.querySelector('.EditVessel input[name=EditPortOfRegistry]').value = H[4].textContent;
        document.querySelector('.EditVessel input[name=EditRegistrationNumber]').value = H[5].textContent;
        document.querySelector('.EditVessel input[name=EditLoa]').value  = H[6].textContent;
        document.querySelector('.EditVessel input[name=EditBoa]').value  = H[7].textContent;
        document.querySelector('.EditVessel input[name=EditDepthMoulded]').value = H[8].textContent;
        document.querySelector('.EditVessel input[name=EditSummerLoadDraught]').value = H[9].textContent;
        document.querySelector('.EditVessel input[name=EditLpp]').value = H[10].textContent;
        document.querySelector('.EditVessel input[name=EditOwner]').value   = H[11].textContent;
        document.querySelector('.EditVessel input[name=EditBuilder]').value = H[12].textContent;
        document.querySelector('.EditVessel input[name=EditDateKeelLaid]').value = H[13].textContent;
        document.querySelector('.EditVessel input[name=EditDateOfBuild]').value  = H[14].textContent;
        document.querySelector('.EditVessel input[name=EditPlaceOfBuild]').value = H[15].textContent;
        document.querySelector('.EditVessel input[name=EditMaterial]').value   = H[16].textContent;
        document.querySelector('.EditVessel input[name=EditYardNumber]').value = H[17].textContent;
        document.querySelector('.EditVessel input[name=EditTypesOfEngines]').value = H[18].textContent;
        document.querySelector('.EditVessel input[name=EditNumberOfEngines]').value = H[19].textContent;
        document.querySelector('.EditVessel input[name=EditNumberOfCyliners]').value = H[20].textContent;
        document.querySelector('.EditVessel input[name=EditEngineOutput]').value = H[21].textContent;
        document.querySelector('.EditVessel input[name=EditEngineMakers]').value  = H[22].textContent;
        document.querySelector('.EditVessel input[name=EditYearOfEngineBuilt]').value = H[23].textContent;
        document.querySelector('.EditVessel input[name=EditPlaceEnginesBuilt]').value = H[24].textContent;
        document.querySelector('.EditVessel input[name=EditDiametermm]').value = H[25].textContent;
        document.querySelector('.EditVessel input[name=EditLengthOfStrokemm]').value = H[26].textContent;
        document.querySelector('.EditVessel input[name=EditGrossTonnage]').value = H[27].textContent;
        document.querySelector('.EditVessel input[name=EditNetTonnage]').value   = H[28].textContent;
        document.querySelector('.EditVessel select[name=EditCompany]').value    = H[29].textContent;
        document.querySelector('.EditVessel select[name=EditVesselType]').value = H[30].textContent;
        document.querySelector('.EditVessel input[name=EditCaptain]').value     = H[31].textContent;
        document.querySelector('.EditVessel input[name=EditROB]').value = H[32].textContent;
        document.querySelector('.EditVessel select[name=EditArea]').value = H[33].textContent;
        document.querySelector('.EditVessel input[name=EditTankCapacity]').value = H[35].textContent;
        document.querySelector('.EditVessel input[name=EditNightDutyCaptain]').value = H[36].textContent;
            
        let VesselId = document.querySelector('.EditVessel input[name=EditImoNumber]').value;
        UpdateVesselButton.addEventListener('click', () => {
            UpdateVesselButton.style.backgroundColor = '#1fb95e';
            UpdateVesselButton.textContent = '+ Updating..';
            EditVesselForm.setAttribute('action', '/Edit/Vessel/' + VesselId); 
            EditVesselForm.submit();
        })

        CancelButtonUpdate.addEventListener('click', () => { 
            EditVesselModal.style.display = 'none';
        })
    });
});