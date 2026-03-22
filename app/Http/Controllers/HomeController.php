<?php

namespace App\Http\Controllers;

use App\Models\Follows;
use App\Models\Question;
use App\Models\Responses;
use App\Models\SavedQuestions;
use App\Models\Tags;
use App\Models\User;
use App\Models\Votes;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private function baseQuestionQuery()
    {
        return Question::with('user', 'images')
            ->whereDoesntHave('hidden');
    }

    private function getUserVotes()
    {
        if (! Auth::check()) {
            return [];
        }

        return Votes::where('user_id', Auth::id())
            ->where('votable_type', 'question')
            ->pluck('type', 'votable_id')
            ->toArray();
    }

    private function getUserSaved()
    {
        if (! Auth::check()) {
            return [];
        }

        return SavedQuestions::where('user_id', Auth::id())
            ->pluck('user_id', 'question_id')
            ->toArray();
    }

    private function getPopularTags()
    {
        return Tags::withCount('questions')
            ->having('questions_count', '>', 0)
            ->orderByDesc('questions_count')
            ->limit(5)
            ->get();
    }

    private function getAnswersQty()
    {
        return Question::sum('answers');
    }

    private function getCommentsQty()
    {
        return Responses::whereNotNull('parent_id')->count();
    }

    private function getRecentPosts()
    {
        if (Auth::check()) {
            return Question::select('questions.*')
                ->join('recent_questions', 'questions.id', '=', 'recent_questions.question_id')
                ->where('recent_questions.user_id', Auth::id())
                ->orderByDesc('recent_questions.updated_at')
                ->limit(5)
                ->with('user')
                ->get();
        }
    }

    private function getUserFollows()
    {
        return Follows::where('user_id', Auth::id())
            ->pluck('user_id', 'question_id')
            ->toArray();
    }

    public function index()
    {

        return view('home', [
            'questions' => $this->baseQuestionQuery()
                ->paginate(20),
            'userVotes' => $this->getUserVotes(),
            'userSaved' => $this->getUserSaved(),
            'questionsQty' => Question::count(),
            'answersQty' => $this->getAnswersQty(),
            'commentQty' => $this->getCommentsQty(),
            'userQty' => User::count(),
            'popularTags' => $this->getPopularTags(),
            'recentPosts' => $this->getRecentPosts(),
            'userFollows' => $this->getUserFollows(),
        ]);
    }

    public function popular()
    {
        return view('popular', [
            'questions' => $this->baseQuestionQuery()
                ->withCount('responses')
                ->orderByDesc('upvotes')
                ->paginate(20),
            'userVotes' => $this->getUserVotes(),
            'userSaved' => $this->getUserSaved(),
            'questionsQty' => Question::count(),
            'answersQty' => $this->getAnswersQty(),
            'commentQty' => $this->getCommentsQty(),
            'userQty' => User::count(),
            'popularTags' => $this->getPopularTags(),
            'recentPosts' => $this->getRecentPosts(),
        ]);
    }

    public function new()
    {
        return view('new', [
            'questions' => $this->baseQuestionQuery()
                ->orderByDesc('id')
                ->paginate(20),
            'userVotes' => $this->getUserVotes(),
            'userSaved' => $this->getUserSaved(),
            'questionsQty' => Question::count(),
            'answersQty' => $this->getAnswersQty(),
            'commentQty' => $this->getCommentsQty(),
            'userQty' => User::count(),
            'popularTags' => $this->getPopularTags(),
            'recentPosts' => $this->getRecentPosts(),
        ]);
    }

    public function notificationShow()
    {
        return view('notification');
    }
}
