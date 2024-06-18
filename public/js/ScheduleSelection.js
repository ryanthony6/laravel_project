document.addEventListener('DOMContentLoaded', function () {
    let selectedTimes = [];
    const pricePerHour = 50000;
    const timeSlotButtons = document.querySelectorAll('.time-slot');
    const totalPriceElement = document.getElementById('total-price');
    const timeSlotsInput = document.getElementById('time_slots');
    const priceInput = document.getElementById('price');

    timeSlotButtons.forEach(button => {
        button.addEventListener('click', function () {
            const time = this.getAttribute('data-time');
            const index = selectedTimes.indexOf(time);
            if (index > -1) {
                selectedTimes.splice(index, 1);
                this.classList.remove('btn-primary');
                this.classList.add('btn-outline-secondary');
            } else {
                if (selectedTimes.length >= 5) {
                    alert('Anda tidak dapat memilih lebih dari 5 slot waktu.');
                    return;
                }
                selectedTimes.push(time);
                this.classList.remove('btn-outline-secondary');
                this.classList.add('btn-primary');
            }
            const totalPrice = selectedTimes.length * pricePerHour;
            totalPriceElement.textContent = totalPrice;
            timeSlotsInput.value = selectedTimes.join(',');
            priceInput.value = totalPrice;
        });
    });
});