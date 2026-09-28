<div class="form-1 UpdateAvailabilityReport UpdateHospitalVisitCrewStaff FormWrapper Hide">
    <div class="inner">
        <div class="close-button"><span></span><button type="button" class="close-button-update-availability-report">✖</button></div>
        <form action="" class="UpdateAvailabilityReportForm" method="POST">
            @csrf
            <input type="hidden" name="ReportType" value="hospital">
            <h1>Update Hospital Visit Crew / Staff</h1>
            @foreach (['Name' => 'Name', 'VesselOffice' => 'Vessel / Office', 'Admission' => 'Admission', 'DepartureTime' => 'Departure Time', 'ArrivalTime' => 'Arrival Time'] as $name => $label)
                <div class="input"><label for="hospital-edit-{{ $name }}">{{ $label }}</label><input id="hospital-edit-{{ $name }}" type="text" name="{{ $name }}"></div>
            @endforeach
            <div class="input"><label for="hospital-edit-Date">Date</label><input id="hospital-edit-Date" type="date" name="Date" required></div>
            <div class="input"><label for="hospital-edit-Time">Time</label><input id="hospital-edit-Time" type="time" name="Time" required></div>
            <div class="input"><label for="hospital-edit-DoneBy">Done By</label><input id="hospital-edit-DoneBy" type="text" name="DoneBy" required></div>
            <div class="input"><label for="hospital-edit-Remarks">Remarks</label><textarea id="hospital-edit-Remarks" name="Remarks"></textarea></div>
            <button type="submit">Update</button>
        </form>
    </div>
</div>
