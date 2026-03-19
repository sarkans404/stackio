<?php

namespace App\Http\Controllers;

use App\Models\HiddenQuestions;
use App\Models\Question;
use App\Models\Responses;
use App\Models\SavedQuestions;
use App\Models\User;
use App\Models\Votes;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index($id)
    {
        if (! Auth::check()) {
            return redirect('login', 403);
        }
        $user = User::where('id', $id)->first();

        $answerQty = Responses::where('user_id', $user->id)
            ->where('parent_id', null)
            ->count();
        $questionQty = Question::where('user_id', $user->id)
            ->count();
        $upvoteQty = Votes::where('user_id', $user->id)
            ->where('type', 'up')
            ->count();
        $downvoteQty = Votes::where('user_id', $user->id)
            ->where('type', 'down')
            ->count();

        return view('user', compact('user', 'answerQty', 'questionQty', 'upvoteQty', 'downvoteQty'));
    }

    public function userQuestions()
    {
        return view('user.user-questions', [
            'user' => Auth::user(),
            'questions' => Question::with('images')
                ->where('user_id', Auth::id())->get(),
            'userSaved' => SavedQuestions::where('user_id', Auth::id())
                ->pluck('question_id')
                ->flip()
                ->toArray(),
        ]);
    }

    public function userAnswers()
    {
        return view('user.user-answers', [
            'user' => Auth::user(),
            'responses' => Responses::with('question')
                ->where('user_id', Auth::id())
                ->get(),
        ]);
    }

    public function userSaved()
    {
        return view('user.user-saved', [
            'user' => Auth::user(),
            'questions' => Question::with('saved_question')
                ->whereHas('saved_question', function ($q) {
                    $q->where('user_id', Auth::id());
                })
                ->get(),
            'userSaved' => SavedQuestions::where('user_id', Auth::id())
                ->pluck('question_id')
                ->flip()
                ->toArray(),
        ]);
    }

    public function userHidden()
    {
        return view('user.user-hidden', [
            'user' => Auth::user(),
            'questions' => Question::with('images', 'user', 'hidden')
                ->whereHas('hidden')
                ->get(),
            'userSaved' => SavedQuestions::where('user_id', Auth::id())
                ->pluck('question_id')
                ->flip()
                ->toArray(),
            'userHidden' => HiddenQuestions::where('user_id', Auth::id())
                ->pluck('question_id')
                ->flip()
                ->toArray(),
        ]);
    }

    public function userUpvoted()
    {
        if (! Auth::check()) {
            return redirect('login', 403);
        }

        return view('user.user-upvoted', [
            'user' => Auth::user(),
            'questions' => Question::with('user', 'images', 'votes')
                ->whereHas('votes', function ($q) {
                    $q->where('type', 'up');
                })
                ->get(),
        ]);
    }

    public function userDownvoted()
    {
        if (! Auth::check()) {
            return redirect('login', 403);
        }

        return view('user.user-downvoted', [
            'user' => Auth::user(),
            'questions' => Question::with('user', 'images', 'votes')
                ->whereHas('votes', function ($q) {
                    $q->where('type', 'down');
                })
                ->get(),
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
