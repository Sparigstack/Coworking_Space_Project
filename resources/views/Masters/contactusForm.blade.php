<form action="{{route('sendInquiry','#sendInquiryForm')}}" class='form' captcha-name='g-recaptcha-inquiryForm' method="post" onsubmit="return validateCaptch(this);" >
@csrf

@php
$fullName = '';
$email = '';
$phone_number = '';

if(Auth::check()){
  $user = Auth::user();
  $fullName = $user->full_name;
  $email = $user->email;
  $phone_number = $user->phone ?? '';
}

@endphp


<input type="hidden" class="sendInquiryUrl" value="{{url('sendInquiry')}}">
<input type="hidden" class='thankYouUrl' value="{{url('thank_you')}}">
<p>Please leave your contact details and enquiry below, someone from our team will get back to you shortly. Else you can mail us on <span style="color: #03d0ea;">hello@gocoworq.com</span> or call/whatsapp on <span style="color: #03d0ea;">+91-9726970725 </span>.</p>
<div class="form-group" id='sendInquiryForm'>
    <label for="fullName">Full Name</label>
    <div class="row">
        <div class="column col-12">
            <input type="text" class="form-control required" required name="fullName" value="{{ old('fullName') ?? $fullName}}" id="fullName" placeholder="Full Name" maxlength="100">
            <p class="error" style="color: red;"></p>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">

        <div class="column col-6">
            <label for="email">Email</label><input type="text" class="form-control required"  value="{{ old('email') ?? $email}}" required name="email" id="email" placeholder="Email" maxlength="100"><p class="error" style="color: red;"></p>
        </div>
        <div class="column col-6">
            <label for="phone">Phone Number</label><input required="" type="text" class="form-control required" name="phone" value="{{ old('phone') ?? $phone_number}}" id="phone" placeholder="Phone Number" maxlength="100">
        </div>
    </div>
</div>

<div class="form-group">
    <label for="subject">Subject</label>
    <div class="row">
        <div class="column col-12">
            <input type="text" class="form-control required" name="subject"  value="{{ old('subject')}}" id="subject" placeholder="Subject" maxlength="100">
        </div>
    </div>
</div>
<div class="form-group">
    <label for="message">Message</label>
    <div class="row">
        <div class="column col-12">
            <textarea type="text" class="form-control "  rows="4" name="message" id="message" placeholder="" > {{ old('message')}} </textarea>
        </div>
    </div>
</div>

<div class="g-recaptcha" id="g-captcha-inquiryForm" data-sitekey="6Lc4ZKAfAAAAABBMdDNoDw_Ab1I_xobtDGu3gZkW" data-callback="verifyCaptcha"></div>
<div id="g-recaptcha-error"></div>


@if ($errors->has('g-recaptcha-inquiryForm'))
    <span >
        <span class="text-danger">{{ $errors->first('g-recaptcha-inquiryForm') }}</span >
    </span>
@endif

<div class="modal-footer">
    <input type="submit" value="Send"  class="btn btn-info waves-effect waves-light m-1">                     
</div>

</form>

