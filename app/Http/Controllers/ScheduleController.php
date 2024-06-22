<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = [
            [
                'court' => 'Lapangan 1',
                'price' => 'Rp. 100.000',
                'schedules' => ['08.00', '09.00', '10.00']
            ],
            // Tambahkan data lainnya di sini
        ];
    
        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        return view('admin.schedules.create');
    }



    public function update(Request $request, $court)
    {
        // Logic to update the schedule for the specified court
        // Validate the request
        $request->validate([
            'price' => 'required|string',
            'schedules' => 'required|array'
        ]);

        // Find and update the schedule data in your data source (e.g., database)
        // Here, you will need to implement your logic to update the data

        // Redirect back with success message
        return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully!');
    }
}
