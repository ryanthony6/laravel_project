<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $today = date('Y-m-d');
        $selectedDate = $request->query('date', $today);

        // Ambil data dari tabel schedules berdasarkan tanggal yang dipilih
        $schedules = Schedule::whereDate('schedule', $selectedDate)->get();

        // Buat array waktu tetap dari 09:00 hingga 21:00
        $fixedTimeslots = [
            '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00'
        ];

        // Daftar semua lapangan yang mungkin ada
        $allPossibleCourts = ['Court 1', 'Court 2', 'Court 3', 'Court 4', 'Court 5', 'Court 6'];

        // Inisialisasi array timeslots
        $timeslots = [];
        foreach ($fixedTimeslots as $time) {
            $timeslots[$time] = [];
            foreach ($allPossibleCourts as $court) {
                $timeslots[$time][$court] = [
                    'court' => $court,
                    'price' => null,
                    'available' => false
                ];
            }
        }

        // Isi timeslots dengan data dari schedules
        foreach ($schedules as $schedule) {
            $scheduleTime = date('H:i', strtotime($schedule->schedule));
            if (in_array($scheduleTime, $fixedTimeslots)) {
                $timeslots[$scheduleTime]['Court ' . $schedule->court] = [
                    'court' => 'Court ' . $schedule->court,
                    'price' => $schedule->price,
                    'available' => $schedule->status === 'available'
                ];
            }
        }

        // Generate full date display
        $fullDate = date('l, d F Y', strtotime($selectedDate));

        // Check if the selected date is today
        $isToday = ($selectedDate == $today);

        // Ambil semua tanggal yang tersedia dari database
        $allDates = Schedule::selectRaw('DATE(schedule) as date')->distinct()->pluck('date')->toArray();
        $dates = [];
        foreach ($allDates as $date) {
            $dates[$date] = date('D, d M', strtotime($date));
        }

        // Urutkan tanggal
        ksort($dates);

        // Return view with compacted variables
        return view('booking', compact('timeslots', 'dates', 'selectedDate', 'fullDate', 'isToday', 'allPossibleCourts'));
    }
}
