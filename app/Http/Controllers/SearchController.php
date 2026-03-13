<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|min:2',
        ]);

        $questions = Question::with('user', 'images')
            ->where('title', 'like', '%'.$request->search.'%')
            ->paginate(20);

        $questionsQty = Question::count();

        return view('search', compact('questions', 'questionsQty'));
    }
}
