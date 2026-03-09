<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Responses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'body' => 'required|min:3',
        ]);

        Responses::create([
            'user_id' => Auth::id(),
            'question_id' => $request->question_id,
            'parent_id' => $request->parent_id,
            'body' => $request->body,
        ]);
        $question = Question::findOrFail($request->question_id);
        $question->answers += 1;
        $question->save();

        return redirect()->route('question.show', $request->question_id);
    }
}
