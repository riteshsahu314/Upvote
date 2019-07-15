<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Comment;
use Illuminate\Http\Request;

class AnswerCommentsController extends Controller
{
    public function store(Request $request, Answer $answer)
    {
        $request->validate([
            'body' => 'required'
        ]);

        $answer->addComment([
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        return redirect($answer->path())
            ->with('flash', 'Comment published.');
    }

    public function destroy(Answer $answer, Comment $comment)
    {
        $this->authorize('update', $comment);

        $comment->delete();

        return redirect($answer->path());
    }
}
