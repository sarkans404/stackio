<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('user', compact('user'));
    }

    public function userQuestions()
    {
        return view('user.user-questions')->with('user', [
            'name' => 'John Doe',
            'date' => '13-03-2026',
            'id' => 99,
            'title' => 'How to implement a binary search algorithm in Python?',
            'author' => 'John Doe',
            'date' => '2023-10-01',
            'content' => 'I am trying to implement a binary search algorithm in Python, but I am having trouble understanding how to handle edge cases. Can someone provide an example implementation?',
            'upvotes' => 15,
            'answers' => 3,
            'views' => 120,
            'image' => 'https://picsum.photos/id/237/200/300',

        ]);
    }

    public function userAnswers()
    {
        return view('user.user-answers')->with('user', [
            'name' => 'John Doe',
            'date' => '13-03-2026',

        ]);
    }

    public function userSaved()
    {
        return view('user.user-saved')->with('user', [
            'name' => 'John Doe',
            'date' => '13-03-2026',
            'id' => 99,
            'title' => 'How to implement a binary search algorithm in Python?',
            'author' => 'John Doe',
            'date' => '2023-10-01',
            'content' => 'I am trying to implement a binary search algorithm in Python, but I am having trouble understanding how to handle edge cases. Can someone provide an example implementation?',
            'upvotes' => 15,
            'answers' => 3,
            'views' => 120,

        ]);
    }

    public function userHidden()
    {
        return view('user.user-hidden')->with('user', [
            'name' => 'John Doe',
            'date' => '13-03-2026',
            'id' => 99,
            'title' => 'How to implement a binary search algorithm in Python?',
            'author' => 'John Doe',
            'date' => '2023-10-01',
            'content' => 'I am trying to implement a binary search algorithm in Python, but I am having trouble understanding how to handle edge cases. Can someone provide an example implementation?',
            'upvotes' => 15,
            'answers' => 3,
            'views' => 120,

        ]);
    }

    public function userUpvoted()
    {
        return view('user.user-upvoted')->with('user', [
            'name' => 'John Doe',
            'date' => '13-03-2026',
            'id' => 99,
            'title' => 'How to implement a binary search algorithm in Python?',
            'author' => 'John Doe',
            'date' => '2023-10-01',
            'content' => 'I am trying to implement a binary search algorithm in Python, but I am having trouble understanding how to handle edge cases. Can someone provide an example implementation?',
            'upvotes' => 15,
            'answers' => 3,
            'views' => 120,

        ]);
    }

    public function userDownvoted()
    {
        return view('user.user-downvoted')->with('user', [
            'name' => 'John Doe',
            'date' => '13-03-2026',
            'id' => 99,
            'title' => 'How to implement a binary search algorithm in Python?',
            'author' => 'John Doe',
            'date' => '2023-10-01',
            'content' => 'I am trying to implement a binary search algorithm in Python, but I am having trouble understanding how to handle edge cases. Can someone provide an example implementation?',
            'upvotes' => 15,
            'answers' => 3,
            'views' => 120,

        ]);
    }

    // ---

    public function userEdit()
    {
        return view('user.user-edit')->with('user', [
            'name' => 'John Doe',
            'email' => 'example@gmail.com',
            'date' => '13-03-2026',
            'id' => 99,
            'title' => 'How to implement a binary search algorithm in Python?',
            'author' => 'John Doe',
            'date' => '2023-10-01',
            'upvotes' => 15,
            'answers' => 3,
            'views' => 120,

        ]);
    }
}
