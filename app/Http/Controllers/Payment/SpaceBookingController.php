<?php

namespace App\Http\Controllers\Payment;

use App\Space;
use App\Booking;
use App\Inquiry;
use App\SeatingType;
use Razorpay\Api\Api;
use App\SpaceOccupation;
use App\MeetingOccupation;
use Illuminate\Http\Request;
use App\Mail\BookingConfirmed;
use App\Helpers\DateTimehelper;
use App\Services\BookingService;
use App\Services\MeetingService;
use App\Http\Controllers\Controller;
use App\Services\InquiryService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class SpaceBookingController extends Controller
{

  public function __construct(Api $api)
  {
    $this->booking = $api;
  }

  public function saveSeatingDetails(Request $request, MeetingService $meetingService)
  {
    $data = (object) $request->bookingDetails;

    $space = Space::with('area:id,name', 'city:id,name')->where('id', $data->space_id)->select('id', 'space_name', 'city_id', 'area_id','address1')->first();
    $seating_type =  SeatingType::where('id', $data->seating_type_id)->select('id', 'name')->first();
    $end_date = DateTimehelper::getEndDate($data->start_date, 1, (int) $data->duration - 1);
    $end_date = date("Y-m-d", strtotime($end_date));
    $data->city = $space->city ? $space->city->name : '';
    $data->area = $space->area ? $space->area->name : '';
    $data->address_1 = $space->area ? $space->address1 : '';
    $data->space_name = $space->space_name;
    $data->end_date = $end_date;
    $data->seating_type_name = $seating_type->name;

    $total = 0;


    // if meeting room calculate price for that 
    if ($data->seating_type_id == "6") {
      $total =  $meetingService->getTotalPrice($data);
    } else {
      // if seating type like hot flexi , dedicated 
      foreach ($data->seatDetails as $seatDetails) {
        $seatDetails = (object) $seatDetails;
        $total += $seatDetails->num_of_person * $seatDetails->price * $data->duration;
      }
    }


    $gst = ($total * 18) / 100;
    $finalAmount = $total + $gst;
    $payableAmount = ($finalAmount * 50) / 100;

    $pricing = (object) [];
    $pricing->total = $total;
    $pricing->gst = $gst;
    $pricing->totalWithGst =  $finalAmount;
    $pricing->payableAmount = $payableAmount;
    $data->pricing = $pricing;

    Session::put('bookSeatDetails', $data);
    return "Success";
  }

  public function Initiate()
  {

    $seatAllocatedData = Session::get('bookSeatDetails');
    
    $price = $seatAllocatedData->pricing->payableAmount;
 
    $response =  $this->booking->order->create(array('receipt' => '', 'amount' => $price * 100, 'currency' => 'INR', 'notes' => array('space_id' => $seatAllocatedData->space_id, 'User Name' =>  $seatAllocatedData->inquiryDetails[0]['name'])));

    $response = [
      'razorpayId' => config('app.payment.razorpay_key'),
      'currency' => $response->currency,
      'id' => $response->id,
      'name' => $seatAllocatedData->inquiryDetails[0]['name'],
      'email' => $seatAllocatedData->inquiryDetails[0]['email'],
      'phone_number' => $seatAllocatedData->inquiryDetails[0]['phoneNumber']
    ];

 

  
    return view('bookingPayment', compact('response', 'seatAllocatedData'));
  }

  public function complete(Request $request, BookingService $bookingService, MeetingService $meetingService, InquiryService $inquiryService)
  {

    $signatureStatus = $this->SignatureVerify(
      $request->all()['rzp_signature'],
      $request->all()['rzp_paymentid'],
      $request->all()['rzp_orderId']
    );
    if ($signatureStatus == true) {

      $seatAllocatedData = Session::get('bookSeatDetails');

      // send email to space owner and user
      $this->sendEmailToSpaceOwner($seatAllocatedData);
      $this->sendEmailToUser($seatAllocatedData);
      DB::beginTransaction();
try {
       // if meeeting room booking
       if ($seatAllocatedData->seating_type_id == "6") {
      
        $booking = $bookingService->create($seatAllocatedData);
        $inquiry =  $inquiryService->createInquiryIfNotExist($seatAllocatedData->inquiryDetails[0], $seatAllocatedData);
        $bookingService->addUserToBooking($booking->id, $inquiry->id);
        $seatAllocatedData->booking_id = $booking->id;
        $seatAllocatedData->inquire_id = $inquiry->id;
        $meetingService->allocateMeetingRoom($seatAllocatedData);
      }
      // if seating type booking  
      else {
        $this->allocateSeat($seatAllocatedData, $bookingService);
      }


  DB::commit();
} catch (\Throwable $th) {
  DB::rollback();  
}
 


      return redirect()->route('booking-successful');
    } else {
      return "Payment Failed Please try again";
    }
  }






  private function createInquiryIfNotExist($inquiryDetails, $seatAllocatedData)
  {
    // create inquiry if not exist 
    $inquiryDetails = (object) $inquiryDetails;

    if (isset($inquiryDetails->name)  && isset($inquiryDetails->email)  && isset($inquiryDetails->phoneNumber)) {
      $inquiry = Inquiry::where([
        ['email', $inquiryDetails->email],
        ['phone_number', $inquiryDetails->phoneNumber]
      ])->first();

      if (!isset($inquiry)) {
        $inquiry = Inquiry::create([
          'space_id' => $seatAllocatedData->space_id,
          'seating_type_id' => $seatAllocatedData->seating_type_id,
          'name' => $inquiryDetails->name,
          'email' => $inquiryDetails->email,
          'phone_number' => $inquiryDetails->phoneNumber,
          'inquiry_type' => 1,
        ]);
      }
    } else {
      $inquiry = Session::get('bookingInquiry');
    }




    return $inquiry;
  }


  private function allocateSeat($seatAllocatedData, $bookingService)
  {

    $isPastOrCurrentDate  = DateTimehelper::isPastOrCurrentDate($seatAllocatedData->start_date, $seatAllocatedData->end_date);

    $booking = Booking::create([
      'user_id' => Auth::id(),
      'num_of_person' => $seatAllocatedData->num_of_seat,
      'seating_type_id' => $seatAllocatedData->seating_type_id,
      'space_id' => $seatAllocatedData->space_id,
      'total_amount' =>  $seatAllocatedData->pricing->totalWithGst,
      'paid_amount' =>  $seatAllocatedData->pricing->payableAmount,
      'start_date' => $seatAllocatedData->start_date,
      'end_date' =>  $seatAllocatedData->end_date,
    ]);
    // allocate seat in that seating type
    // 2 loops => first for in which seating type how many seats need to occupy and  price for that seating type 
    $inquiryCount = 0;
    for ($i = 0; $i < count($seatAllocatedData->seatDetails); $i++) {
      $seatData =   (object)  $seatAllocatedData->seatDetails[$i];
      for ($j = 0; $j < (int) $seatData->num_of_person; $j++) {
        //create inquiry if not exist

        $inquiry =  $this->createInquiryIfNotExist($seatAllocatedData->inquiryDetails[$inquiryCount], $seatAllocatedData);

        $bookingService->addUserToBooking($booking->id, $inquiry->id);

        if ($inquiryCount == 0) {
          Session::put('bookingInquiry', $inquiry);
        }
        SpaceOccupation::create([
          'space_id' => $seatAllocatedData->space_id,
          'space_seating_type_id' => $seatData->seating_type_id,
          'seating_type_id' =>  $seatAllocatedData->seating_type_id,
          'inquire_id' => $inquiry->id,
          'start_date' => $seatAllocatedData->start_date,
          'duration' => $seatAllocatedData->duration,
          'end_date' => $seatAllocatedData->end_date,
          'duration_period' => 1,
          'is_occupied_now' => $isPastOrCurrentDate ? 1 : 0,
          'duration_charges'=>$seatData->price,
          'seat_charges' => $seatData->price * $seatAllocatedData->duration,
          'lead_source' => 1,
          'booking_id' => $booking->id,
        ]);

        $inquiryCount++;
      }
    }
  }

  private  function sendEmailToSpaceOwner($seatAllocatedData)
  {
    // space owner email id , inquiry details , allocation details 
    $mail_user = 'space_owner';
    $space = Space::where('id', $seatAllocatedData->space_id)->select('id', 'space_name', 'email')->first();
    Mail::to($space->email)->send(new BookingConfirmed($seatAllocatedData, $mail_user));
  }

  private  function sendEmailToUser($seatAllocatedData)
  {
    // user email id , inquiry details , allocation details 
    $mail_user = 'user';
    Mail::to($seatAllocatedData->inquiryDetails[0]['email'])->send(new BookingConfirmed($seatAllocatedData,  $mail_user));
  }


  private function SignatureVerify($_signature, $_paymentId, $_orderId)
  {
    try {
      $attributes  = array('razorpay_signature'  => $_signature,  'razorpay_payment_id'  => $_paymentId,  'razorpay_order_id' => $_orderId);
      $order  = $this->booking->utility->verifyPaymentSignature($attributes);
      return true;
    } catch (\Exception $e) {
      // If Signature is not correct its give a excetption so we use try catch
      return false;
    }
  }
}
