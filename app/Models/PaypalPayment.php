<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaypalPayment extends Model
{
    use HasFactory;
    protected $table = 'paypal_payments';
    protected $fillable = [
        'paypal_order_id',
        'paypal_payer_email',
        'amount',
        'notes',
    ];
}
