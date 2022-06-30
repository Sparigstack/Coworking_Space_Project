<div class="col-lg-3 col-md-6 col-12 ">
                    <div class="card pricePlanCard parent basicPlanDiv pricePlanCardBorder">
                        <div class="card-body">
                            <h4 style="color: #F58621;text-decoration: underline;">Basic Plan</h4>
                           
                                  <?php $showActiveplans = 'hidden'; ?>
                            @if($space->plan_id == 2 || $space->plan_id == 3 )
                              <?php $showActiveplans = ''; ?>
                             @endif
                                <div class="activePlancard mt-3 mb-2 row activePlanStyle {{$showActiveplans}}" style="">
                                 <img class="activeplanicon mr-1" src="{{asset('images-new/activePlanicon.svg')}}" style=""> 
                                <span class="para-text mr-1">CURRENT PLAN</span>
                                 <span class="activeText">ACTIVE</span>
                              </div>
                             <div class=" planCardFeaturesHeight ">
                        <?php 
                            if($space->plan_id == 2 || $space->plan_id == 3 ){
                                 
                            }?>
                            <p class="featureList">
                                
                                All Features of Free Plan
                            </p>
                            <p class='featureList'>
                                
                                Featured Listing <a href="javascript:void(0)" onclick="document.getElementById('featuredSection').scrollIntoView();">See Example</a>
                            </p>
                            <p class='featureList'>
                                
                                Unlimited Leads for Free
                            </p>
                            <p class='featureList'>
                                
                                500 Marketing Emails per Month
                            </p>
                            <p class='featureList'>
                                
                                100 Automated Billing (Has to provide minimum 5% discount to <a href="{{url('goPass')}}" target="_blank">GoPass</a> holders)
                            </p>
                             </div>
                            <?php $marginTop1="mt-5 pt-5" ;
                            $discountTop="mt-5 pt-4";
                            if($space->plan_id == 2 || $space->plan_id == 3 ){
                                 $marginTop1="mt-4 pt-2";
                                 $discountTop="mt-2";
                            }?>
                            <div class="pt-0 text-center discountPrice hidden">
                                <p class="durationText"><i class="fas fa-rupee-sign"></i>5988.00/Year</p>
                            </div>
                            
                            <div class="pt-0 mt-4 text-center monthlyDiv">
                                <h4 class="priceText"><i class="fas fa-rupee-sign"></i>499.00/</h4>
                                <p class="durationText">Month</p>
                            </div>
                            
                            <div class="mt-0 text-center yearlyDiv hidden">
                                <h4 class="priceText"><i class="fas fa-rupee-sign"></i>5688.60/</h4>
                                <p class="durationText">Year</p>
                            </div>
                            
                            <p class="mt-4 mb-5 pt-4 d-flex justify-content-around text-center">
                                <span>Monthly</span>
                                <label class="switchRadioBtn mb-0  pt-3">
                                    <input onchange="changePlanPrice(this);" type="checkbox">
                                    <span class="sliderRoundRadioBtn round"></span>
                                </label>
                                <span>Annual</span>
                            </p>
                            
                            <input type="hidden" class="planDuration" value="monthly">
                            <input type="hidden" class="planId" value="2">
                            <input type="hidden" class="currentPlanId" value="2">
                            <button onclick="return choosePricingPlan(this);" class="planButton  mb-5">Choose Plan</button>
                        </div>
                    </div>
                </div>