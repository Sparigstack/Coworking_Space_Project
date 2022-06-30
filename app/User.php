<?php

namespace App;

//use Illuminate\Notifications\Notifiable;
//use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;

class User extends Model implements Authenticatable {

    use Billable;
    use AuthenticableTrait;

//
//    /**
//     * The attributes that are mass assignable.
//     *
//     * @var array
//     */
//    protected $fillable = [
//        'name', 'email', 'password',
//    ];
//
//    /**
//     * The attributes that should be hidden for arrays.
//     *
//     * @var array
//     */
//    protected $hidden = [
//        'password', 'remember_token',
//    ];

    protected $softDelete = true;
    protected $fillable = ['name', 'email', 'password'];

    public function spaces() {
        return $this->hasMany('App\Space');
    }

    public function passport_user(){
        return $this->hasOne('App\PassportUsers', 'user_id');
    }

    public function getFullNameAttribute($value)
    {
        return  $this->first_name . " " . $this->last_name;
    }

}
