<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($seatAllocatedData , $mail_user)
    {
        $this->seatAllocatedData = $seatAllocatedData;
        $this->mail_user = $mail_user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('hello@gocoworq.com' , 'Gocoworq')
            ->markdown('mails.BookingConfirm')
            ->with([
                'seatAllocatedData' => $this->seatAllocatedData,
                'mail_user' => $this->mail_user
            ]);
    }
}
