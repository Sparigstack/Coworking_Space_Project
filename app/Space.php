<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Space extends Model {

    use SoftDeletes;

    protected $table = "spaces"; //

    protected $fillable = ['discount'];
    
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function city() {
        return $this->belongsTo('App\City');
    }
    public function area() {
        return $this->belongsTo('App\Area');
    }

    public function space_working_hours() {
        return $this->hasMany('App\SpaceWorkingHour');
    }

    public function space_images() {
        return $this->hasMany('App\SpaceImage')->orderByDesc('isFeatured');
    }

    public function featured_image() {
        return $this->space_images()->where('isFeatured', 1)->first();
    }

    public function space_meeting_rooms() {
        return $this->hasMany('App\SpaceMeetingRoom');
    }

    public function amenities() {
        return $this->belongsToMany('App\Amenity', 'space_amenities');
    }

    public function passport_configs() {
        return $this->hasMany('App\SpacePassportConfig');
    }

//    public function seating_types() {
//        return $this->belongsToMany('App\SeatingType');
//    }

    public function space_seating_types() {
        return $this->hasMany('App\SpaceSeatingType', 'space_id');
    }

   

   
    public function space_payment_methods() {
        return $this->belongsToMany('App\PaymentMethod', 'space_payment_methods');
    }

    public function space_reviews() {
        return $this->hasMany('App\SpaceReview');
    }

    public function space_payments() {
        return $this->hasMany('App\SpacePayment');
    }

    public function latest_payment() {
        return $this->hasOne('App\SpacePayment')->latest();
    }

    public function userpassportusage() {
        return $this->hasMany('App\UserPassportUsage', 'space_id');
    }

    public function passportusers() {
        return $this->hasMany('App\PassportUsers', 'passport_id');
    }

    public function inquiries() {
        return $this->hasMany('App\Inquiry', 'space_id');
    }
    
    public function invoices() {
        return $this->hasMany('App\Invoice');
    }

    public function spaceplan(){
        return $this->belongsTo('App\SpacePlan','plan_id');
    }

    public function space_occupation() {
        return $this->hasMany('App\SpaceOccupation', 'space_id');
    }

  
 public function inventoryItems() {
        return $this->hasMany('App\SpaceInventoryItem');
    }    
}
