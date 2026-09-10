const formButtons = {
    DailyReportFormButton: 'DailyReportFormWrapper',
    AvailabilityFormButton: 'AvailabilityFormWrapper',
    RadioBroadcastFormButton: 'RadioBroadcastFormWrapper',
    DevicesFormButton: 'DevicesFormWrapper',
    OfficersOnDutyFormButton: 'OfficersOnDutyFormWrapper',
    OthersFormButton: 'OthersFormWrapper'
};

Object.entries(formButtons).forEach(([buttonClass, wrapperClass]) => {

    const button = document.querySelector(`.${buttonClass}`);

    if (!button) return;

    button.addEventListener('click', () => {

        // Remove active from all buttons
        Object.keys(formButtons).forEach(btnClass => {
            const btn = document.querySelector(`.${btnClass}`);

            if (btn) {
                btn.classList.remove('active');
            }
        });

        // Add active to clicked button
        button.classList.add('active');

        // Hide all form wrappers
        Object.values(formButtons).forEach(wrapperClassName => {
            const wrapper = document.querySelector(`.${wrapperClassName}`);

            if (wrapper) {
                wrapper.classList.add('Hide');
            }
        });

        // Show selected form
        const selectedWrapper = document.querySelector(`.${wrapperClass}`);

        if (selectedWrapper) {
            selectedWrapper.classList.remove('Hide');
        }
    });
});