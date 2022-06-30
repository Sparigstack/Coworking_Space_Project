@extends('Masters.app')
@section('content')
<div class="clearfix"></div>

<div class="content-wrapper passportPage mLeftZero">
    <div class="container-fluid">
        <div class="">
            <section class="content-header invoiceDetails">
                <h5 class="centerElement green">You have successfully purchased our Passport service</h5>
                <h3 class="centerElement green">Your order ID is: <small>{{$transaction_id}}</small></h3>
                <h5 class="centerElement green">Below you can explore few best spaces which allow Passport access.</h5>
            </section>
        </div>
        <div class="content-wrapper frontPageReviewSection">
            <h3 class="centerElement title">Best Passport Accessible Spaces</h3>
            <section id="photos">
                <form method="post" action="spacesViewed">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                </form>
            </section>
        </div>
    </div>
</div>
@endsection
@section('pageWiseJs')
<script src="{{asset('/js/paytmJs.js')}}"></script>
@endsection