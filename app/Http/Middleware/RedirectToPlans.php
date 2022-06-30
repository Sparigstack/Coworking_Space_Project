<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\Space;
use App\Inquiry;
use App\Invoice;
use App\SpaceImage;
use Illuminate\Support\Facades\Redirect;

class RedirectToPlans
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $path = $request->path();
        $spaceId = Session::get('spaceid');
        $getPlanId = Space::where("id", $spaceId)->first();
        
        //For Space Images Upload Restriction
        if ($path === 'uploadSpaceImage') {
            $getImageCnt = SpaceImage::where("space_id", $spaceId)->count();
            $newUploadImageCnt = count($request->file('space_image'));
            $totalImageCount = $getImageCnt + $newUploadImageCnt;
            if ($getPlanId->plan_id == 1 && $totalImageCount > 5) {
                return back()->with('upgrade_plan','You can only upload up to 5 images for free listing.');
            }
        }
        
        //For Marketing Emails Send Restriction
        if ($path === 'client/sendEmailToLead') {
            $currentMonth = date('m');
            $currentYear =  date('Y');

            $sendMailCount = Inquiry::where('space_id', $spaceId)->whereMonth('created_at', '=', $currentMonth)->whereYear('created_at' , '=' , $currentYear)->count();
            $getSpaceDetails = Space::where('id', $spaceId)->select('discount')->first();
            $totalEmailsCount = $sendMailCount;
            
            if($getPlanId->plan_id === 1){
                if($totalEmailsCount > 100 || empty($getSpaceDetails->discount) || $getSpaceDetails->discount == null){
                    return redirect('client/spacePlans');
                }
            }
            
            if(($totalEmailsCount > 500 && $getPlanId->plan_id = 2) || ($totalEmailsCount > 2500 && $getPlanId->plan_id = 3) || ($totalEmailsCount > 10000 && $getPlanId->plan_id = 4)){
                return redirect('client/spacePlans');
            }
        }
        
        //For Leads Restriction
        if($path == 'addSpaceInquiry'){
            $currentMonth = date('m');
            $getSpaceId = Space::where('id', $request->inquiry_space_id)->first();
            if($getSpaceId->plan_id == 1){
                $inquiriesCount = Inquiry::where('space_id', $request->inquiry_space_id)->whereMonth('created_at', '=', $currentMonth)->whereYear('created_at' , date('Y'))->count();
                if($inquiriesCount > 5 || empty($getSpaceId->discount) || $getSpaceId->discount == null){
                    return back()->with('error','Count greater than 5');
                }
            }
        }
        
        //For Automated Billing Restriction
        if($path == 'saveInvoice'){            
            $getAutomaticBillingInvoiceCount = Invoice::where('space_id', $spaceId)->where('is_recurring', 1)->count();
            if (($getPlanId->plan_id == 1) || ($getPlanId->plan_id == 2 && $getAutomaticBillingInvoiceCount == 100) || ($getPlanId->plan_id == 3 && $getAutomaticBillingInvoiceCount == 100)) {
                return back()->with('error','Upgrade Plan');
            }
        }
        
        return $next($request);
        
    }
}
