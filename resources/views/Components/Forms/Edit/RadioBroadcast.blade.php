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
                            <label for="">Vessel</label>
                            <select name="Vessel" id="">
                                @foreach ($Vessels as $Vessel)
                                    <option value="{{ $Vessel->VesselName }}">{{ $Vessel->VesselName }}</option>
                                @endforeach
                                <option value=""></option>  
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
                        <label for="">1st Call Time</label>
                        <input type="time" name="FirstCallTime">
                    </div>
                    <div class="input">
                        <label for="">2nd Call Time</label>
                        <input type="time" name="SecondCallTime">
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
        <button class="UpdateRadioBroadcastButton">Update →</button>
    </div>
</div>