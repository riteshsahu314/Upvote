<?php

namespace App\Http\Controllers;

use App\Filters\QuestionFilter;
use App\HotQuestions;
use App\Question;
use App\Rules\Recaptcha;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    /**
     * QuestionsController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(QuestionFilter $filter)
    {
        $questions = Question::filter($filter)->paginate(10);

        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Recaptcha $recaptcha
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Recaptcha $recaptcha)
    {
        // validate
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'tagsIds' => 'required|array',
            'g-recaptcha-response' => ['required', $recaptcha]
        ]);

        // save
        $question = $this->createQuestion($request);

        return redirect($question->path())
            ->with(['flash.message' => 'Your question has been posted successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question, HotQuestions $hot_questions)
    {
        $question->increment('view_count');

        $hot_questions->push($question);

        $question = $question->append(['isFavorited', 'favoritesCount']);

        return view('questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $this->authorize('update', $question);

        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'tagsIds' => 'required|array'
        ]);

        $question->update([
            'title' => $request->title,
            'body' => $request->body
        ]);

        $this->syncTags($question, $request->tagsIds);

        return $question->fresh();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $this->authorize('update', $question);

        $question->delete();

        return redirect()
            ->route('questions.index')
            ->with(['flash.message' => 'Your question has been deleted successfully.']);
    }

    /**
     * Sync up the list of tags in the database.
     *
     * @param Question $question
     * @param array $tags
     */
    private function syncTags(Question $question, array $tagsIds)
    {
        $question->tags()->sync($tagsIds);
    }

    /**
     * Save a new Question.
     *
     * @param Request $request
     * @return mixed
     */
    private function createQuestion(Request $request)
    {
        $question = Question::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'body' => $request->body
        ]);

        $this->syncTags($question, $request->tagsIds);

        return $question;
    }
}
