<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    public function available_cars(Request $request)
    {
        return Booking::all()->where('status', '0');
    }

    public function book_car(Request $request){
        $fields = $request->validate([
            'car_id' => 'required|integer',
            'user_id' => 'required|integer',
            'date' => 'required',
            'return_date' => 'required|string',
            'status' => 'required|integer',
        ]);

        $booking = Booking::create([
            'car_id' => $fields['car_id'],
            'user_id' => $fields['user_id'],
            'date' => $fields['date'],
            'return_date' => $fields['return_date'],
            'status' => $fields['status']
        ]);

        return $booking;
    }

    public function booked_cars(Request $request)
    {
        return Booking::all()->where('status', '1');
    }
}