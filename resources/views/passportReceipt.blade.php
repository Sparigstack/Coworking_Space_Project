@extends('Masters.appFront')
@section('pageWiseMeta')  
<title>GoCoWorq: My Passport Receipt</title>
<meta name = "keywords" content = "gocoworq passport, cowork passport, coworking passport, co-working passport, shared office passport, cowork space passport, coworking space passport, co-work space passport, co-working space passport, shared office space passport, cowork spaces passport, coworking spaces passport, co-work spaces passport, co-working spaces passport, shared office spaces passport"/>
<meta name = "description" content="User can purchase gocoworq passport and use it to pay for coworking spaces that participate in our program."/>  
@endsection
@section('content')

<div class="content-wrapper LeftRightMargin">
    <div class="container-fluid">
        <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">   </div>
        <div class="panel-body">

            <div class="col-md-12 passblock" style="" id="printpage">
                <div class="col-lg-8 centerElement passblock">
                    <div class="card" >
                        <div class="card-body clientUpgradationSection">
                            <div class="row">
                                <?php
                                $createddate = strtotime($subscription->created_at);
                                $createddate = date("m-d-Y", $createddate);
                                ?>
                                <div class="col-md-5 badge-warning firstSection" >

                                    <div class="mt-3 ">
                                        <h5 class="receiptfont">Receipt for</h5>
                                        <span class="mt-2 mb-3" for="inline-radio-primary">{{$user->first_name}} {{$user->last_name}}</span>
                                    </div>
                                    <hr>

                                    <div>
                                        <h5 class="receiptfont">Amount</h5>
                                        <i class="fas fa-rupee-sign"></i>&nbsp;<span class="mt-2 mb-3" for="inline-radio-primary">{{$passport->price}}</span>
                                    </div><hr>
                                    <div>
                                        <h5 class="receiptfont">Date</h5>
                                        <span class="mt-2 mb-3" for="inline-radio-primary">{{$createddate}}</span>
                                    </div><hr>
                                    <div>
                                        <h5 class="receiptfont">Issuer</h5>
                                        <span class="mt-2 mb-3" for="inline-radio-primary">GoCoworq</span>
                                    </div><hr>
                                    <div>
                                        <h5 class="receiptfont">Confirmation #: {{$subscription->stripe_id}}</h5>

                                    </div><hr>

                                </div>
                                <div class="col-md-7 secondSection">
                                    <div class="mt-3">
                                        <!-- logo-icon -->
                                        <img class=""  src="{{asset('images-new/logo_lightbg.png')}}" height="60px" style=""> 
                                        <!-- <h5 class="logo-text">GoCoworq</h5> -->
                                        <label class="mt-2 mb-3 pull-right" for="inline-radio-primary">{{$createddate}}</label>
                                    </div>
                                    <hr>
                                    <div>
                                        <h5>{{$passport->name}}</h5>
                                        <label class="mt-2 mb-3" for="inline-radio-primary">Total: <i class="fas fa-rupee-sign"></i> {{$passport->price}}</label>
                                    </div>
                                    <hr>
                                    <div>
                                        <h5>Hello {{$user->first_name}} {{$user->last_name}}</h5>
                                        <?php if($passport->id == 4){ ?>
                                                 <p>You have successfully purchased {{$passport->name}} to utilize amazing spaces in different cities with ease for <b><i class="fas fa-rupee-sign"></i> {{$passport->price}}/3 months.</b></p>
                                               <?php } else { ?>
                                                <p>You have successfully purchased {{$passport->name}} to utilize amazing spaces in different cities with ease for <b><i class="fas fa-rupee-sign"></i> {{$passport->price}}/month.</b></p>
                                                <?php } ?>
                                                <p>Your go-pass number is: <b>{{$user->passport_user->passportNumber}}</b></p>
                                                <p class="boldFont">(Please note you may use your email address or go-pass number to redeem it at any space.)</p>
                                        <!--<p>You have successfully purchased rrrr to utilize amazing spaces in different cities with ease for <b>{{$passport->price}}/month.</b></p>-->

                                    </div>
                                    <hr>
                                    <div>
                                        <span class="small">You will be automatically charged every month for this subscription, you can cancel it anytime.</span>

                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-8 col-md-8">
                                            <a><span class="small">www.gocoworq.com</span></a>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <!--<input type="button" class="btn btn-primary btn-info" value="Print Receipt">-->
                                            <button onclick="printReceipt();" id="printbtn" class="btn btn-primary btn-info">Print Receipt</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>


            </div>
        </div>
    </div>

</div><!--End content-wrapper-->
@endsection



