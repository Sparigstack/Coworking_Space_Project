@extends('Masters.ClientSpace')
<?php $v= '2.2.0'; ?>
@section('css')

<link rel="stylesheet" href="{{asset('css/allocateseat.css')}}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('spacedetail')
@include('modal.invoice_sent_modal')
@include('modal.past_meeting_room' , ['pastMeetings' => $pastMeetings])
@include('modal.occupy_meeting_room')


@include('modal.changeSeatDetails' , ['spaceid' => session()->get('spaceid') , 'invoiceType' => 'meeting'])

<div class="container">

<a href="javascript:void(0)" class="text-uppercase text-underline mb-3" style="font-weight: 600;" data-toggle="modal" data-target="#past_meeting_modal"> Booking History </a>

    <div class="row mt-3">
    @foreach($meetingRooms as $meetingRoom)
<div class="col-md-4">
<div class="card p-3">
    @if(isset($meetingRoom->name) && !empty($meetingRoom->name))
    <h5 class='card-title text-capitalize'>{{$meetingRoom->name}}</h5>
   
    @endif

    @if(isset($meetingRoom->capacity) && !empty($meetingRoom->capacity))
    <h5 class='card-title c-primary'>Capacity - {{$meetingRoom->capacity}}  </h5>
    @endif

    @if(count($meetingRoom->meating_room_occupation->where('is_occupied_now' , 1 )) > 0 )
    @php
$occupierDetails = $meetingRoom->meating_room_occupation->where('is_occupied_now' , 1 )->first();

$dataContent = "<b style='text-align:center;'>Occupier Details</b> <br> <b>Name:</b> {$occupierDetails->inquiry->name} <br> <b>Email</b>: {$occupierDetails->inquiry->email} <br> <b>Phone no:</b> {$occupierDetails->inquiry->phone_number}  <br><b> Seat Charges:</b> ₹{$occupierDetails->seat_charges} <br> <b>Duration Type:</b> {$occupierDetails->duration_type}  <br> <b> Start time :</b> {$occupierDetails->start_time} <br> <b>End time:</b> {$occupierDetails->end_time} ";

if($occupierDetails->duration_type == "daily"){
    $dataContent = "<b style='text-align:center;'>Occupier Details</b> <br> <b>Name:</b> {$occupierDetails->inquiry->name} <br> <b>Email</b>: {$occupierDetails->inquiry->email} <br> <b>Phone no:</b> {$occupierDetails->inquiry->phone_number}  <br><b> Seat Charges:</b> ₹{$occupierDetails->seat_charges}  
    <br> <b>Duration Type:</b> {$occupierDetails->duration_type}<br> <b> End date:</b> {$occupierDetails->end_date} ";
}
    @endphp

    <div class="occupiedMeeting occupiedTag d-inline-block  " style=""> Occupied</div>
    <img src="{{asset('images-new/meeting_allocation.svg')}}" data-content="{{$dataContent}}" class='w-100 img-fluid editMeatingRoom c-pointer' meeting-id="{{$meetingRoom->id}}" alt='' data-toggle="popover" name="{{$occupierDetails->inquiry->name}}" email="{{$occupierDetails->inquiry->email}}" phone_number="{{$occupierDetails->inquiry->phone_number}}" date="{{date('Y-m-d', strtotime($occupierDetails->date))}}"    start_time="{{$occupierDetails->start_time}}"  end_time="{{$occupierDetails->end_time}}"    end-date = "{{$occupierDetails->end_date}}" duration_type={{$occupierDetails->duration_type}} duration_days = "3" seat_charges="{{$occupierDetails->seat_charges}}" inquiry-id = '{{$occupierDetails->inquiry->id}}' lead_source="{{$occupierDetails->lead_source}}" allocation_id="{{$occupierDetails->id}}" srcset=''>

    @else
    <img src="{{asset('images-new/meeting_allocation.svg')}}" class='w-100 img-fluid occupyMeeting c-pointer' meeting-id="{{$meetingRoom->id}}"  alt="" srcset="" data-toggle="popover" data-html="true" data-content="<b style='text-align:center;'>Click here to occupy meeting room manually</b>">
    @endif

    

@php
$trueIcon = asset('images-new/icons/true.svg');
$falseIcon = asset('images-new/icons/false.svg');
@endphp

<div class="row">
    <div class="col-md-7">
    <div class="meetingRoomsDetails mt-3">
<p class='f-s-16 d-flex align-items-center justify-content-between '>Projector  <span class='text-right'><img src="{{$meetingRoom->is_projector ? $trueIcon : $falseIcon}}" class='' alt="" srcset=""></span>  </p>
<p  class='f-s-16 d-flex align-items-center justify-content-between'>Whiteboard <span class='text-right'><img src="{{$meetingRoom->is_whiteboard ? $trueIcon : $falseIcon}}" class='' alt="" srcset=""></span>  </p>
<p  class='f-s-16 d-flex align-items-center justify-content-between'>Available on Rent <span class='text-right'><img src="{{$meetingRoom->is_allow_rent ? $trueIcon : $falseIcon}}" class='' alt="" srcset=""></span>  </p>
</div>
    </div>
</div>


<div class="div parentListMeetingRoom">
<div class=' meetingList d-none'>
    <p>Occupied on <span class='date'></span> from <span class='list_start_time'> </span> to <span class='list_end_time'> </span>  </p>
    <a href="javascript:void(0)" onclick='deleteMeetingOccupation(this)' data-id = '' class=' removeLink text-underline'><i aria-hidden="true" class="fa fa-times-circle" title="Delete record"></i></a>    
</div>
@if($meetingRoom->meating_room_occupation->where('is_occupied_now' , 0)->count())
<p class="font-weight-bold c-primary f-s-16 text-center"> Upcoming Meetings</p>
@foreach($meetingRoom->meating_room_occupation->where('is_occupied_now' , 0) as $meetingOccupation)

<div class=' meetingList'>
    @if($meetingOccupation->duration_type == 'hourly')
    <p style='max-width: 60%;'>Occupied on {{ Carbon\Carbon::parse($meetingOccupation->date)->format('jS M, Y') }} from {{ $meetingOccupation->start_time }} to {{ $meetingOccupation->end_time }} </p>
    @else
    <p style='max-width: 60%;'>Occupied on {{ Carbon\Carbon::parse($meetingOccupation->date)->format('jS M, Y') }} to {{ Carbon\Carbon::parse($meetingOccupation->end_date)->format('jS M, Y') }} </p>
    @endif
    
    <a href="javascript:void(0)" onclick='deleteMeetingOccupation(this)' data-id = '{{$meetingOccupation->id}}' class='text-dark'><i aria-hidden="true" class="fa fa-times-circle" title="Delete record"></i></a>    
</div>

@endforeach
@else

@endif

</div>

</div>
</div>
@endforeach

    </div>
</div>
@endsection


@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('js/client/meetingrooms.js?v='.$v)}}"></script>
<script src="{{asset('js/client/invoice.js?v='.$v)}}"></script>

@endsection
