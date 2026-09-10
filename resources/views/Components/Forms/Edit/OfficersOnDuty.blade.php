<div class="form-1 UpdateOfficersOnDuty">
    <div class="inner">
        <div class="close-button">
            <span>    </span>
            <button class="close-button-update-officers-on-duty">✖</button>
        </div>
        <form action="" class="UpdateOfficersOnDutyForm" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="inner-1"> 
                <div class="fields">
                    <p class="error-daily-report error"></p>  
                    <h1>Officers On Duty</h1>
                    <section>
                        <div class="input OfficersOnDuty">
                            <label for="">Name</label> 
                            <label for="">Morning</label> 
                            <label for="">Afternoon</label> 
                            <label for="">Night</label> 
                            <label for="">Signature</label> 
                        </div> 
                    </section>
                    <section> 
                        <div class="input"> 
                            <input type="input" name="Name"> 
                            <input type="checkbox" name="Morning" value="Yes"> 
                            <input type="checkbox" name="Afternoon" value="Yes"> 
                            <input type="checkbox" name="Night" value="Yes"> 
                            <input type="file" name="Signature" accept="image/*"> 
                        </div>       
                    </section>
                    <section> 
                        <div class="input"> 
                            <input type="input" name="Name2"> 
                            <input type="checkbox" name="Morning2" value="Yes"> 
                            <input type="checkbox" name="Afternoon2" value="Yes"> 
                            <input type="checkbox" name="Night2" value="Yes"> 
                            <input type="file" name="Signature2" accept="image/*"> 
                        </div>       
                    </section>
                    <section> 
                        <div class="input"> 
                            <input type="input" name="Name3"> 
                            <input type="checkbox" name="Morning3" value="Yes"> 
                            <input type="checkbox" name="Afternoon3" value="Yes"> 
                            <input type="checkbox" name="Night3" value="Yes"> 
                            <input type="file" name="Signature3" accept="image/*"> 
                        </div>       
                    </section>
                    <section> 
                        <div class="input"> 
                            <input type="input" name="Name4"> 
                            <input type="checkbox" name="Morning4" value="Yes"> 
                            <input type="checkbox" name="Afternoon4" value="Yes"> 
                            <input type="checkbox" name="Night4" value="Yes"> 
                            <input type="file" name="Signature4" accept="image/*"> 
                        </div>       
                    </section>
                    <section> 
                        <div class="input"> 
                            <input type="input" name="Name5"> 
                            <input type="checkbox" name="Morning5" value="Yes"> 
                            <input type="checkbox" name="Afternoon5" value="Yes"> 
                            <input type="checkbox" name="Night5" value="Yes"> 
                            <input type="file" name="Signature5" accept="image/*"> 
                        </div>       
                    </section>
                    <section> 
                        <div class="input"> 
                            <input type="input" name="Name6"> 
                            <input type="checkbox" name="Morning6" value="Yes"> 
                            <input type="checkbox" name="Afternoon6" value="Yes"> 
                            <input type="checkbox" name="Night6" value="Yes"> 
                            <input type="file" name="Signature6" accept="image/*"> 
                        </div>       
                    </section>
                    <section> 
                        <div class="input"> 
                            <input type="input" name="Name7"> 
                            <input type="checkbox" name="Morning7" value="Yes"> 
                            <input type="checkbox" name="Afternoon7" value="Yes"> 
                            <input type="checkbox" name="Night7" value="Yes"> 
                            <input type="file" name="Signature7" accept="image/*"> 
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
                </div>
                <br>
            </div> 
        </form>
        <button class="UpdateOfficersOnDutyButton">Update →</button>
    </div>
</div>