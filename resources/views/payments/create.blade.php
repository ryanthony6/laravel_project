
<div class="modal fade" id="addPaymentModal" tabindex="-1" role="dialog" aria-labelledby="addPaymentModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addPaymentModalLabel">Add Payment Method</h5>
        </div>
        <div class="modal-body">
            <!-- START FORM -->
            <form action="{{ route('payments.store') }}" method="POST">
                @csrf
                <p>Select payment method:</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" id="gopayMethod"
                        value="gopay">
                    <label class="form-check-label" for="gopayMethod">Gopay</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" id="ovoMethod"
                        value="ovo">
                    <label class="form-check-label" for="ovoMethod">OVO</label>
                </div>
                <div class="form-group mt-3" id="phoneNumberInput">
                    <label for="phoneNumber">Phone Number:</label>
                    <input type="text" class="form-control" id="phoneNumber" name="phone_number"
                        placeholder="Enter your phone number">
                </div>

                <button type="submit" class="btn save-button mt-3">Simpan</button>
            </form>
            
        </div>
    </div>
</div>
</div>