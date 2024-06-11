document.addEventListener('DOMContentLoaded', function () {
    let selectedTimes = [];
    const maxSelections = 5;
    const pricePerHour = 50000;
    const priceDisplay = document.getElementById('total-price');

    document.querySelectorAll('.time-slot').forEach(button => {
        button.addEventListener('click', function () {
            const time = this.getAttribute('data-time');
            if (selectedTimes.includes(time)) {
                selectedTimes = selectedTimes.filter(t => t !== time);
                this.classList.remove('btn-primary');
                this.classList.add('btn-outline-secondary');
            } else {
                if (selectedTimes.length >= maxSelections) {
                    alert(`Anda hanya bisa memilih maksimal ${maxSelections} jam.`);
                    return;
                }
                selectedTimes.push(time);
                this.classList.remove('btn-outline-secondary');
                this.classList.add('btn-primary');
            }
            selectedTimes.sort();
            priceDisplay.textContent = (selectedTimes.length * pricePerHour).toLocaleString('id-ID');
        });
    });

    document.getElementById('book-now-btn').addEventListener('click', function () {
        if (selectedTimes.length === 0) {
            alert('Silakan pilih jam main.');
        } else {
            alert('Lapangan berhasil dipesan!');
        }
    });
});
