<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->input('tanggal', date('Y-m-d'));
        $schedules = Schedule::where('date', $tanggal)
                            ->orderBy('court', 'asc')
                            ->paginate(10);

        return view('admin.schedules.index', compact('schedules', 'tanggal'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'court' => 'required|integer|min:1|max:6',
            'price' => 'required|numeric',
            'date' => 'required|date_format:Y-m-d',
            'schedule' => 'required|array', // Sesuaikan dengan struktur data schedule yang digunakan
        ]);

        // Memeriksa apakah jadwal untuk lapangan dan tanggal yang sama sudah ada
        $existingSchedule = Schedule::where('court', $request->court)
            ->where('date', $request->date)
            ->exists();

        // Jika jadwal sudah ada, kembalikan response error
        if ($existingSchedule) {
            return back()->with('error', 'Jadwal untuk lapangan nomor ' . $request->court . ' pada tanggal ' . $request->date . ' sudah ada.');
        }

        // Simpan data baru
        $schedule = new Schedule();
        $schedule->court = $request->court;
        $schedule->price = $request->price;
        $schedule->date = $request->date;
        $schedule->schedule = json_encode($request->schedule); // Sesuaikan dengan struktur data schedule yang digunakan
        $schedule->save();

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil disimpan.');
    }


    // Redirect to the reviews index page


    public function create()
    {
        return view('admin.schedules.create');
    }

    public function update(Request $request, $court)
    {
        // Logic to update the schedule for the specified court
        // Validate the request
        $request->validate([
            'court' => 'required|number',
            'price' => 'required|string',
            'schedules' => 'required'
        ]);

        // Find and update the schedule data in your data source (e.g., database)
        // Here, you will need to implement your logic to update the data

        // Redirect back with success message
        return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully!');
    }
}
