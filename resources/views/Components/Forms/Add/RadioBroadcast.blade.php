<div class="RadioBroadcastFormWrapper FormWrapper Hide">
    <form action="" class="AddRadioBroadcastForm" enctype="multipart/form-data" method="POST">
        @csrf
        @php $vesselRows = $Vessels->count(); @endphp
        <div class="inner-1"> 
            <div class="fields">
                <p class="error-daily-report error"></p> 
                <h1>Radio Broadcast</h1>
                <div class="fleet-report-table-wrapper">
                    <table class="fleet-report-table">
                        <thead>
                            <tr>
                                <th>Vessel</th>
                                <th>Watch Keeping Alert</th>
                                <th>Related Distress</th>
                                <th>1st Call Time</th>
                                <th>2nd Call Time</th>
                                <th>Vessel Remarks</th>
                                <th style="visibility: hidden">Responders</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($index = 0; $index < $vesselRows; $index++)
                                <tr>
                                    <td>
                                        <select name="vessels[{{ $index }}][Vessel]" disabled>
                                            <option value="">Select vessel</option>
                                            @foreach ($Vessels as $Vessel)
                                                <option value="{{ $Vessel->VesselName }}" @selected($index < $Vessels->count() && $Vessels[$index]->VesselName === $Vessel->VesselName)>{{ $Vessel->VesselName }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="checkbox" name="vessels[{{ $index }}][WatchKeepingAlert]" value="Yes"></td>
                                    <td><input type="checkbox" name="vessels[{{ $index }}][RelatedDistress]" value="Yes"></td>
                                    <td><input type="checkbox" name="vessels[{{ $index }}][FirstCallTimeEnabled]" value="Yes" aria-label="1st call time completed for selected vessel"></td>
                                    <td><input type="checkbox" name="vessels[{{ $index }}][SecondCallTimeEnabled]" value="Yes" aria-label="2nd call time completed for selected vessel"></td>
                                    <td><input type="text" name="vessels[{{ $index }}][Remarks_]" placeholder="Vessel remarks"></td>
                                    <td style="visibility: hidden"><input type="checkbox" name="vessels[{{ $index }}][Responders]" value="Yes"></td>
                                </tr>
                            @endfor
                            <tr>
                                <td>
                                    <select name="vessels[{{ $vesselRows }}][Vessel]">
                                        <option value="SECURITY GATE" selected>SECURITY GATE</option>
                                    </select>
                                </td>
                                <td><input type="checkbox" name="vessels[{{ $vesselRows }}][WatchKeepingAlert]" value="Yes"></td>
                                <td><input type="checkbox" name="vessels[{{ $vesselRows }}][RelatedDistress]" value="Yes"></td>
                                <td><input type="checkbox" name="vessels[{{ $vesselRows }}][FirstCallTimeEnabled]" value="Yes"></td>
                                <td><input type="checkbox" name="vessels[{{ $vesselRows }}][SecondCallTimeEnabled]" value="Yes"></td>
                                <td><input type="text" name="vessels[{{ $vesselRows }}][Remarks_]" placeholder="Vessel remarks"></td>
                                <td style="visibility: hidden"><input type="checkbox" name="vessels[{{ $vesselRows }}][Responders]" value="Yes"></td>
                            </tr>
                            <tr>
                                <td>
                                    <select name="vessels[{{ $vesselRows + 1 }}][Vessel]">
                                        <option value="CONTAINER CITY" selected>CONTAINER CITY</option>
                                    </select>
                                </td>
                                <td><input type="checkbox" name="vessels[{{ $vesselRows + 1 }}][WatchKeepingAlert]" value="Yes"></td>
                                <td><input type="checkbox" name="vessels[{{ $vesselRows + 1 }}][RelatedDistress]" value="Yes"></td>
                                <td><input type="checkbox" name="vessels[{{ $vesselRows + 1 }}][FirstCallTimeEnabled]" value="Yes"></td>
                                <td><input type="checkbox" name="vessels[{{ $vesselRows + 1 }}][SecondCallTimeEnabled]" value="Yes"></td>
                                <td><input type="text" name="vessels[{{ $vesselRows + 1 }}][Remarks_]" placeholder="Vessel remarks"></td>
                                <td style="visibility: hidden"><input type="checkbox" name="vessels[{{ $vesselRows + 1 }}][Responders]" value="Yes"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
        </div>
        <div class="inner-2"> 
            <section>
                <div class="input">
                    <label for="radio-first-call-time">1st Call Time</label>
                    <input type="time" id="radio-first-call-time" name="FirstCallTime">
                </div>
                <div class="input">
                    <label for="radio-second-call-time">2nd Call Time</label>
                    <input type="time" id="radio-second-call-time" name="SecondCallTime">
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
    <button class="AddRadioBroadcastButton">Create →</button>
</div>