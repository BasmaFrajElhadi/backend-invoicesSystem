<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoices_details extends Model
{
    use HasFactory;
    protected $fillable = [
            'id_invoice',
            'invoice_number',
            'product',
            'Section',
            'status',
            'value_Status',
            'note',
            'user',
    ];

    public function invoice(){
        return $this->belongsTo('App\Models\invoices');
    }

}
