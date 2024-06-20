<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class BookingTesController extends Controller
{
    public function index(Request $request)
    {
        // Define timeslots from 08:00 to 21:00
        $timeslots = [];
        for ($hour = 8; $hour <= 21; $hour++) {
            $timeslots[] = str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00';
        }

        // Define courts from 1 to 6
        $courts = range(1, 6);

        // Generate dates for the next 7 days
        $dates = [];
        for ($i = 0; $i < 7; $i++) {
            $timestamp = strtotime("+$i day");
            $dates[date('Y-m-d', $timestamp)] = date('D, d M', $timestamp);
        }

        // Determine the selected date
        $today = date('Y-m-d');
        $selectedDate = $request->query('date', $today);

        // Generate full date display
        $fullDate = date('l, d F Y', strtotime($selectedDate));

        // Check if the selected date is today
        $isToday = ($selectedDate == $today);

        // Return view with compacted variables
        return view('bookingtes', compact('timeslots', 'courts', 'dates', 'selectedDate', 'fullDate', 'isToday'));
    }
}
