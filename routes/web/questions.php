<?php

use App\Http\Controllers\QuestionController;

Route::controller(QuestionController::class)->group(function () {
    Route::get('/question/create', 'createShow')->name('question.create.show')->middleware('auth');
    Route::post('/question/create', 'create')->name('question.create')->middleware('auth');
    Route::get('/questions/{id}', 'index')->name('question.show');
    Route::delete('/question/delete', 'delete')->name('question.delete')->middleware('auth');
    Route::get('/question/delete', 'edit')->name('question.edit')->middleware('auth');
    Route::post('/question/delete', 'edit')->name('question.edit.show')->middleware('auth');
});
