@extends('layouts.auth')

@section('content')
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-9">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">

                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form method="POST" action="{{ route('register') }}">

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Register your
                                            account</h5>

                                        @csrf


                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" id="name"
                                                class="form-control form-control-lg @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name') }}" autofocus />
                                            <label for="name" class="form-label">Name</label>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        <div data-mdb-input-init class="form-outline">
                                            <input type="email" id="email"
                                                class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" />
                                            <label for="email" class="form-label">Email address</label>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        <div data-mdb-input-init class="form-outline">
                                            <input type="password" id="password"
                                                class="form-control form-control-lg @error('password') is-invalid @enderror"
                                                name="password"  />
                                            <label class="form-label" for="password">Password</label>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        <div data-mdb-input-init class="form-outline">
                                            <input type="password" id="password-confirm"
                                                class="form-control form-control-lg" name="password_confirmation" />
                                            <label class="form-label" for="password-confirm">Confirm Password</label>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button data-mdb-ripple-init
                                                class="btn btn-dark btn-lg btn-block" style="background-color: #006769;"
                                                type="submit"> {{ __('Register') }}</button>
                                        </div>

                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Have an account? <a
                                                href="{{ route('login') }}" style="color: #393f81;">Login here</a></p>

                                    </form>

                                </div>
                            </div>
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="https://images.unsplash.com/photo-1626225015999-2e53f6aaa008?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    alt="login form" class="img-fluid" style="border-radius: 0 1rem 1rem 0;" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection