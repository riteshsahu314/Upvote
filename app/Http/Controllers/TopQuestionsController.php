<?php

namespace App\Http\Controllers;

use App\Question;

class TopQuestionsController extends Controller
{
    public function index()
    {
        $questions = Question::latest()
            ->orderBy('view_count', 'desc')
            ->orderBy('answers_count', 'desc')
            ->orderBy('score', 'desc')
            ->take(30)->get();

        return view('top_questions' , compact('questions'));
    }
}
