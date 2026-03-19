<?php

use App\Http\Controllers\HideController;

Route::controller(HideController::class)->group(function () {
    Route::post('/question/hide', 'hide')->middleware('auth');
});
