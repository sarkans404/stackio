<?php

use App\Http\Controllers\VoteController;

Route::controller(VoteController::class)->group(function () {
    Route::post('/vote', 'vote')->name('vote')->middleware('auth');
});
