@extends('layouts.blank')

@section('content')
    <div class="container" id="checkout-page">
        <div class="row">
            <!-- Payment Details Card -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Payment Details</div>
                    <div class="card-body" id="payment-details">
                        <a href="{{ route('booking.index') }}" class="btn btn-secondary btn-block">
                            Back to Previous Page
                        </a>
                    </div>
                </div>
            </div>
            <!-- Summary Card -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Summary</div>
                    <div class="card-body" id="summary-details">
                    </div>
                </div>
                <div class="checkout-button mt-4">
                    <button type="button" class="btn-lg btn-block" data-toggle="modal" data-target="#paymentModal">Checkout</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="bookingForm" method="POST" action="{{ route('process.payment') }}">
                    @csrf
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
                                @if (!$hasGopay)
                                    <p class="add-payment" data-toggle="modal" data-target="#addPaymentModal">+ Add payment method</p>
                                @endif
                            @else
                                <p>No payment methods added yet.</p>
                                <p class="add-payment" data-toggle="modal" data-target="#addPaymentModal">+ Add payment method</p>
                            @endif
                        </div>
                        <hr class="dashed">
                        <div class="price" id="total-details"></div>
                    </div>
                    <input type="hidden" name="user_name" value="{{ Auth::user()->name }}">
                    <input type="hidden" name="court_id" id="courtId">
                    <input type="hidden" name="date" id="bookingDate">
                    <input type="hidden" name="time" id="bookingTime">
                    <input type="hidden" name="total_price" id="totalPrice">
                    <button type="submit" class="pay-button btn btn-success">Pay Now</button>
                </form>
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
                        <label class="form-check-label" for="gopayMethod">Gopay</label>
                    </div>
                    <div class="form-group mt-3" id="phoneNumberInput">
                        <label for="phoneNumber">Phone Number:</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Enter your phone number">
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center p-3">
                    <button type="button" class="btn btn-primary" id="confirmPaymentMethod">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
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
                        $('.modal-backdrop').remove(); // Hapus elemen backdrop
                        $('body').removeClass('modal-open'); // Hapus kelas modal-open dari body
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

        document.querySelector('.pay-button').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent form from submitting the default way

            const selectedPaymentMethod = document.querySelector('input[name="paymentMethod"]:checked');
            if (!selectedPaymentMethod) {
                alert('Please select a payment method.');
                return;
            }

            const courtSelections = JSON.parse(localStorage.getItem('courtSelections'));
            document.getElementById('courtId').value = Object.keys(courtSelections).join(', ');
            document.getElementById('bookingDate').value = courtSelections[Object.keys(courtSelections)[0]].date;
            document.getElementById('bookingTime').value = courtSelections[Object.keys(courtSelections)[0]].times.join(', ');

            const form = document.getElementById('bookingForm');
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                console.log('Response status:', response.status); // Debugging line
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Success:', data); // Debugging line
                if (data.success) {
                    alert(data.message);
                    // Update the view to mark the courts as booked
                    Object.keys(courtSelections).forEach(courtId => {
                        courtSelections[courtId].times.forEach(timeRange => {
                            const timeSlot = timeRange.split(' - ')[0];
                            const courtElement = document.querySelector(`.court-status[data-court-id="${courtId}"][data-time-slot="${timeSlot}"]`);
                            if (courtElement) {
                                courtElement.classList.remove('available');
                                courtElement.classList.add('booked');
                                courtElement.innerText = `${courtId} booked`;
                            }
                        });
                    });
                    // Redirect to booking page or clear local storage
                    localStorage.removeItem('courtSelections');
                    window.location.href = '/booking';
                } else {
                    alert('Booking failed. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        });
    </script>
@endsection
