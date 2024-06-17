@extends('layouts.mainlayout')

@section('content')

<div class="container-centered">
    <div class="col-md-6 col-lg-4">
        <div class="profile-card-background">
            <div class="card profile-card">
                <h1 class="edit-profile-title">Edit Profile</h1>
                <div class="profile-container">
                    <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('images/ProfilePic.png') }}" alt="{{ Auth::user()->image ? 'User Image' : 'Default Image' }}" class="profile-img">
                    <h3 class="mt-2">{{ Auth::user()->name }}</h3>
                </div>
                
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="email" style="font-size: 1.1em">Email</label>
                        <input type="text" class="form-control" id="email" value="{{ Auth::user()->email }}" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="name" style="font-size: 1.1em">Name</label>
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
                        <label for="image" class="form-label" style="font-size: 1.1em">Change image</label>
                        <input class="form-control" type="file" id="image" name="image">
                        @error('image')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="button-center">
                        <button type="submit" class="btn btn-success btn-block justify-content-center align-items-center">Save Changes</button>
                        <a href={{ route('home') }} type="button" class="btn btn-primary btn-block justify-content-center align-items-center">Back to home</a>
                        <button type="button" class="btn btn-danger btn-block justify-content-center align-items-center" data-toggle="modal" data-target="#deleteAccountModal">
                            Delete Account
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" role="dialog" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAccountModalLabel">Delete Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete your account? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form action="{{ route('profile.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Account</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
