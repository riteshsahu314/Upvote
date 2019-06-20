<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class QuestionCommentsController extends Controller
{
    public function store(Request $request, Question $question)
    {
        $request->validate([
            'body' => 'required'
        ]);

        $question->addComment([
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        return redirect($question->path())
            ->with('flash', 'Comment published.');
    }
}
