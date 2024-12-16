<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MidtransPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'amount',
        'first_name',
        'last_name',
        'email',
        'phone',
        'notes',
        'type',

    ];



}
