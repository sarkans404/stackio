<?php

use App\Http\Controllers\UserController;

Route::controller(UserController::class)->group(function () {
    Route::get('/user/questions', 'userQuestions')->name('user.questions')->middleware('auth');
    Route::get('/user/answers', 'userAnswers')->name('user.answers')->middleware('auth');
    Route::get('/user/saved', 'userSaved')->name('user.saved')->middleware('auth');
    Route::get('/user/hidden', 'userHidden')->name('user.hidden')->middleware('auth');

    Route::get('/user/upvoted', 'userUpvoted')->name('user.upvoted')->middleware('auth');
    Route::get('/user/downvoted', 'userDownvoted')->name('user.downvoted')->middleware('auth');

    Route::get('/user/edit', 'userEdit')->name('user.edit')->middleware('auth');
    Route::post('/user/edit', 'update')->name('user.update')->middleware('auth');

    Route::get('/user/{id}', 'index')->name('user.profile');
}
);
