<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpaceSeatingType2 extends Model
{
    protected $table = 'space_seating_types_2'; //
    protected  $fillable = ['price_weekly', 'price_daily'];
    
    public function space() {
        return $this->belongsTo('App\Space');
    }

    public function seating_type() {
        return $this->belongsTo('App\SeatingType');
    }

    public function space_disount() {
        // return $this->hasMany('App\SpaceDiscount');
       return $this->hasMany(SpaceDiscount::class, 'space_seating_type_id');
    }
    public function spaceoccupation() {
        return $this->hasMany('App\SpaceOccupation');
    }
}
