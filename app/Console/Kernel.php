<?php

namespace App\Console;
use PDF;
use Mail;
use App\User;
use DateTime;
use App\Space;
use App\Emails;
use App\Invoice;
use DateTimeZone;
use App\EmailRecipients;
use App\SpaceOccupation;
use App\SpaceSeatingType;
use App\MeetingOccupation;
use App\SpaceInventoryItem;
use Illuminate\Foundation\Inspiring;
use App\Console\Commands\sendEmailCron;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\tallyAccountSpaces;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\tallyAccountSpaces::class, //
        \App\Console\Commands\sendEmailCron::class, //
        \App\Console\Commands\SendInvoice::class, //
        \App\Console\Commands\MeetingRoomOccupy::class, //
        
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
//    protected function schedule(Schedule $schedule)
//    {
//        // $schedule->command('inspire')
//        //          ->hourly();
//        $schedule->command('word:day')
//            ->daily();
//    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
    
    
    protected function schedule(Schedule $schedule)
    {

   

         // $schedule->command('sendEmail:cron')
        //          ->everyMinute();
        // // will send invoice at 10 am in morning 
        // $schedule->command('sendInvoice:cron')
        // ->dailyAt('02:30');

        // // run every morning at 7 am ist and change seats status 
        // $schedule->command('changeSeatOccupation:cron')
        // ->dailyAt('01:30');
    
        // // occupy meeting room and change status accordingly 
        // $schedule->command('occupyMeetingRoom:cron')
        //          ->everyMinute();


        $schedule->call(function () {
           
            $dt = new DateTime(date("Y-m-d H:i:00"));
            $tz = new DateTimeZone('Asia/Kolkata');
            $dt->setTimezone($tz);
         

            $emails = Emails::whereHas('emailRecipients', function($q){
                $q->where('is_sent', 0);
            })->with('emailRecipients' , 'emailRecipients.inquiry')->whereNull('schedule_date')->orWhere('schedule_date' , $dt->format('Y-m-d H:i:00'))->get();

            foreach($emails as $email){
                foreach ($email->emailRecipients as $recipient) {
                    $utility = new \App\Utility; 
                    $email_body = str_replace("%%FullName_%%",$recipient->inquiry->name , $recipient->email->email_body);
                    $email_body = str_replace("%%PhoneNumber_%%",$recipient->inquiry->phone_number ,  $email_body );
                    $email_body = str_replace("%%Email_%%",$recipient->inquiry->email ,  $email_body);
                    $result = $utility->sendEmail_to_leads($recipient->email->from_name,$recipient->inquiry->email , $recipient->email->subject,$email_body);
                    $recipient->is_sent = 1 ; 
                    $recipient->save();
                    echo $result;
                }
            }
        })->everyMinute();

        $schedule->call(function () {
            $today_date = idate("d");
            $invoices = Invoice::has('spaceoccupation')->with('invoiceitems', 'spaceoccupation', 'spaceoccupation.inquiries','space:id,space_name','spaceoccupation.spaceseatingtypes.seating_type:id,name')->where(['is_recurring' , '=' , 1] , ['num_of_date' , '=' , $today_date])->get();
                  
    foreach($invoices as $invoice){
      $data["title"] = "Invoice";
      $data["email"] = $invoice->spaceoccupation->inquiries->email;
      $data["name"] = $invoice->spaceoccupation->inquiries->name;
      $data["space_name"] = $invoice->space->space_name;
      $data["seat_type"] = $invoice->spaceoccupation->spaceseatingtypes->seating_type->name;
      $data["invoiceId"] = $invoice->id;
    
      $pdf = PDF::loadView('pdf.createInvoice', compact('invoice'))->setPaper('a4');
    
      $pdf = PDF::loadView('pdf.createInvoice' , compact('invoice', 'recurring'))->setPaper('a4');
    
      Mail::send('mails.invoice_attachment', $data, function($message)use($data, $pdf) {
          $message->to($data["email"], $data["email"])
                  ->subject($data["title"])
                  ->attachData($pdf->output(), "invoice.pdf");
      });
    
    
    }
        })->dailyAt('02:30');

        // send mail if  inventory Item  will out of stock daily at 10 am in morning.
        $schedule->call(function () {
            $getReminderSpaces = SpaceInventoryItem::whereHas('space', function ($q) {
                $q->where('is_remind', '=', 1);
            })->distinct('space_id')->pluck('space_id');
    
            $res = array();
            foreach ($getReminderSpaces as $getReminderSpace) {
                $spaceId = $getReminderSpace;
                $data["spaceid"] = $spaceId;
                $getSpaceData = Space::where('id', $spaceId)->first();
                $spaceName = $getSpaceData->space_name;
                $userEmailAddress = $getSpaceData->user->email;
                
                $getSpaceInventoryItems = SpaceInventoryItem::where('space_id', $getReminderSpace)->get();
                foreach ($getSpaceInventoryItems as $getSpaceInventoryItem) {
                    if ($getSpaceInventoryItem->quantity == $getSpaceInventoryItem->stock_remind_quantity) {
                        $res[] = array(
                            "itemName" => $getSpaceInventoryItem->name,
                            "quantity" => $getSpaceInventoryItem->quantity
                        );
                        $userEmailAddress = 'mailto:ayushi.sprigstack@outlook.com';
                        $data["inventoryItems"] = $res;
                        $data["spacename"] = $spaceName;
                    }
                }
                
                Mail::send('mails.reminderSpaceInventoryItems', $data, function($message)use($userEmailAddress) {
                    $message->to($userEmailAddress, $userEmailAddress)
                            ->subject('Gentle Reminder!!');
                });       
            }
            

        })->dailyAt('04:30');

        $schedule->call(function () {
            $today = date('Y-m-d');
            //  vacant seat if time period of that person is completed 
            $datePlusOne = date('Y-m-d', strtotime("+1 day"));
     SpaceOccupation::whereDate(['end_date' , $datePlusOne])->where('is_occupied_now' , 1)->update(['is_occupied_now' => 0]);
    
         // occupy that seat if start date is today 
       SpaceOccupation::whereDate('start_date' , $today )->where('is_occupied_now' , 0)->update(['is_occupied_now' => 1]);
        })->dailyAt('01:30');

        $schedule->call(function () {
            // end time is current time , date today , is_occupied_now = 1 get that records make that meeting rooms  vacant
MeetingOccupation::where('duration_type' , 'hourly')->whereDate('date' , date('Y-m-d'))->whereTime('end_time' ,date('H:i:00'))->where('is_occupied_now' , 1)->update(['is_occupied_now' => 0 ]);
     // get record where date is today , time now is between start time and end time is_occupied_now = 0 than occupy seat
MeetingOccupation::where('duration_type' , 'hourly')->whereDate('date' , date('Y-m-d'))->whereTime('start_time' ,date('H:i:00'))->where('is_occupied_now' , 0)->update(['is_occupied_now' => 1 ]);
     MeetingOccupation::where('duration_type' , 'daily')->whereDate('date' , date('Y-m-d'))->where('is_occupied_now' ,  0 )->update(['is_occupied_now' => 1 ]);
      })->everyMinute();


      // vacant daily meeting occupation at daily 11:59 pm
      $schedule->call(function () {
        MeetingOccupation::where('duration_type' , 'daily')->whereDate('date' , date('Y-m-d', strtotime("+1 day")))->where('is_occupied_now' , 1)->update(['is_occupied_now' => 0 ]);
      })->dailyAt('01:30');

      // oocupy daily meeting room at 12:00 am 
     $schedule->call(function () {
        MeetingOccupation::where('duration_type' , 'daily')->whereDate('date' , date('Y-m-d', strtotime("+1 day")))->where('is_occupied_now' , 1)->update(['is_occupied_now' => 0 ]);
      })->dailyAt('01:30');

      
      

        
   
    }
}
