<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BookingCar;
use Illuminate\Http\Request;

class BookingCarController extends Controller
{
    public function BookingCarList()
    {
        $bookingCar = BookingCar::latest()->get();
        return view('backend.booking_car.booking_car_list', compact('bookingCar'));
    }
}