<div class="form-1 UpdateAvailabilityReport UpdateCctvPositioning FormWrapper Hide">
    <div class="inner">
        <div class="close-button"><span></span><button type="button" class="close-button-update-availability-report">✖</button></div>
        <form action="" class="UpdateAvailabilityReportForm" method="POST">
            @csrf
            <input type="hidden" name="ReportType" value="cctv">
            <h1>Update CCTV Positioning</h1>
            <div class="input">
                <label for="cctv-edit-Vessel">Vessel</label>
                <select id="cctv-edit-Vessel" name="Vessel" required>
                    @foreach ($Vessels as $Vessel)
                        <option value="{{ $Vessel->VesselName }}">{{ $Vessel->VesselName }}</option>
                    @endforeach
                </select>
            </div>
            @foreach (['RecordingCapacity' => 'Recording Capacity', 'Positioning' => 'Positioning', 'Correction' => 'Correction', 'From' => 'From', 'To' => 'To'] as $name => $label)
                <div class="input">
                    <label for="cctv-edit-{{ $name }}">{{ $label }}</label>
                    @if (in_array($name, ['Positioning', 'Correction'], true))
                        <select id="cctv-edit-{{ $name }}" name="{{ $name }}" required>
                            <option value="OK">OK</option>
                            <option value="NOT OK">NOT OK</option>
                        </select>
                    @else
                        <input id="cctv-edit-{{ $name }}" type="{{ $name == 'From' || $name == 'To' ? 'date' : 'text' }}" name="{{ $name }}" required>
                    @endif
                </div>
            @endforeach
            <div class="input"><label for="cctv-edit-DoneBy">Done By</label><input id="cctv-edit-DoneBy" type="text" name="DoneBy" required></div>
            <div class="input"><label for="cctv-edit-Date">Date</label><input id="cctv-edit-Date" type="date" name="Date" required></div>
            <div class="input"><label for="cctv-edit-Remarks">Remarks</label><textarea id="cctv-edit-Remarks" name="Remarks"></textarea></div>
            <button type="submit" class="UpdateButton">Update</button>
        </form>
    </div>
</div>