<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    /**
     * AnswersController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question)
    {
        return $question->answers()->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Question $question
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Question $question)
    {
        // validate
        $request->validate([
            'body' => 'required'
        ]);

        // store
//        dd($question->addAnswer([
////            'body' => $request->body,
////            'user_id' => auth()->id()
////        ])->with('owner'));
        return $question->addAnswer([
            'body' => $request->body,
            'user_id' => auth()->id()
        ])->load('owner', 'comments');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Answer $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Answer $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Answer $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        $this->authorize('update', $answer);

        $request->validate([
            'body' => 'required'
        ]);

        $answer->update([
            'body' => $request->body
        ]);

        // return the update answer
        return $answer->fresh();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Answer $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        $this->authorize('update', $answer);

        $answer->delete();
    }

    /**
     *  Mark the answer as Best Answer
     *
     * @param Answer $answer
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function best(Answer $answer)
    {
        $this->authorize('update', $answer->question);

        $answer->question->markBestAnswer($answer);
    }
}
