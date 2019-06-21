<?php

namespace App\Http\Controllers;

use App\Answer;

class AnswerVotesController extends Controller
{
    //
    /**
     * QuestionVotesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Answer $answer, $type)
    {
        if ($type == 'UpVote') {
            if (!$answer->upvote()) {
                return redirect()->back()->with([
                    'flash.message' => 'You have already up voted the answer.',
                    'flash.type' => 'danger'
                ]);
            }
        } else if ($type == 'DownVote') {
            if (! $answer->downvote()) {
                return redirect()->back()->with([
                    'flash.message' => 'You have already down voted the answer.',
                    'flash.type' => 'danger'
                ]);
            }
        }

        return redirect()->back();
    }
}
