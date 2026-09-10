<div class="DailyReportFormWrapper FormWrapper Hide">
    <form action="" class="AddDailyReportForm" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="inner-1"> 
            <div class="fields">
                <p class="error-daily-report error"></p>
                <section>  
                    <div class="input">
                        <label for="">Vessel</label>
                        <input type="text" name="Vessel" list="daily-report-vessels" autocomplete="off" placeholder="Type to filter vessels">
                        <datalist id="daily-report-vessels">
                            @foreach ($Vessels as $Vessel)
                                <option value="{{ $Vessel->VesselName }}">{{ $Vessel->VesselName }}</option>
                            @endforeach
                        </datalist>
                    </div>     
                </section> 
                @foreach (range(1, 3) as $deployedVesselIndex)
                    <section>
                        <div class="input">
                            <label for="deployed-vessel-{{ $deployedVesselIndex }}">Deployed Vessel {{ $deployedVesselIndex }}</label>
                            <input type="text" name="DeployedVessel{{ $deployedVesselIndex }}" id="deployed-vessel-{{ $deployedVesselIndex }}" list="daily-report-vessels" autocomplete="off" placeholder="Type to filter vessels">
                            <datalist id="daily-report-vessels-{{ $deployedVesselIndex }}">
                                @foreach ($Vessels as $Vessel)
                                    <option value="{{ $Vessel->VesselName }}">{{ $Vessel->VesselName }}</option>
                                @endforeach
                            </datalist>
                        </div>
                    </section>
                @endforeach
                <section> 
                    <div class="input">
                        <label for="">Status</label>
                        <select name="Status" id=""> 
                            <option value="DEPARTURE">DEPARTURE</option>
                            <option value="ARRIVAL">ARRIVAL</option>
                            <option value="INSPECTION">INSPECTION</option> 
                            <option value="DRILL">DRILL</option>  
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
        </div>
        <div class="inner-2">
            <h1><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/></svg>Time Period/Total Hours</h1>
            <div class="input">
                <label for="">Start time</label>
                <input type="text" name="StartTime" maxlength="8">
            </div>  
            <div class="input">
                <label for="">End time</label>
                <input type="text" name="EndTime" maxlength="8">
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
            <br><br>
        </div>
    </form>
    <button class="AddDailyReportButton">Create →</button>
</div>