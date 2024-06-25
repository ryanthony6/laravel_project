@extends('layouts.blank')

@section('content')
    <div class="container" id="checkout-page">
        <div class="row">
            <!-- Payment Details Card -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Payment Details</div>
                    <div class="card-body" id="payment-details">
                        <a href="{{ route('booking.index') }}" class="btn btn-secondary btn-block">
                            Back to Previous Page
                        </a>
                    </div>
                </div>
            </div>
            <!-- Summary Card -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Summary</div>
                    <div class="card-body" id="summary-details">
                    </div>
                </div>
            </div>
        </div>
    </div>
