<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $query = Schedule::query();

        $tanggal = $request->has('tanggal') ? $request->tanggal : Carbon::today()->toDateString();

        $query->whereDate('schedule', $tanggal);

        $schedules = $query->orderBy('court', 'asc')
            ->get()
            ->groupBy(function ($schedule) {
                return (new \DateTime($schedule->schedule))->format('Y-m-d');
            })
            ->map(function ($dateGroup) {
                return $dateGroup->groupBy('court')->map(function ($courtGroup) {
                    return $courtGroup->sortBy('schedule');
                });
            });

        // dd($schedules);

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
            'hours.*' => 'integer|between:10,21',
        ]);

        $court = $request->input('court');
        $price = $request->input('price');
        $scheduleDate = $request->input('schedule_date');
        $hours = $request->input('hours');

        // Memeriksa apakah jadwal untuk lapangan dan tanggal yang sama sudah ada
        $existingSchedule = Schedule::where('court', $court)
            ->whereDate('schedule', $scheduleDate)
            ->exists();

        if ($existingSchedule) {
            return redirect()->route('schedules.index')->with('error', 'Jadwal untuk lapangan nomor ' . $court . ' pada tanggal ' . $scheduleDate . ' sudah ada.');
        }

        // Simpan jadwal untuk setiap jam yang dipilih
        foreach ($hours as $hour) {
            $scheduleDateTime = sprintf('%s %02d:00:00', $scheduleDate, $hour);

            $schedule = new Schedule();
            $schedule->court = $court;
            $schedule->price = $price;
            $schedule->schedule_date = $scheduleDate;
            $schedule->schedule = $scheduleDateTime;
            $schedule->status = 'available'; // Atau status yang sesuai
            $schedule->save();
        }

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil disimpan!');
    }


    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
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
        'hours.*' => 'integer|between:10,21', // Memastikan jam antara 10 dan 21
    ]);

    $court = $request->input('court');
    $price = $request->input('price');
    $scheduleDate = $request->input('schedule_date');
    $hours = $request->input('hours');

    try {
        // Temukan jadwal berdasarkan ID
        $schedule = Schedule::findOrFail($id);

        
        // Hapus jadwal lama
        Schedule::where('court', $schedule->court)
                ->where('schedule_date', $schedule->schedule_date)
                ->delete();

        // Simpan jadwal baru untuk setiap jam yang dipilih
        foreach ($hours as $hour) {
            $scheduleDateTime = sprintf('%s %02d:00:00', $scheduleDate, $hour);

            $newSchedule = new Schedule();
            $newSchedule->court = $court;
            $newSchedule->price = $price;
            $newSchedule->schedule_date = $scheduleDate;
            $newSchedule->schedule = $scheduleDateTime;
            $newSchedule->status = 'available'; // Atau status yang sesuai
            $newSchedule->save();
        }

      
        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil diperbarui.');

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        
        return redirect()->back()->with('error', 'Jadwal tidak ditemukan.');
    } catch (\Exception $e) {
       
        return redirect()->back()->with('error', 'Gagal memperbarui jadwal: ' . $e->getMessage());
    }
}




    public function destroy(Request $request)
    {
        // Validasi input
        $request->validate([
            'court' => 'required|integer|between:1,6',
            'schedule_date' => 'required|date',
        ]);

        $court = $request->input('court');
        $scheduleDate = $request->input('schedule_date');

        // Hapus semua jadwal yang sesuai dengan lapangan dan tanggal tertentu
        Schedule::where('court', $court)
            ->whereDate('schedule', $scheduleDate)
            ->delete();

        return redirect()->route('schedules.index')->with('success', 'Semua jadwal untuk lapangan nomor ' . $court . ' pada tanggal ' . $scheduleDate . ' berhasil dihapus.');
    }
}
