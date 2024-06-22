@unless (Route::is('login') || Route::is('register') || Route::is('password.request') || Route::is('profile.index') || Route::is('bookingtes.index'))

    <nav class="navbar navbar-expand-md navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                Cahaya Sports
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav ms-auto gap-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home.index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('booking.index') }}">Book</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#contact-us">Contact Us</a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item ">
                                <a class="nav-link active" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link active dropdown-toggle " href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('images/ProfilePic.png') }}"
                                    alt="{{ Auth::user()->image ? 'User Image' : 'Default Image' }}" class="rounded-circle"
                                    width="30" height="30" style="margin-right: 10px;">
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @if (Auth::user()->role !== 'admin')
                                    <!-- Check if the user is not an admin -->
                                    <a class="dropdown-item" href="{{ route('profile.index') }}">
                                        {{ __('Edit Profile') }}
                                    </a>
                                @endif
                                @if (Auth::user()->role === 'admin')
                                    <!-- Check if the user is an admin -->
                                    <a class="dropdown-item" href="{{ route('admin.home') }}">
                                        {{ __('Dashboard') }}
                                    </a>
                                @endif

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
@endunless

@if (Route::is('booking.index'))
    <nav class="navbar navbar-expand-md navbar-light bg-white fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}" style="color: black;">
                Cahaya Sports
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav ms-auto gap-3">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.index') }}" style="color: black;">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('booking.index') }}" style="color: black;">Booking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact-us" style="color: black;">Contact Us</a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('login') }}" style="color: black;">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}" style="color: black;">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle " href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: black;">
                                <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('images/ProfilePic.png') }}"
                                    alt="{{ Auth::user()->image ? 'User Image' : 'Default Image' }}" class="rounded-circle"
                                    width="30" height="30" style="margin-right: 10px;">
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @if (Auth::user()->role !== 'admin')
                                    <a class="dropdown-item" href="{{ route('profile.index') }}">
                                        {{ __('Edit Profile') }}
                                    </a>
                                @endif
                                @if (Auth::user()->role === 'admin')
                                    <a class="dropdown-item" href="{{ route('admin.home') }}">
                                        {{ __('Dashboard') }}
                                    </a>
                                @endif

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
@endif