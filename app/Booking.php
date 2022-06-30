<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = "bookings";
    protected $guarded = [];   
    public function space(){
        return   $this->belongsTo('App\Space' , 'space_id');
    }

    public function seating_type()
    {
        return  $this->belongsTo('App\SeatingType' , 'seating_type_id');
    }
    
    public function space_occupation(){
        return $this->hasMany('App\SpaceOccupation','booking_id');
    }
   
    public function booking_users(){
        return $this->hasMany('App\BookingUsers','booking_id');
    }

    
    public function space_images() {
        return $this->hasMany('App\SpaceImage', 'space_id')->orderByDesc('isFeatured');
    }

    public function meeting_occupation()
    {
       return $this->hasOne('App\MeetingOccupation' , 'booking_id');
    }
}
