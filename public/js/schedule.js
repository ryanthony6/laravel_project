var fullDate = document.getElementById('full-date').textContent.trim();
document.addEventListener('DOMContentLoaded', function() {
    const courts = document.querySelectorAll('.court-status.available');
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
                    pricePerHour: price
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
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'You can only select a court for a maximum of 5 hours.',
                    });
                }
            }
            updateBookingDetails();
        });
    });

    document.querySelector('.checkout-button button').addEventListener('click', function(event) {
        let hasSelection = false;
        for (const courtId in courtSelections) {
            if (courtSelections[courtId].times.length > 0) {
                hasSelection = true;
                break;
            }
        }

        if (!hasSelection) {
            event.preventDefault(); // Prevent default form submission or link navigation
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please select a court first',
            });
            return; // Prevents further execution
        }

        localStorage.setItem('courtSelections', JSON.stringify(courtSelections));
        localStorage.setItem('fullDate', fullDate); // Save fullDate to localStorage
        window.location.href = '/checkout';
    });
});
