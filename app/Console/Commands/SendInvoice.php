<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendInvoice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendInvoice:cron';

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
        $today_date = idate("d");
        $invoice = Invoice::has('spaceoccupation')->with('invoiceitems', 'spaceoccupation', 'spaceoccupation.inquiries','space:id,space_name','spaceoccupation.spaceseatingtypes.seating_type:id,name')->where(['is_recurring' , '=' , 1] , ['num_of_date' , '=' , $today_date])->get();
              
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

    }
}
