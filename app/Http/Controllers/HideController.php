<?php

namespace App\Http\Controllers;

use App\Models\HiddenQuestions;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HideController extends Controller
{
    public function hide(Request $request)
    {
        if (! Auth::check()) {
            return response()->json(['error' => 'Authentication failed'], 403);
        }

        $isOwner = Question::where('id', $request->question_id)->first();
        if ($isOwner->user->id === Auth::id()) {
            return response()->json(['error' => 'Cannot hide own post!'], 403);
        }

        $exists = HiddenQuestions::where('user_id', $request->user_id)
            ->where('question_id', $request->question_id)
            ->first();

        if ($exists) {
            $exists->delete();

            return response()->json(['success' => 'Post is unhidden!', 'action' => 'unhide']);
        } else {
            HiddenQuestions::create([
                'user_id' => $request->user_id,
                'question_id' => $request->question_id,
            ]);

            return response()->json(['success' => 'Post is hidden', 'action' => 'hide']);
        }

        return response()->json(['error' => 'Cannot hide post!'], 403);
    }
}
