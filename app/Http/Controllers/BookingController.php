<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Schedule;
use App\Models\Booking;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

date_default_timezone_set('Asia/Jakarta');

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $startDate = Carbon::now();
        $endDate = Carbon::now()->addDays(6);
        $period = CarbonPeriod::create($startDate, $endDate);

        $dates = [];
        foreach ($period as $date) {
            $key = $date->format('Y-m-d');
            $value = $date->format('D, d M');
            $dates[$key] = $value;
        }

        $selectedDate = $request->input('date', $startDate->format('Y-m-d'));
        $fullDate = Carbon::parse($selectedDate)->format('l, d F Y');

        // Ambil data dari tabel schedules berdasarkan tanggal yang dipilih
        $schedules = Schedule::whereDate('schedule_date', $selectedDate)->get();

        // Buat array waktu tetap dari 10:00 hingga 21:00
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
                    'status' => 'not_available'
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
                    'status' => $schedule->status,
                    'user_id' => $schedule->user_id // Add user_id to the court data
                ];
            }
        }

        // Check if the selected date is today
        $isToday = ($selectedDate == date('Y-m-d'));

        // Return view with compacted variables
        return view('booking', compact('timeslots', 'dates', 'selectedDate', 'fullDate', 'isToday', 'allPossibleCourts'));
    }

    public function showPaymentPage(Request $request)
    {
        $bookingDetails = $request->input('booking_details');
        return view('payments/checkout', compact('bookingDetails'));
    }

    public function processCheckout(Request $request)
    {
        $bookingDetails = json_decode($request->input('booking_details'), true);
        
        // Simpan booking details sementara di session
        session(['booking_details' => $bookingDetails]);

        // Redirect ke halaman checkout
        return redirect()->route('payments.index');
    }

    public function checkout()
    {
        $bookingDetails = session('booking_details');

        // Validasi booking details jika perlu
        if (!$bookingDetails) {
            return redirect()->route('booking.index')->with('error', 'No booking details found.');
        }

        return view('payments/checkout', compact('bookingDetails'));
    }

    public function processPayment(Request $request)
    {
        $bookingDetails = session('booking_details');
        $userId = Auth::id(); // Ambil ID pengguna yang sedang login
        $totalPrice = 0;

        foreach ($bookingDetails as $courtId => $details) {
            foreach ($details['times'] as $timeRange) {
                $timeParts = explode(' - ', $timeRange);
                $startTime = $timeParts[0];
                $scheduleDate = date('Y-m-d', strtotime($details['date']));
                $scheduleDateTime = $scheduleDate . ' ' . $startTime;

                $schedule = Schedule::where('court', str_replace('Court ', '', $courtId))
                                    ->where('schedule', $scheduleDateTime)
                                    ->first();

                if ($schedule) {
                    $schedule->status = 'booked';
                    $schedule->user_id = $userId; // Set user_id
                    $schedule->save();

                    // Simpan data booking ke dalam database bookings
                    Booking::create([
                        'user_name' => Auth::user()->name,
                        'court_id' => $schedule->court,
                        'date' => $scheduleDate,
                        'time' => $startTime,
                        'total_price' => $schedule->price
                    ]);

                    $totalPrice += $schedule->price;
                }
            }
        }

        // Hapus booking details dari session setelah pembayaran berhasil
        session()->forget('booking_details');

        return redirect()->route('home.index');
    }
}