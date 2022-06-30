@extends('Masters.app')
@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">   </div>
        <div class="panel-body">

            <div class="col-md-12" style="">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body clientUpgradationSection">
                            <div class="row">
                                <?php
                                $createddate = strtotime($passportUser->created_at);
                                $createddate = date("m-d-y", $createddate);
                                ?>
                                <div class="col-md-5 badge-warning firstSection" >

                                    <div class="mt-3 ">
                                        <h5>Receipt for</h5>
                                        <span class="mt-2 mb-3" for="inline-radio-primary">{{$planName}}</span>
                                    </div>
                                    <hr>

                                    <div>
                                        <h5>Amount</h5>
                                        @php  $amount="" @endphp
                                        @if($passportUser->passport_id==1)
                                        @php $amount="$29.00" @endphp
                                        @elseif($passportUser->passport_id==2)
                                        @php $amount="$79.00" @endphp
                                         @elseif($passportUser->passport_id==3)
                                        @php $amount="$149.00" @endphp
                                         @elseif($passportUser->passport_id==4)
                                        @php $amount="$299.00" @endphp
                                        @endif
                                        <span class="mt-2 mb-3" for="inline-radio-primary">{{$amount}}</span>
                                    </div><hr>
                                    <div>
                                        <h5>Date</h5>
                                        <span class="mt-2 mb-3" for="inline-radio-primary">{{$createddate}}</span>
                                    </div><hr>
                                    <div>
                                        <h5>Issuer</h5>
                                        <span class="mt-2 mb-3" for="inline-radio-primary">GoCoWorq</span>
                                    </div><hr>
                                    <div>
                                        <h5>Confirmation #: {{$passportUser->payment_reference}}</h5>

                                    </div><hr>

                                </div>
                                <div class="col-md-7 secondSection">
                                    <div class="mt-3">
                                        <img class="logo-icon"  src="{{asset('images/logo-icon.png')}}"> 
                                        <h5 class="logo-text">GoCoWorq</h5>
                                        <label class="mt-2 mb-3 pull-right" for="inline-radio-primary">{{$createddate}}</label>
                                    </div>
                                    <hr>
                                    <div>
                                        <h5>{{$planName}}</h5>
                                        <label class="mt-2 mb-3" for="inline-radio-primary">Total: {{$amount}} USD</label>
                                    </div>
                                    <hr>
                                    <div>
                                        <h5>Hello {{$user->first_name}} {{$user->last_name}}</h5>
                                        <p>
                                            You have successfully purchased {{$planName}} for {{$amount}} per month. Your passport will renew automatically after one month, you can cancel it anytime from your account. 
                                        </p>
                                        
                                        <!--<p>You have sent payment of <b>{{$amount}} USD</b> to COWorkaholic({{$user->email}})</p>-->
                                    </div>
                                    <hr>
                                    <div>
                                        <span class="small">You will be automatically charged  every month for this subscription, you can cancel it anytime.</span>

                                    </div>
                                    <hr>
                                    <div>
                                        <a><span class="small">www.GoCoWorq.com</span></a>
                                        <a href="{{url('/')}}"> <button class="btn badge-warning pull-right">Explore Spaces</button></a>
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

