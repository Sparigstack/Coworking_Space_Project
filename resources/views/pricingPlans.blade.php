@extends('Masters.appFront')
@section('pageWiseMeta')  
<title>GoCoWorq: Upgrade Your Space</title>
<meta name = "keywords" content = "cowork, coworking, co-working, shared office, cowork space, coworking space, co-work space, co-working space, shared office space, cowork spaces, coworking spaces, co-work spaces, co-working spaces, shared office spaces, coworking reviews, coworking ratings, co-working reviews, co-working ratings, cowork passport, co-work passport, coworking passport, co-working passport, shared office passport "/>
<meta name = "description" content = "Upgrade your space to appear on the top of list in search results and get 10 times more leads. Receive Featured Space badge for your coworking space."/>  
@endsection
@section('pageWiseCss')
<link rel="stylesheet" href="{{asset('css/about-style.css')}}">
<link rel="stylesheet" href="{{asset('css/owl.carousel.css')}}">
@endsection
@section('content')

<div class="clearfix"></div>

<section class="site-banner">
    <div class="page-banner inner-banner aboutPageBannerImage" style="background-image: url(images-new/aboutPageBanner.jpg);">
        <!-- passport-page-banner -->
        <div class="container">
            <div class="row justify-content-center align-items-center float-none-banner">
                <div class="col-md-12">
                    <div class="banner-content">
                        <h1 class="white-text fadeInUp wow text-center" style="">Pricing Plans </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="content-wrapper passportPage mLeftZero pt-0">
    <div class="headings-title">
                <div class="mb45 mb-xs-40 text-center">
                    <h2 class="title-border border-center border-black orange-text centerElement paddingBottom">Pricing Plans</h2>
                </div>
            </div>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col"> </div>
                <div class="col-md-5 col-lg-5 col-sm-10 plansDiv">
                    <div class="pricing-standard text-center">
                        <div class="pricing-header">
                            <div class="pricing-icon text-center iconBackColor1">
                                <i style="" class="l-text m-text mb24 inline-block fas fa-globe"></i>
                                <!-- ti-thought -->
                            </div>
                            <h5 class="widgettitle mb0">BASIC</h5>
                        </div>
                        <div class="pricing">
                            <span class="price">Free</span>
                            <p class="lead hidden">per month</p>
                        </div>
                        <ul>
                            <li>Free Listing of your space</li>
                            <li>Mention all details of your space</li>
                            <li>Upload upto 5 pictures</li>
                            <li>Lead capturing buttons</li>
                            <li>Passport program participation</li>
                            <li>Link your social media & website</li>
                        </ul>
                        <!-- <p>
                            <a style="color:#222222;background:#eeeeee;border-color:#eeeeee;" id="btn-5ea133a7cdc0d" class="btn  btn-block btn-sm-sm mb0" href="#" target="_self">Order Now
                            </a>
                        </p> -->
                    </div>
                </div>
                <div class="col-md-5 col-lg-5 col-sm-10 plansDiv">
                    <div class="pricing-standard text-center paidPlanDiv" style="border-color: #03d0ea;">
                        <div class="pricing-header">
                            <div class="pricing-icon text-center iconBackColor2">
                                <i style="" class="l-text m-text mb24 inline-block fas fa-box"></i>
                                <!-- ti-thought -->
                            </div>
                            <h5 class="widgettitle mb0">PREMIUM</h5>
                        </div>
                        <div class="pricing premiumPlanColor paddingTopBottom" style="">
                            <span class="price" style="margin-top: 10px;"><span><i class="fas fa-rupee-sign"></i> </span>1,087</span>
                            <p class="lead" style="color:#fff;">per month</p>
                        </div>
                        <ul style="">
                            <li>Everything in the basic plan</li>
                            <li>Show your space at the top of the queue</li>
                            <li>Receive a special featured space badge</li>
                            <li>Highlighted pin drop on your cities map</li>
                        </ul>
                        <p class="upgradePlanButton">
                            <!-- <a style="" id="" class="btn  btn-block btn-sm-sm mb0" href="#" target="_self">BUY NOW
                            </a> -->
                            <a data-toggle="modal" class="btn btn-lg  btn-block btn-sm-sm mb0 w-50 ml25" data-target="#modal-add-space" href="#">BUY NOW</a>
                        </p>
                    </div>
                </div>
                <div class="col"> </div>
            </div>

            <div class="headings-title">
                <div class="mb45 mb-xs-40 text-center">
                    <!-- <h2 class="widgettitle centerElement paddingBottom">Common Questions</h2> -->
                    <h2 class="title-border border-center border-black orange-text centerElement paddingBottom">Common Questions</h2>
                </div>
            </div>

            <div class="row questionAnswerDiv">
                <div class="col"> </div>
                <div class="col-md-5 col-lg-5 col-sm-10">
                    <ul class="accordion accordion-style-1 accordion-auto-close">
                        <li class="parent active pb-3">
                            <div class="title" onclick="return showHideAnswer(this);">
                                <!-- <i class="ti-layers icon"></i> -->
                                <span>How can I get started?
                                    <i class="fa fa-minus plusMinusSign pt-1"></i>
                                </span>
                            </div>
                            <div class="content questionPara">
                                <p>Torquent lacinia elementum sodales facilisis eleifend ultricies neque ipsum litora, habitasse euismod vel ut egestas viverra at suspendisse ut tristique, donec fusce nisi venenatis aptent vitae libero taciti sodales justo dictum pharetra.</p>
                            </div>
                        </li>
                        <li class="parent pb-3 contentHidden">
                            <div class="title" onclick="return showHideAnswer(this);">
                                <!-- <i class="ti-layers icon"></i> -->
                                <span>Is my data secured?
                                    <i class="fa fa-plus plusMinusSign pt-1"></i>
                                </span>
                            </div>
                            <div class="content questionPara">
                                <p>Torquent lacinia elementum sodales facilisis eleifend ultricies neque ipsum litora, habitasse euismod vel ut egestas viverra at suspendisse ut tristique, donec fusce nisi venenatis aptent vitae libero taciti sodales justo dictum pharetra.</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-5 col-lg-5 col-sm-10">
                    <ul class="accordion accordion-style-2 accordion-auto-close">
                        <li class="parent active pb-3">
                            <div class="title" onclick="return showHideAnswer(this);">
                                <!-- <i class="ti-layers icon"></i> -->
                                <span>How can I get started?
                                    <i class="fa fa-minus plusMinusSign pt-1"></i>
                                </span>
                            </div>
                            <div class="content questionPara">
                                <p>Torquent lacinia elementum sodales facilisis eleifend ultricies neque ipsum litora, habitasse euismod vel ut egestas viverra at suspendisse ut tristique, donec fusce nisi venenatis aptent vitae libero taciti sodales justo dictum pharetra.</p>
                            </div>
                        </li>
                        <li class="parent pb-3 contentHidden">
                            <div class="title" onclick="return showHideAnswer(this);">
                                <!-- <i class="ti-layers icon"></i> -->
                                <span>Is my data secured?
                                    <i class="fa fa-plus plusMinusSign pt-1"></i>
                                </span>
                            </div>
                            <div class="content questionPara">
                                <p>Torquent lacinia elementum sodales facilisis eleifend ultricies neque ipsum litora, habitasse euismod vel ut egestas viverra at suspendisse ut tristique, donec fusce nisi venenatis aptent vitae libero taciti sodales justo dictum pharetra.</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col"> </div>
            </div>
        </div>
    </div>
</div>
@endsection

