<?php

use App\Http\Controllers\NotificationController;

Route::controller(NotificationController::class)->group(function () {
    Route::get('/notification', 'index')->name('notification.show')->middleware('auth');
    Route::get('/notification/read', 'markAllRead')->name('notification.read.all')->middleware('auth');
});
