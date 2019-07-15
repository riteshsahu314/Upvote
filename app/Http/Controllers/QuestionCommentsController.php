<?php

namespace App\Http\Controllers;

use App\Comment;
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
            ->with(['flash.message' => 'Comment published.']);
    }

    public function destroy(Question $question, Comment $comment)
    {
        $this->authorize('update', $comment);

        $comment->delete();

        return redirect($question->path());
    }
}
