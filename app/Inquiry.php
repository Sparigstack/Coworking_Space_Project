<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    //
    protected $table="inquiries";
    protected $guarded = [];
    
    public function spaceoccupation() {
        return $this->hasMany('App\SpaceOccupation');
    }

    public function space()
    {
        return $this->belongsTo('App\Space');
    }

    // public function seating_type()
    // {
    //     return $this->belongsTo('App\SeatingType' , 'seating_type_id');
    // }

}
