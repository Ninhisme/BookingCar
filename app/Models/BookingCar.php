<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingCar extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function carCategory()
    {
        return $this->belongsTo('App\Models\CarCategory', 'car_category_id','id');
    }
    
}