<?php

namespace App\Http\Controllers;

use App\Models\SavedQuestions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaveController extends Controller
{
    public function save(Request $request)
    {
        if (! Auth::check()) {
            return response()->json(['error' => 'Authentication failed'], 403);
        }

        $exist = SavedQuestions::where('user_id', $request->user_id)
            ->where('question_id', $request->question_id)
            ->first();

        if ($exist) {
            $exist->delete();

            return response()->json(['success' => 'Post unsaved!', 'action' => 'unsaved']);
        } else {
            SavedQuestions::create([
                'user_id' => $request->user_id,
                'question_id' => $request->question_id,
            ]);

            return response()->json(['success' => 'Post saved!', 'action' => 'saved']);
        }

        return response()->json(['error' => 'Cannot save post!'], 403);
    }
}
