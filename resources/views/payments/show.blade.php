 <!-- Modal -->
 <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <form id="bookingForm" method="POST" action="{{ route('process.payment') }}">
                 @csrf
             </form>
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
                             <div class="payment-option">
                                 <input type="radio" name="paymentMethod" value="{{ $payment->payment_method }}"
                                     id="{{ $payment->payment_method }}" hidden>
                                 <label for="{{ $payment->payment_method }}">
                                     <img src="{{ asset('images/' . $payment->payment_method . '.png') }}"
                                         alt="{{ ucfirst($payment->payment_method) }} Logo" class="payment-logo">
                                     {{ ucfirst($payment->payment_method) }}:
                                     **********{{ substr($payment->phone_number, -2) }}
                                 </label>

                                 <form action="{{ route('payments.delete', $payment->id) }}" method="POST"
                                     class="d-inline"
                                     onsubmit="return confirm('Are you sure you want to delete this schedule?');">
                                     @method('delete')
                                     @csrf
                                     <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                 </form>
                             </div>
                         @endforeach
                         @if (!$hasOvo || !$hasGopay)
                             <p class="add-payment" data-toggle="modal" data-target="#addPaymentModal">+ Add payment
                                 method</p>
                         @endif
                     @else
                         <p>No payment methods added yet.</p>
                         <p class="add-payment" data-toggle="modal" data-target="#addPaymentModal">+ Add payment
                             method</p>
                     @endif
                 </div>
                 <hr class="dashed">
                 <div class="price" id="totalAmount">Total: </div>
             </div>
             <input type="hidden" name="user_name" value="{{ Auth::user()->name }}">
             <input type="hidden" name="court_id" id="courtId">
             <input type="hidden" name="date" id="bookingDate">
             <input type="hidden" name="time" id="bookingTime">
             <input type="hidden" name="total_price" id="totalPrice">
             <button type="button" class="pay-button btn btn-success" data-toggle="modal"
                 data-target="#confirmPaymentModal">Confirm</button>

         </div>
     </div>
 </div>
