<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\emailReviewController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\BookingHistoryController;

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', [HomeController::class, 'index'])->name('home.index');

// Apply middleware only to routes that require authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/booking-history', [BookingHistoryController::class, 'showBookingHistory'])->name('booking.history');
    Route::post('/cancel-booking/{id}', [BookingHistoryController::class, 'cancelBooking'])->name('cancel.booking');

    Route::post('contact-us', [ContactController::class, 'store'])->name('contact.us.store');

    Route::get('/checkout', [BookingController::class, 'checkout'])->name('checkout.index');
    Route::post('/process-checkout', [BookingController::class, 'processCheckout'])->name('process.checkout');
    Route::post('/process-payment', [BookingController::class, 'processPayment'])->name('process.payment');

    Route::get('/checkout', [PaymentController::class, 'getPayments'])->name('checkout.index');
    Route::post('/checkout/store', [PaymentController::class, 'getPayments'])->name('checkout.store');

    Route::post('/api/payment-methods', [PaymentController::class, 'store']);
    Route::post('/payments', [PaymentController::class, 'store']);
    Route::post('/delete-payment-method', [PaymentController::class, 'delete'])->name('payment.delete');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/home', function () {
        return view('admin.home');
    })->name('admin.home');

    Route::get('/dashboard', function () {
        return view('admin.statistics');
    })->name('admin.statistics');

    // History Routes
    Route::prefix('history')->group(function () {
        Route::get('/', [HistoryController::class, 'index'])->name('history.index');
    });
    // User Routes
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/create', [UserController::class, 'store'])->name('users.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');
    });

    // Schedule Routes
    Route::prefix('schedules')->group(function () {
        Route::get('/', [ScheduleController::class, 'index'])->name('schedules.index');
        Route::get('/create', [ScheduleController::class, 'create'])->name('schedules.create');
        Route::post('/store', [ScheduleController::class, 'store'])->name('schedules.store');
        Route::get('/edit/{id}', [ScheduleController::class, 'edit'])->name('schedules.edit');
        Route::put('/update/{id}', [ScheduleController::class, 'update'])->name('schedules.update');
        Route::delete('/delete', [ScheduleController::class, 'destroy'])->name('schedules.delete');
    });


    // Orders
    Route::get('/orders', function () {
        return view('admin.orders');
    })->name('admin.orders');

    
    Route::get('/displayreview', [emailReviewController::class, 'index'])->name('displayreview.index');

    Route::resource('reviews', ReviewController::class);
});


Auth::routes();
