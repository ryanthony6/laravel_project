@extends('layouts.admin')

@section('content')
    <main class="container px-3 py-3">

        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">

            <!-- TOMBOL TAMBAH DATA -->
            <div class="pb-3">
                <h4>Booking history</h4>
            </div>

            <!-- Table -->

            <table class="table table-striped compact cell-border dt-center dt-left" id="dataTable">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Court</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>{{ $booking->user_email }}</td>
                            <td>{{ $booking->court_id }}</td>
                            <td>{{ $booking->date }}</td>
                            <td>{{ $booking->time }}</td>
                            <td>{{ $booking->total_price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
