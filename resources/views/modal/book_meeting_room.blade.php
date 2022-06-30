<input type="hidden" name="" class="payNowUrl" value="{{route('book_now')}}">
<input type="hidden" name="" class="saveMeetingRoomDetails" value="{{route('saveMeetingDetails')}}">
{{-- <input type="hidden" name="" class="meeting_availabilityUrl" value="{{route('checkMeetingAvailability')}}"> --}}
@modal(['size' => 'modal-lg' , 'title' => "Book Meeting Room" , 'id' => 'bookMeetingModal'])
<div class="col-12">
    {{-- <h6>You can book online meeting room</h6> --}}
</div>
<div class="card-body col12css">
    <form id='meetingRoomBookingForm' action="{{route('checkMeetingAvailability')}}" class='form'
        onsubmit="return checkMeetingAvailability(this);">
        {{ csrf_field() }}
        <input type="hidden" class="spaceIdforBooking" value="">
        <input type="hidden" class="checkBookingAvailability" value="{{url('checkBookingAvailability')}}">

        <div class="row">


            @formGroup(['groupClass' => "col-lg-4 col-md-6 col-12 " , 'name' => 'name' , 'inputVal' => old('name') ??
            $user->full_name ,'label' => "Name" , 'placeholder' => "Enter Your Name" , 'required' => 'required' ])

            @formGroup(['groupClass' => "col-lg-5 col-md-6 col-12" , 'name' => 'emailAddress' , 'type' => 'email' ,
            'inputVal' => old('emailAddress') ?? $user->email ,'label' => "Email" , 'placeholder' => "Enter Your Email
            Address" , 'required' => 'required'])

            @formGroup(['groupClass' => "col-lg-3 col-md-6 col-12" , 'name' => 'phnum' , 'inputVal' => old('phnum') ??
            $user->phone_number ,'label' => "Phone Number" , 'placeholder' => "Enter Your Phone Number" , 'required' =>
            'required'])

            <div class="form-group col-lg-4 col-md-6 col-12">
                <label>Duration</label>
                <div class="row">
                    <div class="column col-6">
                        <div class="icheck-material-primary">
                            <input checked="" id="meetingHourly" type="radio"  class="changeBtn" name="meetingDuration" value="hourly">
                            <label for="meetingHourly">Hourly</label>
                        </div>
                    </div>
                    <div class="column col-6">
                        <div class="icheck-material-primary">
                            <input type="radio" id="meetingDaily" class="changeBtn" name="meetingDuration" value="daily">
                            <label for="meetingDaily">Daily</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group col-lg-5 col-md-6 col-12">
                <label for="datetime">Date</label>
                <div class="input-group date align-items-center datetimepickerforseating" id="">
                    <input min="{{date('Y-m-d')}}" value="{{date('Y-m-d')}}" class="datePickerForSeating" type="date"
                        class="form-control c-pointer changeBtn" name="datetime" placeholder="DD/MM/YY" required=""
                        autocomplete="off">
                    <span class="input-group-addon"></span>
                </div>
            </div>

            <div class="form-group col-lg-3 col-md-4 col-6">
                <label for="capacity">Capacity</label>
                <select required="" name="capacity" class="form-control mb-3 changeBtn">
                    @foreach($meetingRooms as $meetingRoom)
                    <option value="{{$meetingRoom->id}}" data-person="{{$meetingRoom->capacity}}" price-hour="{{$meetingRoom->price_hour}}" price-day="{{$meetingRoom->price_day}}"> {{$meetingRoom->capacity}} persons</option>
                    @endforeach
                </select>
            </div>


            @formGroup(['groupClass' => "col-lg-3 col-md-4 col-6 d-none" , 'placeholder' => "Days", 'inputVal' => '1' ,
            'name' => 'duration_days' ,'label' => "Duration" , 'type' => 'number' , 'attr' => array(
            'min' => "1",
            "max" => "3",
            'pattern' => "[0-9]",
            'onKeyUp' => "if(this.value>3){this.value='3';}else if(this.value<0){this.value='0';}" )])
             <div
                class="form-group col-lg-4 col-md-6  col-12">
                <label for="start_time">Start time:</label>
                <div class="input-group">

                    <input type="text"  autocomplete='off'
                        class='input-group form-control datepickertime changeBtn' name="start_time" required>
                    <div class="input-group-append" data-target="#start_time" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-clock-o" style='font-size: 16px;'></i></div>
                    </div>
                </div>

        </div>
        <div class="form-group col-lg-4 col-md-6  col-12 ">
            <label for="end_time">End time:</label>
            <div class="input-group">
                <input type="text"  autocomplete='off' class='input-group form-control datepickertime changeBtn'
                    name="end_time" required>
                <div class="input-group-append" data-target="#end_time" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-clock-o" style='font-size: 16px;'></i></div>
                </div>

            </div>
        </div>


        <p class="text-danger occupySeatDateError mb-0 col-md-12"></p>
        <p class="text-success occupySeatAvailable mb-0 col-md-12"></p>
</div>



<div class="form-group d-flex justify-content-center align-items-center">

    @primaryButton(['value' => "Check Availability" , 'type' => 'submit' , 'classList' => 'btn-warning flexall
    checkAvailabilityBtn'])
    <span class="small-loader ml-3 d-none"></span>
</div>
<div class="d-flex justify-content-center ">
    @primaryButton(['value' => "Proceed to Book" , 'classList' => 'btn-warning d-none proceedbtn' , 'onclick' =>
    "bookMeetingNow()"])

</div>

</form>

</div>


@endmodal