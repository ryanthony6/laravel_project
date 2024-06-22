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
                    <input type="date" id="tanggal" name="tanggal" value="{{ request('tanggal') }}" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+1 week')) }}">
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
                        <th class="col-md-1">No.</th>
                        <th class="col-md-2">Court</th>
                        <th class="col-md-2">Price</th>
                        <th class="col-md-2">Schedules</th>
                        <th class="col-md-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($schedules->isEmpty())
                        <tr>
                            <td colspan="5">Tidak ada data yang tersedia.</td>
                        </tr>
                    @else
                        <?php $i = $schedules->firstItem(); ?>
                        @foreach ($schedules as $schedule)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $schedule->court }}</td>
                                <td>{{ $schedule->price }}</td>
                                <td>
                                    @php
                                        $scheduleArray = json_decode($schedule->schedule);
                                    @endphp
                                    @if (is_array($scheduleArray))
                                        @foreach ($scheduleArray as $item)
                                            <span class="badge bg-primary">{{ $item }}</span>
                                        @endforeach
                                    @else
                                        <span class="badge bg-primary">{{ $schedule->schedule }}</span>
                                    @endif
                                </td>

                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editScheduleModal{{ $schedule->id }}">
                                        Edit
                                    </button>
                                    <form action='{{ route('schedules.delete', $schedule->id) }}' method="POST" class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this review?');">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <!-- AKHIR DATA -->
    </main>

    @include('admin.schedules.create')
    @include('admin.schedules.edit')
@endsection
