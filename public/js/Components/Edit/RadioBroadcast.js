(() => {
    const editButtons = document.querySelectorAll(
        '.EditRadioBroadcastButton'
    );

    const updateButton = document.querySelector(
        '.UpdateRadioBroadcastButton'
    );

    const form = document.querySelector(
        '.UpdateRadioBroadcastForm'
    );

    const modal = document.querySelector(
        '.UpdateRadioBroadcast'
    );

    const closeButton = document.querySelector(
        '.close-button-update-radio-broadcast'
    );

    if (!form || !updateButton || !modal) return;

    const field = (name) =>
        form.querySelector(`[name="${name}"]`);

    const alertFields = [
        'WatchKeepingAlert',
        'RelatedDistress',
        'Responders'
    ];

    const timeFields = [
        'FirstCallTime',
        'SecondCallTime'
    ];

    // Safely populate ordinary form fields.
    const setValue = (name, value) => {
        const input = field(name);
        if (!input) return;

        input.value = value ?? '';
    };

    // Populate a select even if the saved value is no longer
    // among the available vessel options.
    const setVessel = (value) => {
        const select = field('Vessel');
        if (!select) return;

        const vessel = String(value ?? '').trim();

        if (!vessel) {
            select.value = '';
            return;
        }

        const exists = Array.from(select.options).some(
            option => option.value === vessel
        );

        if (!exists) {
            const option = new Option(
                vessel + ' (not in vessel list)',
                vessel,
                true,
                true
            );

            select.add(option);
        }

        select.value = vessel;
    };

    editButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const row = button.closest('tr');

            if (!row || !row.dataset.report) {
                console.error(
                    'Radio broadcast report data is missing.'
                );
                return;
            }

            let report;

            try {
                report = JSON.parse(atob(row.dataset.report));
            } catch (error) {
                console.error(
                    'Unable to read radio broadcast report:',
                    error
                );
                return;
            }

            // Populate regular fields.
            setVessel(report.Vessel);
            setValue('DoneBy', report.DoneBy);
            setValue('Remarks', report.Remarks);
            setValue('Remarks_', report.Remarks_);
            setValue('Date', report.Date);

            // Populate Yes/No checkboxes.
            alertFields.forEach((name) => {
                const input = field(name);
                if (!input) return;

                input.checked =
                    String(report[name] ?? '').toLowerCase() === 'yes';
            });

            // Populate call times and their enable checkboxes.
            timeFields.forEach((name) => {
                const input = field(name);
                const enabled = field(`${name}Enabled`);

                if (!input || !enabled) return;

                const value = String(report[name] ?? '');

                const isTime =
                    value !== '' &&
                    value.toLowerCase() !== 'yes' &&
                    value.toLowerCase() !== 'no';

                input.value = isTime ? value : '';
                enabled.checked = isTime;

                input.disabled = !enabled.checked;
            });

            // Store the ID and set the action before submission.
            updateButton.dataset.id = report.id;
            let reportId = button.parentElement.parentElement.firstElementChild.textContent;
 
            form.action =
                `/Edit/RadioBroadcastReport/${reportId}`;

            modal.style.display = 'flex';
        });
    });

    // Enable/disable time fields as their checkboxes change.
    timeFields.forEach((name) => {
        const input = field(name);
        const enabled = field(`${name}Enabled`);

        if (!input || !enabled) return;

        enabled.addEventListener('change', () => {
            input.disabled = !enabled.checked;

            if (!enabled.checked) {
                input.value = '';
            }
        });
    });

    // Handle submission through the form.
    form.addEventListener('submit', () => {
        timeFields.forEach((name) => {
            const input = field(name);
            const enabled = field(`${name}Enabled`);

            if (input && enabled && !enabled.checked) {
                input.value = '';
            }
        });
    });

    // Update button is outside the form, so request a normal submit.
    updateButton.addEventListener('click', (event) => {
        event.preventDefault();

        if (!updateButton.dataset.id) {
            console.error('No radio broadcast report selected.');
            return;
        }

        if (typeof form.requestSubmit === 'function') {
            form.requestSubmit();
        } else {
            // Fallback for older browsers.
            form.dispatchEvent(
                new Event('submit', {
                    bubbles: true,
                    cancelable: true
                })
            );

            HTMLFormElement.prototype.submit.call(form);
        }
    });

    if (closeButton) {
        closeButton.addEventListener('click', (event) => {
            event.preventDefault();
            modal.style.display = 'none';
        });
    }
})();