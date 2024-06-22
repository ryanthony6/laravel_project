<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            border: none; 
            border-radius: 10px; 
            box-shadow: 0 4px 8px rgba(0,0,0,0.15); 
            overflow: hidden;
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #177d00;
            text-align: center; 
            color: white;
            font-size: 22px; 
            padding: 15px 20px; 
            text-transform: uppercase; 
            letter-spacing: 1px; 
        }
        .card-body {
            background-color: #ffffff;
            padding: 25px; 
            color: #333; 
            font-size: 16px; 
        }
        .booking-detail {
            border-left: 5px solid #0e4d00; 
            padding: 10px;
            margin-bottom: 15px; 
        }
        .booking-detail div {
            margin-bottom: 20px; 
            border-left: 5px solid #0e4d00; 
            padding-left: 10px;
            background-color: #f9f9f9;
        }
        .booking-detail p, .summary-line p {
            margin-bottom: 5px; 
        }
        .dashed {
            border-top: 2px dashed #ccc; 
        }
        .checkout-button button {
            background-color: #24870e; 
            color: white;
            padding: 15px 30px;
            font-size: 20px;
            border-radius: 8px;
            cursor: pointer; 
            transition: background-color 0.3s; 
        }
        .checkout-button button:hover {
            background-color: #0e4502; 
        } 
        .no-details {
            text-align: center; 
            padding: 20px; 
            font-size: 16px; 
            color: #666;
            border-left: none !important;
            background: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <!-- Payment Details Card -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Payment Details</div>
                    <div class="card-body" id="payment-details">
                        <!-- Payment details will be dynamically inserted here -->
                    </div>
                </div>
            </div>
            <!-- Summary Card -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Summary</div>
                    <div class="card-body" id="summary-details">
                        <!-- Summary will be dynamically inserted here -->
                    </div>
                </div>
                <div class="checkout-button mt-4">
                    <button type="button" class="btn-lg btn-block">Confirm Payment</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const courtSelections = JSON.parse(localStorage.getItem('courtSelections'));
            const paymentDetails = document.getElementById('payment-details');
            const summaryDetails = document.getElementById('summary-details');
            let totalCost = 0;

            Object.keys(courtSelections).forEach(courtId => {
                const { times, date } = courtSelections[courtId];
                if (times.length > 0) {
                    const price = times.length * 50000;
                    totalCost += price;

                    paymentDetails.innerHTML += `<div class="booking-detail">
                        <h4>Court ${courtId}</h4>
                        <p>Date: ${date}</p>
                        <p>Time: ${times.join(', ')}</p>
                        <p>Price: Rp ${price.toLocaleString()}</p>
                    </div>`;
                }
            });

            if (totalCost > 0) {
                const tax = totalCost * 0.10;
                const totalIncludingTax = totalCost + tax;
                summaryDetails.innerHTML = `<p>Court Total: Rp ${totalCost.toLocaleString()}</p>
                                            <p>Tax 10%: Rp ${tax.toLocaleString()}</p>
                                            <hr class="dashed">
                                            <p>Total: Rp ${totalIncludingTax.toLocaleString()}</p>`;
            } else {
                paymentDetails.innerHTML = '<div class="no-details">No payment details</div>';
                summaryDetails.innerHTML = '<div class="no-details">No payment details</div>';
            }
        });
    </script>
</body>
</html>