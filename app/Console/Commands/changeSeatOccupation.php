<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class changeSeatOccupation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'changeSeatOccupation:cron';

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
        $today = date('Y-m-d');
        //  vacant seat if time period of that person is completed 
        $datePlusOne = date('Y-m-d', strtotime("+1 day"));
 SpaceOccupation::whereDate(['end_date' , $datePlusOne])->where('is_occupied_now' , 1)->update(['is_occupied_now' => 0]);

        // occupy that seat if start date is today 
   SpaceOccupation::whereDate('start_date' , $today )->where('is_occupied_now' , 0)->update(['is_occupied_now' => 1]);





    }
}
