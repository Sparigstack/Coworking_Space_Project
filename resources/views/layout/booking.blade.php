@if(isset($bookings) && !empty($bookings))


<div class="parentBooking mb-4" >
    @foreach($bookings as $booking)
    <div class="row Descriptiondiv">
        <div class="col-lg-3 col-md-6 col-12 mb-3 mb-md-0">
@if($user_type == "space_owner")
<h6 class="text-uppercase">USER Details</h6>
<p class="text-capitalize">{{$booking->booking_users[0]->inquiries->name ?? ''}}</p>
<p>{{$booking->booking_users[0]->inquiries->email ?? ''}}</p>
<p>{{$booking->booking_users[0]->inquiries->phone_number ?? ''}}</p>
@else
<h6 class="text-uppercase">Space Name</h6>
<p class="text-capitalize">{{$booking->space->space_name ?? ''}}</p>
<p>{{$booking->space->address1 ?? ''}}, {{$booking->space->address2 ?? ''}}, {{$booking->space->area->name ?? ''}}, {{$booking->space->city->name ?? ''}}</p>
<p class="showSpaceInMap pull-left"><a data-toggle="modal" href="javascript:void(0)" data-target="#showMapView" style="display: unset !important;" class="showSpaceInMap text-underline">Show Map</a></p>
@endif
        </div>
        
@if($booking->seating_type_id != 6)
        <div class="col-lg-3 col-md-6 col-12 mb-3 mb-md-0">
    <h6 class="text-uppercase">
        Seats and Booking Details
    </h6>
    <p>{{$booking->num_of_seat}}</p>
    <?php  $startdate=date('d/m/Y',strtotime($booking->start_date)); 
    $enddate=date('d/m/Y',strtotime($booking->end_date)); ?>
    <p>{{$startdate ?? '' }} to {{$enddate ?? '' }}</p>
    <p>₹ {{$booking->paid_amount}} (paid)</p>
    <p>₹ {{$booking->total_amount}} (total amount)</p>
        </div>
        
        <div class="col-lg-6 col-md-12  mb-2 mb-md-0">
    <h6 class="text-uppercase">Occupier Details</h6>
@foreach($booking->booking_users as $booking_users)

<div class="row">
<div class="col-md-3 col-6">
<p class="text-capitalize">{{$booking_users->inquiries->name}}</p>
</div> 
<div class="col-md-4 col-6">
    <p>{{$booking_users->inquiries->email}}</p>
</div>

<div class="col-md-4 col-6 text-md-right">
    <p>{{$booking_users->inquiries->phone_number}}</p>
</div>
</div>
@endforeach
        </div>

@else

<div class="col-lg-3 col-md-6 col-12 mb-3 mb-md-0">
    <h6 class="text-uppercase">
        Meeting Room Booking Details
    </h6>
    <p>{{$booking->num_of_seat}}</p>
    @if(!isset($booking->meeting_occupation->start_time) && !isset($booking->meeting_occupation->end_time))
    <p>Daily</p>
    <p>Start Date: {{$booking->start_date ?  Carbon\Carbon::parse($booking->start_date)->format('jS M, Y')  :  ' ' }}</p>
    <p>End Date: {{$booking->end_date ?  Carbon\Carbon::parse($booking->end_date)->format('jS M, Y')  :  ' '  }}</p>
    @else
    <?php  $hourlydate=date('d/m/Y',strtotime($booking->start_date)); ?>
    <p>Hourly | Date: {{$hourlydate ?? '' }}</p>
    <p>Start Time: {{$booking->meeting_occupation->start_time ?? '' }} </p>
    <p>End Time: {{$booking->meeting_occupation->end_time ?? '' }}  </p>
    @endif
    <p>₹ {{$booking->paid_amount}} (paid)</p>
    <p>₹ {{$booking->total_amount}} (total amount)</p>
        </div>        
@endif
        <div class="hidden renderMapSection">
            <input type="hidden" class="dbspaceName" value="{{$booking->space->space_name}}">
            <input type="hidden" class="dblat" value="{{$booking->space->latitude}}">
            <input type="hidden" class="dblong" value="{{$booking->space->longitude}}">
            <input type="hidden" class="dbPriceSpace" value="{{$booking->space->price_start_from}}">
            <input type="hidden" class="dbplanId" value="{{round($booking->space->plan_id)}}">
            <input type="hidden" class="dbspaceid" value="{{$booking->space->id}}">
            <input type="hidden" class="dbspaceimage" value="{{$booking->spaceImagePath}}">
            <input type="hidden" class="dbspaceplaceid" id="dbspaceplaceid" name="dbspaceplaceid" value="{{$booking->space->place_id}}">
        </div>
    </div>
    <hr />
    @endforeach

</div>


{{-- if there is no bookings  --}}



@endif





