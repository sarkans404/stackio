<?php

use App\Http\Controllers\HomeController;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/popular', 'popular')->name('popular');
    Route::get('/new', 'new')->name('new');
});
