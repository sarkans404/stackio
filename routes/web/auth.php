<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegister')->name('register.show')->middleware('guest');
    Route::post('/register', 'register')->name('register')->middleware('guest');

    Route::get('/login', 'showLogin')->name('login.show')->middleware('guest');
    Route::post('/login', 'login')->name('login')->middleware('guest');

    Route::post('/user/logout', 'logout')->name('logout')->middleware('auth');
});
