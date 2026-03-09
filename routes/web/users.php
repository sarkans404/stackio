<?php

use App\Http\Controllers\UserController;

Route::controller(UserController::class)->group(function () {
    Route::get('/user/questions', 'userQuestions')->name('user.questions');
    Route::get('/user/answers', 'userAnswers')->name('user.answers');
    Route::get('/user/saved', 'userSaved')->name('user.saved');
    Route::get('/user/hidden', 'userHidden')->name('user.hidden');
    Route::get('/user/upvoted', 'userUpvoted')->name('user.upvoted');
    Route::get('/user/downvoted', 'userDownvoted')->name('user.downvoted');
    Route::get('/user/edit', 'userEdit')->name('user.edit');
    Route::post('/user/edit', 'userUpdate')->name('user.update');

    Route::get('/user/', 'index')->name('user.profile')->middleware('auth');
}
);
