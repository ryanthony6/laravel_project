<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Apply middleware only to routes that require authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/booking', [HomeController::class, 'booking'])->name('booking');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware(['auth','admin'])->group(function () {
    Route::get('/home', function () {
        return view('admin.home');
    })->name('admin.home');

    Route::get('/dashboard', function () {
        return view('admin.statistics');
    })->name('admin.statistics');

    Route::get('/schedules', function () {
        return view('admin.schedules');
    })->name('admin.schedules');

    Route::get('/orders', function () {
        return view('admin.orders');
    })->name('admin.orders');
});

Auth::routes();
