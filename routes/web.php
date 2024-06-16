<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/homepage', function () {
//     return view('homepage');
// });

Route::get('/kocak', function () {
    return view('homepage');
});

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/booking', [App\Http\Controllers\HomeController::class, 'booking'])->name('booking');
Route::get('/editProfile', [App\Http\Controllers\HomeController::class, 'editProfile'])->name('editProfile');

Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');

Auth::routes();

Route::prefix('admin')->group(function () {
    // Home route
    Route::get('/home', function () {
        return view('admin.home');
    })->name('admin.home');

    // Statistics routes
    Route::get('/dashboard', function () {
        return view('admin.statistics');
    })->name('admin.statistics');

    // Schedules route
    Route::get('/schedules', function () {
        return view('admin.schedules');
    })->name('admin.schedules');

    // Orders route
    Route::get('/orders', function () {
        return view('admin.orders');
    })->name('admin.orders');

    // Customers Review route
    Route::get('/customers-review', function () {
        return view('admin.customers-review');
    })->name('admin.customers-review');

    Route::post('/admin/schedule-management', 'ScheduleController@update')->name('admin.schedule-management.update');
});



