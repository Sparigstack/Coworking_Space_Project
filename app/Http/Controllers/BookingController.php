<?php

namespace App\Http\Controllers;


use App\SpaceMeetingRoom;

use App\MeetingOccupation;
use Illuminate\Http\Request;
use App\Helpers\DateTimehelper;
use App\Services\BookingService;
use App\Services\MeetingService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class BookingController extends Controller
{
    public function index(BookingService $bookingService)
    {
        $spaceId = Session::get('spaceid');
        $bookings = $bookingService->SpaceBookings($spaceId);
        return view('Client.bookings', compact('bookings'));
    }

    public function myBookings(BookingService $bookingService)
    {
        $bookings = $bookingService->myBookings(Auth::id());

        return view('Bookings.my_bookings', compact('bookings'));
    }


    public function thankYou()
    {
        $seatAllocatedData = Session::get('bookSeatDetails');
        return view('payment.PaymentConfirm', compact('seatAllocatedData'));
    }

    public function checkMeetingAvailability(Request $request, MeetingService $meetingService)
    {
        // check meeting room availability based daily and hourly 
        $start_time = date("G:i", strtotime($request->start_time));
        $end_time =  date("G:i", strtotime($request->end_time));
        $start_date = $request->start_date;
        $duration = $request->duration;
        $duration_type = $request->duration_type;
        $space_id = $request->space_id;
        $person_count = $request->person_count;
        $meeting_room_id = $request->meeting_room_id;
        $end_date = '';
        if(isset($duration)){
            $end_date = DateTimehelper::getEndDate($start_date, 1,$duration - 1)->format('Y-m-d');
        }

        if ($duration_type == "hourly") {
            $availability = $meetingService->checkHourlyMeetingRoom($meeting_room_id, $start_date, $start_time, $end_time,'');
            $price = SpaceMeetingRoom::where('id', $meeting_room_id)->select('price_hour')->first()->price_hour;
        } else {
            $availability =  $meetingService->checkdailyMeetingRoom($meeting_room_id, $start_date, $end_date,'');
            $price = SpaceMeetingRoom::where('id', $meeting_room_id)->select('price_day')->first()->price_day;
        }
        return response()->json([
            'message' => $availability,
            'price' => $price
        ]);
    }
   
}
