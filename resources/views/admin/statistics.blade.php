@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row my-4">
        <!-- Dashboard Header -->
        <div class="col-12">
            <h2 class="text-center">Admin Dashboard</h2>
        </div>
    </div>

    <div class="row">
        <!-- Cards Section -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <p class="card-text">1,234</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Products</h5>
                    <p class="card-text">567</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Customers</h5>
                    <p class="card-text">789</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Sales</h5>
                    <p class="card-text">$12,345</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-4">
        <!-- Charts Section -->
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Sales Chart</h5>
                    <!-- Placeholder for chart -->
                    <div id="sales-chart" style="height: 300px;"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Orders Chart</h5>
                    <!-- Placeholder for chart -->
                    <div id="orders-chart" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-4">
        <!-- Recent Orders Table -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Recent Orders</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>001</td>
                                <td>John Doe</td>
                                <td>2023-06-16</td>
                                <td><span class="badge bg-success">Completed</span></td>
                                <td>$123.45</td>
                            </tr>
                            <tr>
                                <td>002</td>
                                <td>Jane Smith</td>
                                <td>2023-06-15</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td>$67.89</td>
                            </tr>
                            <!-- More rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
