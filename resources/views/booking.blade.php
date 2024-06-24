@extends('layouts.mainlayout')

@section('content')
    <div class="container mt-5" style="padding-top: 40px;">
        <div class="day-nav mb-3 d-flex justify-content-start">
            @foreach ($dates as $key => $value)
                <a href="{{ $isToday && $key == date('Y-m-d') ? url('booking') : url('booking?date=' . $key) }}" class="btn btn-link {{ $selectedDate == $key ? 'active' : '' }}">{{ $value }}</a>
            @endforeach
        </div>
        <h1 class="mb-4">{{ $fullDate }}</h1> 
        
        <div class="card cardBooking mx-auto" style="max-width: 1500px;">
            <div class="card-header text-center">
                Available Courts
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
                                        <span class="court-status available flex-fill text-center" data-court-id="{{ $courtData['court'] }}" data-time-slot="{{ $time }}">
                                            {{ $courtData['court'] }}
                                            Rp {{ number_format($courtData['price'], 0, ',', '.') }}
                                        </span>
                                    @elseif ($courtData['status'] == 'booked')
                                        <span class="court-status booked flex-fill text-center">
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
    <style>
        .day-nav {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .day-nav a {
            margin: 0 5px;
        }
        .day-nav a.active {
            font-weight: bold;
            color: #28a745;
        }
        .time-slot {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .time-label {
            width: 60px;
            text-align: center;
            margin-right: 10px;
        }
        .court-status {
            padding: 10px;
            border-radius: 20px;
            margin: 0 5px;
            border: 1px solid #ccc;
            flex: 1;
            max-width: 185px;
            min-width: 185px;
            box-sizing: border-box;
        }
        .court-status.available {
            background-color: #f8f9fa;
            color: #000;
            cursor: pointer;
        }
        .court-status.unavailable {
            background-color: #EEEEEE;
            color: #686D76;
        }
        .court-status.booked {
            background-color: #dc3545;
            color: #ffffff;
        }
        .court-status.selected {
            background-color: #28a745;
            color: #ffffff;
        }
        .dotted-line {
            border: none;
            border-top: 2px dotted black;
        }
        .checkout-button button {
            background-color: #28a745;
            color: #ffffff;
        }
    </style>
    <script>
        var fullDate = "{{ $fullDate }}"; 
        document.addEventListener('DOMContentLoaded', function() {
            const courts = document.querySelectorAll('.court-status.available');
            const checkoutForm = document.getElementById('checkout-form');
            const bookingDetailsInput = document.getElementById('booking_details');
            const courtSelections = {};

            function updateBookingDetails() {
                bookingDetailsInput.value = JSON.stringify(courtSelections);
            }

            courts.forEach(court => {
                court.addEventListener('click', function() {
                    const courtId = this.dataset.courtId;
                    const timeSlot = this.dataset.timeSlot;
                    const nextHour = `${parseInt(timeSlot.split(':')[0]) + 1}:00`;
                    const timeRange = `${timeSlot} - ${nextHour}`;

                    if (!courtSelections[courtId]) {
                        courtSelections[courtId] = {
                            times: [],
                            date: fullDate
                        };
                    }

                    if (this.classList.contains('selected')) {
                        this.classList.remove('selected');
                        const index = courtSelections[courtId].times.indexOf(timeRange);
                        if (index > -1) {
                            courtSelections[courtId].times.splice(index, 1);
                        }
                    } else {
                        if (courtSelections[courtId].times.length < 5) {
                            this.classList.add('selected');
                            courtSelections[courtId].times.push(timeRange);
                        } else {
                            alert('You can only select a court for a maximum of 5 hours.');
                        }
                    }

                    updateBookingDetails();
                });
            });

            document.querySelector('.checkout-button button').addEventListener('click', function() {
                localStorage.setItem('courtSelections', JSON.stringify(courtSelections));
                window.location.href = '/checkout';
            });
        });
    </script>
@endsection

