<?php

namespace App\Http\Controllers;

use App\Models\Follows;
use App\Models\Notifications;
use App\Models\Question;
use App\Models\Reports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function index(Request $request)
    {
        Reports::create([
            'user_id' => Auth::id(),
            'question_id' => $request->question_id,
        ]);

        $question = Question::find($request->question_id);

        if ($question->user_id !== Auth::id()) {
            Notifications::create([
                'user_id' => $question->user_id,
                'actor_id' => Auth::id(),
                'notifiable_id' => $question->id,
                'notifiable_type' => 'question',
                'type' => 'question_reported',
            ]);
        }
    }

    public function toggle(Request $request)
    {
        if (! Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $exists = Follows::where('user_id', Auth::id())
            ->where('question_id', $request->question_id)
            ->first();

        if ($exists) {
            $exists->delete();

            return response()->json([
                'status' => 'unfollowed',
            ]);
        }

        Follows::create([
            'user_id' => Auth::id(),
            'question_id' => $request->question_id,
        ]);

        return response()->json([
            'status' => 'followed',
        ]);
    }
}
