<div class="form-1 UpdateAvailabilityReport UpdateIncidentAccidentNearMiss FormWrapper Hide">
    <div class="inner">
        <div class="close-button"><span></span><button type="button" class="close-button-update-availability-report">✖</button></div>
        <form action="" class="UpdateAvailabilityReportForm" method="POST">
            @csrf
            <input type="hidden" name="ReportType" value="incident">
            <h1>Update Incident / Accident / Near Miss Report</h1>
            @foreach (['PersonVesselInvolved' => 'Person / Vessel Involved', 'NatureOf' => 'Nature Of (IAN)', 'Location' => 'Location', 'AidRequired' => 'Aid Required', 'SalvageTugs' => 'Salvage Tugs'] as $name => $label)
                <div class="input"><label for="incident-edit-{{ $name }}">{{ $label }}</label><input id="incident-edit-{{ $name }}" type="text" name="{{ $name }}"></div>
            @endforeach
            <div class="input"><label for="incident-edit-Date">Date</label><input id="incident-edit-Date" type="date" name="Date" required></div>
            <div class="input"><label for="incident-edit-Time">Time</label><input id="incident-edit-Time" type="time" name="Time" required></div>
            <div class="input"><label for="incident-edit-DoneBy">Done By</label><input id="incident-edit-DoneBy" type="text" name="DoneBy" required></div>
            <div class="input"><label for="incident-edit-Remarks">Remarks</label><textarea id="incident-edit-Remarks" name="Remarks"></textarea></div>
            <button type="submit">Update</button>
        </form>
    </div>
</div>
