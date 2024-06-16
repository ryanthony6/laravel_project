<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        // Fetch existing schedule data (example)
        $fields = [
            ['id' => 1, 'name' => 'Field 1', 'available' => true],
            ['id' => 2, 'name' => 'Field 2', 'available' => false],
            // Add more fields as needed
        ];

        return view('admin.schedule-management', compact('fields'));
    }

    public function update(Request $request)
    {
        // Handle form submission to update schedule availability
        foreach ($request->fields as $fieldId => $available) {
            // Update availability in database or wherever you store the data
            // Example:
            // Field::where('id', $fieldId)->update(['available' => $available]);
        }

        return redirect()->route('admin.schedules')->with('success', 'Schedule availability updated successfully');
    }
}
