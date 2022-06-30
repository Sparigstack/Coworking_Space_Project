<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpaceMeetingRoom extends Model
{
    protected $table="space_meeting_rooms";//
    //
    
    public function space(){
        return $this->belongsTo('App\Space');
    }

    public function meating_room_occupation(){
        return $this->hasMany('App\MeetingOccupation' , 'space_meeting_room_id');
    }


}
