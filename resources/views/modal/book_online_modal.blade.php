
<input type="hidden" name="" class="payNowUrl" value="{{route('book_now')}}">
<input type="hidden" name="" class="saveSeatDetailsUrl" value="{{route('saveSeatingDetails')}}">
@modal(['size' => 'modal-lg' , 'title' => "Book a Day-Pass" , 'id' => 'bookSeatModal'])
<div class="col-12">
    <h6>You can book online for a short duration, maximum 7 days, for vacant hot/flexi or dedicated desks at this space.</h6>
</div>
<div class="card-body col12css">
    <form method="post" action="{{url('checkBookingAvailability')}}" class='form'
    onsubmit="return checkBookingAvailability(this);">
    {{ csrf_field() }}
    <input type="hidden" class="spaceIdforBooking" value="{{$spaceDetails->id}}">
    <input type="hidden" class="checkBookingAvailability" value="{{url('checkBookingAvailability')}}">
    <div class="row">
        <div class="row col-12">
  
          @formGroup(['groupClass' => "col-lg-4 col-md-6 col-12" , 'name' => 'noofSeats' ,'label' => "Number of Seats" , 'placeholder' => "Ex: 1" , 'type' => 'number' , 'required' => 'required' , 'attr' => array(
              'min' => "1",
              "max" => "5",
              'pattern' => "[0-9]",
              'onKeyUp' => "if(this.value>5){this.value='5';}else if(this.value<0){this.value='0';}"
          )])
  
            <div class="form-group col-lg-5 col-md-6 col-12">
                <label for="">Interested In </label>
                <select onchange="$(this).prop('selected', true);" id="book_seating_options" required=""
                    name="seatingType" class="form-control">
                  
                    @foreach($getSeatingTypes as $getSeatingType)

                    @if ($loop->first) <option value="{{$getSeatingType->seating_type->id}}" selected='selected'>
                        {{$getSeatingType->seating_type->name}}</option> 
                    @else
                   
                    <option value="{{$getSeatingType->seating_type->id}}">
                        {{$getSeatingType->seating_type->name}}</option>
                    @endif

                    @endforeach
               
                </select>
            </div>
        </div>
    </div>
    <div class="row inquiryBookParent">
        <div class="row col-12 inquiryInputsDefault ">
           
            @formGroup(['groupClass' => "col-lg-4 col-md-6 col-12" , 'name' => 'name' , 'inputVal' => old('name') ?? $user->full_name ,'label' => "Name" , 'placeholder' => "Enter Your Name" , 'required' => 'required' ])
  
            @formGroup(['groupClass' => "col-lg-5  col-md-6 col-12" , 'name' => 'emailAddress' , 'type' => 'email' , 'inputVal' =>  old('emailAddress') ?? $user->email ,'label' => "Email" , 'placeholder' => "Enter Your Email Address" , 'required' => 'required'])
  
            @formGroup(['groupClass' => "col-lg-3 col-md-6 col-12" , 'name' => 'phnum' , 'inputVal' =>  old('phnum') ?? $user->phone_number ,'label' => "Phone Number" , 'placeholder' => "Enter Your Phone Number" , 'required' => 'required'])
  
        </div>
    </div>
    
   
    <div class="row">
        <div class="col-md-12 row">
            <div class="form-group col-lg-4 col-md-6 col-12">
                <label for="datetime">Start Date</label>
                <div class="input-group date align-items-center datetimepickerforseating" id="">
                    <input min="{{date('Y-m-d')}}" value="{{date('Y-m-d')}}" class="datePickerForSeating" type="date"
                        class="form-control c-pointer"  name="datetime"
                        placeholder="DD/MM/YY" required="" autocomplete="off">
                    <span class="input-group-addon"></span>
                </div>
            </div>
  
            @formGroup(['groupClass' => "col-lg-5 col-md-6 col-12" , 'placeholder' => "Days", 'inputVal' => '1' , 'name' => 'duration_days' ,'label' => "Duration" , 'label_small_txt' => "(Maximum 7 days)" , 'type' => 'number' , 'attr' => array(
                'min' => "1",
                "max" => "7",
                'pattern' => "[0-9]",
                'onKeyUp' => "if(this.value>7){this.value='7';}else if(this.value<0){this.value='0';}"
            )])
  
        </div>
        <p class="text-danger occupySeatDateError mb-0 col-md-12"></p>
        <p class="text-success occupySeatAvailable mb-0 col-md-12"></p>
    </div>
  
  
    <div class="form-group d-flex justify-content-center align-items-center">
  
        @primaryButton(['value' => "Check Availability" , 'type' => 'submit' , 'classList' => 'btn-warning flexall checkAvailabilityBtn'])
        <span class="small-loader ml-3 d-none"></span>
    </div>
  </form>
  <div class="d-flex justify-content-center ">
    @primaryButton(['value' => "Proceed to Book" , 'classList' => 'btn-warning  d-none proceedbtn' , 'onclick' => "bookNow(this)"])
  
  </div>

</div>
 
@endmodal
 