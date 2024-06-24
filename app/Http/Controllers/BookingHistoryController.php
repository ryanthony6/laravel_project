<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Schedule;

class BookingHistoryController extends Controller
{
    public function showBookingHistory()
    {
        $userId = Auth::id();
        $bookings = Schedule::where('user_id', $userId)->get();

        return view('booking-history', [
            'bookings' => $bookings
        ]);
    }

    public function cancelBooking($id)
    {
        $schedule = Schedule::find($id);

        if ($schedule && $schedule->user_id == Auth::id()) {
            $schedule->status = 'available';
            $schedule->user_id = null;
            $schedule->save();

            return response()->json(['success' => true, 'message' => 'Booking cancelled successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Failed to cancel booking.']);
    }
}
