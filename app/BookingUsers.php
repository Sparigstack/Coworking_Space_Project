<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingUsers extends Model
{
    protected $table = "booking_users";
    protected $guarded = []; 
    

    public function booking()
    {
        return  $this->belongsTo('App\Booking' , 'booking_id');
    }

    public function inquiries()
    {
        return  $this->belongsTo('App\Inquiry' , 'inquire_id');
    }


}
