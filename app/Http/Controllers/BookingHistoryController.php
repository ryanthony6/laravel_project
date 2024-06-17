<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingHistoryController extends Controller
{
    public function index()
    {
        return view('bookingHistory');
    }
}
