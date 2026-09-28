(() => {
    const form = document.querySelector('.AddPeriodicChecksForm');
    const button = document.querySelector('.AddPeriodicChecksButton');
    if (!form || !button) return;

    const location = form.querySelector('[name="Location"]');
    const remarks = form.querySelector('[name="Remarks"]');
    const error = form.querySelector('.error-periodic-check');

    const syncRemarksRequirement = () => {
        remarks.required = location.value === 'Others';
    };
    location.addEventListener('change', syncRemarksRequirement);

    const submit = (event) => {
        event.preventDefault();
        syncRemarksRequirement();
        if (!form.reportValidity()) return;
        button.disabled = true;
        button.textContent = 'Processing...';
        error.textContent = '';
        form.action = '/Add/PeriodicCheck';
        HTMLFormElement.prototype.submit.call(form);
    };

    button.addEventListener('click', submit);
    form.addEventListener('submit', submit);
})();