@php
$spaceSeatTypesCount = count($spaceSeatingTypes);
@endphp


<div class="col-md-12 mobilepad pl-0 pr-0" style="display: table;padding-top: 20px !important;" id="seatingtypes">
    <div class="card">
        <div class="card-header text-uppercase">Seats and their prices</div>
        <div class="card-body">
            @if($spaceSeatTypesCount > 0)
            <!-- check for flexi desk  -->
            @if($spaceSeatingTypes->where('seating_type_id', 2)->count() > 0)
            @include('layout.seats.seat' , ['title' => 'HOT/FLEXI DESK' , 'iconUrl' => asset('images-new/icons/flexi.svg') , 'data' => $spaceSeatingTypes->where('seating_type_id', 2)->all() , 'checkOnline' => $spaceSeatingTypes->where('seating_type_id', 2)->where('check_online_booking' , 1)->count() ])
            @endif
            <!--end of  flexi desk  -->


            <!-- check for dedicated desk  -->
            @if($spaceSeatingTypes->where('seating_type_id', 3)->count() > 0)
            @include('layout.seats.seat' , ['title' => 'DEDICATED DESK' , 'iconUrl' => asset('images-new/icons/dedicated.svg') , 'data' => $spaceSeatingTypes->where('seating_type_id', 3)->all() , 'checkOnline' => $spaceSeatingTypes->where('seating_type_id',3)->where('check_online_booking' , 1)->count()])
            @endif
            <!--  end of dedicated desk  -->


            <!-- check for private desk  -->
            @if($spaceSeatingTypes->where('seating_type_id', 4)->count() > 0)
            @include('layout.seats.seat' , ['title' => 'SEATER PRIVATE OFFICE/CABIN' , 'iconUrl' => asset('images-new/icons/private.svg') , 'data' => $spaceSeatingTypes->where('seating_type_id', 4)->all(), 'checkOnline' => $spaceSeatingTypes->where('seating_type_id', 4)->where('check_online_booking' , 1)->count()])
            @endif
            <!--end of  private desk  -->


            <!-- check for meeting room  -->
            @if($meeting_room->count() > 0)
            @include('layout.seats.meetingRooms' , ['title' => 'Meeting Room' , 'iconUrl' => asset('images-new/icons/meeting.svg') , 'data' => $meeting_room , 'checkOnline' => $meeting_room->where('check_online_booking' , 1)->count()])
            @endif
            <!--end of meeting room  -->

            @else
            <div class="col-md-12 text-uppercase">Not Found Details Of Seating Types</div>
            @endif

        </div>
    </div>
</div>