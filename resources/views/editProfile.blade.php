@extends('layouts.app')

<style>
    .profile-img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 20px;
        border: 2px solid black;
        transition: opacity 0.3s;
        position: relative;
    }

    .profile-container label {
        position: relative;
        display: inline-block;
    }

    .profile-container label:hover .change-image-text {
        opacity: 1;
    }

    .profile-card {
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: black;
    }

    .profile-container {
        text-align: center;
        margin-bottom: 40px;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .container-centered {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f8f9fa;
        padding: 10px;
    }

    .file-input {
        display: none;
    }

    .button-center {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }

    .edit-profile-title {
        text-align: center;
        font-weight: bold;
        font-size: 2em;
        margin-bottom: 20px;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        padding-bottom: 10px;
        border-bottom: 2px solid black;
    }

    .profile-card-background {
        background-color: #DCDCDC;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .edit-icon {
        position: absolute;
        right: 10px; /* Jarak dari kanan */
        top: 50%; /* Posisi di tengah vertikal */
        transform: translateY(-50%);
        cursor: pointer;
        color: #007bff; /* Warna ikon edit */
        background-color: transparent; /* Atur background menjadi transparan */
        border: none; /* Hapus border jika ada */
    }

    .edit-icon:hover {
        color: #0056b3; /* Warna saat ikon edit dihover */
    }

</style>

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
                        <button type="button" class="btn btn-primary btn-block justify-content-center align-items-center">Back to home</button>
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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function enableEdit(inputId) {
        var inputElement = document.getElementById(inputId);
        inputElement.readOnly = false;
        inputElement.focus();
    }
</script>
@endsection