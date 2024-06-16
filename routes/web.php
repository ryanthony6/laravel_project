<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
    return redirect('/login');
});

Auth::routes();

Route::get('/homepage', [HomeController::class, 'index'])->name('home');


