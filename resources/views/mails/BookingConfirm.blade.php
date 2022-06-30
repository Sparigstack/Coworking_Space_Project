@php
$start_date='';
$end_date='';
if(isset($seatAllocatedData->start_date) && !empty($seatAllocatedData->start_date)){
  $start_date=$seatAllocatedData->start_date;
  $start_date = dateDmy($start_date);
}

if(isset($seatAllocatedData->start_date) && !empty($seatAllocatedData->start_date)){
    $end_date=$seatAllocatedData->end_date;
    $end_date = dateDmy($end_date);
}


@endphp

@component('mail::message')

@if($mail_user == "user")
Dear {{ $seatAllocatedData->inquiryDetails[0]['name']}},

Your Booking for {{$seatAllocatedData->seating_type_name}} is confirmed. Thank you for choosing Gocoworq.
You can access the {{$seatAllocatedData->space_name}}
{{ $start_date == $end_date ? ' on ' . $start_date : ' from ' .$start_date  . " to " . $end_date}}. 

Space Details: 
{{$seatAllocatedData->space_name}},<br/>
{{$seatAllocatedData->address_1}} , {{$seatAllocatedData->area}} {{$seatAllocatedData->city}}

Number of seat : {{$seatAllocatedData->num_of_seat}}

Type Of Seat : {{$seatAllocatedData->seating_type_name}}

@if($seatAllocatedData->start_date == $seatAllocatedData->end_date)
Duration Time : {{$start_date }}
@else
Duration Time : {{$start_date . " to " . $end_date}}
@endif

Total Amount: ₹{{$seatAllocatedData->pricing->totalWithGst}}

Amount Paid: ₹{{$seatAllocatedData->pricing->payableAmount}}


@else 

To {{$seatAllocatedData->space_name}} ,<br/>
You have received a booking for your space in {{$seatAllocatedData->area}} , {{$seatAllocatedData->city}}

Name: {{ $seatAllocatedData->inquiryDetails[0]['name'] }}

Email Address: {{ $seatAllocatedData->inquiryDetails[0]['email']}} 

Contact Number : {{$seatAllocatedData->inquiryDetails[0]['phoneNumber']}}

Number of seat : {{$seatAllocatedData->num_of_seat}}

Type Of Seat Or Cabin : {{$seatAllocatedData->seating_type_name}}

@if($start_date == $end_date)
Duration Time : {{$start_date }}
@else
Duration Time : {{$start_date . " to " . $end_date}}
@endif

Total Amount: ₹{{$seatAllocatedData->pricing->totalWithGst}}

Amount Paid: ₹{{$seatAllocatedData->pricing->payableAmount}}

@endif



Thank you,<br>
Team Gocoworq<br>
+91-97 2697 0725<br>
<a href="{{url('/')}}">{{ config('app.name') }}</a>

@endcomponent
