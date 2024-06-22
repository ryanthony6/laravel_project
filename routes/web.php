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
use App\Http\Controllers\BookingTesController;

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Apply middleware only to routes that require authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('contact-us', [ContactController::class, 'store'])->name('contact.us.store');
    Route::get('/bookingtes', [BookingTesController::class, 'index'])->name('bookingtes.index');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/home', function () {
        return view('admin.home');
    })->name('admin.home');

    Route::get('/dashboard', function () {
        return view('admin.statistics');
    })->name('admin.statistics');


    // Schedules
    Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedule.index');
    Route::get('create', [ScheduleController::class, 'create'])->name('schedule.create');
    // Route::get('/schedules', [ScheduleController::class, 'store'])->name('schedule.store');
    // Route::get('/schedules', [ScheduleController::class, 'edit'])->name('schedule.edit');
    // Route::get('/schedules', [ScheduleController::class, 'update'])->name('schedule.update');
    // Route::get('/schedules', [ScheduleController::class, 'create'])->name('schedule.delete');

    


    Route::get('/orders', function () {
        return view('admin.orders');
    })->name('admin.orders');

    Route::get('/displayreview', [emailReviewController::class, 'index'])->name('displayreview.index');
    

    Route::resource('reviews', ReviewController::class);
});


Auth::routes();
