<div class="AvailabilityReportForms">
    @php
        $reportForms = [
            'incident' => ['class' => 'IncidentReportFormWrapper', 'title' => 'Incident / Accident / Near Miss Report', 'fields' => [['PersonVesselInvolved', 'Person / Vessel Involved'], ['NatureOf', 'Nature Of (IAN)'], ['Location', 'Location'], ['AidRequired', 'Aid Required'], ['SalvageTugs', 'Salvage Tugs']]],
            'hospital' => ['class' => 'HospitalReportFormWrapper', 'title' => 'Hospital Visit Crew / Staff', 'fields' => [['Name', 'Name'], ['VesselOffice', 'Vessel / Office'], ['Admission', 'Admission'], ['DepartureTime', 'Departure Time'], ['ArrivalTime', 'Arrival Time']]],
            'tugs' => ['class' => 'TugsReportFormWrapper', 'title' => 'Tugs Assignment', 'fields' => [['Vessel', 'Vessel'], ['NoOfJobs', 'No. Of Jobs'], ['NavyJobs', 'Navy Jobs'], ['Tugs', 'Tugs']]],
        ];
    @endphp
    @foreach ($reportForms as $type => $form)
        <div class="{{ $form['class'] }} FormWrapper Hide">
            <form id="availability-report-form-{{ $type }}" action="{{ route('AddAvailabilityReport', ['type' => $type]) }}" class="AddAvailabilityReportForm" method="POST">
                @csrf
                <div class="inner-1">
                    <div class="fields">
                        <p class="error-availability error"></p>
                        <h1>{{ $form['title'] }}</h1>
                        <section>
                            @foreach ($form['fields'] as [$name, $label])
                                <div class="input">
                                    <label for="{{ $type }}-{{ $name }}">{{ $label }}</label>
                                    <input id="{{ $type }}-{{ $name }}" type="{{ in_array($name, ['DepartureTime', 'ArrivalTime'], true) ? 'time' : 'text' }}" name="{{ $name }}" @if ($type !== 'hospital' || !in_array($name, ['Admission', 'DepartureTime', 'ArrivalTime'], true)) required @endif>
                                </div>
                            @endforeach
                        </section>
                    </div>
                </div>
                <div class="inner-2">
                    <h1>Date / Time and Accountability</h1>
                    <div class="input">
                        <label for="{{ $type }}-Date">Date</label>
                        <input id="{{ $type }}-Date" type="date" name="Date" required>
                    </div>
                    <div class="input">
                        <label for="{{ $type }}-Time">Time</label>
                        <input id="{{ $type }}-Time" type="time" name="Time" required>
                    </div>
                    <div class="input">
                        <label for="{{ $type }}-DoneBy">Done By</label>
                        <input id="{{ $type }}-DoneBy" type="text" name="DoneBy" required>
                    </div>
                    <div class="input">
                        <label for="{{ $type }}-Remarks">Remarks</label>
                        <textarea id="{{ $type }}-Remarks" name="Remarks"></textarea>
                    </div>
                </div>
            </form>
            <button class="AddAvailabilityReportButton" form="availability-report-form-{{ $type }}" type="submit">Create →</button>
        </div>
    @endforeach
</div>
