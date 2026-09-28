<div class="form-1 UpdateRadioBroadcast">
    <div class="inner">
        <div class="close-button">
            <span>    </span>
            <button class="close-button-update-radio-broadcast">✖</button>
        </div>
        <form action="" class="UpdateRadioBroadcastForm" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="inner-1"> 
                <div class="fields">
                    <p class="error-daily-report error"></p> 
                    <h1>Radio Broadcast</h1>
                    <section>  
                        <div class="input">
                            <label for="">Vessel Remarks</label>
                            <textarea name="Remarks_"></textarea>
                        </div>
                    </section>
                    <section>
                        <div class="input">
                            <label for="edit-radio-vessel">Vessel</label>
                            <select disabled name="Vessel" id="edit-radio-vessel" required>
                                <option value="">Select vessel</option>

                                @foreach ($Vessels as $Vessel)
                                    <option value="{{ $Vessel->VesselName }}">
                                        {{ $Vessel->VesselName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>  
                    </section>
                    <section>
                        <div class="input">
                            <label for="">Watch Keeping Alert</label>
                            <input type="checkbox" name="WatchKeepingAlert">
                        </div>    
                        <div class="input">
                            <label for="">Related Distress</label>
                            <input type="checkbox" name="RelatedDistress">
                        </div>    
                        <div class="input">
                            <label for="">Responders</label>
                            <input type="checkbox" name="Responders">
                        </div>    
                    </section>
                </div>
                <br>
            </div>
            <div class="inner-2"> 
                <section>
                    <div class="input">
                        <label for="edit-radio-first-call-time">1st Call Time</label>
                        <input type="time" id="edit-radio-first-call-time" name="FirstCallTime" disabled>
                        <label for="edit-radio-first-call-enabled">Call completed</label>
                        <input type="checkbox" id="edit-radio-first-call-enabled" name="FirstCallTimeEnabled" value="Yes">
                    </div>
                    <div class="input">
                        <label for="edit-radio-second-call-time">2nd Call Time</label>
                        <input type="time" id="edit-radio-second-call-time" name="SecondCallTime" disabled>
                        <label for="edit-radio-second-call-enabled">Call completed</label>
                        <input type="checkbox" id="edit-radio-second-call-enabled" name="SecondCallTimeEnabled" value="Yes">
                    </div>
                </section>
                <section>
                    <div class="input">
                        <label for="">Done By</label>
                        <input type="text" name="DoneBy">
                    </div> 
                </section>
                <section>
                    <div class="input">
                        <label for="">Remarks</label>
                        <textarea name="Remarks"></textarea>
                    </div> 
                </section>  
                <section class="t-f"> 
                    <div class="input">
                        <label for="">Date</label>
                        <input type="date" name="Date">
                    </div>  
                </section> 
                <br><br>
            </div>
        </form>
        <button class="UpdateRadioBroadcastButton UpdateButton">Update →</button>
    </div>
</div>