
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
            const price = parseFloat(this.dataset.price);

            if (!courtSelections[courtId]) {
                courtSelections[courtId] = {
                    times: [],
                    date: fullDate,
                    price: price
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