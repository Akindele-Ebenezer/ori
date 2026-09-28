<div class="form-1 UpdateAvailabilityReport FormWrapper Hide">
    <div class="inner">
        <div class="close-button">
            <span></span>
            <button type="button" class="close-button-update-availability-report">✖</button>
        </div>
        <form action="" class="UpdateAvailabilityReportForm" method="POST">
            @csrf
            <input type="hidden" name="ReportType">
            <h1>Update Availability Report</h1>
            @foreach ([
                'PersonVesselInvolved' => 'Person / Vessel Involved', 'NatureOf' => 'Nature Of (IAN)',
                'Location' => 'Location', 'AidRequired' => 'Aid Required', 'SalvageTugs' => 'Salvage Tugs',
                'Name' => 'Name', 'VesselOffice' => 'Vessel / Office', 'Admission' => 'Admission',
                'DepartureTime' => 'Departure Time', 'ArrivalTime' => 'Arrival Time', 'Vessel' => 'Vessel',
                'NoOfJobs' => 'No. Of Jobs', 'NavyJobs' => 'Navy Jobs', 'Tugs' => 'Tugs',
            ] as $name => $label)
                <div class="input">
                    <label for="edit-availability-report-{{ $name }}">{{ $label }}</label>
                    <input id="edit-availability-report-{{ $name }}" type="{{ in_array($name, ['NoOfJobs', 'NavyJobs', 'Tugs'], true) ? 'time' : 'text' }}" name="{{ $name }}">
                </div>
            @endforeach
            <div class="input"><label for="edit-availability-report-Date">Date</label><input id="edit-availability-report-Date" type="date" name="Date" required></div>
            <div class="input"><label for="edit-availability-report-Time">Time</label><input id="edit-availability-report-Time" type="time" name="Time" required></div>
            <div class="input"><label for="edit-availability-report-DoneBy">Done By</label><input id="edit-availability-report-DoneBy" type="text" name="DoneBy" required></div>
            <div class="input"><label for="edit-availability-report-Remarks">Remarks</label><textarea id="edit-availability-report-Remarks" name="Remarks"></textarea></div>
            <button type="submit" class="UpdateButton">Update</button>
        </form>
    </div>
</div>
