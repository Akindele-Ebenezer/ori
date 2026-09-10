<div class="OthersFormWrapper FormWrapper Hide">
    <form action="" class="AddOthersForm" enctype="multipart/form-data" method="POST">
        @csrf
        @php $vesselRows = max(30, $Vessels->count()); @endphp
        <div class="inner-1"> 
            <div class="fields">
                <p class="error-daily-report error"></p>
                <h1>Other Vessel Reports</h1>
                <div class="fleet-report-table-wrapper">
                    <table class="fleet-report-table">
                        <thead>
                            <tr>
                                <th>Vessel</th>
                                <th>ROB</th>
                                <th>Fresh Water</th>
                                <th>CCTV</th>
                                <th>Internet</th>
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
                                    <td><input type="text" name="vessels[{{ $index }}][ROB]"></td>
                                    <td><input type="text" name="vessels[{{ $index }}][FreshWater]"></td>
                                    @foreach (['CCTV', 'Internet'] as $field)
                                        <td>
                                            <label><input type="radio" name="vessels[{{ $index }}][{{ $field }}]" value="Yes"> Yes</label>
                                            <label><input type="radio" name="vessels[{{ $index }}][{{ $field }}]" value="No" checked> No</label>
                                        </td>
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
    <button class="AddOthersButton">Create →</button>
</div>