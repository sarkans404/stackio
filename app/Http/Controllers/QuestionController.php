<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionImages;
use App\Models\QuestionTag;
use App\Models\RecentQuestions;
use App\Models\Responses;
use App\Models\SavedQuestions;
use App\Models\Tags;
use App\Models\User;
use App\Models\Votes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

    private function getRecentPosts()
    {
        if (Auth::check()) {
            return Question::select('questions.*')
                ->join('recent_questions', 'questions.id', '=', 'recent_questions.question_id')
                ->where('recent_questions.user_id', Auth::id())
                ->orderByDesc('recent_questions.updated_at')
                ->limit(5)
                ->with('user', 'images')
                ->get();
        }
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
        ])
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

        if (Auth::check()) {

            $exists = RecentQuestions::where('user_id', Auth::id())
                ->where('question_id', $id)
                ->exists();

            if (! $exists) {

                $count = RecentQuestions::where('user_id', Auth::id())->count();

                if ($count >= 5) {
                    RecentQuestions::where('user_id', Auth::id())
                        ->orderBy('created_at', 'asc')
                        ->first()
                        ?->delete();
                }

                RecentQuestions::create([
                    'user_id' => Auth::id(),
                    'question_id' => $id,
                ]);
            }
            if ($exists) {
                RecentQuestions::where('user_id', Auth::id())
                    ->where('question_id', $id)
                    ->update(['updated_at' => now()]);
            }
        }
        $recentPosts = $this->getRecentPosts();

        $popularTags = $this->getPopularTags();
        $answersQty = $this->getAnswersQty();
        $commentQty = $this->getCommentsQty();
        $userQty = User::count();

        return view('question', compact('question', 'recentPosts', 'userVotes', 'userVotesRes', 'userSaved', 'questionsQty', 'popularTags', 'answersQty', 'commentQty', 'userQty'));
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
            'body' => 'nullable|min:3',
            'img' => 'nullable|array|max:10',
            'img.*' => 'image|mimes:jpg,jpeg,png,webp|max:15360',
        ]);
        $question = Question::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'body' => $request->text,
        ]);
        if ($request->hasFile('img')) {
            foreach ($request->file('img') as $image) {
                $path = $image->store('questions', 'public');

                QuestionImages::create([
                    'question_id' => $question->id,
                    'image' => $path,
                ]);
            }
        }

        if ($request->tags) {
            foreach ($request->tags as $tagName) {

                $slug = Str::slug($tagName);

                $tag = Tags::firstOrCreate(
                    ['slug' => $slug],
                    ['name' => $tagName]
                );

                QuestionTag::create([
                    'question_id' => $question->id,
                    'tag_id' => $tag->id,
                ]);
            }
        }

        return redirect()->route('question.show', $question->id);
    }

    public function delete(Request $request)
    {
        if (Auth::check()) {
            $question = Question::where('id', $request->question_id);

            $images = QuestionImages::where('question_id', $request->question_id)->get();

            foreach ($images as $image) {
                Storage::disk('public')->delete($image->image);
            }

            $question->delete();
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
            return redirect()->route('home');
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
            'body' => 'nullable|min:3',
            'img' => 'nullable|array|max:10',
            'img.*' => 'image|mimes:jpg,jpeg,png,webp|max:15360',
        ]);

        $question = Question::with('question_tags')
            ->findOrFail($request->question_id);

        if (Auth::user()->id !== $question->user_id) {
            return redirect()->route('home');
        }

        $question->title = $request->title;
        $question->body = $request->body;

        $question->save();

        if ($request->has('tags')) {

            QuestionTag::where('question_id', $question->id)->delete();

            foreach ($request->tags as $tagName) {

                $slug = Str::slug($tagName);

                $tag = Tags::firstOrCreate(
                    ['slug' => $slug],
                    ['name' => $tagName]
                );

                QuestionTag::create([
                    'question_id' => $question->id,
                    'tag_id' => $tag->id,
                ]);
            }
        } else {
            QuestionTag::where('question_id', $question->id)->delete();
        }

        if ($request->hasFile('img')) {
            foreach ($request->file('img') as $image) {
                $path = $image->store('questions', 'public');

                QuestionImages::create([
                    'question_id' => $question->id,
                    'image' => $path,
                ]);
            }
        }

        return redirect()->route('question.show', $question->id);
    }

    public function questionImagesRemove(Request $request)
    {
        if (! Auth::check()) {
            return response()->json(['error' => 'Authentification failed!'], 403);
        }

        $image = QuestionImages::where('id', $request->id)->first();
        $questionUser = Question::where('id', $image->question_id)->first();

        if ($questionUser->user_id !== Auth::id()) {
            return response()->json(['error' => 'Validation failed!'], 403);
        }

        Storage::disk('public')->delete($image->image);
        $image->delete();

        return response()->json(['success' => 'Image has removed!']);
    }
}
