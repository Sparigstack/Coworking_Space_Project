<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\UserPassportUsage;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class tallyAccountSpaces extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'word:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a Daily email to all users with a word and its meaning';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
//        $words = [
//            'aberration' => 'a state or condition markedly different from the norm',
//            'convivial' => 'occupied with or fond of the pleasures of good company',
//            'diaphanous' => 'so thin as to transmit light',
//            'elegy' => 'a mournful poem; a lament for the dead',
//            'ostensible' => 'appearing as such but not necessarily so'
//        ];


        $lastMonthPassportReedemRecords = UserPassportUsage::select('id')->where(
                        'created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString()
                )->get();

//        $key = array_rand($words);
//        $value = $words[$key];

        $users = User::all();
        foreach ($users as $user) {
            Mail::raw("$lastMonthPassportReedemRecords", function ($mail) use ($user) {
                $mail->from('team.sprigstack@gmail.com');
                $mail->to($user->email)
                        ->subject('Word of the Day test again');
            });
        }

        $this->info('Word of the Day sent to All Users Test Again');
    }

}
