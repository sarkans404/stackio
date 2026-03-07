<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(){
        return view('question-create');
    }

    public function create(){

    }
}
