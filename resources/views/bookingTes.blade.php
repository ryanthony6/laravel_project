<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Outdoor Sports Centre Booking</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
        .court-status {
            padding: 5px;
            border: 1px solid #ccc;
            margin: 2px 0px; 
            display: inline-block;
            min-width: 150px;
            text-align: center;
            border-radius: 20px;
            cursor: pointer;
        }
        .available { color: green; }
        .booked { color: red; }
        .time-slot {
            border-bottom: 1px dashed #ccc;
            padding: 10px 0;
        }
        .time-slot span {
            display: inline-block;
            margin-right: 10px; 
        }

        .card {
            border: none; 
            border-radius: 10px; 
            box-shadow: 0 4px 8px rgba(0,0,0,0.15); 
            overflow: hidden;
        }

        .card-header {
            background-color: #177d00;
            text-align: center; 
            color: white;
            font-size: 22px; 
            padding: 15px 20px; 
            text-transform: uppercase; 
            letter-spacing: 1px; 
        }

        .card-body {
            background-color: #ffffff;
            padding: 25px; 
            color: #333; 
            font-size: 16px; 
        }

        .booking-detail{
            border-left: 5px solid #0e4d00; 
            padding: 10px;
            margin-bottom: 15px; 
        }

        .booking-detail div {
            margin-bottom: 20px; 
            border-left: 5px solid #0e4d00; 
            padding-left: 10px;
            background-color: #f9f9f9;
        }

        .booking-detail {
            border-left: none; 
        }

        .booking-detail p, .summary-line p {
            margin-bottom: 5px; 
        }

        .dashed {
            border-top: 2px dashed #ccc; 
        }

        .checkout-button button {
            background-color: #24870e; 
            color: white;
            padding: 15px 30px;
            font-size: 20px;
            border-radius: 8px;
            cursor: pointer; 
            transition: background-color 0.3s; 
        }
        .checkout-button button:hover {
            background-color: #0e4502; 
        } 

        .selected {
            background-color: #24870e;
            color: white;
        }

        .unavailable {
            background-color: #8B0000; 
            color: #ffffff;
        }

        .court-status.available {
            cursor: pointer; 
        }

        .no-details {
            text-align: center; 
            padding: 20px; 
            font-size: 16px; 
            color: #666;
            border-left: none !important;
            background: none;
        }

        .day-nav a {
            padding: 8px 16px;
            margin: 0 4px;
            display: inline-block;
            background-color: #f4f4f4;
            color: #333;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
        }

        .day-nav a:hover {
            background-color: #ddd;
            text-decoration: none;
        }

        .day-nav a.active {
            background-color: #4CAF50;
            color: white;
            border-bottom: 3px solid #388E3C;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="day-nav mb-3">
            @foreach ($dates as $key => $value)
                <a href="{{ $isToday && $key == date('Y-m-d') ? url('bookingtes') : url('bookingtes?date=' . $key) }}" class="btn btn-link {{ $selectedDate == $key ? 'active' : '' }}">{{ $value }}</a>
            @endforeach
        </div>
        <h1 class="mb-4">{{ $fullDate }}</h1> 
        
        <div class="card">
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

        <div class="row mt-5">
            <div class="col-md-6">
                <!-- Payment Details Card -->
                <div class="card">
                    <div class="card-header">
                        Payment Details
                    </div>
                    <div class="card-body">
                        <div id="payment-details" class="booking-detail mb-3">
                            <!-- Payment details will be updated here -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary Card -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Summary
                    </div>
                    <div class="card-body">
                        <div id="summary-details" class="summary-line">
                            <!-- Summary will be updated here -->
                        </div>
                    </div>
                </div>
                <div class="checkout-button mt-4">
                    <button type="button" class="btn-lg btn-block">Checkout</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var fullDate = "{{ $fullDate }}"; // Mengubah $fullDate dari Blade ke variabel JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            const courts = document.querySelectorAll('.court-status');
            const paymentDetails = document.getElementById('payment-details');
            const summaryDetails = document.getElementById('summary-details');
            const courtSelections = {};

            function updateDetails() {
                let totalCost = 0;
                paymentDetails.innerHTML = ''; // Clear previous details
                summaryDetails.innerHTML = ''; // Clear previous summary details

                Object.keys(courtSelections).forEach(courtId => {
                    const { times } = courtSelections[courtId];
                    if (times.length > 0) {
                        const price = times.length * 50000;
                        totalCost += price;

                        paymentDetails.innerHTML += `<div class="booking-detail">
                            <h4>Court ${courtId}</h4>
                            <p>Date: ${fullDate}</p>
                            <p>Time: ${times.join(', ')}</p>
                            <p>Price: Rp ${price.toLocaleString()}</p>
                        </div>`;
                    }
                });

                if (totalCost > 0) {
                    const tax = totalCost * 0.10;
                    const totalIncludingTax = totalCost + tax;
                    summaryDetails.innerHTML = `<p>Court Total: Rp ${totalCost.toLocaleString()}</p>
                                                <p>Tax 10%: Rp ${tax.toLocaleString()}</p>
                                                <hr class="dashed">
                                                <p>Total: Rp ${totalIncludingTax.toLocaleString()}</p>`;
                } else {
                    paymentDetails.innerHTML = '<div class="no-details">Please book a court</div>';
                    summaryDetails.innerHTML = '<div class="no-details">No payment details</div>';
                }
            }

            updateDetails(); // Call updateDetails on page load to set initial state

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

                    updateDetails();
                });
            });

            const links = document.querySelectorAll('.day-nav a');

            links.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault(); 
                    links.forEach(lnk => lnk.classList.remove('active')); 
                    this.classList.add('active'); 
                    window.location.href = this.href; 
                });
            });
        });
    </script>
</body>
</html>