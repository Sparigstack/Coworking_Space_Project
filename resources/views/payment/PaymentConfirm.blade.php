@extends('Masters.appFront')
@section('pageWiseCss')

<style>
    .containerPayment{
        max-width: 795px !important;
    }
    .card{
        box-shadow: 0px 0px 10px rgb(0 0 0 / 20%) !important;
        
    }
</style>
@endsection
   
@section('content')


@php
$start_time='';
$end_time= '';
if(isset($seatAllocatedData->start_time) && isset($seatAllocatedData->end_time)){
$start_time = $seatAllocatedData->start_time;
$end_time = $seatAllocatedData->end_time;
}

@endphp



<div class="container containerPayment mt-5 pt-md-5 mb-5 pb-4">
     
    <div class="card">
        <div class="card-body">
            <div class="d-flex p-3   justify-content-center align-items-center">
                <img src="{{asset('images-new/icons/true.svg')}}" width="60px" class="mr-3" alt="" srcset="">
                <div>
                    <h2>Payment Successful</h2>
                    {{-- <p class="max-width:150px;">simply dummy text of the printing and typesetting industry. </p> --}}
                </div>
            </div>
            <div class="dropdown-divider "></div>
            <div class="wrapper pl-md-5 pr-md-5 pt-3">
                @inputDetails(['title' => 'name' , 'value' => $seatAllocatedData->inquiryDetails[0]['name']])
                @inputDetails(['title' => 'Email Address' , 'value' => $seatAllocatedData->inquiryDetails[0]['email'] ])
                @inputDetails(['title' => 'Contact Number' , 'value' => $seatAllocatedData->inquiryDetails[0]['phoneNumber'] ])
                @inputDetails(['title' => 'Type Of Seat ' , 'value' => $seatAllocatedData->seating_type_name ])
                @isset($seatAllocatedData->num_of_seat)
                @inputDetails(['title' => 'Nnmber of Seats' , 'value' => $seatAllocatedData->num_of_seat  ?? ''])
                @endisset
                @inputDetails(['title' => 'Duration Time' , 'value' => dateDmy($seatAllocatedData->start_date) . ' ' .$start_time .  " to " . dateDmy($seatAllocatedData->end_date) . ' ' . $end_time ])

                @inputDetails(['title' => 'Total Price' , 'value' => "₹"  . $seatAllocatedData->pricing->totalWithGst])
                @inputDetails(['title' => 'Paid Amount' , 'value' => "₹" . $seatAllocatedData->pricing->payableAmount])
                @inputDetails(['title' => 'Space Name' , 'value' => $seatAllocatedData->space_name . ", " . $seatAllocatedData->area ?? '' .  " " . $seatAllocatedData->city ?? '' ])

            </div>
            <div class="d-flex flex-column align-items-center mt-3">
                <div class="mb-3">
                    <a href="javascript:void(0)" class="text-underline hidePrint" onclick="window.print()">Download Receipt</a>
                    <a href="{{route('my_booking')}}?seating-types={{$seatAllocatedData->seating_type_id}}" class="text-underline ml-3 hidePrint" >My Bookings</a>
                </div>
@primaryButton(['value' => "Back to Home" , "onclick" => "window.location.href='/'" , 'classList' => 'btn-warning'])
            </div>
        </div>
    </div>
</div> 
@endsection
