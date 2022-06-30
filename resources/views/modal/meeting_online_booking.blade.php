@modal([ 'title' => "ACCEPT ONLINE  BOOKING" , 'id' => 'meeting_booking_modal'])
<!-- <form method="post" action="{{url('addBookingprice')}}" onsubmit="showLoader()">
    {{ csrf_field() }} -->
<div class="col-12">
    <p>Please set your daily and hourly price you want to charge for day pass to your users. Your vacant meeting room will be occupied by online booking on our portal.</p>
</div>
    <input type="hidden" class="meetingroom" name="meetingroomid" value="">
    <!-- <input type="hidden" class="seatPrice" name="seatdailyPrice" value=""> -->
    <div class="col-lg-12 col-12 row">
    @formGroup(['groupClass' => "col-md-6 col-6 mt-2 meetingHourprice" , 'group_prepend' => '<i class="iconColor fas fa-rupee-sign"
    aria-hidden="true"></i>' , 'name' => 'hour_booking_price' ,'label' => "Hourly-Pass Charges" , 'placeholder' => "Ex: 100" , 'type' => 'number' , 'required' => 'required' , 'attr' => array(
        'min' => "1",
        "maxlength"=> "900",
        'pattern' => "[0-9]",
        'onkeypress' => "return !(event.charCode == 46)"
    )])
    @formGroup(['groupClass' => "col-md-6 col-6 mt-2 meetingDailyprice" , 'group_prepend' => '<i class="iconColor fas fa-rupee-sign"
    aria-hidden="true"></i>' , 'name' => 'day_booking_price' ,'label' => "Day-Pass Charges" , 'placeholder' => "Ex: 100" , 'type' => 'number' , 'required' => 'required' , 'attr' => array(
        'min' => "1",
        "maxlength"=> "900",
        'pattern' => "[0-9]",
        'onkeypress' => "return !(event.charCode == 46)"
    )])
    </div>
        <div class="col-lg-12 col-12 text-danger validatefield d-none">Please fill the fields</div>

    <div class='col-12 d-flex justify-content-end align-items-center'>
        <a href="javascript:void()" data-dismiss="modal" class="mr-2 text-underline"> Cancel </a>
    @primaryButton(['value' => "Save" , 'type' => 'button' , 'classList' => 'btn-info  ','onclick'=>'return checkmeetingOnlineBooking(this);' , 'attr' => array("data-check" => 1 )])
    </div>

<!-- </form> -->
@endmodal