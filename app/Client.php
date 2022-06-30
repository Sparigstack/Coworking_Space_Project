<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
   protected $fillable = ['username', 'email', 'password']; //
   
   public function spaces(){
       return $this->hasMany('App\Space');
   }
}
