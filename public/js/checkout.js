document.addEventListener("DOMContentLoaded", function () {
    const courtSelections = JSON.parse(localStorage.getItem("courtSelections"));
    const fullDate = localStorage.getItem("fullDate"); // Retrieve fullDate from localStorage
    const paymentDetails = document.getElementById("payment-details");
    const summaryDetails = document.getElementById("summary-details");
    const totalDetails = document.getElementById("total-details");
    let totalCost = 0;

    if (courtSelections && Object.keys(courtSelections).length > 0) {
        Object.keys(courtSelections).forEach((courtId) => {
            const { times, pricePerHour } = courtSelections[courtId];
            if (times.length > 0) {
                const price = times.length * pricePerHour;
                totalCost += price;

                paymentDetails.innerHTML += `<div class="card mb-3 mt-3">
                    <div class="card-body">
                    <h5>${courtId}</h5>
                    <p>${fullDate}</p>
                    <div class="d-flex justify-content-between align-items-start">
                    <p>${times
                        .map(
                            (time) =>
                                `<span class="badge bg-secondary">${time}</span>`
                        )
                        .join(" ")}</p>

                    <strong>Rp ${price.toLocaleString()}</strong>
                    </div>
                    </div>
                </div>`;
            }
        });

        if (totalCost > 0) {
            summaryDetails.innerHTML = `
                <div class="d-flex align-items-start justify-content-between">
                    <p>Biaya Sewa</p>
                    <strong>${totalCost.toLocaleString()}</strong>
                </div>
                <hr class="dashed divider-dash">
                <div class="d-flex align-items-start justify-content-between">
                    <p>Total Biaya</p>
                    <strong>${totalCost.toLocaleString()}</strong>
                </div>`;

            totalDetails.innerHTML = `Total: Rp ${totalCost.toLocaleString()}`;

        } else {
            paymentDetails.innerHTML =
                '<div class="no-details">No payment details</div>';
            summaryDetails.innerHTML =
                '<div class="no-details">No summary details</div>';
            totalDetails.innerHTML = "Total: Rp 0"; // No cost
        }
    } else {
        paymentDetails.innerHTML =
            '<div class="no-details">No payment details</div>';
        summaryDetails.innerHTML =
            '<div class="no-details">No summary details</div>';
        totalDetails.innerHTML = "Total: Rp 0"; // No cost
    }

    // Set hidden input values
    if (courtSelections && Object.keys(courtSelections).length > 0) {
        document.getElementById("courtId").value =
            Object.keys(courtSelections).join(", ");
        document.getElementById("bookingDate").value = fullDate;
        document.getElementById("bookingTime").value =
            courtSelections[Object.keys(courtSelections)[0]].times.join(", ");
    }
});


