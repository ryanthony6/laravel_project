<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class HistoryController extends Controller
{
    public function index()
    {
        $bookings = Booking::all(); // Ambil semua data booking
        return view('admin.history.index', compact('bookings'));
    }
}
