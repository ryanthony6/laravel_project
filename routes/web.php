<?php

use App\Http\Controllers\BookingController;

Route::get('/bookings', [BookingController::class, 'index']);



