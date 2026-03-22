<?php

use App\Http\Controllers\FollowController;

Route::controller(FollowController::class)->group(function () {
    Route::post('/question/follow', 'toggle');
});
