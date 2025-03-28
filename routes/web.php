<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
// use Illuminate\Support\Facades\Auth;

// Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class,'logout'])->name('logout');

Route::get('/verify_token/{token}', [RegisterController::class, 'verify'])->name('verify.token');
Route::view('/user_verified','user_verified')->name('user_verified');
Route::post('resend_email',[RegisterController::class,'resendEmail'])->name('resend_email');

Route::view('varify','verify')->name('verify')->middleware(['auth']);

Route::group(['name'=>'customer', 'prefix'=>'customer'], function () {
    Route::view('dashboard','customer.dashboard')->name('customer.dashboard')->middleware(['auth','role_check:customer']);
    Route::view('register','customer.register')->name('customer.register');
    Route::post('register',[RegisterController::class,'registerCustomer'])->name('customer.register');
});

Route::group(['name'=>'admin', 'prefix'=>'admin'], function () {
    Route::view('dashboard','admin.dashboard')->name('admin.dashboard')->middleware(['auth','role_check:admin']);
    Route::view('register','admin.register')->name('admin.register');
    Route::post('register',[RegisterController::class,'registerAdmin'])->name('admin.register');
});