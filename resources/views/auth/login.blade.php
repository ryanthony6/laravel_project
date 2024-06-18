@extends('layouts.auth')

@section('content')
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-9">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="https://images.unsplash.com/photo-1614058585909-031fc6e4f0bb?q=80&w=1892&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your
                                            account</h5>

                                        <div data-mdb-input-init class="form-outline">  
                                            <input type="email" id="email" name="email"
                                                class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                value="{{ old('email') }}"  autofocus />
                                            <label for="email" class="form-label">Email address</label>
                                            @error('email')
                                                <div class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div data-mdb-input-init class="form-outline">
                                            <input type="password" id="password" name="password"
                                                class="form-control form-control-lg @error('password') is-invalid @enderror"/>
                                            <label for="password" class="form-label">Password</label>
                                            @error('password')
                                                <div class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block" style="background-color: #006769;"
                                                type="submit"> {{ __('Login') }}</button>
                                        </div>

                                        <a class="small text-muted" href="{{ route('password.request') }}">Forgot
                                            password?</a>
                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a
                                                href="{{ route('register') }}" style="color: #393f81;">Register here</a></p>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection