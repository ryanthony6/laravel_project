<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $query = Schedule::query();

        // Filter berdasarkan tanggal jika ada
        if ($request->has('tanggal')) {
            $query->whereDate('schedule', $request->tanggal);
        }

        // Mengelompokkan data berdasarkan tanggal dan lapangan
        $schedules = $query->orderBy('schedule', 'asc')->get()
            ->groupBy(function($schedule) {
                return (new \DateTime($schedule->schedule))->format('Y-m-d');
            })->map(function($dateGroup) {
                return $dateGroup->groupBy('court');
            });

        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        return view('admin.schedules.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'court' => 'required|integer|between:1,6',
            'price' => 'required|numeric',
            'schedule_date' => 'required|date',
            'hours' => 'required|array',
            'hours.*' => 'integer|between:10,22', // Memastikan jam antara 8 dan 16
        ]);

        $court = $request->input('court');
        $price = $request->input('price');
        $scheduleDate = $request->input('schedule_date');
        $hours = $request->input('hours');

        // Simpan jadwal untuk setiap jam yang dipilih
        foreach ($hours as $hour) {
            $scheduleDateTime = sprintf('%s %02d:00:00', $scheduleDate, $hour);

            $schedule = new Schedule();
            $schedule->court = $court;
            $schedule->price = $price;
            $schedule->schedule = $scheduleDateTime;
            $schedule->status = 'available'; // Atau status yang sesuai
            $schedule->save();
        }

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil disimpan!');
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
            'court' => 'required|integer|between:1,6',
            'price' => 'required|numeric',
            'schedule_date' => 'required|date',
            'hours' => 'required|array',
            'hours.*' => 'integer|between:8,16', // Memastikan jam antara 8 dan 16
        ]);

        $court = $request->input('court');
        $price = $request->input('price');
        $scheduleDate = $request->input('schedule_date');
        $hours = $request->input('hours');

        // Hapus jadwal lama
        Schedule::where('court', $court)
            ->whereDate('schedule', $scheduleDate)
            ->delete();

        // Simpan jadwal baru untuk setiap jam yang dipilih
        foreach ($hours as $hour) {
            $scheduleDateTime = sprintf('%s %02d:00:00', $scheduleDate, $hour);

            $schedule = Schedule::findOrFail($id);
            $schedule->court = $court;
            $schedule->price = $price;
            $schedule->schedule = $scheduleDateTime;
            $schedule->status = 'available'; // Atau status yang sesuai
            $schedule->save();
        }

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id); // Cari jadwal berdasarkan ID

        $schedule->delete(); // Hapus jadwal dari database

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
