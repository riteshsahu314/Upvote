<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class QuestionVotesController extends Controller
{
    //
    /**
     * QuestionVotesController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function store(Question $question, $type)
    {
        if ($type == 'UpVote') {
            if (!$question->upvote()) {
                return redirect()->back()->with([
                    'flash.message' => 'You have already up voted the question.',
                    'flash.type' => 'danger'
                ]);
            }
        } else if ($type == 'DownVote') {
            if (! $question->downvote()) {
                return redirect()->back()->with([
                    'flash.message' => 'You have already down voted the question.',
                    'flash.type' => 'danger'
                ]);
            }
        }

        return redirect()->back();
    }
}
