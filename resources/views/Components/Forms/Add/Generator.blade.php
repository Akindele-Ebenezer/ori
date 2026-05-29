<div class="form-1 AddGenerator">
    <div class="inner">
        <div class="close-button close-generator-form-button">
            <span>    </span>
            <button class="cancel-button-generator">✖</button>
        </div>
        <form action="" class="AddGeneratorForm" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="inner-1"> 
                <div class="fields">
                    <p class="error-generator error"></p>
                    <section>
                        <div class="input">
                            <label for="">Priority/ InternalNo</label>
                            <input type="text" name="Priority_InternalNo"> 
                        </div>  
                        <div class="input">
                            <label for="">Used By</label>
                            <input type="text" name="UsedBy"> 
                        </div>  
                        <div class="input">
                            <label for="">Engine Make</label>
                            <input type="text" name="EngineMake"> 
                        </div> 
                        <div class="input">
                            <label for="">Power</label>
                            <input type="text" name="Power">
                        </div> 
                        {{-- <div class="input Hide">
                            <label for="">Attachment</label>
                            <input type="file" name="Attachment">
                        </div>  --}}
                        <div class="input">
                            <label for="">Model</label>
                            <input type="text" name="Model">
                        </div>  
                        <div class="input">
                            <label for="">Machine Type</label>
                            <select name="MachineType" id="">
                                <option value="Generator">Generator</option> 
                                <option value="Compressor">Compressor</option> 
                                <option value="Engine">Engine</option> 
                                <option value="Pump">Pump</option>
                            </select> 
                        </div>  
                    </section>  
                </div>   
            </div>
            <div class="inner-2"> 
                <h1><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/></svg>Information</h1>
                <div class="input">
                    <label for="">SN</label>
                    <input type="text" name="SN">
                </div>  
                <div class="input">
                    <label for="">Engine Type</label>
                    <input type="text" name="EngineType">
                </div>  
                <section class="t-f">
                    <h1>More Details</h1>
                    <div class="input">
                        <label for="">Location</label>
                        <input type="text" name="Location">
                    </div>  
                    <div class="input">
                        <label for="">Remarks</label>
                        <input type="text" name="Remarks">
                    </div>   
                    <div class="input">
                        <label for="">Class</label>
                        <select name="Class" id="">
                            <option value="ENGINES IN STOCK">ENGINES IN STOCK</option>
                            <option value="ASHORE MACHINERY">ASHORE MACHINERY</option>
                        </select>
                    </div>  
                </section> 
                <section class="t-f"> 
                    <div class="input">
                        <label for="">Company</label>
                        <select name="Company" id=""> 
                            @foreach (\DB::table('companies_')->select('Alias')->get() as $Company)
                            <option value="{{ $Company->Alias }}">{{ $Company->Alias }}</option>
                            @endforeach
                        </select>
                    </div>   
                </section>
                <br><br>
            </div>
        </form>
        <button class="AddGeneratorButtonX">Create →</button>
    </div>
</div>