document.addEventListener("DOMContentLoaded", function () {
    const courtSelections = JSON.parse(localStorage.getItem("courtSelections"));
    const paymentDetails = document.getElementById("payment-details");
    const summaryDetails = document.getElementById("summary-details");
    let totalCost = 0;

    if (courtSelections && Object.keys(courtSelections).length > 0) {
        Object.keys(courtSelections).forEach((courtId) => {
            const { times, date } = courtSelections[courtId];
            if (times.length > 0) {
                const price = times.length * 50000;
                totalCost += price;

                paymentDetails.innerHTML += `<div class="card mb-3 mt-3">
                    <div class="card-body">
                    <h5>${courtId}</h5>
                    <p>${date}</p>
                    <div class="d-flex align-items-start justify-content-between">
                    <p>${times.join(", ")}</p>
                    <strong>Rp ${price.toLocaleString()}</strong>
                    </div>
                    </div>
                </div>`;
            }
        });

        if (totalCost > 0) {
            const tax = totalCost * 0.1;
            const totalIncludingTax = totalCost + tax;
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

            document.querySelector(".price");
        } else {
            paymentDetails.innerHTML =
                '<div class="no-details">No payment details</div>';
            summaryDetails.innerHTML =
                '<div class="no-details">No summary details</div>';
        }
    } else {
        paymentDetails.innerHTML =
            '<div class="no-details">No payment details</div>';
        summaryDetails.innerHTML =
            '<div class="no-details">No summary details</div>';
    }

    // Set hidden input values
    if (courtSelections && Object.keys(courtSelections).length > 0) {
        document.getElementById("courtId").value =
            Object.keys(courtSelections).join(", ");
        document.getElementById("bookingDate").value =
            courtSelections[Object.keys(courtSelections)[0]].date;
        document.getElementById("bookingTime").value =
            courtSelections[Object.keys(courtSelections)[0]].times.join(", ");
    }
});
