<div class="form-1 UpdatePeriodicChecks">
    <div class="inner">
        <div class="close-button">
            <span></span>
            <button class="close-button-update-periodic-checks" type="button">✖</button>
        </div>
        <form action="" class="UpdatePeriodicChecksForm" method="POST">
            @csrf
            <div class="inner-1">
                <div class="fields">
                    <p class="error-periodic-check error"></p>
                    <h1>Periodic Checks</h1>
                    <section>
                        <div class="input">
                            <label for="">Type</label>
                            <select name="Type" required>
                                <option value="Weekly">Weekly</option>
                                <option value="Bi-weekly">Bi-weekly</option>
                                <option value="Monthly">Monthly</option>
                            </select>
                        </div>
                        <div class="input">
                            <label for="">Equipment</label>
                            <select name="Equipment" required>
                                <option value="PA System">PA System</option>
                                <option value="Alarm">Alarm</option>
                                <option value="Iridium Satellite Phone">Iridium Satellite Phone</option>
                                <option value="CCTV">CCTV</option>
                                <option value="FIRE CONTAINER">FIRE CONTAINER</option>
                            </select>
                        </div>
                        <div class="input">
                            <label for="">Location</label>
                            <select name="Location" required>
                                <option value="Dockyard">Dockyard</option>
                                <option value="Bullnose">Bullnose</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="input">
                            <label for="">Date</label>
                            <input type="date" name="Date" required>
                        </div>
                        <div class="input">
                            <label for="">Time</label>
                            <input type="time" name="Time" required>
                        </div>
                        <div class="input">
                            <label for="">Done by</label>
                            <input type="text" name="DoneBy" maxlength="255" required>
                        </div>
                        <div class="input">
                            <label for="">Remarks</label>
                            <textarea name="Remarks"></textarea>
                        </div>
                    </section>
                </div>
            </div>
        </form>
        <button class="UpdatePeriodicChecksButton UpdateButton" type="button">Update →</button>
    </div>
</div>