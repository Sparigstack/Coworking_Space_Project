<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emails extends Model
{
    public function space()
    {
        return $this->belongsTo('App\Space');
    }

    public function emailRecipients()
    {
        return $this->hasMany('App\EmailRecipients' , 'email_id');
    }

}
