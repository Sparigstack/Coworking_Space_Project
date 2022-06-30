  
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card pricePlanCard pricePlanCardBorderDiv parent premiumPlanDiv">
                        <div class="card-body">
                            <h4 style="color: #F58621; text-decoration: underline;">Premium Plan</h4>
                              <?php $showActiveplans = 'hidden'; ?>
                             @if($space->plan_id == 6 || $space->plan_id == 7)
                             <?php $showActiveplans = ''; ?>
                             @endif
                            <div class="activePlancard mt-3 mb-2 row activePlanStyle {{$showActiveplans}}" style="">
                                <img class="activeplanicon mr-1" src="{{asset('images-new/activePlanicon.svg')}}" style=""> 
                                <span class="para-text mr-1">CURRENT PLAN</span>
                                  <span class="activeText">ACTIVE</span>
                              </div>
                           
                          <div class="planCardFeaturesHeight">
                            <p class="featureList">
                               
                                All Features of Standard Plan
                            </p>
                            <p class="featureList">
                                
                                Priority Call & WhatsApp Support (Expected revert time is 8 working hours)
                            </p>
                            <p class="featureList">
                                
                                Upto 10,000 Marketing Emails per Month
                            </p>
                            <p class="featureList">
                                
                                Unlimited Individual WhatsApp Messages
                            </p>
                            <p class="featureList">
                                
                                Inventory Management<i title="Manage any kind of inventories along with their categories & prices. See monthly reports of your inventories"  data-toggle="tooltip" data-placement="top" aria-hidden="true" class="fas fa-info-circle ml-2"></i>
                            </p>
                            <p class="featureList">
                                
                                Automatic Reminders<i title="Get automatic reminders at the time of space user's payment date, space user's duration completion, inventory getting out of stock"  data-toggle="tooltip" data-placement="top" aria-hidden="true" class="fas fa-info-circle ml-2"></i>
                            </p>
                          </div>
                            <div class="pt-0 text-center discountPrice hidden">
                                <p class="durationText"><i class="fas fa-rupee-sign"></i>29988.00/Year</p>
                            </div>
                            
                            <div class="mt-4 text-center monthlyDiv">
                                <h4 class="priceText"><i class="fas fa-rupee-sign"></i>2499.00/</h4>
                                <p class="durationText">Month</p>
                            </div>
                            
                            <div class="mt-0 text-center yearlyDiv hidden">
                                <h4 class="priceText"><i class="fas fa-rupee-sign"></i>28488.60/</h4>
                                <p class="durationText">Year</p>
                            </div>
                            
                            <p class="mt-5  d-flex justify-content-around text-center">
                                <span>Monthly</span>
                                <label class="switchRadioBtn mb-0  pt-3">
                                    <input onchange="changePlanPrice(this);" type="checkbox">
                                    <span class="sliderRoundRadioBtn round"></span>
                                </label>
                                <span>Annual</span>
                            </p>
                            
                            <input type="hidden" class="planDuration" value="monthly">
                            <input type="hidden" class="planId" value="4">
                            <button onclick="return choosePricingPlan(this);" class="planButton mt-5 mb-5">Choose Plan</button>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>