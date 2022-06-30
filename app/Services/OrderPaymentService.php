<?php

namespace App\Services;
use Razorpay\Api\Api;

class OrderPaymentService{

    public function __construct(Api $api)
    {
    // create api instance for razorpay payment
      $this->booking = $api;
    }


    public function intiate()
    {
        
    }

    public function complete()
    {
        
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