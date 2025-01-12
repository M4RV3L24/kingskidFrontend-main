<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nominal',
        'description',
        'start_date',
        'end_date',
    ];

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
