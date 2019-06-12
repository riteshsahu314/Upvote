<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReadQuestionsTest extends TestCase
{
    use RefreshDatabase;

    protected $question;

    protected function setUp():void
    {
        parent::setUp();
        $this->question = create('App\Question');
    }

    /** @test */
    function a_user_can_browse_all_questions()
    {
        $this->get(route('questions.index'))
            ->assertSee($this->question->title);
    }
    
    /** @test */
    function a_user_can_read_single_question()
    {
        $this->get(route('questions.show', $this->question))
            ->assertSee($this->question->title);
    }

    /** @test */
    function a_user_can_read_answers_that_are_associated_with_a_question()
    {
        $answer = create('App\Answer', ['question_id' => $this->question->id]);

        $this->get(route('questions.show', $this->question))
            ->assertSee($answer->body);
    }
}
