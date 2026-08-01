<div class="form-1 AddVessel_Checklist3">
    <div class="inner">
        <div class="close-button">
            <span>    </span>
            <button class="cancel-button-vessel-checklist">✖</button>
        </div>
        <form action="" class="AddVessel_ChecklistForm" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="inner-1"> 
                <div class="fields">
                    <h1>VESSEL HANDOVER/ TAKEOVER STATEMENT
                        </h1>
                    <section>
                        @php
                            $Vessels = \DB::table('vessels_vessel_information')->select('VesselName')->whereIn('VesselType', ['PILOT CUTTERS', 'SURVEY', 'MULTICAT', 'MOORING'])->get();
                            $Captains_Engineers = \DB::table('employees')->select('FullName')->whereIn('Rank', ['CAPTAIN', 'ENGINEER'])->get();
                        @endphp
                        <div class="input">
                            <label for="">Vessel</label> 
                            <select name="Vessel" id="">
                                @foreach ($Vessels as $Vessel)
                                <option value="{{ $Vessel->VesselName }}">{{ $Vessel->VesselName }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="input">
                            <label for="">IMO</label>
                            <input type="text" name="IMO">
                        </div> 
                        <div class="input">
                            <label for="">Port/Place of Handover</label>
                            <input maxlength="23" type="text" name="Port_PlaceOfHandover">
                        </div> 
                        <div class="input">
                            <label for="">Date</label>
                            <input type="date" name="Date">
                        </div> 
                        <h1>Outgoing</h1>
                        <div class="input">
                            <label for="">Captain</label>
                            <select name="OutgoingCapt_EngName" id="">
                                @foreach ($Captains_Engineers as $Captain_Engineer)
                                <option value="{{ $Captain_Engineer->FullName }}">{{ $Captain_Engineer->FullName }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="input">
                            <label for="">Engineer</label>
                            <select name="OutgoingCapt_EngName" id="">
                                @foreach ($Captains_Engineers as $Captain_Engineer)
                                <option value="{{ $Captain_Engineer->FullName }}">{{ $Captain_Engineer->FullName }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <h1>Incoming</h1>
                        <div class="input">
                            <label for="">Captain</label>
                            <select name="OutgoingCapt_EngName" id="">
                                @foreach ($Captains_Engineers as $Captain_Engineer)
                                <option value="{{ $Captain_Engineer->FullName }}">{{ $Captain_Engineer->FullName }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="input">
                            <label for="">Engineer</label>
                            <select name="OutgoingCapt_EngName" id="">
                                @foreach ($Captains_Engineers as $Captain_Engineer)
                                <option value="{{ $Captain_Engineer->FullName }}">{{ $Captain_Engineer->FullName }}</option>
                                @endforeach
                            </select>
                        </div>      
                    </section> 
                </div>
                <br>
                <section class="t-f">
                    <h1>BOAT ENVIRONMENT</h1>
                    <div class="input">
                        <label class="th-1" for=""></label>
                        <span class="th-2">Good</span>
                        <span class="th-3">Not Good</span> 
                    </div>   
                    <div class="input">
                        <label for="">Sanitary and waste management</label>
                        <input type="radio" name="Sanitary_Waste" value="Good">
                        <input type="radio" name="Sanitary_Waste" value="NotGood"> 
                    </div>    
                    <div class="input">
                        <label for="">Bilge maintenance</label>
                        <input type="radio" name="Bilge_Maintenance" value="Good">
                        <input type="radio" name="Bilge_Maintenance" value="NotGood"> 
                    </div>    
                    <div class="input">
                        <label for="">Remarks</label>
                        <input type="text" name="BoatEnvironment_Remarks">
                    </div>    
                </section>
                <br>
                <section class="t-f">
                    <h1>Comm. Device/ CCTV</h1>
                    <div class="input">
                        <label class="th-1" for=""></label>
                        <span class="th-2">Working</span>
                        <span class="th-3">Not Working</span>
                        <span class="th-4">Recording</span>
                        <span class="th-5">Not Recording</span>
                    </div>   
                    <div class="input">
                        <label for="">VHF 1</label>
                        <input type="radio" name="VHF_1" value="Working">
                        <input type="radio" name="VHF_1" value="NotWorking"> 
                        <input type="radio" name="VHF_1a" value="Recording">
                        <input type="radio" name="VHF_1a" value="NotRecording"> 
                    </div>    
                    <div class="input">
                        <label for="">VHF 2</label>
                        <input type="radio" name="VHF_2" value="Working">
                        <input type="radio" name="VHF_2" value="NotWorking">
                        <input type="radio" name="VHF_2a" value="Recording">
                        <input type="radio" name="VHF_2a" value="NotRecording"> 
                    </div>      
                    <div class="input">
                        <label for="">Handheld</label>
                        <input type="radio" name="Handheld" value="Working">
                        <input type="radio" name="Handheld" value="NotWorking">
                        <input type="radio" name="Handhelda" value="Recording">
                        <input type="radio" name="Handhelda" value="NotRecording"> 
                    </div>    
                    <div class="input">
                        <label for="">AIS</label>
                        <input type="radio" name="AIS" value="Working">
                        <input type="radio" name="AIS" value="NotWorking">
                        <input type="radio" name="AISa" value="Recording">
                        <input type="radio" name="AISa" value="NotRecording"> 
                    </div>   
                    <div class="input">
                        <label for="">CCTV</label>
                        <input type="radio" name="CCTV" value="Working">
                        <input type="radio" name="CCTV" value="NotWorking">
                        <input type="radio" name="CCTVa" value="Recording">
                        <input type="radio" name="CCTVa" value="NotRecording"> 
                    </div> 
                    <div class="input">
                        <label for="">Remarks</label>
                        <input type="text" name="Comm_Device_CCTV_Remarks">
                    </div>    
                </section>  
                <br><br>
                <section class="t-f">
                    <h1>Deck Equipment Condition</h1>
                    <div class="input">
                        <label class="th-1" for=""></label>
                        <span class="th-2">OK</span>
                        <span class="th-3">NOT OK</span>
                    </div>   
                    <div class="input">
                        <label for="">Bits and Bollards</label>
                        <input type="radio" name="BitsAndBollards" value="Good">
                        <input type="radio" name="BitsAndBollards" value="NotGood">
                    </div>    
                    <div class="input">
                        <label for="">Ropes</label>
                        <input type="radio" name="Ropes" value="Good">
                        <input type="radio" name="Ropes" value="NotGood">
                    </div>      
                    <div class="input">
                        <label for="">Fenders</label>
                        <input type="radio" name="Fenders" value="Good">
                        <input type="radio" name="Fenders" value="NotGood">
                    </div>      
                    <div class="input">
                        <label for="">Hatch</label>
                        <input type="radio" name="Hatch" value="Good">
                        <input type="radio" name="Hatch" value="NotGood">
                    </div>   
                    <div class="input">
                        <label for="">Remarks</label>
                        <input type="text" name="Deck_Equipment_Remarks">
                    </div>   
                </section>   
                <br><br>
                <section class="t-f">
                    <h1>Dive Results</h1>
                    <div class="input">
                        <label class="th-1" for=""></label>
                        <span class="th-2">Cleared</span>
                        <span class="th-3">OK</span>
                        <span class="th-4">NOT OK</span>
                    </div>   
                    <div class="input">
                        <label for="">Propeller</label>
                        <input type="radio" name="Propeller" value="Cleared">
                        <input type="radio" name="Propeller" value="OK">
                        <input type="radio" name="Propeller" value="NOT OK">
                    </div>    
                    <div class="input">
                        <label for="">Echo Sounder</label>
                        <input type="radio" name="EchoSounder" value="Cleared">
                        <input type="radio" name="EchoSounder" value="OK">
                        <input type="radio" name="EchoSounder" value="NOT OK">
                    </div>      
                    <div class="input">
                        <label for="">Box Cooler</label>
                        <input type="radio" name="BoxCooler" value="Cleared">
                        <input type="radio" name="BoxCooler" value="OK">
                        <input type="radio" name="BoxCooler" value="NOT OK">
                    </div>    
                    <div class="input">
                        <label for="">Nozzle Bolts</label>
                        <input type="radio" name="NozzleBolts" value="Cleared">
                        <input type="radio" name="NozzleBolts" value="OK">
                        <input type="radio" name="NozzleBolts" value="NOT OK">
                    </div>  
                    <div class="input">
                        <label for="">Remarks</label>
                        <input type="text" name="Dive_Result_Remarks">
                    </div>   
                </section> 
                <section class="t-f">
                    <h1>LSA Condition</h1>
                    <div class="input">
                        <label class="th-1" for=""></label>
                        <span class="th-2">OK</span>
                        <span class="th-3">NOT OK</span>
                    </div>   
                    <div class="input">
                        <label for="">Life rafts and cradles</label>
                        <input type="radio" name="LifeRaftsAndCradles" value="OK">
                        <input type="radio" name="LifeRaftsAndCradles" value="NOT OK">
                    </div>    
                    <div class="input">
                        <label for="">Life rings</label>
                        <input type="radio" name="LifeRings" value="OK">
                        <input type="radio" name="LifeRings" value="NOT OK">
                    </div>      
                    <div class="input">
                        <label for="">Life jackets and work vest</label>
                        <input type="radio" name="LifeJacketsAndWorkVest" value="OK">
                        <input type="radio" name="LifeJacketsAndWorkVest" value="NOT OK">
                    </div>    
                    <div class="input">
                        <label for="">Remarks</label>
                        <input type="text" name="LSA_Condition_Remarks">
                    </div>   
                </section>   
                <br><br> 
                <br><br>
                <section class="t-f">
                    <h1>Safety of Navigation</h1>
                    <div class="input">
                        <label class="th-1" for=""></label>
                        <span class="th-2">Good</span>
                        <span class="th-3">Not Good</span>
                        <span class="th-4">Comments</span>
                    </div>   
                    <div class="input">
                        <label for="">Steering System</label>
                        <input type="radio" name="SteeringSytem" value="Good">
                        <input type="radio" name="SteeringSytem" value="NotGood">
                        <input class="comment" name="SteeringSytem_Comment" type="text">
                    </div>    
                    <div class="input">
                        <label for="">Emergency Steering</label>
                        <input type="radio" name="EmergencySteering" value="Good">
                        <input type="radio" name="EmergencySteering" value="NotGood">
                        <input class="comment" name="EmergencySteering_Comment" type="text">
                    </div>      
                    <div class="input">
                        <label for="">Navigational Lights</label>
                        <input type="radio" name="NavigationalLights" value="Good">
                        <input type="radio" name="NavigationalLights" value="NotGood">
                        <input class="comment" name="NavigationalLights_Comment" type="text">
                    </div>    
                    <div class="input">
                        <label for="">Search Light</label>
                        <input type="radio" name="SearchLight" value="Good">
                        <input type="radio" name="SearchLight" value="NotGood">
                        <input class="comment" name="SearchLight_Comment" type="text">
                    </div> 
                    <div class="input">
                        <label for="">A and B Flags</label>
                        <input type="radio" name="A_B_Flags" value="Good">
                        <input type="radio" name="A_B_Flags" value="NotGood">
                        <input class="comment" name="A_B_Flags_Comment" type="text">
                    </div> 
                    <div class="input">
                        <label for="">Siren/ Horn</label>
                        <input type="radio" name="Siren_Horn" value="Good">
                        <input type="radio" name="Siren_Horn" value="NotGood">
                        <input class="comment" name="Siren_Horn_Comment" type="text">
                    </div> 
                </section> 
                <br><br>
                <section class="t-f">
                    <h1>Navigation & Electronic Equipment</h1>
                    <div class="input">
                        <label class="th-1" for=""></label>
                        <span class="th-2">Good</span>
                        <span class="th-3">Not Good</span>
                        <span class="th-4">Comments</span>
                    </div>   
                    <div class="input">
                        <label for="">Magnetic compass</label>
                        <input type="radio" name="MagneticCompass" value="Good">
                        <input type="radio" name="MagneticCompass" value="NotGood">
                        <input class="comment" name="MagneticCompass_Comment" type="text">
                    </div>    
                    <div class="input">
                        <label for="">Radar</label>
                        <input type="radio" name="Radar" value="Good">
                        <input type="radio" name="Radar" value="NotGood">
                        <input class="comment" name="Radar_Comment" type="text">
                    </div>      
                    <div class="input">
                        <label for="">Echo sounder</label>
                        <input type="radio" name="EchoSounder" value="Good">
                        <input type="radio" name="EchoSounder" value="NotGood">
                        <input class="comment" name="EchoSounder_Comment" type="text">
                    </div>    
                    <div class="input">
                        <label for="">GPS</label>
                        <input type="radio" name="GPS" value="Good">
                        <input type="radio" name="GPS" value="NotGood">
                        <input class="comment" name="GPS_Comment" type="text">
                    </div>  
                </section>
                <br><br>
                <section class="t-f">
                    <h1>Fire Equipment</h1>
                    <div class="input">
                        <label class="th-1" for=""></label>
                        <span class="th-2">Good</span>
                        <span class="th-3">Not Good</span>
                        <span class="th-4">Comments</span>
                    </div>   
                    <div class="input">
                        <label for="">Extinguishers (exp. date)</label>
                        <input type="radio" name="Extinguishers_Exp_Date" value="Good">
                        <input type="radio" name="Extinguishers_Exp_Date" value="NotGood">
                        <input class="comment" name="Extinguishers_Exp_Date_Comment" type="text">
                    </div>    
                    <div class="input">
                        <label for="">Fire hoses (no condition)</label>
                        <input type="radio" name="FireHosesCondition" value="Good">
                        <input type="radio" name="FireHosesCondition" value="NotGood">
                        <input class="comment" name="FireHosesCondition_Comment" type="text">
                    </div>      
                    <div class="input">
                        <label for="">Nozzles (No condition) </label>
                        <input type="radio" name="Nozzles_NoCondition" value="Good">
                        <input type="radio" name="Nozzles_NoCondition" value="NotGood">
                        <input class="comment" name="Nozzles_NoCondition_Comment" type="text">
                    </div>     
                </section>     
            </div>
            <div class="inner-2"> 
                <section class="t-f">
                    <h1>Hull (Dents and damages)</h1>
                    <div class="input">
                        <label class="th-1" for=""></label>
                        <span class="th-2">Good</span>
                        <span class="th-3">Not Good</span>
                        <span class="th-4">Comments</span>
                    </div>   
                    <div class="input">
                        <label for="">Deck maintenance condition</label>
                        <input type="radio" name="DeckMaintenanceCondition" value="Good">
                        <input type="radio" name="DeckMaintenanceCondition" value="NotGood">
                        <input class="comment" name="DeckMaintenanceCondition_Comment" type="text">
                    </div>     
                    <div class="input">
                        <label for="">Accommodation Maint. Condition</label>
                        <input type="radio" name="AccommodationMaintenanceCondition" value="Good">
                        <input type="radio" name="AccommodationMaintenanceCondition" value="NotGood">
                        <input class="comment" name="AccommodationMaintenanceCondition_Comment" type="text">
                    </div>     
                    <div class="input">
                        <label for="">Pilot Handrails condition</label>
                        <input type="radio" name="PilotHandrailsCondition" value="Good">
                        <input type="radio" name="PilotHandrailsCondition" value="NotGood">
                        <input class="comment" name="PilotHandrailsCondition_Comment" type="text">
                    </div>     
                    <div class="input">
                        <label for="">Tyre fender condition</label>
                        <input type="radio" name="TyreFenderCondition" value="Good">
                        <input type="radio" name="TyreFenderCondition" value="NotGood">
                        <input class="comment" name="TyreFenderCondition_Comment" type="text">
                    </div>     
                    <div class="input">
                        <label for="">Hull fenders condition</label>
                        <input type="radio" name="HullFendersCondition" value="Good">
                        <input type="radio" name="HullFendersCondition" value="NotGood">
                        <input class="comment" name="HullFendersCondition_Comment" type="text">
                    </div>     
                </section>   
                <br><br>
                <section class="t-f">
                    <h1>Environmental</h1>
                    <div class="input">
                        <label class="th-1" for=""></label>
                        <span class="th-2">Good</span>
                        <span class="th-3">Not Good</span>
                        <span class="th-4">Comments</span>
                    </div>   
                    <div class="input">
                        <label for="">Garbage collecting</label>
                        <input type="radio" name="GarbageCollecting" value="Good">
                        <input type="radio" name="GarbageCollecting" value="NotGood">
                        <input class="comment" name="GarbageCollecting_Comment" type="text">
                    </div>   
                    <div class="input">
                        <label for="">Garbage depositing</label>
                        <input type="radio" name="GarbageDepositing" value="Good">
                        <input type="radio" name="GarbageDepositing" value="NotGood">
                        <input class="comment" name="GarbageDepositing_Comment" type="text">
                    </div> 
                    <div class="input">
                        <label for="">Engine smoking</label>
                        <input type="radio" name="EngineSmoking" value="Good">
                        <input type="radio" name="EngineSmoking" value="NotGood">
                        <input class="comment" name="EngineSmoking_Comment" type="text">
                    </div>      
                </section>  
                <br><br> 
                <section class="t-f">
                    <h1>Crew Presence on board</h1>
                    <div class="input">
                        <label class="th-1" for=""></label>
                        <span class="th-2">Good</span>
                        <span class="th-3">Not Good</span>
                        <span class="th-4">Comments</span>
                    </div>   
                    <div class="input">
                        <label for="">All crew on board</label>
                        <input type="radio" name="AllCrewOnBoard" value="Good">
                        <input type="radio" name="AllCrewOnBoard" value="NotGood">
                        <input class="comment" name="AllCrewOnBoard_Comment" type="text">
                    </div>     
                </section>   
                <br><br>
                <section class="t-f">
                    <h1>Liquids on board</h1>
                    <div class="input">
                        <label class="th-1" for=""></label>
                        <span class="th-2">Good</span>
                        <span class="th-3">Not Good</span>
                        <span class="th-4">Comments</span>
                    </div>   
                    <div class="input">
                        <label for="">Fuel oil (ROB)</label>
                        <input type="radio" name="FuelOil" value="Good">
                        <input type="radio" name="FuelOil" value="NotGood">
                        <input class="comment" name="FuelOil_Comment" type="text">
                    </div>     
                    <div class="input">
                        <label for="">Lube oil (ROB)</label>
                        <input type="radio" name="LubeOil" value="Good">
                        <input type="radio" name="LubeOil" value="NotGood">
                        <input class="comment" name="LubeOil_Comment" type="text">
                    </div>     
                    <div class="input">
                        <label for="">Fresh water (ROB)</label>
                        <input type="radio" name="FreshWater" value="Good">
                        <input type="radio" name="FreshWater" value="NotGood">
                        <input class="comment" name="FreshWater_Comment" type="text">
                    </div>     
                </section>   
                <br><br>
                <section class="t-f">
                    <h1>Engine Maintenance </h1>
                    <div class="input">
                        <label class="th-1" for=""></label>
                        <span class="th-2">Good</span>
                        <span class="th-3">Not Good</span>
                        <span class="th-4">Comments</span>
                    </div>   
                    <div class="input">
                        <label for="">Condition of main engine(s)</label>
                        <input type="radio" name="ConditionOfMainEngine" value="Good">
                        <input type="radio" name="ConditionOfMainEngine" value="NotGood">
                        <input class="comment" name="ConditionOfMainEngine_Comment" type="text">
                    </div>     
                    <div class="input">
                        <label for="">Lube oil cons/hour/engine</label>
                        <input type="radio" name="LubeOil_Cons_hour_Engine" value="Good">
                        <input type="radio" name="LubeOil_Cons_hour_Engine" value="NotGood">
                        <input class="comment" name="LubeOil_Cons_hour_Engine_Comment" type="text">
                    </div>     
                    <div class="input">
                        <label for="">Condition of gear box(es)</label>
                        <input type="radio" name="ConditionOfGearBox" value="Good">
                        <input type="radio" name="ConditionOfGearBox" value="NotGood">
                        <input class="comment" name="ConditionOfGearBox_Comment" type="text">
                    </div>     
                    <div class="input">
                        <label for="">Condition of gen set(s)</label>
                        <input type="radio" name="ConditionOfGenSet" value="Good">
                        <input type="radio" name="ConditionOfGenSet" value="NotGood">
                        <input class="comment" name="ConditionOfGenSet_Comment" type="text">
                    </div>      
                    <div class="input">
                        <label for="">Condition of Bilge Pump</label>
                        <input type="radio" name="ConditionOfBilgePump" value="Good">
                        <input type="radio" name="ConditionOfBilgePump" value="NotGood">
                        <input class="comment" name="ConditionOfBilgePump_Comment" type="text">
                    </div>     
                    <div class="input">
                        <label for="">Condition of Bilge system</label>
                        <input type="radio" name="ConditionOfBilgeSystem" value="Good">
                        <input type="radio" name="ConditionOfBilgeSystem" value="NotGood">
                        <input class="comment" name="ConditionOfBilgeSystem_Comment" type="text">
                    </div>     
                    <div class="input">
                        <label for="">Condition of Battery(es)</label>
                        <input type="radio" name="ConditionOfBattery" value="Good">
                        <input type="radio" name="ConditionOfBattery" value="NotGood">
                        <input class="comment" name="ConditionOfBattery_Comment" type="text">
                    </div>     
                    <div class="input">
                        <label for="">Shore connection cables</label>
                        <input type="radio" name="ShoreConnectionCables" value="Good">
                        <input type="radio" name="ShoreConnectionCables" value="NotGood">
                        <input class="comment" name="ShoreConnectionCables_Comment" type="text">
                    </div>    
                </section> 
                <br><br>
                <section class="t-f">
                    <h1>The service on the Vessel has been taken over in accordance with<br> the above findings and comments  </h1>
                    <div class="input">
                        <label for="">Outgoing Captain /Engineer <br> comments (If any): </label>
                        <textarea maxlength="50" name="Outgoing_Captain_Engineer" id="" cols="30" rows="10"></textarea>
                    </div> 
                    <div class="input">
                        <label for="">Incoming Captain/Engineer <br> comments (If any):</label>
                        <textarea maxlength="50" name="Incoming_Captain_Engineer" id="" cols="30" rows="10"></textarea>
                    </div>  
                </section>  
            </div>
        </form>
        <div class="button">
            <button class="AddVessel_ChecklistButton">Handover →</button>
        </div>
        <p class="error-small-Vessels-checklist error"></p>
    </div>
</div>