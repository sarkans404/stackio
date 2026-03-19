<?php

use App\Http\Controllers\SaveController;

Route::controller(SaveController::class)->group(function () {
    Route::post('/question/save', 'save')->name('question.save')->middleware('auth');
});
