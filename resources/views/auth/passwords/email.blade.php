@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 95vh;">
    <div class="row justify-content-center w-100">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow">

                <div class="text-center py-4" style="margin-bottom: -50px;">
                    <h3 class="mb-2" style="font-size: 1.8rem; color: #333; font-weight: 100;">Reset Password</h3>
                </div>

                <div class="card-body p-5">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Send Password Reset Link') }}
                            </button>
                            @if (Route::has('login'))
                                <a class="btn btn-outline-primary btn-block" href="{{ route('login') }}">
                                    {{ __('Back to Login') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .container {
        background-color: #f8f9fa;
    }
    .card {
        border-radius: 15px;
        border: none;
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    .card-header {
        font-weight: bold;
        border-bottom: none;
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
        transition: background-color 0.3s;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .invalid-feedback {
        display: block;
    }
</style>
