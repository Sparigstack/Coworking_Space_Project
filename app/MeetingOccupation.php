<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MeetingOccupation extends Model
{
    use SoftDeletes;
    protected $table = "meeting_rooms_occupation";

    protected $guarded = [];
    
    public function space_meatings_rooms() {
        return $this->belongsTo('App\SpaceMeetingRoom', 'space_meeting_room_id');
    }

    public function inquiry() {
        return $this->belongsTo('App\Inquiry', 'inquire_id');
    }

    public function inquiries() {
        return $this->belongsTo('App\Inquiry', 'inquire_id');
    }

    // public function invoices(){
    //     return $this->morphMany('App\Invoice', 'inquire_id');
    // }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = date("G:i", strtotime($value));
    }
    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = date("G:i", strtotime($value));
    }

    public function getStartTimeAttribute($value)
{
  return date('g:i a', strtotime($value)); 
}

public function getEndTimeAttribute($value)
{
    return date('g:i a', strtotime($value)); 
}

public function meetingBooking()
{
    $this->belongsTo('App/Booking' , 'booking_id');
}

}
