<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'time_slots' => 'required|string',
            'price' => 'required|integer',
        ]);

        $booking = new Booking();
        $booking->user_name = Auth::user()->name;
        $booking->date = $request->date;
        $booking->time_slots = $request->time_slots;
        $booking->price = $request->price;
        $booking->save();

        return redirect()->back()->with('success', 'Booking successful!');
    }
}
