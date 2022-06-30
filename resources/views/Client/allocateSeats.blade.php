@extends('Masters.ClientSpace')
@section('css')
<?php $v= '2.2.0'; ?>

<link rel="stylesheet" href="{{asset('css/allocateseat.css')}}">
@endsection
@section('spacedetail')

@include('modal.changeSeatDetails' , ['spaceid' => $spaceid , 'invoiceType' => 'seating'])
@include('modal.past_seat_booking' , ['pastSeatList' => $pastSeatList])
  <!-- End container-fluid-->
    <!-- popup -->
@include('seatAllocate.AddSeatPopup', ['spaceid' => $spaceid])
@include('modal.invoice_sent_modal')
    <!-- end of popup -->
<div class="content-wrapper">
    {{ csrf_field() }}
  

    <input type="hidden" name="" class='vacantSeatUrl' value="{{url('client/vacantSeat')}}">
    
    <!-- hot/flexi part -->
    <div class="container">
<a href="javascript:void(0)" class='text-uppercase text-underline d-block text-right mt-3' style='    font-weight: 600;' data-toggle="modal" data-target="#past_seat_booking_modal"> Booking History </a>

        <div class="row mt-lg-3 mt-3">
            <div class="col-md-4 pr-lg-0">
                <div class="card seatTypeSection" data-seat-name= "Hot/Flexi Desk">
                    <div class="card-header">
                        <i class="fa fa-table pt-3" ></i> Hot/Flexi Desk
                    </div>
                    <div class="card-body">
                        @foreach($spaceSeatTypes->where('seating_type_id','2') as $spaceSeatType)
                        @include('seatAllocate.seatingDetails' , ['spaceSeatType' => $spaceSeatType ])
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- hot/flexi part -->


            <!-- dedicated desk part -->
            <div class="col-md-4 pr-lg-0">
                <div class="card seatTypeSection" data-seat-name= "Dedicated Desk">
                    <div class="card-header">
                        <i class="fa fa-table pt-3"></i> Dedicated Desk
                    </div>
                    <div class="card-body">
                        @foreach($spaceSeatTypes->where('seating_type_id','3') as $spaceSeatType)
                        @include('seatAllocate.seatingDetails' , ['spaceSeatType' => $spaceSeatType ])
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- end dedicated -->


            <!-- private office part -->
            <div class="col-md-4">
                <div class="card seatTypeSection" data-seat-name= "Private Office">
                    <div class="card-header">
                        <i class="fa fa-table pt-3"></i> Private Office
                    </div>
                    <div class="card-body">
                        @foreach($spaceSeatTypes->where('seating_type_id','4') as $spaceSeatType)                   
                        @include('seatAllocate.privateSeatDetails' , ['spaceSeatType' => $spaceSeatType ])
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- private office part end -->

            
        </div>
    </div>
  

</div>
<!--End content-wrapper-->

@endsection

@section('script')
<script src="{{asset('js/client/allocateSeat.js?v='.$v)}}"></script>
<script src="{{ asset('js/client/index.js?v='.$v) }}"></script>
<script src="{{ asset('js/client/invoice.js?v='.$v) }}"></script>



@endsection