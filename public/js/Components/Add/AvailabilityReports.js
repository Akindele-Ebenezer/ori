let AddAvailabilityReportButtons = document.querySelectorAll('.AddAvailabilityReportButton');
AddAvailabilityReportButtons.forEach(button => {
    button.addEventListener('click', () => {
        const form = button.previousElementSibling;

        if (form && !form.checkValidity()) {
            form.reportValidity();  
            return;
        }

        button.style.backgroundColor = '#1fb95e';
        button.textContent = '+ Processing..';
    });
});