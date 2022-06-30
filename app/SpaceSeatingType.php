<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpaceSeatingType extends Model {

    protected $table = 'space_seating_types'; //

    public function space() {
        return $this->belongsTo('App\Space');
    }

    public function seating_type() {
        return $this->belongsTo('App\SeatingType');
    }

 
    public function spaceoccupation() {
        return $this->hasMany('App\SpaceOccupation');
    }

}
