<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionTag;
use App\Models\Tags;
use App\Models\Votes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index($id)
    {
        $question = Question::with([
            'user',
            'images',
            'tags',
            'question_tags',
            'responses.user',
            'responses.children.user',
        ])->findOrFail($id);
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

        return view('question', compact('question', 'userVotes', 'userVotesRes', 'questionsQty'));
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
}
