<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceItems extends Model
{
    protected $table = "invoice_items";
    //

    public function invoices() {
        return $this->belongsTo('App\Invoice', 'invoice_id');
    }
}
