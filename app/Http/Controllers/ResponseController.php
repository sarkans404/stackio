<?php

namespace App\Http\Controllers;

use App\Models\Follows;
use App\Models\Notifications;
use App\Models\Question;
use App\Models\Responses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ResponseController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'body' => 'required|min:3',
            'file' => 'sometimes|image|mimes:jpg,jpeg,png,webp|max:2000',
        ]);
        if ($request->hasFile('file')) {
            $path = $request->file('file')
                ->store('responses', 'public');

            $response = Responses::create([
                'user_id' => Auth::id(),
                'question_id' => $request->question_id,
                'parent_id' => $request->parent_id,
                'body' => $request->body,
                'image' => $path,
            ]);
        } else {
            $response = Responses::create([
                'user_id' => Auth::id(),
                'question_id' => $request->question_id,
                'parent_id' => $request->parent_id,
                'body' => $request->body,
            ]);
        }

        $question = Question::findOrFail($request->question_id);
        if ($request->parent_id === null) {
            $question->answers += 1;
            $question->save();
        }

        if (! $request->parent_id) {

            $followers = Follows::where('question_id', $request->question_id)
                ->where('user_id', '!=', Auth::id())
                ->pluck('user_id');

            foreach ($followers as $userId) {
                Notifications::create([
                    'user_id' => $userId,
                    'actor_id' => Auth::id(),
                    'notifiable_id' => $response->id,
                    'notifiable_type' => 'response',
                    'type' => 'new_response',
                ]);
            }
        }
        if ($request->parent_id) {

            $parent = Responses::find($request->parent_id);

            if ($parent && $parent->user_id !== Auth::id()) {
                Notifications::create([
                    'user_id' => $parent->user_id,
                    'actor_id' => Auth::id(),
                    'notifiable_id' => $response->id,
                    'notifiable_type' => 'responses',
                    'type' => 'new_comment',
                ]);
            }
        }

        return redirect()->route('question.show', $request->question_id);
    }

    public function delete(Request $request)
    {
        $response = Responses::findOrFail($request->response_id);
        if ($response->user_id === Auth::id() || Auth::user()->role === 'admin') {
            if ($response->image) {
                Storage::disk('public')->delete($response->image);
            }
            Responses::where('id', $request->response_id)->delete();
        }

        $question = Question::findOrFail($request->question_id);
        if ($response->parent_id === null) {
            $question->answers -= 1;
            $question->save();
        }

        return redirect()->route('question.show', $request->question_id);
    }

    public function edit(Request $request)
    {
        $request->validate([
            'body' => 'required|min:3',
            'file' => 'sometimes|image|mimes:jpg,jpeg,png,webp|max:2000',
        ]);

        $response = Responses::findOrFail($request->response_id);

        if ($response->user_id === Auth::id()) {
            $response->body = $request->body;
            $response->is_edited = true;

            if ($request->remove_image == '1') {
                if ($response->image) {
                    Storage::disk('public')->delete($response->image);
                    $response->image = null;
                }
            } elseif ($request->hasFile('file')) {
                if ($response->image) {
                    Storage::disk('public')->delete($response->image);
                }

                $path = $request->file('file')->store('responses', 'public');
                $response->image = $path;
            }

            $response->save();
        }

        return redirect()->route('question.show', $request->question_id);
    }

    public function markAsAccepted(Request $request)
    {
        if (! Auth::id()) {
            return redirect()->route('login');
        }

        $response = Responses::findOrFail($request->responses_id);
        $response->is_accepted = ! $response->is_accepted;
        $response->save();

        return redirect()->route('question.show', $request->question_id);
    }
}
