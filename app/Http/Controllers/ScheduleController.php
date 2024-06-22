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

    public function create()
    {
        return view('admin.schedules.create');
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

    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id); // Cari jadwal berdasarkan ID, atau beri response error jika tidak ditemukan
        return view('admin.schedules.edit', compact('schedule'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'court' => 'required|integer|min:1|max:6',
            'price' => 'required|numeric',
            'date' => 'required|date_format:Y-m-d',
            'schedule' => 'required|array', // Sesuaikan dengan struktur data schedule yang digunakan
        ]);

        // Cari jadwal berdasarkan ID
        $schedule = Schedule::findOrFail($id);

        // Memeriksa apakah jadwal untuk lapangan dan tanggal yang sama sudah ada, kecuali untuk jadwal yang sedang diedit
        $existingSchedule = Schedule::where('court', $request->court)
            ->where('date', $request->date)
            ->where('id', '!=', $id) // Exclude jadwal yang sedang diedit
            ->exists();

        // Jika jadwal sudah ada, kembalikan response error
        if ($existingSchedule) {
            return back()->with('error', 'Jadwal untuk lapangan nomor ' . $request->court . ' pada tanggal ' . $request->date . ' sudah ada.');
        }

        // Update data jadwal
        $schedule->court = $request->court;
        $schedule->price = $request->price;
        $schedule->date = $request->date;
        $schedule->schedule = json_encode($request->schedule); // Sesuaikan dengan struktur data schedule yang digunakan
        $schedule->save();

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id); // Cari jadwal berdasarkan ID

        $schedule->delete(); // Hapus jadwal dari database

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
