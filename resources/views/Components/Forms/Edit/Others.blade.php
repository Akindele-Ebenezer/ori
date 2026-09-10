<div class="form-1 UpdateOthers">
    <div class="inner">
        <div class="close-button">
            <span>    </span>
            <button class="close-button-update-others">✖</button>
        </div>
        <form action="" class="UpdateOthersForm" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="inner-1"> 
                <div class="fields">
                    <p class="error-daily-report error"></p>
                    <section>  
                        <div class="input">
                            <label for="">Vessel</label>
                            <select disabled name="Vessel" id="">
                                @foreach ($Vessels as $Vessel)
                                    <option value="{{ $Vessel->VesselName }}">{{ $Vessel->VesselName }}</option>
                                @endforeach
                                <option value=""></option>  
                            </select>
                        </div>     
                    </section>
                    <section>
                        <div class="input">
                            <label for="">ROB</label>
                            <input type="text" name="ROB">
                        </div> 
                    </section>
                    <section>
                        <div class="input">
                            <label for="">FRESH WATER</label>
                            <input type="text" name="FreshWater">
                        </div> 
                    </section>
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
        <button class="UpdateOthersButton">Update →</button>
    </div>
</div>