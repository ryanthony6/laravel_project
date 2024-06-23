<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            border: none; 
            border-radius: 10px; 
            box-shadow: 0 4px 8px rgba(0,0,0,0.15); 
            overflow: hidden;
            margin-bottom: 20px;
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

        .booking-detail {
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

        .no-details {
            text-align: center; 
            padding: 20px; 
            font-size: 16px; 
            color: #666;
            border-left: none !important;
            background: none;
        }

        .modal-content {
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .modal-header {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            font-size: 18px;
            border-bottom: 2px solid #e5e5e5;
        }

        .modal-body {
            padding: 20px;
            font-size: 16px;
            line-height: 1.5;
        }

        .form-check {
            margin-bottom: 15px;
        }

        .form-check-input {
            margin-top: 0.3em;
        }

        .form-check-label {
            margin-left: 5px;
            font-weight: normal;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px;
            font-size: 16px;
        }

        .btn-primary {
            background-color: #4CAF50;
            border-color: #4CAF50;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            transition: background-color 0.2s;
        }

        .btn-primary:hover {
            background-color: #45a049;
        }

        .btn-secondary {
            background-color: #f4f4f4;
            color: #333;
            border-color: #ccc;
            transition: background-color 0.2s;
        }

        .btn-secondary:hover {
            background-color: #e2e2e2;
        }


        .modal-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            border-top: 2px dashed #ccc;
        }

        .modal-footer .price {
            font-size: 20px;
            color: #333;
            margin-bottom: 0;
            flex-grow: 1; 
        }

        .modal-footer {
            background-color: #24870e;
            color: white;
            padding: 10px 20px;
            font-size: 18px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
            margin-top: 10px; 
        }

        .pay-button{
            background-color: #24870e;
            color: white;
            padding: 10px 20px;
            font-size: 18px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: calc(100% - 40px);
            margin: 10px 20px 20px;
        }

        #payment-methods {
            margin-bottom: 20px; 
        }

        .add-payment{
            margin-top: 20px; 
        }

        .modal-footer .pay-button:hover {
            background-color: #0e4502;
        }

        .payment-option {
            display: flex;
            align-items: center;
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: all 0.3s ease;
            background-color: #fff;
        }

        .payment-option:hover {
            background-color: #f0f0f0;
        }

        .payment-option.selected {
            border-color: #24870e;
            background-color: #e6ffe6;
        }

        .payment-option img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
            object-fit: contain;
        }

        .payment-option label {
            margin: 0;
            flex-grow: 1;
            font-size: 16px;
            color: #333;
        }

        .payment-option input[type="radio"] {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <!-- Payment Details Card -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Payment Details</div>
                    <div class="card-body" id="payment-details">
                        <!-- Payment details will be dynamically inserted here -->
                    </div>
                </div>
            </div>
            <!-- Summary Card -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Summary</div>
                    <div class="card-body" id="summary-details">
                        <!-- Summary will be dynamically inserted here -->
                    </div>
                </div>
                <div class="checkout-button mt-4">
                    <button type="button" class="btn-lg btn-block" data-toggle="modal" data-target="#paymentModal">Checkout</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Select Payment Method</h5>
                </div>
                <div class="modal-body">
                    <div id="payment-methods">
                        @if ($payments->count() > 0)
                            @php
                                $hasOvo = false;
                                $hasGopay = false;
                            @endphp
                            @foreach ($payments as $payment)
                                @if ($payment->payment_method == 'ovo')
                                    @php $hasOvo = true; @endphp
                                @elseif ($payment->payment_method == 'gopay')
                                    @php $hasGopay = true; @endphp
                                @endif
                                <div class="payment-option" onclick="selectPaymentMethod(this, '{{ $payment->payment_method }}')">
                                    <input type="radio" name="paymentMethod" value="{{ $payment->payment_method }}" id="{{ $payment->payment_method }}" hidden>
                                    <label for="{{ $payment->payment_method }}">
                                        <img src="{{ asset('images/' . $payment->payment_method . '.png') }}" alt="{{ ucfirst($payment->payment_method) }} Logo">
                                        {{ ucfirst($payment->payment_method) }}: ***********{{ substr($payment->phone_number, -4) }}
                                    </label>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="deletePaymentMethod('{{ $payment->payment_method }}', event)">Delete</button>
                                </div>
                            @endforeach
                            @if (!$hasOvo || !$hasGopay)
                                <p class="add-payment" data-toggle="modal" data-target="#addPaymentModal">+ Add payment method</p>
                            @endif
                        @else
                            <p>No payment methods added yet.</p>
                            <p class="add-payment" data-toggle="modal" data-target="#addPaymentModal">+ Add payment method</p>
                        @endif
                    </div>
                    <hr class="dashed">
                    <div class="price" id="totalAmount">Total: </div>
                </div>
                <button type="button" class="pay-button btn btn-success">Pay Now</button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addPaymentModal" tabindex="-1" role="dialog" aria-labelledby="addPaymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPaymentModalLabel">Add Payment Method</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Select payment method:</p>
                   
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="gopayMethod" value="gopay">
                            <label class="form-check-label" for="gopayMethod">
                                Gopay
                            </label>
                        </div>
                    
                   
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="ovoMethod" value="ovo">
                            <label class="form-check-label" for="ovoMethod">
                                OVO
                            </label>
                        </div>
                

                    <div class="form-group mt-3" id="phoneNumberInput">
                        <label for="phoneNumber">Phone Number:</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Enter your phone number">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="confirmPaymentMethod">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const courtSelections = JSON.parse(localStorage.getItem('courtSelections'));
            const paymentDetails = document.getElementById('payment-details');
            const summaryDetails = document.getElementById('summary-details');
            let totalCost = 0;

            Object.keys(courtSelections).forEach(courtId => {
                const { times, date } = courtSelections[courtId];
                if (times.length > 0) {
                    const price = times.length * 50000;
                    totalCost += price;

                    paymentDetails.innerHTML += `<div class="booking-detail">
                        <h4>Court ${courtId}</h4>
                        <p>Date: ${date}</p>
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

                document.querySelector('.price').innerText = `Total: Rp ${totalIncludingTax.toLocaleString()}`;
            } else {
                paymentDetails.innerHTML = '<div class="no-details">No payment details</div>';
                summaryDetails.innerHTML = '<div class="no-details">No payment details</div>';
            }
        });

        $(document).ready(function() {
        $('.add-payment').click(function() {
            $('#addPaymentModal').modal('show');
        });

        $('#confirmPaymentMethod').click(function() {
            var selectedMethod = $('input[name=paymentMethod]:checked').val();
            var phoneNumber = $('#phoneNumber').val();

            if (!phoneNumber) {
                alert('Please enter your phone number.');
                return;
            }

            // Kirim data ke server
            $.ajax({
                url: '/payments', // Pastikan URL ini sesuai dengan route yang Anda definisikan
                method: 'POST',
                data: {
                    payment_method: selectedMethod,
                    phone_number: phoneNumber
                },
                success: function(response) {
                    alert(response.message);
                    $('#addPaymentModal').modal('hide');
                    location.reload();
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 400) {
                        alert(xhr.responseJSON.message); // Tampilkan pesan kesalahan dari server
                    } else {
                        alert('Error saving payment method: ' + xhr.responseText);
                    }
                }
            });
        });

        // Adjust modal content based on selected payment method
        $('input[name=paymentMethod]').change(function() {
            var selectedMethod = $(this).val();
            if (selectedMethod === 'ovo') {
                $('#phoneNumberInput label').text('OVO Phone Number:');
                $('#phoneNumber').attr('placeholder', 'Enter your OVO phone number');
            } else if (selectedMethod === 'gopay') {
                $('#phoneNumberInput label').text('Gopay Phone Number:');
                $('#phoneNumber').attr('placeholder', 'Enter your Gopay phone number');
            }
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    function selectPaymentMethod(element, method) {
        document.querySelectorAll('.payment-option').forEach(el => el.classList.remove('selected'));
        element.classList.add('selected');
        document.getElementById(method).checked = true;
    }

    function deletePaymentMethod(paymentMethod, event) {
        event.stopPropagation(); // Stop bubbling to prevent selecting the payment method
        if (confirm('Are you sure you want to delete this payment method?')) {
            $.ajax({
                url: '{{ route('payment.delete') }}', // Gunakan helper route untuk menghindari hardcoding URL
                method: 'POST',
                data: {
                    payment_method: paymentMethod
                },
                success: function(response) {
                    alert(response.message);
                    location.reload(); // Reload the page to update the list
                },
                error: function(xhr) {
                    alert('Error deleting payment method: ' + xhr.responseText);
                }
            });
        }
    }
    </script>
</body>
</html>
