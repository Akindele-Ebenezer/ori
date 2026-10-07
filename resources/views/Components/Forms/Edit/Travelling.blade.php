<div class="form-1 UpdateAvailabilityReport UpdateTravelling FormWrapper Hide">
    <div class="inner">
        <div class="close-button"><span></span><button type="button" class="close-button-update-availability-report">✖</button></div>
        <form action="" class="UpdateAvailabilityReportForm" method="POST">
            @csrf
            <input type="hidden" name="ReportType" value="travelling">
            <h1>Update Travelling</h1>
            <div class="input"><label for="travelling-edit-Name">Name</label><input id="travelling-edit-Name" type="text" name="Name" required></div>
            <div class="input">
                <label for="travelling-edit-Type">Type</label>
                <select id="travelling-edit-Type" name="Type" required>
                    <option value="">Select type</option>
                    <option value="ARRIVAL">ARRIVAL</option>
                    <option value="DEPARTURE">DEPARTURE</option>
                </select>
            </div>
            <div class="input">
                <label for="travelling-edit-Vessel">Vessel</label>
                <select id="travelling-edit-Vessel" name="Vessel" required>
                    <option value="">Select vessel</option>
                    @foreach ($Vessels as $Vessel)
                        <option value="{{ $Vessel->VesselName }}">{{ $Vessel->VesselName }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input"><label for="travelling-edit-Office">Office</label><input id="travelling-edit-Office" type="text" name="Office" required></div>
            <div class="input"><label for="travelling-edit-Driver">Driver</label><input id="travelling-edit-Driver" type="text" name="Driver" required></div>
            <div class="input"><label for="travelling-edit-Lodging">Lodging</label><input id="travelling-edit-Lodging" type="text" name="Lodging" required></div>
            <div class="input"><label for="travelling-edit-Date">Date</label><input id="travelling-edit-Date" type="date" name="Date" required></div>
            <div class="input"><label for="travelling-edit-Time">Time</label><input id="travelling-edit-Time" type="time" name="Time" required></div>
            <div class="input"><label for="travelling-edit-DoneBy">Done By</label><input id="travelling-edit-DoneBy" type="text" name="DoneBy" required></div>
            <button type="submit" class="UpdateButton">Update</button>
        </form>
    </div>
</div>
