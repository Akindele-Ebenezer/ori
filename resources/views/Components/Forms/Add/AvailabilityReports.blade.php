<div class="AvailabilityReportForms">
    @php
        $reportForms = [
            'incident' => ['class' => 'IncidentReportFormWrapper', 'title' => 'Incident / Accident / Near Miss Report', 'fields' => [['PersonVesselInvolved', 'Person / Vessel Involved'], ['NatureOf', 'Nature Of (IAN)'], ['Location', 'Location'], ['AidRequired', 'Aid Required'], ['SalvageTugs', 'Salvage Tugs']]],
            'hospital' => ['class' => 'HospitalReportFormWrapper', 'title' => 'Hospital Visit Crew / Staff', 'fields' => [['Name', 'Name'], ['VesselOffice', 'Vessel / Office'], ['Admission', 'Admission'], ['DepartureTime', 'Departure Time'], ['ArrivalTime', 'Arrival Time']]],
            'travelling' => ['class' => 'TravellingReportFormWrapper', 'title' => 'Travelling', 'fields' => [['Name', 'Name'], ['Type', 'Type'], ['Vessel', 'Vessel'], ['Office', 'Office'], ['Driver', 'Driver'], ['Lodging', 'Lodging']]],
            'tugs' => ['class' => 'TugsReportFormWrapper', 'title' => 'Tugs Assignment', 'fields' => [['Tugs', 'Tugs'], ['Vessel', 'Vessel'], ['NoOfJobs', 'No. Of Jobs'], ['NavyJobs', 'Navy Jobs']]],
            'cctv' => ['class' => 'CctvReportFormWrapper', 'title' => 'CCTV Positioning', 'fields' => [['Vessel', 'Vessel'], ['RecordingCapacity', 'Recording Capacity'], ['Positioning', 'Positioning'], ['Correction', 'Correction'], ['From', 'From'], ['To', 'To']]],
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
                            @if ($type === 'cctv')
                                <div class="fleet-report-table-wrapper">
                                    <table class="fleet-report-table">
                                        <thead>
                                            <tr>
                                                <th>Vessel</th>
                                                <th>Recording Capacity</th>
                                                <th>Positioning</th>
                                                <th>Correction</th>
                                                <th>From</th>
                                                <th>To</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Vessels as $index => $Vessel)
                                                <tr>
                                                    <td>
                                                        {{ $Vessel->VesselName }}
                                                        <input type="hidden" name="vessels[{{ $index }}][Vessel]" value="{{ $Vessel->VesselName }}">
                                                    </td>
                                                    <td><input type="text" name="vessels[{{ $index }}][RecordingCapacity]" maxlength="255"></td>
                                                    @foreach (['Positioning', 'Correction'] as $field)
                                                        <td>
                                                            <select name="vessels[{{ $index }}][{{ $field }}]">
                                                                <option value="">Select status</option>
                                                                <option value="OK">OK</option>
                                                                <option value="NOT OK">NOT OK</option>
                                                            </select>
                                                        </td>
                                                    @endforeach
                                                    <td><input type="date" name="vessels[{{ $index }}][From]" maxlength="255"></td>
                                                    <td><input type="date" name="vessels[{{ $index }}][To]" maxlength="255"></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                @foreach ($form['fields'] as [$name, $label])
                                    <div class="input">
                                        <label for="{{ $type }}-{{ $name }}">{{ $label }}</label>
                                        @if ($type === 'travelling' && $name === 'Type')
                                            <select id="{{ $type }}-{{ $name }}" name="{{ $name }}" required>
                                                <option value="">Select type</option>
                                                <option value="ARRIVAL">ARRIVAL</option>
                                                <option value="DEPARTURE">DEPARTURE</option>
                                            </select>
                                        @elseif ($type === 'travelling' && $name === 'Vessel')
                                            <select id="{{ $type }}-{{ $name }}" name="{{ $name }}" required>
                                                <option value="">Select vessel</option>
                                                @foreach ($Vessels as $Vessel)
                                                    <option value="{{ $Vessel->VesselName }}">{{ $Vessel->VesselName }}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <input id="{{ $type }}-{{ $name }}" type="{{ in_array($name, ['DepartureTime', 'ArrivalTime'], true) ? 'time' : ($type === 'tugs' && $name === 'NoOfJobs' ? 'number' : 'text') }}" @if ($type === 'tugs' && $name === 'NoOfJobs') min="0" step="1" @endif name="{{ $name }}" @if ($type !== 'hospital' || !in_array($name, ['Admission', 'DepartureTime', 'ArrivalTime'], true)) required @endif>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </section>
                    </div>
                </div>
                <div class="inner-2">
                    <h1>{{ $type === 'cctv' ? 'Accountability' : 'Date / Time and Accountability' }}</h1>
                    <div class="input">
                        <label for="{{ $type }}-Date">Date</label>
                        <input id="{{ $type }}-Date" type="date" name="Date" @if ($type !== 'cctv') required @endif>
                    </div>
                    @if ($type !== 'cctv')
                    <div class="input">
                        <label for="{{ $type }}-Time">Time</label>
                        <input id="{{ $type }}-Time" type="time" name="Time" required>
                    </div>
                    @endif
                    <div class="input">
                        <label for="{{ $type }}-DoneBy">Done By</label>
                        <input id="{{ $type }}-DoneBy" type="text" name="DoneBy" @if ($type !== 'cctv') required @endif>
                    </div>
                    @if ($type !== 'travelling')
                        <div class="input">
                            <label for="{{ $type }}-Remarks">Remarks</label>
                            <textarea id="{{ $type }}-Remarks" name="Remarks"></textarea>
                        </div>
                    @endif
                </div>
            </form>
            <button class="AddAvailabilityReportButton" form="availability-report-form-{{ $type }}" type="submit">Create →</button>
        </div>
    @endforeach
</div>
