@extends('layouts.profile')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 d-flex flex-column align-items-center">
                <div class="card profile-card flex-fill text-center shadow-sm p-3 mb-4">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('images/ProfilePic.png') }}" alt="User Image" class="img-fluid rounded-circle mb-2 profile-image">
                        <h4 class="card-title">{{ Auth::user()->name }}</h4>
                        <p class="card-text">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex flex-column align-items-center">
                <div class="card edit-profile-card flex-fill shadow-sm p-3 mb-4">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Edit Profile</h3>
                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" readonly>
                                <div class="input-group-append">
                                    <span id="editName" class="input-group-text edit-icon" onclick="enableEdit('name')">
                                        <i class="fa fa-edit"></i>
                                    </span>
                                </div>
                            </div>
                            <input type="hidden" id="currentName" name="current_name" value="{{ Auth::user()->name }}">
                                @error('name')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>  
                            
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="image" class="form-label">Change image</label>
                                <input class="form-control" type="file" id="image" name="image">
                                @error('image')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                <button type="submit" class="btn btn-primary mr-2">Update</button>
                                <a href="{{ route('home.index') }}" class="btn btn-secondary mr-2">Back to home</a>
                                <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete Account</button>
                            </div>
                        </form>
                        <form id="deleteAccountForm" action="{{ route('profile.destroy') }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete() {
        Swal.fire({
            title: 'Are you sure?',
            text: 'Are you sure you want to delete your account? This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, keep it'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteAccountForm').submit();
            }
        });
    }
</script>

@endsection
