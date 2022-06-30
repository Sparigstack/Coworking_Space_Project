@extends('Masters.ClientSpace')
@section('spacedetail')
@include('modal.space_on_map')
<div class="container mt-4 tab-theme-modal">
    <div class="card">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <button class="nav-item nav-link active show text-uppercase c-pointer" id="nav-flexi-tab" data-toggle="tab" href="#flexi-details" role="tab" aria-controls="nav-home" aria-selected="true">Hot/Flexi desk </button>
              <button class="nav-item nav-link text-uppercase c-pointer" id="nav-dedicated-tab" data-toggle="tab" href="#dedicated-details" role="tab" aria-controls="nav-profile" aria-selected="false">Dedicated desk</button>
              <button class="nav-item nav-link text-uppercase c-pointer" id="nav-meeting-tab" data-toggle="tab" href="#meeting-details" role="tab" aria-controls="nav-contact" aria-selected="false">meeting room</button>
            </div>
          </nav>
        </div>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="flexi-details" role="tabpanel">
                @include('layout.booking' , ['bookings' => $bookings->where('seating_type_id' , 2) , 'user_type' => 'space_owner' ])
            </div>
            <div class="tab-pane fade" id="dedicated-details" role="tabpanel" > 
                @include('layout.booking' , ['bookings' => $bookings->where('seating_type_id' , 3) , 'user_type' => 'space_owner' ])
            </div>
            <div class="tab-pane fade" id="meeting-details" role="tabpanel" > 
                @include('layout.booking' , ['bookings' => $bookings->where('seating_type_id' , 6) , 'user_type' => 'space_owner' ])
            </div>
          </div>
   
</div>

@endsection