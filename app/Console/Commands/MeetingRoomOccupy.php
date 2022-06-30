<?php

namespace App\Console\Commands;

use App\MeetingOccupation;
use Illuminate\Console\Command;

class MeetingRoomOccupy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'occupyMeetingRoom:cron';

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
       
        // end time is current time , date today , is_occupied_now = 1 get that records make that meeting rooms  vacant 
        MeetingOccupation::where([
            'date' => date('Y-m-d'),
            'end_time' => date('H:i:s'),
            'is_occupied_now' => 1
        ])->update(['is_occupied_now' => 0 ]);

       // get record where date is today , time now is between start time and end time is_occupied_now = 0 than occupy seat 

       MeetingOccupation::where([
        'date' => date('Y-m-d'),
        'is_occupied_now' => 0
    ])->whereTime('start_time', '<', date('H:i:s'))
    ->whereTime('end_time', '>' ,  date('H:i:s'))
    ->update(['is_occupied_now' => 1 ]);

   

    }
}
