
@extends('layouts.admin')

@section('content')

    <main class="container px-3 py-3">

        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <!-- FORM PENCARIAN -->
            <div class="pb-3">
                <form class="d-flex" action="{{ url('admin/reviews') }}" method="get">
                    <input id="katakunci" class="form-control me-1" type="search" name="katakunci"
                        value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search"
                    placeholder="Masukkan kata kunci" aria-label="Search">
                    <button class="btn btn-secondary" type="submit">Cari</button>
                </form>
            </div>

            <!-- TOMBOL TAMBAH DATA -->
            <div class="pb-3">
                <h4>Booking history</h4>
            </div>

            <!-- Table -->
            
            <table class="table table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th class="col-md-1">Name</th>
                        <th class="col-md-1">Court</th>
                        <th class="col-md-2">Date</th>
                        <th class="col-md-2">Time</th>
                        <th class="col-md-2">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($bookings->isEmpty())
                        <tr>
                            <td colspan="5">Tidak ada data yang tersedia.</td>
                        </tr>
                    @else
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->user_name }}</td>
                                <td>{{ $booking->court_id }}</td>
                                <td>{{ $booking->date }}</td>
                                <td>{{ $booking->time }}</td>
                                <td>{{ $booking->total_price }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </main>
@endsection
