<div class="form-1 UpdateAvailabilityReport UpdateTugsAssignment FormWrapper Hide">
    <div class="inner">
        <div class="close-button"><span></span><button type="button" class="close-button-update-availability-report">✖</button></div>
        <form action="" class="UpdateAvailabilityReportForm" method="POST">
            @csrf
            <input type="hidden" name="ReportType" value="tugs">
            <h1>Update Tugs Assignment</h1>
            @foreach (['Tugs' => 'Tugs', 'Vessel' => 'Vessel', 'NoOfJobs' => 'No. Of Jobs', 'NavyJobs' => 'Navy Jobs'] as $name => $label)
                <div class="input"><label for="tugs-edit-{{ $name }}">{{ $label }}</label><input id="tugs-edit-{{ $name }}" type="{{ $name === 'NoOfJobs' ? 'number' : 'text' }}" @if ($name === 'NoOfJobs') min="0" step="1" required @endif name="{{ $name }}"></div>
            @endforeach
            <div class="input"><label for="tugs-edit-Date">Date</label><input id="tugs-edit-Date" type="date" name="Date" required></div>
            <div class="input"><label for="tugs-edit-Time">Time</label><input id="tugs-edit-Time" type="time" name="Time" required></div>
            <div class="input"><label for="tugs-edit-DoneBy">Done By</label><input id="tugs-edit-DoneBy" type="text" name="DoneBy" required></div>
            <div class="input"><label for="tugs-edit-Remarks">Remarks</label><textarea id="tugs-edit-Remarks" name="Remarks"></textarea></div>
            <button type="submit">Update</button>
        </form>
    </div>
</div>
