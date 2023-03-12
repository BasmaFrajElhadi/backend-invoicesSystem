<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoices extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'invoice_number',
        'invoice_Date',
        'due_Date',
        'product',
        'section_id',
        'Amount_collection',
        'Amount_Commission',
        'discount',
        'rate_vat',
        'value_vat',
        'total',
        'status',
        'value_status',
        'note',
        'Payment_Date',
    ];

    public function section(){
        return $this->belongsTo('App\Models\section');
    }
    public function invoices_details(){
        return $this->hasMany('App\Models\invoices_details');
    }
}
