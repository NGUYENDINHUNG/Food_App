<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('client.home.home'))->name('home');

Route::prefix('auth')->name('auth.')->controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegisterForm')->name('register');
    Route::post('/register', 'register')->name('register.store');
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login')->name('login.store');
    Route::post('/logout', 'logout')->name('logout');
});
Route::get('/test-csrf', function () {
    return response()->json([
        'csrf_token' => csrf_token(),
        'session_id' => session()->getId(),
        'session_driver' => config('session.driver'),
        'session_connection' => config('session.connection')
    ]);
});
