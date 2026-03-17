<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Votes;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $questions = Question::with('user', 'images')
            ->paginate(20);

        $questionsQty = Question::count();

        $userVotes = [];

        if (Auth::check()) {
            $userVotes = Votes::where('user_id', Auth::id())
                ->where('votable_type', 'question')
                ->pluck('type', 'votable_id')
                ->toArray();
        }

        return view('home', compact('questions', 'userVotes', 'questionsQty'));
    }

    public function popular()
    {
        $questions = Question::with('user', 'images')
            ->withCount('responses')
            ->orderByDesc('upvotes')
            ->paginate(20);

        $questionsQty = Question::count();

        $userVotes = [];

        if (Auth::check()) {
            $userVotes = Votes::where('user_id', Auth::id())
                ->where('votable_type', 'question')
                ->pluck('type', 'votable_id')
                ->toArray();
        }

        return view('popular', compact('questions', 'userVotes', 'questionsQty'));
    }

    public function new()
    {
        $questions = Question::with('user', 'images')
            ->orderByDesc('id')
            ->paginate(20);

        $questionsQty = Question::count();

        $userVotes = [];

        if (Auth::check()) {
            $userVotes = Votes::where('user_id', Auth::id())
                ->where('votable_type', 'question')
                ->pluck('type', 'votable_id')
                ->toArray();
        }

        return view('new', compact('questions', 'userVotes', 'questionsQty'));
    }

    public function notificationShow()
    {
        return view('notification');
    }
}
