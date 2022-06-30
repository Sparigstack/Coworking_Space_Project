<?php

namespace App\Services;

use App\Booking;
use App\BookingUsers;
use App\BookingDetails;
use App\MeetingOccupation;
use Illuminate\Support\Facades\Auth;

class BookingService
{

    public function create($seatAllocatedData)
    {
  
      try {
        return Booking::create([
            'user_id' => Auth::id(),
            'num_of_person' => $seatAllocatedData->num_of_person,
            'seating_type_id' => $seatAllocatedData->seating_type_id,
            'space_id' => $seatAllocatedData->space_id,
            'total_amount' =>  $seatAllocatedData->pricing->totalWithGst,
            'paid_amount' =>  $seatAllocatedData->pricing->payableAmount,
            'start_date' => $seatAllocatedData->start_date,
            'end_date' =>  $seatAllocatedData->end_date ?? null,
          
        ]);
      } catch (\Throwable $th) {
         
      }
    }
    public function SpaceBookings($spaceId)
    {
        return Booking::with(['booking_users' => function ($q) {
            $q->select('id', 'booking_id', 'inquire_id');
        }, 'booking_users.inquiries' => function ($q) {
            $q->select('id', 'name', 'email', 'phone_number');
        }])->where('space_id', $spaceId)->get();
    }

    public function myBookings($userId)
    {

        return  Booking::with(['space' => function ($q) {
            $q->select('id', 'space_name', 'address1', 'address2', 'latitude', 'longitude', 'place_id', 'plan_id', 'price_start_from','city_id','area_id');
        }, 'booking_users.inquiries' => function ($q) {
            $q->select('id', 'name', 'email', 'phone_number');
        }])->join('space_images', function ($q) {
            $q->on('space_images.space_id', '=', 'bookings.space_id')
                ->where('isFeatured', 1);
        })->select('bookings.*', 'space_images.id as image_id ', 'space_images.spaceImagePath')->where('user_id', $userId)
            ->get();
    }

    public function addUserToBooking($bookingId, $inquireId)
    {
        return BookingUsers::create([
            'booking_id' => $bookingId,
            'inquire_id' => $inquireId
        ]);
    }
}
