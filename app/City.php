<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;
    //
    public function country(){
        return $this->belongsTo('App\Country' , 'country_id');
    }

    public function Locality(){
        return $this->hasMany('App\Area','city_id');
    }

    public function discounted_spaces(){
        return $this->hasMany('App\Space','city_id')->where('is_active','1')->whereNotNull('discount')->orderBy('discount','desc');
    }  
    
    public function spaces(){
        return $this->hasMany('App\Space','city_id')->where('is_active','1');
    }

}
