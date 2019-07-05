<?php

namespace App\Http\Controllers;

use App\HotQuestions;
use App\Question;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function show(Request $request)
    {
        $query = $request['q'];

        $questions = Question::search($query)->paginate(20);

        if ($request->expectsJson()) {
            return $questions;
        }

        return view('questions.index', compact('questions'));
    }
}
