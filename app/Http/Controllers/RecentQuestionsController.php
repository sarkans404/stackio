<?php

namespace App\Http\Controllers;

use App\Models\RecentQuestions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecentQuestionsController extends Controller
{
    public function index(Request $request)
    {
        if (! Auth::check()) {
            return response()->json(['erorr' => 'Authentication failed'], 403);
        }
        RecentQuestions::where('user_id', $request->user_id)->delete();

        return response()->json(['success' => 'Latest posts deleted!']);
    }
}
