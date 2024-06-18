<?php

namespace App\Http\Controllers;

class BookingController extends Controller
{
    public function index()
    {
        // Data dummy untuk booking
        $bookings = [
            [
                'id' => 1,
                'name' => 'John Doe',
                'court' => 'Court 1',
                'date' => '2024-06-01',
                'time' => '10:00 AM',
                'created_at' => '2024-06-01 08:00:00'
            ],
            [
                'id' => 2,
                'name' => 'Jane Smith',
                'court' => 'Court 2',
                'date' => '2024-06-02',
                'time' => '11:00 AM',
                'created_at' => '2024-06-01 09:00:00'
            ],
            [
                'id' => 3,
                'name' => 'Michael Johnson',
                'court' => 'Court 3',
                'date' => '2024-06-03',
                'time' => '12:00 PM',
                'created_at' => '2024-06-01 10:00:00'
            ],
            [
                'id' => 4,
                'name' => 'Emily Davis',
                'court' => 'Court 4',
                'date' => '2024-06-04',
                'time' => '01:00 PM',
                'created_at' => '2024-06-01 11:00:00'
            ],
            [
                'id' => 5,
                'name' => 'Chris Brown',
                'court' => 'Court 5',
                'date' => '2024-06-05',
                'time' => '02:00 PM',
                'created_at' => '2024-06-01 12:00:00'
            ]
        ];

        return view('bookings.index', compact('bookings'));
    }
}
