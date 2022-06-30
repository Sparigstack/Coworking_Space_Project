<?php
namespace App\Helpers;
use Session;
use App\Space;
use App\Inquiry;
use App\Invoice;

class RestrictionCheck{

  public static  function checkInvoiceRestrction(){
        $spaceId = Session::get('spaceid');
        $getPlanId = Space::where("id", $spaceId)->first();
                 
            $getAutomaticBillingInvoiceCount = Invoice::where('space_id', $spaceId)->where('is_recurring', 1)->count();
            if (($getPlanId->plan_id == 1) || ($getPlanId->plan_id == 2 && $getAutomaticBillingInvoiceCount == 100) || ($getPlanId->plan_id == 3 && $getAutomaticBillingInvoiceCount == 100)) {
                return 'Upgrade Plan';
            }
      }

      public static  function leadRestrction($inquiry_space_id){
        $currentMonth = date('m');
        $getSpaceId = Space::where('id',$inquiry_space_id )->first();
        if($getSpaceId->plan_id == 1){
            $inquiriesCount = Inquiry::where('space_id', $inquiry_space_id)->whereMonth('created_at', '=', $currentMonth)->whereYear('created_at' , date('Y'))->count();
            if($inquiriesCount > 5 || empty($getSpaceId->discount) || $getSpaceId->discount == null){
                return 'Upgrade Plan';
            }
        }
      }


}

	   
	 
