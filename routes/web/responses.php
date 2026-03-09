<?php

use App\Http\Controllers\ResponseController;

Route::controller(ResponseController::class)->group(function () {
    Route::post('/response/create', 'create')->name('responses.create')->middleware('auth');
});
