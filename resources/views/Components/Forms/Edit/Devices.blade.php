<div class="form-1 UpdateDevices">
    <div class="inner">
        <div class="close-button">
            <span>    </span>
            <button class="close-button-update-devices">✖</button>
        </div>
        <form action="" class="UpdateDevicesForm" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="inner-1"> 
                <div class="fields">
                    <p class="error-daily-report error"></p> 
                    <h1>Devices</h1>
                    <section>
                        <div class="input Devices">
                            <label for=""> </label> 
                            <label for="">Working</label> 
                            <label for="">Not Working</label> 
                        </div> 
                    </section>
                    <section> 
                        <div class="input">
                            <label for="">Vhf Base Radio</label>
                            <input type="radio" name="VhfBaseRadio" value="Yes">
                            <input type="radio" name="VhfBaseRadio" value="No">
                        </div>    
                        <div class="input">
                            <label for="">Vhf Hand Held</label>
                            <input type="radio" name="VhfHandHeld" value="Yes">
                            <input type="radio" name="VhfHandHeld" value="No">
                        </div>    
                        <div class="input">
                            <label for="">Ais</label>
                            <input type="radio" name="Ais" value="Yes">
                            <input type="radio" name="Ais" value="No">
                        </div>    
                        <div class="input">
                            <label for="">Vhf Recorder</label>
                            <input type="radio" name="VhfRecorder" value="Yes">
                            <input type="radio" name="VhfRecorder" value="No">
                        </div>    
                        <div class="input">
                            <label for="">Wind Detector</label>
                            <input type="radio" name="WindDetector" value="Yes">
                            <input type="radio" name="WindDetector" value="No">
                        </div>    
                        <div class="input">
                            <label for="">Storm Detector</label>
                            <input type="radio" name="StormDetector" value="Yes">
                            <input type="radio" name="StormDetector" value="No">
                        </div>    
                        <div class="input">
                            <label for="">Computer System</label>
                            <input type="radio" name="ComputerSystem" value="Yes">
                            <input type="radio" name="ComputerSystem" value="No">
                        </div> 
                    <div class="input">
                        <label for="">Public Address System</label>
                        <input type="radio" name="PublicAddressSystem" value="Yes">
                        <input type="radio" name="PublicAddressSystem" value="No">
                    </div> 
                    <div class="input">
                        <label for="">Fire Alarm System</label>
                        <input type="radio" name="FireAlarmSystem" value="Yes">
                        <input type="radio" name="FireAlarmSystem" value="No">
                    </div> 
                    <div class="input">
                        <label for="">Voltage Regulator</label>
                        <input type="radio" name="VoltageRegulator" value="Yes">
                        <input type="radio" name="VoltageRegulator" value="No">
                    </div> 
                    <div class="input">
                        <label for="">Vhf Repeater</label>
                        <input type="radio" name="VhfRepeater" value="Yes">
                        <input type="radio" name="VhfRepeater" value="No">
                    </div> 
                    <div class="input">
                        <label for="">Mobile Phone</label>
                        <input type="radio" name="MobilePhone" value="Yes">
                        <input type="radio" name="MobilePhone" value="No">
                    </div> 
                    <div class="input">
                        <label for="">Intercomm.</label>
                        <input type="radio" name="Intercomm" value="Yes">
                        <input type="radio" name="Intercomm" value="No">
                    </div>    
                    </section>
                </div>
                <br>
            </div>
            <div class="inner-2">
                <section>
                    <div class="input Devices D2">
                        <label for=""></label> 
                        <label for="">Working</label> 
                        <label for="">Not Working</label> 
                    </div> 
                </section>
                <section>
                    <div class="input">
                        <label for="">CCTV</label>
                        <input type="radio" name="CCTV" value="Yes">
                        <input type="radio" name="CCTV" value="No">
                    </div> 
                    <div class="input">
                        <label for="">Internet</label>
                        <input type="radio" name="Internet" value="Yes">
                        <input type="radio" name="Internet" value="No">
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
        <button class="UpdateDevicesButton">Update →</button>
    </div>
</div>