@section('script')
<?php $v = '2.2.0'; ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjWotF6wKKrsQHC18xo0E-W77YpoOY8b8"></script>
<script>
    var baseURL = getBaseURL();
    $(document).ready(function () {
        initialize();
    });
                                        
    function initialize() {
        $(".showSpaceInMap").each(function (index) {
            $(this).on("click", function () {
                var parentElement = $(this).closest('.Descriptiondiv');
                var Spacelat = parseFloat($(parentElement).find('.renderMapSection').find('.dblat').val());
                var Spacelong = parseFloat($(parentElement).find('.renderMapSection').find('.dblong').val());
                var map = new google.maps.Map(document.getElementById('marker-map'), {
                    center: {
                        lat: Spacelat,
                        lng: Spacelong
                    },
                    zoom: 13,
                    mapTypeId: 'roadmap'
                });
                var iconBase = "\\images-new\\";
                var icons = {
                    parking: {
                       icon: iconBase + 'mapPin.png'
                   },
                };
                var infowindow = new google.maps.InfoWindow();
                var marker, i;
                var latlong = "";
                var latitudeOfSpace = "";
                var longitudeOfSpace = "";
                var SpaceName = "";
                var dbPriceSpace = "";
                var marker = "";
                var dbratingSpace = "";
                var SpacePlanId = "";
                var dbspaceimage = "";
                var dbspaceid = "";
                var ImagePath = "";
                SpacePlanId = $(parentElement).find('.dbplanId').val();
                latitudeOfSpace = parseFloat($(parentElement).find(".dblat").val());
                longitudeOfSpace = parseFloat($(parentElement).find(".dblong").val());
                SpaceName = $(parentElement).find('.dbspaceName').val();
                dbPriceSpace = $(parentElement).find('.dbPriceSpace').val();
                dbratingSpace = $(parentElement).find('.dbratingSpace').val();
                dbspaceimage = $(parentElement).find('.dbspaceimage').val();
                dbspaceid = $(parentElement).find('.dbspaceid').val();
                ImagePath = dbspaceid + '/height_190/' + dbspaceimage;
                latlong = {lat: Spacelat, lng: Spacelong};
                marker = new google.maps.Marker({position: latlong, map: map, scale: 1000});
                google.maps.event.addListener(marker, 'mouseover', (function (marker, i) {
                    return function () {
                        infowindow.setContent("<div class='content'>\n\
                                                <img style='height: 100px;' src='" + baseURL + "/uploads/" + ImagePath + "'></div><h6 class='fontWhite mt-1 mb-1'>" + SpaceName + "</h6><span class='fontWhite mt-1 mb-1'>INR " + dbPriceSpace + "/-</span></div>");
                        infowindow.open(map, marker);
                    }
                })(marker, i));
                $(".gm-style-iw").removeAttr("style");
                $(".gm-style-iw-t").removeAttr("style");
                $(".gm-style-iw-d").removeAttr("style");
            });
        });
            
            //Add the event listener after Google Mpas and window is loaded
            var firstSpacelat = parseFloat($('#firstSpacelat').val());
            var firstSpacelong = parseFloat($('#firstSpacelong').val());
            $('#MapRender').click(function () {
                var map = new google.maps.Map(document.getElementById('marker-map'), {
                    center: {
                        lat: firstSpacelat,
                        lng: firstSpacelong
                    },
                    zoom: 13,
                    mapTypeId: 'roadmap'
                });
                var iconBase = baseURL + "/images-new/";
                var icons = {
                    parking: {
                        icon: iconBase + 'mapPin.png'
                    },
                };
                var infowindow = new google.maps.InfoWindow();
                var marker, i;
                $('.renderMapSection').each(function (index, value) {
                    var latlong = "";
                    var latitudeOfSpace = "";
                    var longitudeOfSpace = "";
                    var SpaceName = "";
                    var dbPriceSpace = "";
                    var marker = "";
                    var dbratingSpace = "";
                    var SpacePlanId = "";
                    var dbspaceimage = "";
                    var dbspaceid = "";
                    var ImagePath = "";
                    SpacePlanId = $(this).find('.dbplanId').val();
                    latitudeOfSpace = parseFloat($(this).find(".dblat").val());
                    longitudeOfSpace = parseFloat($(this).find(".dblong").val());
                    SpaceName = $(this).find('.dbspaceName').val();
                    dbPriceSpace = $(this).find('.dbPriceSpace').val();
                    dbratingSpace = $(this).find('.dbratingSpace').val();
                    dbspaceimage = $(this).find('.dbspaceimage').val();
                    dbspaceid = $(this).find('.dbspaceid').val();
                    ImagePath = dbspaceid + '/height_190/' + dbspaceimage;
                    latlong = {lat: latitudeOfSpace, lng: longitudeOfSpace};
                    var iconName = "";
                    if (SpacePlanId == '2') {
                        var iconName = icons['parking'].icon;
                    }
                    
                    marker = new google.maps.Marker({position: latlong, map: map, scale: 1000, icon: iconName});
                    google.maps.event.addListener(marker, 'mouseover', (function (marker, index) {
                        return function () {
                            infowindow.setContent("<div class='content'>\n\
                                                <img style='height: 100px;' src='" + baseURL + "/uploads/" + ImagePath + "'></div><h6 class='fontWhite mt-1 mb-1'>" + SpaceName + "</h6><span class='fontWhite mt-1 mb-1'>INR " + dbPriceSpace + "/-</span>\n\/div>");
                            infowindow.open(map, marker);
                        }
                    })(marker, index));
                    $(".gm-style-iw").find("img").attr("src", "http://www.google.com/intl/en_us/mapfiles/close.gif");
                    $(".gm-style-iw").removeAttr("style");
                    $(".gm-style-iw-t").removeAttr("style");
                    $(".gm-style-iw-d").css("overflow", 'hidden !important');
                });
            });
        }
</script>
@endsection
