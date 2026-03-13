<?php

use App\Http\Controllers\SearchController;

Route::controller(SearchController::class)->group(function () {
    Route::get('/search', 'search')->name('search');
});
