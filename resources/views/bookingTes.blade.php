@extends('layouts.mainlayout')

@section('content')
    <div class="container mt-5" style="padding-top: 40px;">
        <div class="day-nav mb-3">
            @foreach ($dates as $key => $value)
                <a href="{{ $isToday && $key == date('Y-m-d') ? url('bookingtes') : url('bookingtes?date=' . $key) }}" class="btn btn-link {{ $selectedDate == $key ? 'active' : '' }}">{{ $value }}</a>
            @endforeach
        </div>
        <h1 class="mb-4">{{ $fullDate }}</h1> 
        
        <div class="cardBooking">
            <div class="card-header">
                Available Courts
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($timeslots as $time)
                        <div class="col-12">
                            <div class="time-slot">
                                <span>{{ $time }}</span>
                                @foreach ($courts as $court)
                                    <span class="court-status available" data-court-id="{{ $court }}" data-time-slot="{{ $time }}">
                                        Court {{ $court }}
                                        Rp 50,000
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <form id="checkout-form" action="/checkout" method="POST">
            @csrf
            <input type="hidden" name="booking_details" id="booking_details">
            <div class="checkout-button mt-4 mb-4">
                <button type="submit" class="btn-lg btn-block w-100">Checkout</button>
            </div>
        </form>
    </div>
    <script>
        var fullDate = "{{ $fullDate }}"; 
        document.addEventListener('DOMContentLoaded', function() {
            const courts = document.querySelectorAll('.court-status');
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