<form id="bookingForm" method="POST" action="{{ route('process.payment') }}">
    <div class="modal fade" id="confirmPaymentModal" tabindex="-1" role="dialog" aria-labelledby="confirmPaymentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmPaymentModalLabel">Confirm Payment</h5>
                    
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to proceed with this payment?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="bookingForm" class="btn btn-success" id="confirmPaymentButton">Confirm Payment</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    document.getElementById('confirmPaymentButton').addEventListener('click', function() {
        // Remove items from localStorage
        localStorage.removeItem('courtSelections');
        localStorage.removeItem('fullDate');
    });
</script>
