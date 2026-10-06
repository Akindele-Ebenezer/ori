<div class="form-1 UpdateDailyReport">
    <div class="inner">
        <div class="close-button">
            <span>    </span>
            <button class="close-button-update-daily-report">✖</button>
        </div>
        <form action="" class="UpdateDailyReportForm" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="inner-1"> 
                <div class="fields">
                    <p class="error-daily-report error"></p>
                    <section>  
                        <div class="input">
                            <label for="">Vessel</label>
                            <select name="Vessel" id="">
                                @foreach ($Vessels as $Vessel)
                                    <option value="{{ $Vessel->VesselName }}">{{ $Vessel->VesselName }}</option>
                                @endforeach
                                <option value="" hidden></option>
                            </select>
                        </div>     
                    </section> 
                    @foreach (range(1, 3) as $deployedVesselIndex)
                        <section>
                            <div class="input">
                                <label for="edit-deployed-vessel-{{ $deployedVesselIndex }}">Deployed Vessel {{ $deployedVesselIndex }}</label>
                                <select name="DeployedVessel{{ $deployedVesselIndex }}" id="edit-deployed-vessel-{{ $deployedVesselIndex }}">
                                    <option value="">Select vessel</option>
                                    @foreach ($Vessels as $Vessel)
                                        <option value="{{ $Vessel->VesselName }}">{{ $Vessel->VesselName }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </section>
                    @endforeach
                    <section> 
                        <div class="input">
                            <label for="">Status</label>
                            <select name="Status" id=""> 
                                <option value="DEPARTURE">DEPARTURE</option>
                                <option value="ARRIVAL">ARRIVAL</option>
                                <option value="BERTHING">BERTHING</option>
                                <option value="UNBERTHING">UNBERTHING</option>
                                <option value="DISEMBARKATION">DISEMBARKATION</option>
                                <option value="EMBARKATION">EMBARKATION</option>
                                <option value="MAINTENANCE">MAINTENANCE</option>
                                <option value="INSPECTION">INSPECTION</option> 
                                <option value="DRILL">DRILL</option>
                                <option value="DIVE CHECK">DIVE CHECK</option>
                                <option value="WEATHER BROADCAST">WEATHER BROADCAST</option>
                            </select>
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
                </div>
                <br>
                <br>
                <h1><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/></svg>Time Period/Total Hours</h1>
                <div class="input">
                    <label for="">Start time</label>
                    <input type="text" name="StartTime" maxlength="8" inputmode="numeric" placeholder="HH:MM HRS">
                </div>  
                <div class="input">
                    <label for="">End time</label>
                    <input type="text" name="EndTime" maxlength="8" inputmode="numeric" placeholder="HH:MM HRS">
                </div>  
                <section class="t-f">
                    <h1>Date</h1>
                    <div class="input">
                        <label for="">Start date</label>
                        <input type="date" name="StartDate">
                    </div>  
                    <div class="input">
                        <label for="">End date</label>
                        <input type="date" name="EndDate">
                    </div>  
                </section> 
            </div>
            <div class="inner-2">
                <section class="t-f">
                    <h1>Berthing</h1>
                    <div class="input">
                        <label for="edit-berthing-date">Date</label>
                        <input type="date" name="BerthingDate" id="edit-berthing-date">
                    </div>
                    <div class="input">
                        <label for="edit-berthing-time">Time</label>
                        <input type="time" name="BerthingTime" id="edit-berthing-time">
                    </div>
                    @foreach (range(1, 3) as $deployedVesselIndex)
                        <div class="input">
                            <label for="edit-berthing-deployed-vessel-{{ $deployedVesselIndex }}">Deployed Vessel {{ $deployedVesselIndex }}</label>
                            <select name="BerthingDeployedVessel{{ $deployedVesselIndex }}" id="edit-berthing-deployed-vessel-{{ $deployedVesselIndex }}">
                                <option value="">Select vessel</option>
                                @foreach ($Vessels as $Vessel)
                                    <option value="{{ $Vessel->VesselName }}">{{ $Vessel->VesselName }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach
                </section>
                <br>
                <br>
                <section class="t-f">
                    <h1>Unberthing</h1>
                    <div class="input">
                        <label for="edit-unberthing-date">Date</label>
                        <input type="date" name="UnberthingDate" id="edit-unberthing-date">
                    </div>
                    <div class="input">
                        <label for="edit-unberthing-time">Time</label>
                        <input type="time" name="UnberthingTime" id="edit-unberthing-time">
                    </div>
                    @foreach (range(1, 3) as $deployedVesselIndex)
                        <div class="input">
                            <label for="edit-unberthing-deployed-vessel-{{ $deployedVesselIndex }}">Deployed Vessel {{ $deployedVesselIndex }}</label>
                            <select name="UnberthingDeployedVessel{{ $deployedVesselIndex }}" id="edit-unberthing-deployed-vessel-{{ $deployedVesselIndex }}">
                                <option value="">Select vessel</option>
                                @foreach ($Vessels as $Vessel)
                                    <option value="{{ $Vessel->VesselName }}">{{ $Vessel->VesselName }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach
                </section>
                <br>
                <br>
                <section class="t-f">
                    <h1>Shifting</h1>
                    <div class="input">
                        <label for="edit-shifting-date">Date</label>
                        <input type="date" name="ShiftingDate" id="edit-shifting-date">
                    </div>
                    <div class="input">
                        <label for="edit-shifting-time">Time</label>
                        <input type="time" name="ShiftingTime" id="edit-shifting-time">
                    </div>
                    @foreach (range(1, 3) as $deployedVesselIndex)
                        <div class="input">
                            <label for="edit-shifting-deployed-vessel-{{ $deployedVesselIndex }}">Deployed Vessel {{ $deployedVesselIndex }}</label>
                            <select name="ShiftingDeployedVessel{{ $deployedVesselIndex }}" id="edit-shifting-deployed-vessel-{{ $deployedVesselIndex }}">
                                <option value="">Select vessel</option>
                                @foreach ($Vessels as $Vessel)
                                    <option value="{{ $Vessel->VesselName }}">{{ $Vessel->VesselName }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach
                </section>
                <br><br>
            </div>
        </form>
        <button class="UpdateDailyReportButton UpdateButton">Update →</button>
    </div>
</div>