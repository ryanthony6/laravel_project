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

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
Route::post('contact-us', [ContactController::class, 'store'])->name('contact.us.store');

// Apply middleware only to routes that require authentication
Route::middleware(['auth'])->group(function () {

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking-history', [BookingController::class, 'showBookingHistory'])->name('booking.history');
    Route::get('/checkout', [BookingController::class, 'checkout'])->name('checkout.index');
    Route::post('/process-checkout', [BookingController::class, 'processCheckout'])->name('process.checkout');
    Route::post('/process-payment', [BookingController::class, 'processPayment'])->name('process.payment');

    // Payment Routes
    Route::prefix('payment')->group(function () {
        Route::get('/', [PaymentController::class, 'index'])->name('payments.index');
        Route::get('/confirm', [PaymentController::class, 'confirm'])->name('payments.confirm');
        Route::get('/addpayment', [PaymentController::class, 'create'])->name('payments.create');
        Route::get('/showpayment', [PaymentController::class, 'show'])->name('payments.show');
        Route::post('/store', [PaymentController::class, 'store'])->name('payments.store');
        Route::delete('/delete/{id}', [PaymentController::class, 'destroy'])->name('payments.delete');
    });
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/home', [HomeController::class, 'admin'])->name('home.admin');

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

    // Review Routes
    Route::get('/displayreview', [emailReviewController::class, 'index'])->name('displayreview.index');
    Route::resource('reviews', ReviewController::class);
});


Auth::routes();
