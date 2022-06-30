@extends('Masters.app')
@section('content')
<div class="clearfix"></div>

<div class="content-wrapper paymentPage mLeftZero">
    <div class="container-fluid">
        <div class="col-12 col-lg-10 centerElement">
            <div class="card">

                <div class="card-body">
                    <h3 class="text-center">GoCoWorq Payment Process</h3>
                    <a class="centerElement" href="{{url('/')}}">
                        <img src="{{asset('/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
                        <h5 class="logo-text">GoCoWorq</h5>
                    </a>
                    <hr>

                    <form class="form paymentForm" role="form" autocomplete="off">
                        <div class="alert alert-info p-2 pb-3">
                            <a class="close font-weight-normal initialism" data-dismiss="alert"
                                href="#"><samp>×</samp></a>
                            CVC code is required.
                        </div>
                        <div class="form-group row">

                            <div class="col-md-12">
                                <div class="icheck-material-primary">
                                    <input type="radio" id="debitOrcredit" name="debitOrcredit" checked="">
                                    <label class="col-md-12">Credit/Debit Cards</label>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="">Card Number</label>
                                    <input type="number" class="form-control" autocomplete="off" maxlength="14"
                                        placeholder="Card number" required="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-12">Card Exp. Date</label>
                                    <div class="col-md-3">
                                        <select class="form-control" name="cc_exp_date" size="0">
                                            <option value="01">MM</option>
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                            <option value="06">06</option>
                                            <option value="07">07</option>
                                            <option value="08">08</option>
                                            <option value="09">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-control" name="cc_exp_yr" size="0">
                                            <option>YY</option>
                                            <option>2018</option>
                                            <option>2019</option>
                                            <option>2020</option>
                                            <option>2021</option>
                                            <option>2022</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" autocomplete="off" maxlength="3"
                                            pattern="\d{3}" title="Three digits at back of your card" required=""
                                            placeholder="CVC">
                                    </div>
                                </div>
                            </div>



                        </div>

                        <div class="form-group row">
                            <label class="col-md-12">Personal Details</label>
                            <div class="col-md-6">
                                <input type="text" name="fname" class="form-control" autocomplete="off" maxlength="100"
                                    placeholder="FirstName" required="">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="lname" class="form-control" autocomplete="off" maxlength="100"
                                    placeholder="LastName" required="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-12">Save Card As</label>
                            <div class="col-md-6">
                                <input type="text" name="saveCarsAs" class="form-control" autocomplete="off"
                                    maxlength="100" placeholder="Personal" required="">
                            </div>
                            <div class="col-md-6">
                                <img style="width: 50%;" src="{{asset('images/paymentCards.png')}}">
                            </div>

                        </div>



                        <hr>

                        <div class="row">
                            <label class="col-md-10">
                                <h4>Total Cost :</h4>
                            </label>
                            <label class="col-md-2 pull-right">
                                <h4>Rs. 299</h4>
                            </label>
                        </div>

                        <div class="row pull-right">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-info waves-effect waves-light m-1"> <i
                                        class="fa fa-credit-card-alt"></i> <span>Pay Rs. 299 by card</span> </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@endsection
@section('pageWiseJS')


@endsection