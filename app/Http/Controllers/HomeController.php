<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $questions = Question::with('user', 'images')
            ->paginate(20);

        $questionsQty = Question::count();

        return view('home', compact('questions', 'questionsQty'));
    }

    public function popular()
    {
        $questions = Question::with('user', 'images')
            ->withCount('responses')
            ->orderByDesc('upvotes')
            ->paginate(20);

        $questionsQty = Question::count();

        return view('home', compact('questions', 'questionsQty'));
    }

    public function new()
    {
        $questions = Question::with('user', 'images')
            ->orderByDesc('id')
            ->paginate(20);

        $questionsQty = Question::count();

        return view('home', compact('questions', 'questionsQty'));
    }

    public function show($id)
    {
        return view('question', ['question' => [
            'id' => $id,
            'title' => 'How to implement a binary search algorithm in Python?',
            'author' => 'John Doe',
            'date' => '2023-10-01',
            'content' => 'I am trying to implement a binary search algorithm in Python, but I am having trouble understanding how to handle edge cases. Can someone provide an example implementation?',
            'upvotes' => 15,
            'answers' => 3,
            'views' => 120,
            'image' => 'https://picsum.photos/id/237/200/300',
        ]]);
    }

    public function search(Request $request)
    {
        return view('search', [
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
                    'image' => 'https://picsum.photos/id/237/200/300',
                ],
            ],
        ]);
    }

    public function notificationShow()
    {
        return view('notification');
    }
}
