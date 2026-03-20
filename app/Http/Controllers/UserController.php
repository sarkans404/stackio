<?php

namespace App\Http\Controllers;

use App\Models\HiddenQuestions;
use App\Models\Question;
use App\Models\Responses;
use App\Models\SavedQuestions;
use App\Models\User;
use App\Models\Votes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index($id)
    {
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
            return redirect()->route('login');
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
            return redirect()->route('login');
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

    public function userEdit()
    {
        return view('user.user-edit', [
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'username' => 'required|min:2',
            'avatar' => 'sometimes|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = Auth::user();

        $user->bio = $request->bio;
        $user->username = $request->username;

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return redirect()->route('user.profile', Auth::id());
    }
}
