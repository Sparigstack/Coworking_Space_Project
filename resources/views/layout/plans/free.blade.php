<div class="col-lg-3 col-md-6 col-12 ">
                    <div class="card pricePlanCard pricePlanCardBorder freePlanDiv">
                        <div class="card-body">
                            <h4 style="color: #F58621;text-decoration: underline;">Free Plan</h4>
                             <?php $showActiveplans = 'hidden'; ?>
                        @if($space->plan_id == 1)
                            <?php $showActiveplans = ''; ?>
                        @endif
                         <div class="activePlancard mt-3 mb-2 row activePlanStyle {{$showActiveplans}}" style="">
                        <img class="activeplanicon mr-1" src="{{asset('images-new/activePlanicon.svg')}}" style=""> 
                        <span class="para-text mr-1">CURRENT PLAN</span>
                          <span class="activeText">ACTIVE</span>
                              </div>
                        
                        <div class="planCardFeaturesHeight">
                        <?php 
                            if($space->plan_id == 1 ){
                                
                            }?>
                            <p class=" featureList">
                                
                                List Your Space for Free
                            </p>
                            <p class='featureList'>
                                
                                Space Management<i title="Define amenities that you provide, operating hours of your space, payment modes that you accept, showcase your social media & website links"  data-toggle="tooltip" data-placement="top" aria-hidden="true" class="fas fa-info-circle ml-2"></i>
                            </p>
                            <p class='featureList'>
                                
                                Upto 5 Space Pictures
                            </p>
                            <p class='featureList'>
                                
                                Seats Management<i title="Define charges for all types of seats available in your coworking space. Allocate seats to a person & manage online availability"  data-toggle="tooltip" data-placement="top" aria-hidden="true" class="fas fa-info-circle ml-2"></i>
                            </p>
                            <p class='featureList'>
                                
                                Meeting Room Management<i title="Define meeting rooms with their hourly/daily charges & amenities. Allocate meeting rooms, maintain availability for online booking"  data-toggle="tooltip" data-placement="top" aria-hidden="true" class="fas fa-info-circle ml-2"></i>
                            </p>
                            <hr class="mt-5">
                            <p>
                                Provide discount to avail below benefits<br></br>
                            </p>
                            <p class='featureList'>  Upto 5 Leads Free per Month</p>
                              <p class='featureList'>
                                100 Marketing Emails per Month
                            </p>
                        </div>
                            <?php $marginbot=" mb-4 pt-4" ;
                            $planbutton="mt-4 pt-5";
                            if($space->plan_id == 1){
                                 $marginbot="";
                                 $planbutton="pt-4 mt-3";
                            }?>
                           
                          
                            <div class="{{$planbutton}} mb-5 freePlanBtnDiv">
                            <?php 
                                $showmsg="";
                                $disableBtn="disableBtn";
                                if($space->discount=="" || $space->discount==null || $space->discount=="undefined"){
                                    $showmsg="d-none";
                                    $disableBtn="";
                                }
                                ?>
                                <button class="planButton freeActivebtn {{$disableBtn}}">Avail Benefits</button>
                                    <p class="{{$showmsg}}" style="display: flex;margin: 10px auto;">You have already set discount, you can change it from <a style="display: contents;" href="{{url('client/space')}}/{{$space->id}}">Basic Details</a> update page.</p>
                                
                            </div>
                           
                        </div>
                    </div>
                </div>


              
