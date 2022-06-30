@modal([ 'title' => "ACCEPT ONLINE  BOOKING" , 'id' => 'booking_modal'])
<!-- <form method="post" action="{{url('addBookingprice')}}" onsubmit="showLoader()">
    {{ csrf_field() }} -->
<div class="col-12">
    <p>Please set daily price you want to charge for day pass to your users. Your vacant hot/flexi and dedicated spaces will be occupied by online booking on our portal.</p>
</div>
    <input type="hidden" class="seatType" name="seatypeId" value="">
    <input type="hidden" class="seatPrice" name="seatdailyPrice" value="">
    @formGroup(['groupClass' => "col-md-12 col-12 mt-2 setDailyprice" , 'group_prepend' => '<i class="iconColor fas fa-rupee-sign"
    aria-hidden="true"></i>' , 'name' => 'seat_booking_price' ,'label' => "Day-Pass Charges" , 'placeholder' => "Ex: 100" , 'type' => 'number' , 'required' => 'required' , 'attr' => array(
        'min' => "1",
        "maxlength"=> "900",
        'pattern' => "[0-9]",
        'onkeypress' => "return !(event.charCode == 46)"
    )])
    <div class="col-lg-12 col-12 text-danger validatefield d-none">Please fill the fields</div>
    <div class='col-12 d-flex justify-content-end align-items-center'>
        <a href="javascript:void()" data-dismiss="modal" class="mr-2 text-underline"> Cancel </a>
    @primaryButton(['value' => "Save" , 'type' => 'button' , 'classList' => 'btn-info  ','onclick'=>'return checkOnlineBooking(this);' , 'attr' => array("data-check" => 1 )])
    </div>

<!-- </form> -->
@endmodal