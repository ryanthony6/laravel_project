<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Schedule;

date_default_timezone_set('Asia/Jakarta');

class BookingController extends Controller
{

    public function store(Request $request)
    {
        $booking = new Booking();
        $booking->user_name = $request->user_name;
        $booking->court_id = $request->court_id;
        $booking->date = $request->date;
        $booking->time = $request->time;
        $booking->total_price = $request->total_price;
        $booking->save();

        \Log::info('Booking saved successfully', ['booking' => $booking]);

        return response()->json(['success' => true, 'message' => 'Booking successful']);
    }

    public function index(Request $request)
    {
        $today = date('Y-m-d');
        $selectedDate = $request->query('date', $today);

        // Ambil data booking dari database
        $bookings = Booking::where('date', $selectedDate)->get();

        // Ambil data lain yang diperlukan seperti $dates, $timeslots, dll.
        $schedules = Schedule::where('date', $selectedDate)->get();

        // Buat array waktu tetap dari 09:00 hingga 21:00
        $fixedTimeslots = [
            '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00'
        ];

        // Daftar semua lapangan yang mungkin ada
        $allPossibleCourts = ['Court 1', 'Court 2', 'Court 3', 'Court 4', 'Court 5', 'Court 6'];

        // Ambil timeslots, courts, price, dan dates dari schedules
        $timeslots = [];
        foreach ($fixedTimeslots as $time) {
            $timeslots[$time] = [];
            foreach ($allPossibleCourts as $court) {
                $timeslots[$time][$court] = [
                    'court' => $court,
                    'available' => false
                ];
            }
        }

        foreach ($schedules as $schedule) {
            $scheduleTimeslots = json_decode($schedule->schedule); // Asumsikan schedule disimpan dalam format JSON
            foreach ($scheduleTimeslots as $time) {
                if (in_array($time, $fixedTimeslots)) {
                    $timeslots[$time]['Court ' . $schedule->court] = [
                        'court' => 'Court ' . $schedule->court,
                        'price' => $schedule->price,
                        'available' => true
                    ];
                }
            }
        }

        // Generate full date display
        $fullDate = date('l, d F Y', strtotime($selectedDate));

        // Check if the selected date is today
        $isToday = ($selectedDate == $today);

        // Ambil semua tanggal yang tersedia dari database
        $allDates = Schedule::select('date')->distinct()->pluck('date')->toArray();
        $dates = [];
        foreach ($allDates as $date) {
            $dates[$date] = date('D, d M', strtotime($date));
        }

        // Urutkan tanggal
        ksort($dates);

        // Return view with compacted variables
        return view('booking', compact('timeslots', 'dates', 'selectedDate', 'fullDate', 'isToday', 'allPossibleCourts', 'bookings'));
    }
}
