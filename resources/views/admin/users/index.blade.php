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
        
            <div class="pb-3">
                <h4>Manage User</h4>
            </div>

            <!-- TOMBOL TAMBAH DATA -->
            <div class="pb-3">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">
                    + Tambah Data
                </button>
            </div>

            <!-- Table -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="col-md-1">No.</th>
                        <th class="col-md-2">Name</th>
                        <th class="col-md-2">Email</th>
                        <th class="col-md-2">Role</th>
                        <th class="col-md-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($users->isEmpty())
                        <tr>
                            <td colspan="4">Tidak ada data yang tersedia.</td>
                        </tr>
                    @else
                        <?php $i = $users->firstItem(); ?>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#edituserModal{{ $user->id }}">
                                        Edit
                                    </button>
                                    <form  action='{{ route('users.delete', $user->id) }}' method="POST" class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this user?');">
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

    @include('admin.users.create')
    @include('admin.users.edit')
   
@endsection