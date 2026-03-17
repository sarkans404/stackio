<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Responses;
use App\Models\Votes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function vote(Request $request)
    {
        if (! Auth::check()) {
            return response()->json(['error' => 'Authentication failed!'], 403);
        }

        $response = Responses::find($request->response_id);
        $question = Question::find($request->question_id);

        $userVote = null;

        if ($response && $response->user_id == Auth::id()) {
            return response()->json(['error' => 'Cannot vote own response!'], 403);
        }

        if ($question && $question->user_id == Auth::id()) {
            return response()->json(['error' => 'Cannot vote own question!'], 403);
        }

        if ($response) {

            $existing = Votes::where('user_id', Auth::id())
                ->where('votable_id', $response->id)
                ->where('votable_type', 'response')
                ->first();

            if ($existing) {

                if ($existing->type === $request->type) {

                    $existing->delete();

                    if ($request->type === 'up') {
                        $response->decrement('upvotes');
                    } else {
                        $response->decrement('downvotes');
                    }

                    $userVote = null;

                } else {

                    if ($request->type === 'up') {
                        $response->increment('upvotes');
                        $response->decrement('downvotes');
                    } else {
                        $response->increment('downvotes');
                        $response->decrement('upvotes');
                    }

                    $existing->type = $request->type;
                    $existing->save();

                    $userVote = $request->type;
                }

            } else {

                Votes::create([
                    'user_id' => Auth::id(),
                    'votable_id' => $response->id,
                    'votable_type' => 'response',
                    'type' => $request->type,
                ]);

                if ($request->type === 'up') {
                    $response->increment('upvotes');
                } else {
                    $response->increment('downvotes');
                }

                $userVote = $request->type;
            }

            return response()->json([
                'upvotes' => $response->upvotes,
                'downvotes' => $response->downvotes,
                'user_vote' => $userVote,
            ]);
        }

        if ($question) {

            $existing = Votes::where('user_id', Auth::id())
                ->where('votable_id', $question->id)
                ->where('votable_type', 'question')
                ->first();

            if ($existing) {

                if ($existing->type === $request->type) {

                    $existing->delete();

                    if ($request->type === 'up') {
                        $question->decrement('upvotes');
                    } else {
                        $question->decrement('downvotes');
                    }

                    $userVote = null;

                } else {

                    if ($request->type === 'up') {
                        $question->increment('upvotes');
                        $question->decrement('downvotes');
                    } else {
                        $question->increment('downvotes');
                        $question->decrement('upvotes');
                    }

                    $existing->type = $request->type;
                    $existing->save();

                    $userVote = $request->type;
                }

            } else {

                Votes::create([
                    'user_id' => Auth::id(),
                    'votable_id' => $question->id,
                    'votable_type' => 'question',
                    'type' => $request->type,
                ]);

                if ($request->type === 'up') {
                    $question->increment('upvotes');
                } else {
                    $question->increment('downvotes');
                }

                $userVote = $request->type;
            }

            return response()->json([
                'upvotes' => $question->upvotes,
                'downvotes' => $question->downvotes,
                'user_vote' => $userVote,
            ]);
        }

        return response()->json(['error' => 'Cannot vote post!'], 403);
    }
}
