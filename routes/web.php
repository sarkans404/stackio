<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;

Route::get('/', function () {
    return view('home', [ 
        'questions' => [
            0 => [
                'id' => 99,
                'title' => 'How to implement a binary search algorithm in Python?',
                'author' => 'John Doe',
                'date' => '2023-10-01',
                'content' => 'I am trying to implement a binary search algorithm in Python, but I am having trouble understanding how to handle edge cases. Can someone provide an example implementation?',
                'upvotes' => 15,
                'answers' => 3,
                'views' => 120,
                'image' => 'https://picsum.photos/id/237/200/300'
            ]
        ]
    ]);
})->name('home');

Route::get('/popular', function () {
    return view('home', [ 
        'questions' => [
            0 => [
                'id' => 99,
                'title' => 'How to implement a binary search algorithm in Python?',
                'author' => 'John Doe',
                'date' => '2023-10-01',
                'content' => 'I am trying to implement a binary search algorithm in Python, but I am having trouble understanding how to handle edge cases. Can someone provide an example implementation?',
                'upvotes' => 15,
                'answers' => 3,
                'views' => 120,
                'image' => 'https://picsum.photos/id/237/200/300'
            ]
        ]
    ]);
})->name('popular');

Route::get('/new', function () {
    return view('home', [ 
        'questions' => [
            0 => [
                'id' => 99,
                'title' => 'How to implement a binary search algorithm in Python?',
                'author' => 'John Doe',
                'date' => '2023-10-01',
                'content' => 'I am trying to implement a binary search algorithm in Python, but I am having trouble understanding how to handle edge cases. Can someone provide an example implementation?',
                'upvotes' => 15,
                'answers' => 3,
                'views' => 120,
                'image' => 'https://picsum.photos/id/237/200/300'
            ]
        ]
    ]);
})->name('new');

Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::get('/questions/{id}', [HomeController::class, 'show'])->name('question.show');

Route::get('/question/create', [QuestionController::class, 'index'])->name('question.create');
Route::post('/question/create', [QuestionController::class, 'create'])->name('question.create');

Route::get('/notification', [HomeController::class, 'notificationShow'])->name('notification.show');

Route::get('/user', [HomeController::class, 'userShow'])->name('user.profile');
Route::get('/user/questions', [HomeController::class, 'userQuestions'])->name('user.questions');
Route::get('/user/answers', [HomeController::class, 'userAnswers'])->name('user.answers');
Route::get('/user/saved', [HomeController::class, 'userSaved'])->name('user.saved');
Route::get('/user/hidden', [HomeController::class, 'userHidden'])->name('user.hidden');
Route::get('/user/upvoted', [HomeController::class, 'userUpvoted'])->name('user.upvoted');
Route::get('/user/downvoted', [HomeController::class, 'userDownvoted'])->name('user.downvoted');
Route::get('/user/edit', [HomeController::class, 'userEdit'])->name('user.edit');
Route::post('/user/edit', [HomeController::class, 'userUpdate'])->name('user.update');

Route::view('/rules', 'rules')->name('rules');
Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/agreement', 'agreement')->name('agreement');