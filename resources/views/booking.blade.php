@extends('layouts.mainlayout')

@section('content')
    <section>
        <div class="container pt-5">
            <div class="day-nav mb-3 d-flex justify-content-start pt-5">
                @foreach ($dates as $key => $value)
                    <a href="{{ $isToday && $key == date('Y-m-d') ? url('booking') : url('booking?date=' . $key) }}"
                        class="btn {{ $selectedDate == $key ? 'active' : '' }}">{{ $value }}</a>
                @endforeach
            </div>
            <h1 class="mb-4">{{ $fullDate }}</h1>

            <div class="card cardBooking mx-auto" style="max-width: 1500px;">
                <div class="card-header text-center">
                    Available Schedule
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($timeslots as $time => $courts)
                            <div class="col-12">
                                <div class="time-slot d-flex align-items-center">
                                    <span class="time-label">{{ $time }}</span>
                                    @foreach ($allPossibleCourts as $court)
                                        @php
                                            $courtData = $courts[$court];
                                        @endphp
                                        @if ($courtData['status'] == 'available')
                                            <span class="court-status available flex-fill text-center"
                                                data-court-id="{{ $courtData['court'] }}"
                                                data-time-slot="{{ $time }}"
                                                data-price="{{ $courtData['price'] }}">
                                                {{ $courtData['court'] }}
                                                Rp {{ number_format($courtData['price'], 0, ',', '.') }}
                                            </span>
                                        @elseif ($courtData['status'] == 'booked')
                                            <span
                                                class="court-status booked {{ isset($courtData['user_id']) && $courtData['user_id'] == auth()->id() ? 'booked-by-user' : '' }} flex-fill text-center">
                                                {{ $courtData['court'] }} booked
                                            </span>
                                        @else
                                            <span class="court-status unavailable flex-fill text-center">
                                                {{ $courtData['court'] }} not available
                                            </span>
                                        @endif
                                    @endforeach
                                </div>
                                <hr class="dotted-line">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <form id="checkout-form" action="{{ route('process.checkout') }}" method="POST">
                @csrf
                <input type="hidden" name="booking_details" id="booking_details">
                <div class="checkout-button mt-4 mb-4">
                    <button type="submit" class="btn btn-success btn-lg btn-block w-100">Checkout</button>
                </div>
            </form>
        </div>
    </section>
@endsection
