<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    protected $table="areas";
    use SoftDeletes;
    //
    public function city(){
        return $this->belongsTo('App\City');
    }
}
