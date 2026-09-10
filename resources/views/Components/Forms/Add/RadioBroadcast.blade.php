<div class="RadioBroadcastFormWrapper FormWrapper Hide">
    <form action="" class="AddRadioBroadcastForm" enctype="multipart/form-data" method="POST">
        @csrf
        @php $vesselRows = max(30, $Vessels->count()); @endphp
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
                                <th>Responders</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($index = 0; $index < $vesselRows; $index++)
                                <tr>
                                    <td>
                                        <select name="vessels[{{ $index }}][Vessel]">
                                            <option value="">Select vessel</option>
                                            @foreach ($Vessels as $Vessel)
                                                <option value="{{ $Vessel->VesselName }}" @selected($index < $Vessels->count() && $Vessels[$index]->VesselName === $Vessel->VesselName)>{{ $Vessel->VesselName }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    @foreach (['WatchKeepingAlert', 'RelatedDistress', 'FirstCallTime', 'SecondCallTime', 'Responders'] as $field)
                                        <td><input type="checkbox" name="vessels[{{ $index }}][{{ $field }}]" value="Yes"></td>
                                    @endforeach
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
        </div>
        <div class="inner-2"> 
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