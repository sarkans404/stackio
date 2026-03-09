<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index($id)
    {
        $question = Question::with([
            'user',
            'images',
            'responses.user',
            'responses.children.user',
        ])->findOrFail($id);
        $questionsQty = Question::count();

        return view('question', compact('question', 'questionsQty'));
    }

    public function createShow()
    {
        return view('question-create');
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

        return redirect()->route('question.show', $question->id);
    }
}
