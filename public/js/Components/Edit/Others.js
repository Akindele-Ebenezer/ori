const editOthersButtons = document.querySelectorAll('.EditOthersButton');
const updateOthersButton = document.querySelector('.UpdateOthersButton');
const updateOthersForm = document.querySelector('.UpdateOthersForm');
const othersModal = document.querySelector('.UpdateOthers');
const cancelOthersButton = document.querySelector('.close-button-update-others');

if (updateOthersButton && updateOthersForm) {
    editOthersButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const row = button.closest('tr');
            if (!row) return;
            const report = JSON.parse(atob(row.dataset.report));
            ['Vessel', 'ROB', 'FreshWater', 'DoneBy', 'Remarks', 'Date'].forEach((name) => {
                const input = updateOthersForm.querySelector(`[name="${name}"]`);
                if (input) input.value = report[name] || '';
            });
            updateOthersButton.dataset.id = report.id;
            othersModal.style.display = 'flex';
        });
    });
    updateOthersButton.addEventListener('click', (event) => {
        event.preventDefault();
        const vessel = updateOthersForm.querySelector('[name="Vessel"]');
        if (vessel.disabled) vessel.disabled = false;
        updateOthersForm.action = `/Edit/OthersReport/${updateOthersButton.dataset.id}`;
        HTMLFormElement.prototype.submit.call(updateOthersForm);
    });
    if (cancelOthersButton) cancelOthersButton.addEventListener('click', () => { othersModal.style.display = 'none'; });
}