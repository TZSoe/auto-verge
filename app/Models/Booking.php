<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'customer_id', 'car_number', 'duration', 'notes', 'is_taken_back'];

    protected $attributes = [
        'is_taken_back' => 0,
    ];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function services()
    {
        return $this->belongsToMany('App\Models\Service');
    }
}
