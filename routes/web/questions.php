<?php

use App\Http\Controllers\QuestionController;

Route::controller(QuestionController::class)->group(function () {
    Route::get('/question/create', 'createShow')->name('question.create.show')->middleware('auth');
    Route::post('/question/create', 'create')->name('question.create')->middleware('auth');
    Route::delete('/question/delete', 'delete')->name('question.delete')->middleware('auth');
    Route::get('/question/edit/{id}', 'editShow')->name('question.edit.show')->middleware('auth');
    Route::post('/question/edit', 'edit')->name('question.edit')->middleware('auth');
    Route::post('/question/follow', 'follow')->name('question.follow')->middleware('auth');
    Route::post('/question/hide', 'hide')->name('question.hide')->middleware('auth');
    Route::post('/question/report', 'report')->name('question.report')->middleware('auth');
    Route::post('/question/showless', 'showLess')->name('question.showless')->middleware('auth');

    Route::get('/questions/{id}', 'index')->name('question.show');
});
