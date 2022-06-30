<!-- // Let's Click this button automatically when this page load using javascript -->
<?php $v = "1.5.0"; ?>
@extends('Masters.appFront')
@section('content')
<!-- This form is hidden -->
@section('pageWiseCss')
<link rel="stylesheet" href="{{asset('css/goPass-style.css?v='.$v)}}">
@endsection
<input type="hidden" name="" class='gocoworqLogo' value="{{asset('/images-new/logo_lightbg.png')}}">
<div class="mt-2 mt-md-5 LeftRightMargin pb-0 pb-md-5 pt-0 pt-md-2">
    <div class="container">
        <!-- Breadcrumb-->
    
        <div class="">
            <div class="posRel d-flex mainGoPassBg row">
                <div class="col-md-6 pr-0 pt-4 d-flex align-items-end">
                <img src="{{asset('/images-new/go-pass/desk.png')}}" style='max-width: 50%;' alt="list-your-space" class="img-fluid" />
                <img src="{{asset('/images-new/go-pass/go_pass_mobile.png')}}" style='max-width: 50%;' alt="list-your-space" class="img-fluid" />
                </div>
                <div class="col-md-6 pr-4">
                <span class="ContentDiv col-6 p-5">
                    <p class='txtWhite goPassPaymentH pt-4'> gocoworq <span style='color:#17B8E9;'>g</span>o-<span style='color:#F6881F;' >p</span>ass</p>
                    <ul class="txtWhite pt-3 pl-3 ulFont">
                        <li class="liBullet pl-2">Avail up to 15% discount on various coworking spaces in different cities of India. </li>
                        <li class="liBullet pl-2 pt-3">Get support of gocoworq experts to crack a great deal for you or your team without paying any commission. </li>
                    </ul>
                    <div class="pt-5">
                        <p class='text-right mb-3 txtWhite go-passTotal'>Total : ₹ {{$passport->price}}</p>
                        <button  id="rzp-button1" class="btn d-block fltRight btn-warning waves-effect waves-light  mb-3 mb-lg-0 c-pointer">START SUBSCRIPTION</button>
                    </div>
                </span>
                </div>
               
            </div>
        </div>

        
    </div>

</div><!--End content-wrapper-->


<form action="{{url('/payment-complete')}}" method="POST" hidden>
        <input type="hidden" value="{{csrf_token()}}" name="_token" /> 
        <input type="text" class="form-control" id="rzp_paymentid"  name="rzp_paymentid">
        <input type="text" class="form-control" id="rzp_subscriptionid" name="rzp_subscriptionid">
        <input type="text" class="form-control"  id="rzp_signature" name="rzp_signature">
        <input type="text" class="form-control"  value="{{$response['planId']}}"  name="planId">
        <input type="text" class="form-control"  value="{{$response['currentEnd']}}"  name="currentEnd">
    <button type="submit" id="rzp-paymentresponse" class="btn btn-primary">Submit</button>
</form>
@endsection

@section('pageWiseJs')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var options = {
    "key": "{{$response['razorpayId']}}", // Enter the Key ID generated from the Dashboard// Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "{{$response['currency']}}",
    "name": "{{$response['name']}}",
    "description": "{{$response['description']}}",
    "image": "{{asset('/images-new/logo_lightbg.png')}}", // You can give your logo url
    "subscription_id": "{{$response['subscriptionId']}}", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "handler": function (response){
        // After payment successfully made response will come here
        // send this response to Controller for update the payment response
        // Create a form for send this data
        // Set the data in form
        document.getElementById('rzp_paymentid').value = response.razorpay_payment_id;
        document.getElementById('rzp_subscriptionid').value = "{{$response['subscriptionId']}}";
        document.getElementById('rzp_signature').value = response.razorpay_signature;

        // // Let's submit the form automatically
        document.getElementById('rzp-paymentresponse').click();
    },
    "prefill": {
        "name": "{{$response['name']}}",
        "email": "{{$response['email']}}",
        "contact": "{{$response['contactNumber']}}"
    },
    "notes": {
        "address": "{{$response['address']}}"
    },
};
var rzp1 = new Razorpay(options);


document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
</script>

@endsection