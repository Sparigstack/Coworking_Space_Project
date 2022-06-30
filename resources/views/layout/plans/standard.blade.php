<div class="col-lg-3  col-md-6 col-12 standardPricePlanCard">
                    <div class="mostPickedDivMob">
                        <h4 class="text-white text-center mt-2">MOST PICKED</h4>
                    </div>
                    <div class="card pricePlanCard parent standardPlanDiv pickedCardDiv">
                        <div class="mostPickedDiv">
                            <h4 class="text-white text-center mt-2">MOST PICKED</h4>
                        </div>
                        <div class="card-body">
                            <h4 style="color: #F58621;text-decoration: underline;">Standard Plan</h4>
                            <?php $showActiveplans = 'hidden'; ?>
                             @if($space->plan_id == 4 || $space->plan_id == 4)
                             <?php $showActiveplans = ''; ?>
                             @endif
                              <div class="activePlancard mt-3 mb-2 row activePlanStyle {{$showActiveplans}}">                                                
                                  <img class="activeplanicon mr-1" src="{{asset('images-new/activePlanicon.svg')}}" style=""> 
                                                <span class="para-text mr-1">CURRENT PLAN</span>
                                                 <span class="activeText">ACTIVE</span>
                               </div>
                       <div class="planCardFeaturesHeight">
                            <p class="featureList">
                                All Features of Basic plan
                            </p >
                            <p class='featureList'>
                                
                                Priority Email Support (Expected revert time is 20 working hours)
                            </p>
                            <p class='featureList'>
                                
                                2500 Marketing Emails per Month
                            </p>
                            <p class='featureList'>
                                
                               Unlimited Automated Billing
                            </p>
                            <p class='featureList'>
                                
                                Unlimited Individual WhatsApp Messages
                            </p>
                            <p class='featureList'>
                                
                                Revenue Reports
                            </p>
                          
                            <p class='featureList'> Accept Online Booking day passes<i title="You can accept online booking for your vacant hot/flexi and dedicated desks for day passes. Users will be able to see it online and will pay online for day passes. We (gocoworq.com) will process online booking payment pass it to your bank account."  data-toggle="tooltip" data-placement="top" aria-hidden="true" class="fas fa-info-circle ml-1" style="height:5px "></i></p>
                            
                            <p class='featureList'> Accept Online Booking for Meeting  Rooms<i title="You can accept online booking for your for your meeting rooms on hourly or daily basis. Users will be able to see it online and will pay online for day passes. We (gocoworq.com) will process online booking payment pass it to your bank account."  data-toggle="tooltip" data-placement="top" aria-hidden="true" class="fas fa-info-circle ml-2"></i></p>
                       </div>
                            <?php $monthprice="mt-5" ;
                            $discprice="mt-3 pt-2 ";
                            $checkdiv="mt-5";
                            if($space->plan_id == 4 || $space->plan_id == 4 ){
                                 $monthprice="mt-3 pt-1";
                                 $discprice="";
                                 $checkdiv="mt-4 pt-1 ";
                            }?>
                            
                            <div class=" text-center discountPrice hidden ">
                                <p class="durationText"><i class="fas fa-rupee-sign"></i>17988.00/Year</p>
                            </div>
                            
                            <div class="pt-0 mt-4 text-center monthlyDiv">
                                <h4 class="priceText"><i class="fas fa-rupee-sign"></i>1499.00/</h4>
                                <p class="durationText">Month</p>
                            </div>
                            
                            <div class="mt-0 text-center yearlyDiv hidden">
                                <h4 class="priceText"><i class="fas fa-rupee-sign"></i>17088.60/</h4>
                                <p class="durationText">Year</p>
                            </div>
                            
                            <p class="mt-4 mb-5 pt-4  d-flex justify-content-around text-center">
                                <span>Monthly</span>
                                <label class="switchRadioBtn mb-0  pt-3">
                                    <input onchange="changePlanPrice(this);" type="checkbox">
                                    <span class="sliderRoundRadioBtn round"></span>
                                </label>
                                <span>Annual</span>
                            </p>
                            
                            <input type="hidden" class="planDuration" value="monthly">
                            <input type="hidden" class="planId" value="4">
                            <input type="hidden" class="currentPlanId" value="4">
                            <button onclick="return choosePricingPlan(this);" class="planButton mt-5 mb-5">Choose Plan</button>
                        </div>
                    </div>
                </div>
