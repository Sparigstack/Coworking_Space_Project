 <!-- edit seat tab  -->
 <div class="card-body col12css edit-seat-form">

<form id="editMeetingroomForm" action="{{ route('allocateMeetingRooms.store') }}" >
<input type="hidden"  class='space_meeting_room_id' name='space_meeting_room_id' >
<input type="hidden" name="inquire_id" class='added_inquire_id'>


<input type="hidden" name="" class='occupier_name'>
<input type="hidden" name="" class='occupier_email'>
<input type="hidden" name="" class='occupier_phone_number'>
<input type="hidden" name="" class="old_inquire_id" value="">
<input type="hidden" name="allocation_id" class="allocation_id" value="">

    {{ csrf_field() }}                        
    <div class="row">

        <!-- when suggestion is added -->
        <div class="form-group col-12 alreadyaddedContactPerson parent ">
            <label for="Addedname">who is occupying this meating room</label>
                                    
            <p class='contactDetails d-none'> 
                <span class="contact_name"></span>  (<span class="contact_phone"></span>)  (<span class="contact_email"></span>)

                <span class="d-block">
                    <a href="javascript:void()" onclick="showContactInput()" class=" text-underline">Change</a>
            <a href="javascript:void()" onclick="vacantMetingRoom(this)" class=" ml-2 text-underline">Vacant room</a>
                 </span>

                
            </p>
            
            <input value="" maxlength="1000" type="search" class="form-control searchSeatcontactdet" name="Addedname" id="Addedname" placeholder="Search By Name or Contact number or Email" autocomplete="off">
            <a href="javascript:void()" class='backBtnContact  mt-2 d-none text-underline' onclick='backContactBtn()'  style="position: absolute;right: 8px;" >back</a>
            <i class="fa fa-spinner fa-spin float-right mr-2 d-none" style="font-size:20px;margin-top: -29px;"></i>
            <p class="d-none text-danger alertMSG">Add appropriate data from suggestion or add new contact</p>
            <!-- default div for suggestion -->
         <div class='searchPersonContainer'>
         <div class="searchResult ">
                <div class="userSearchcardDefault d-none card" onclick="addthisToinput(this);">
                    <div class="align-center  p-2 ">
                        <span class="search-userName ">
                            demoName
                        </span>
                        <span>, </span>
                        <span class="search-userContact  ">
                            9898989898
                        </span>
                        <span>, </span>
                            <span class='search-emailAddress pull-right'>abc.sprigstack@outlook.com</span>
                            <!-- <span class="pull-right search-already"></span> -->
                       
                    </div>
                </div>
              
            </div>
            <div class="addNewDetDiv c-pointer  d-none">
                <div class="card newContactbtn p-3">
                    <span onclick="AddNewContactDetail()" class="text-underline">Add New Contact</span>
                </div>
            </div>

         </div>

           
            <!-- default div end -->

        </div>
        <!-- end -->

        <!-- when suggestion is not added (new contact is added)-->
        <div class="newContactPerson d-none" style='position: relative;'>
            <div class="" style="display: flex;">
                <div class="form-group col-md-6 ">
                    <label for="name">Name of Contact Person</label>
                    <input value="" maxlength="1000" type="text" class="form-control" name="name" id="Newname" placeholder="Enter Your Name">
                </div>
                <div class="form-group col-md-6 ">
                    <label for="phone_number">Contact Number</label>
                    <input value="" maxlength="1000" type="number" class="form-control" name="phone_number" id="phoneNum" placeholder="Enter contact number">
                </div>
            </div>
            <div class="form-group col-12  mt-2">
                <label for="email">Email Id</label>
                <input value="" maxlength="1000" type="email" class="form-control" name="email" id="newEmail" placeholder="Enter Your Email">
            </div>
            <a href="javascript:void()" class='backBtnContact  mt-2 d-none text-underline' onclick='backContactBtn()'  style="position: absolute;right: 8px;" >back</a>
        </div>
        <!-- end -->

      

    </div>
    <div class="row">
        <div class="form-group  col-md-6 col-12">
            <label>Duration Type</label>
            <div class="row">
                <div class="column col-6">
                    <div class="icheck-material-primary">
                        <input  type="radio" id="editMeetingHourly"  name="meetingDuration" value="hourly">
                        <label for="editMeetingHourly">Hourly</label>
                    </div>
                </div>
                <div class="column col-6">
                    <div class="icheck-material-primary">
                        <input type="radio" id="editMeetingDaily"  name="meetingDuration" value="daily">
                        <label for="editMeetingDaily">Daily</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group  col-md-6 mt-2 ">
            <label for="datetime">Date</label>
            <div class="input-group date align-items-center datetimepickerforseating" id="">
                <input type="date" class="form-control" id="date" name="date" placeholder="DD/MM/YY" required="" autocomplete="off" style="cursor:pointer;border-radius: 0.25rem !important;">
                <span class="input-group-addon " style="position: absolute;margin-left: 100%;padding-left: 10px;">
                  
                </span>
            </div>
        </div>
    </div>


    <div class="row" style="align-items: self-end;">
        <div class="form-group col-md-6 mt-2">
            <label for="duration_days">Duration </label>
            <input value="1" type="number" class="form-control" name="duration_days" placeholder="Days" min="1" max="3" pattern="[0-9]" onkeyup="if(this.value>3){this.value='3';}else if(this.value<0){this.value='0';}" required="required">
        </div>

        <div class="form-group col-md-6 mt-2 ">
        <label for="start_time">Start time:</label>
            <div class="input-group">
           
<input type="text" id="start_time" autocomplete='off' class='input-group form-control datepickertime' name="start_time"
required>
<div class="input-group-append" data-target="#start_time" data-toggle="datetimepicker">
<div class="input-group-text"><i class="fa fa-clock-o"></i></div>
</div>
            </div>

        </div>
        <div class="form-group col-md-6 mt-2 ">
        <label for="end_time">End time:</label>
            <div class="input-group">
<input type="text" id="end_time" autocomplete='off' class='input-group form-control datepickertime' name="end_time"
required>
<div class="input-group-append" data-target="#end_time" data-toggle="datetimepicker">
<div class="input-group-text"><i class="fa fa-clock-o"></i></div>
</div>
            </div>
        </div>

    </div>
    <p class="meetingError text-danger"> </p>
    <div class="row">
        <div class="form-group col-md-6 col-12 mt-2 ">
            <label for="seat_charges" class="chargesBasis">Charges</label>
           
            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="iconColor fas fa-rupee-sign" aria-hidden="true"></i></span>
                            </div> 
                            <input value=""  type="number" class="form-control" name="seat_charges" id="seat_charges" placeholder="Ex: 100" required="" min="0" pattern="[0-9]"  step="1">
           </div>

        </div>
        <div class="form-group col-md-6 col-12 mt-2 ">
            <label for="">Lead Source</label>
            <select id="lead_source" required="" name="lead_source" class="form-control">
                <option value="Gocoworq.com">Gocoworq.com</option>
                <option value="Manual Walk-in">Manual Walk-in</option>
            </select>
        </div>
    </div>
  
    
   


    <div class="form-group d-flex justify-content-center align-items-center mt-3">
<a href="javascript:void(0)" data-dismiss="modal" class='text-underline closeModal text-capitalize'>cancel</a>
        <button type="submit"  class="btn d-inline-block btn-warning waves-effect waves-light m-1 ml-3 checkpropdata">Save</button>
    </div>
    
  
</form>
</div>