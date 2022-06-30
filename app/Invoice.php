<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model {
    protected $table = "invoices"; //
    protected $fillable = ['pdf_url'];  

    public function space(){
        return $this->belongsTo('App\Space', 'space_id');
    }
    public function inquiry(){
        return $this->belongsTo('App\Inquiry', 'inquiry_id');
    }
    
    public function spaceoccupation() {
        return $this->belongsTo('App\SpaceOccupation', 'space_occupation_id');
    }

    public function invoiceitems(){
        return $this->hasMany('App\InvoiceItems','invoice_id');
    }
}
