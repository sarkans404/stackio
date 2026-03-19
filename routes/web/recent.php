<?php

use App\Http\Controllers\RecentQuestionsController;

Route::controller(RecentQuestionsController::class)->group(function () {
    Route::post('recent/clear', 'index')->middleware('auth');
});
