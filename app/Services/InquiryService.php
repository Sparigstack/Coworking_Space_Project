<?php

namespace App\Services;

use App\Inquiry;
use Illuminate\Support\Facades\Session;



class InquiryService
{

  public function createInquiryIfNotExist($inquiryDetails, $seatAllocatedData)
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
}
