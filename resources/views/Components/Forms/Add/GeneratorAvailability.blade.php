<div class="form-1 AddGeneratorAvailability">
    <div class="inner">
        <div class="close-button">
            <span>    </span>
            <button class="cancel-button-generator-availability">✖</button>
        </div>
        <form action="" class="AddGeneratorAvailabilityForm" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="inner-1"> 
                <div class="fields">
                    <p class="error-generator-availability error"></p>
                    <section>
                        <div class="input">
                            <label for="">Machinery</label> 
                            <input type="text" autocomplete="off" id="FILTER_Input5" onkeyup="filterFunction5()" name="Generator">
                            <div class="filter-list-wrapper-5 wrap-x">
                                @foreach (\DB::table('generators')->get() as $Generator) 
                                <div class="filter-value-5"> 
                                    <h1>{{ $Generator->EngineMake }}</h1>
                                    <div> 
                                        <span>{{ $Generator->Priority_InternalNo }}</span> 
                                        <span>({{ $Generator->Company }})</span> 
                                        <span class="Hide">{{ $Generator->id }}</span> 
                                    </div>
                                </div>
                                @endforeach 
                                <div class="empty empty5">
                                    <center>
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-280q17 0 28.5-11.5T520-320q0-17-11.5-28.5T480-360q-17 0-28.5 11.5T440-320q0 17 11.5 28.5T480-280Zm-40-160h80v-240h-80v240Zm40 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg>
                                        <h1>No data available</h1>
                                        <p>Looks like the search value you entered isn't in the list.</p>
                                        <br>
                                        <p>Please try again!</p>
                                    </center>
                                </div>
                            </div>
                        </div>  
                        <div class="input">
                            <label for="">Status</label>
                            <select name="Status" id="">  
                                <option value="MAINTENANCE">MAINTENANCE</option> 
                                <option value="BREAKDOWN">BREAKDOWN</option> 
                                <option value="INSPECTION">INSPECTION</option>  
                                <option value="IDLE">READY TO GO</option> 
                            </select>
                        </div> 
                        <div class="input">
                            <label for="">Done By</label>
                            <input type="text" name="DoneBy">
                        </div> 
                        {{-- <div class="input Hide">
                            <label for="">Attachment</label>
                            <input type="file" name="Attachment">
                        </div>  --}}
                        <div class="input">
                            <label for="">Remarks</label>
                            <input type="text" name="Remarks">
                        </div>   
                    </section> 
                    <input type="text" name="EngineMake" class="Hide">
                </div>   
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
                <input type="text" name="GeneratorId" class="Hide">
                <section class="t-f"> 
                    <div class="input">
                        <label for="">Till date</label>
                        <select name="TillNow" id=""> 
                            <option value="NO">NO</option> 
                            <option value="YES">YES</option> 
                        </select>
                    </div>   
                </section>
                <br><br>
            </div>
        </form>
        <button class="AddGeneratorAvailabilityButton">Create →</button>
    </div>
</div>