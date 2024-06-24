@extends('layouts.admin')

@section('content')
    <main class="container px-3">

        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            @if (session('error'))
                <div id="errorAlert" class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div id="successAlert" class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- FORM PENCARIAN -->
            <div class="pb-3">
                <h4>Schedule to Display</h4>
            </div>

            <div class="pb-3">
                <label for="tanggal">Pilih tanggal:</label>
                <form action="{{ route('schedules.index') }}" method="GET">
                    <input type="date" id="tanggal" name="tanggal" value="{{ request('tanggal') }}"
                        min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+1 week')) }}">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>

            <!-- TOMBOL TAMBAH DATA -->
            <div class="pb-3">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createScheduleModal">
                    + Tambah Data
                </button>
            </div>

            <!-- Table -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Court</th>
                        <th>Price</th>
                        <th>Schedules</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $counter = 1;
                    @endphp
                    @forelse ($schedules as $date => $courts)
                        @foreach ($courts as $court => $scheduleGroup)
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $court }}</td>
                                <td>{{ $scheduleGroup->first()->price }}</td>
                                <td>
                                    @foreach ($scheduleGroup as $schedule)
                                        @php
                                            $dateTime = new DateTime($schedule->schedule);
                                            $time = $dateTime->format('H:i');
                                        @endphp
                                        <span class="badge bg-primary">{{ $time }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <!-- Aksi untuk setiap kelompok jadwal -->
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editScheduleModal{{ $schedule->id }}">
                                        Edit
                                    </button>
                                    <form action="{{ route('schedules.delete') }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this schedule?');">
                                        @method('DELETE')
                                        @csrf
                                        <input type="hidden" name="court" value="{{ $court }}">
                                        <input type="hidden" name="schedule_date" value="{{ $date }}">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="5">Tidak ada data yang tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- AKHIR DATA -->
    </main>


    @include('admin.schedules.create')
    @include('admin.schedules.edit')
@endsection
