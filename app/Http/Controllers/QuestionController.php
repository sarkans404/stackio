<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionTag;
use App\Models\Responses;
use App\Models\SavedQuestions;
use App\Models\Tags;
use App\Models\User;
use App\Models\Votes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
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

    public function index($id)
    {
        $question = Question::with([
            'user',
            'images',
            'tags',
            'question_tags',
            'responses' => function ($q) {
                $q->whereHas('user', fn ($uq) => $uq->where('is_banned', false))
                    ->with(['user', 'children' => fn ($c) => $c->whereHas('user', fn ($cu) => $cu->where('is_banned', false))->with('user')])
                    ->orderByDesc('is_accepted');
            },
            'hidden',
        ])
            ->whereDoesntHave('hidden', function ($q) {
                $q->where('user_id', Auth::id());
            })
            ->findOrFail($id);

        $questionsQty = Question::count();

        $userVotes = [];
        $userVotesRes = [];

        if (Auth::check()) {
            $userVotes = Votes::where('user_id', Auth::id())
                ->where('votable_type', 'question')
                ->pluck('type', 'votable_id')
                ->toArray();
        }

        if (Auth::check()) {
            $userVotesRes = Votes::where('user_id', Auth::id())
                ->where('votable_type', 'response')
                ->pluck('type', 'votable_id')
                ->toArray();
        }

        $userSaved = [];
        if (Auth::check()) {
            $userSaved = SavedQuestions::where('user_id', Auth::id())
                ->pluck('user_id')
                ->toArray();
        }

        $popularTags = $this->getPopularTags();
        $answersQty = $this->getAnswersQty();
        $commentQty = $this->getCommentsQty();
        $userQty = User::count();

        return view('question', compact('question', 'userVotes', 'userVotesRes', 'userSaved', 'questionsQty', 'popularTags', 'answersQty', 'commentQty', 'userQty'));
    }

    public function createShow()
    {
        $tags = Tags::all();

        return view('question-create', compact('tags'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
        ]);
        $question = Question::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'body' => $request->text,
        ]);

        if ($request->tag) {
            $tag = Tags::where('slug', '=', $request->tag)->first();

            QuestionTag::create([
                'question_id' => $question->id,
                'tag_id' => $tag->id,
            ]);
        }

        return redirect()->route('question.show', $question->id);
    }

    public function delete(Request $request)
    {
        if (Auth::check()) {
            Question::where('id', $request->question_id)->delete();
        }

        return redirect()->route('home');
    }

    public function editShow($id)
    {
        if (! Auth::check()) {
            return redirect()->route('home');
        }

        $question = Question::with([
            'tags',
            'images',
        ])
            ->findOrFail($id);

        if (Auth::user()->id !== $question->user_id) {
            return redirect('home', 403);
        }
        $tags = Tags::all();

        return view('question-edit', compact('question', 'tags'));
    }

    public function edit(Request $request)
    {
        if (! Auth::check()) {
            return redirect()->route('home');
        }

        $request->validate([
            'title' => 'required|min:3',
        ]);

        $question = Question::with('question_tags')
            ->findOrFail($request->question_id);

        if (Auth::user()->id !== $question->user_id) {
            return redirect('home', 403);
        }

        $question->title = $request->title;
        $question->body = $request->body;

        $question->save();

        return redirect()->route('question.show', $question->id);
    }
}
