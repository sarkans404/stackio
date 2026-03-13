<?php

use App\Http\Controllers\ResponseController;

Route::controller(ResponseController::class)->group(function () {
    Route::post('/response/create', 'create')->name('responses.create')->middleware('auth');
    Route::post('/response/edit', 'edit')->name('responses.edit')->middleware('auth');
    Route::post('/response/delete', 'delete')->name('responses.delete')->middleware('auth');
});
