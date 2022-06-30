<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpaceOccupation extends Model
{
    use SoftDeletes;
    protected $table="space_occupation";
    protected $guarded = [];
    public function spaceseatingtypes() {
        return $this->belongsTo('App\SpaceSeatingType', 'space_seating_type_id');
    }
    public function inquiries() {
        return $this->belongsTo('App\Inquiry', 'inquire_id');
    }

    // public function invoices(){
    //     return $this->morphMany('App\Invoice', 'inquire_id');
    // }

    public function passport_user() {
        return $this->hasOne('App\PassportUsers', 'user_id','inquire_id');
    }
}
