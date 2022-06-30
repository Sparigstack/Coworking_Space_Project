
<div class="modal fade" id="vacantSeatmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  vacant-seat-modal"  role="document" style="max-width: 805px !important;">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-center" style="font-size: 20px;" > Occupy <span class='modaldeskText'> Hot flexi desk</span>  </h5>
                
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-right: 20px;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <!-- edit seat tab  -->
                <div class="card-body col12css edit-seat-form">

                    <form class="" id='OccupySeatForm'  action="{{ url('saveSeatData') }}" >

                        {{ csrf_field() }}
                        <input type="hidden" name="space_id" value="{{$spaceid}}">
                        <input type="hidden" name="space_seat_type_id" class="space_seat_type_id" value="">
                        <input type="hidden" name="seat_type_id" class="seat_type_id" value="">
                        <input type="hidden" name="added_inquire_id" class="added_inquire_id" value="">
                        <input type="hidden" name="" class="old_inquire_id" value="">
                        <input type="hidden" name="occupation_id" class="occupation_id" value="">
                        <input type="hidden" name="Go_Passport_id" class="Go_pass_num" value="">
                        <input type="hidden" name="go_pass_num" class="go_pass_num" value="">
                        <input type="hidden" name="spaceDiscount" class="spaceDiscount" value="{{$Discount}}">
                        <input type="hidden"  class="validateGoPass" value="{{url('validateGoPass')}}">
                        <input type="hidden" name="seat_charges" class="totalChargesInput">
                        
                        
                        <div class="row">

                            <!-- when suggestion is added -->
                            <div class="form-group col-12 alreadyaddedContactPerson parent">
                                <label for="Addedname">who is occupying this seat</label>
                               <!--add invoice link---->
                                <a href="javascript:void(0)" onclick='addInvoiceDetails(this)' class='text-underline invoicelink d-none' style="float: right;">Add invoice</a>
                                <!--end-->
                                
                                <p class='contactDetails d-none'> 
                                    <span class="contact_name"></span>  (<span class="contact_phone"></span>)  (<span class="contact_email"></span>)
                                    <a href="javascript:void()" onclick='showContactInput()' class='d-block text-underline'>Change</a>
                                </p>
                                
                                <input value="" maxlength="1000" type="search" class="form-control searchSeatcontactdet" name="Addedname" id="Addedname" placeholder="Search By Name or Contact number or Email" required="" autocomplete="off">
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
                                        <label for="Newname">Name of Contact Person</label>
                                        <input value="" maxlength="1000" type="text" class="form-control" name="Newname" id="Newname" placeholder="Enter Your Name">
                                    </div>
                                    <div class="form-group col-md-6 ">
                                        <label for="phoneNum">Contact Number</label>
                                        <input value="" maxlength="1000" type="number" class="form-control" name="phoneNum" id="phoneNum" placeholder="Enter contact number">
                                    </div>
                                </div>
                                <div class="form-group col-12  mt-2">
                                    <label for="newEmail">Email Id</label>
                                    <input value="" maxlength="1000" type="email" class="form-control" name="newEmail" id="newEmail" placeholder="Enter Your Email">
                                </div>
                                <a href="javascript:void()" class='backBtnContact  mt-2 d-none text-underline' onclick='backContactBtn()'  style="position: absolute;right: 8px;" >back</a>
                            </div>
                            <!-- end -->

                            <div class="form-group  col-6 mt-2 ">
                                <label for="datetime">Start Date</label>
                                <div class='input-group date align-items-center datetimepickerforseating' id=''>
                                    <input type='date' class="form-control" id="datetime" name="datetime" placeholder="DD/MM/YY" required="" autocomplete="off" style="cursor:pointer;border-radius: 0.25rem !important;" />
                                    <span class="input-group-addon " style="position: absolute;margin-left: 100%;padding-left: 10px;">
                                      
                                    </span>
                                    <p class='text-danger occupySeatDateError mb-0'></p>
                                </div>

                            </div>

                        </div>
                        <div class="row" style="align-items: self-end;">


                            <div class="form-group col-md-6 mt-2 ">
                                <label for="duration_days">Duration</label>
                                <input value="" maxlength="800" type="number" class="form-control" name="duration_days" id="duration_days" placeholder="Ex: 5" required="" min="0" pattern="[0-9]" onkeypress="return !(event.charCode == 46)" step="1">
                            </div>
                            <div class="form-group col-md-6 mt-2 ">
                                <!-- <label for="">Duration</label> -->
                                <select id="seat_duration" required="" name="seat_duration" class="form-control" onchange="selectseatDuration(this);">
                                    <option value="1">Days</option>
                                    <option value="2">Months</option>
                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-12 mt-2 ">
                                <label for="" class="chargesBasis">Charges per Day</label>
                                <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="iconColor fas fa-rupee-sign" aria-hidden="true"></i></span>
                                                </div> 
                                                <input value="" maxlength="900" type="number" class="form-control" name="duration_charges" id="duration_charges" placeholder="Ex: 100" required="" min="0" pattern="[0-9]" onkeypress="return !(event.charCode == 46)" step="1">
                                            </div>

                               
                            </div>
                            <div class="form-group col-md-6 col-12 mt-2 ">
                                <label for="">Lead Source</label>
                                <select id="lead_source" required="" name="lead_source" class="form-control">
                                    <option value="1">Gocoworq.com</option>
                                    <option value="2">Manual Walk-in</option>
                                </select>
                            </div>
                        </div>
                      
                        
                        <div class="row mt-2" style="margin:auto">
                        <div class="col-md-6 pl-0">
                        <div class="form-group   go_pass_checkbox icheck-material-info" style="margin: auto 0;">
                                    <input type="checkbox" class="form-check-input mt-0 checkboxclass" id="GoPass" name="GoPass" value="1" onclick="GoPassCheck()">
                               <label class="form-check-label" for="GoPass">have go-pass?</label>
                                </div>
                                <div class="form-group mt-2 input-group mr-3 text_area_checkbox">
                                     <input type="textarea" id="Gopassnum" rows="1" placeholder="Enter Go-pass number" cols="" class="Gopassclass addGopass form-control" value="" name="Gopassnum"  style=""> 
                                     <div class="input-group-append">
                                     <button type="button" class="btn btn-warning waves-effect waves-light checkboxbtns " id="checkbtn" onclick="Validategopass(this)" style="" required>Check Validity</button> 
  </div>
                               </div>
                               <div   class="d-none Go_pass_num_alert go_pass_num_check ">
                     <p class="Go_pass_num_alertmsg " >Go-pass number is not match</p>
                     <!--<p class="text-success d-none alertMSG" style="">Go-pass number is  match</p>-->
                     </div>
                        </div>
                            
                            
                        <div class="col-md-6 mt-3 mt-md-0 text-left text-md-right">
<p class="font-weight-bold "> Total charges: ₹ <span class="totalCharges">0</p>
                        </div>
                 
                      
                                           
                        </div>


                        <div class="form-group d-flex justify-content-center align-items-center mt-3">
              <a href="javascript:void(0)" class='text-underline closeModal text-capitalize'>cancel</a>
                            <button type="submit" class="btn d-inline-block btn-warning waves-effect waves-light m-1 ml-3 checkpropdata">Save</button>
                        </div>
                        
                      
                    </form>



                




    <!-- invoice tab -->
          



                </div>
        </div>
    </div>
</div>
    <!-- end of invoice tab -->