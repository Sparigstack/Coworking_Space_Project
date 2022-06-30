<?php

namespace App\Console\Commands;

use DateTime;
use App\Emails;
use DateTimeZone;
use App\EmailRecipients;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class sendEmailCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendEmail:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \Log::info('This is some useful information.');
            $dt = new DateTime(date("Y-m-d H:i:00"));
            $tz = new DateTimeZone('Asia/Kolkata');
            $dt->setTimezone($tz);
         

            $emails = Emails::with('emailRecipients')->whereHas('emailRecipients', function($q){
                $q->where('is_sent', 0);
            })->whereNull('schedule_date')->orWhere('schedule_date' , $dt->format('Y-m-d H:i:s'))->get();

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
            
    }
}
