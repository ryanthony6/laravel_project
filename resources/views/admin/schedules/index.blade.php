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
                    @forelse ($schedules as $index => $schedule)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $schedule['court'] }}</td>
                            <td>{{ $schedule['price'] }}</td>
                            <td>
                                @foreach ($schedule['schedules'] as $time)
                                    <span class="badge bg-primary">{{ $time }}</span>
                                @endforeach
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editScheduleModal">
                                    Edit
                                </button>
                                <form action="" method="POST" class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this schedule?');">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
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

    {{-- @include('admin.schedules.create') --}}
@endsection
