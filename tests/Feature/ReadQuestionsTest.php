<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReadQuestionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_can_browse_all_questions()
    {
        $question = create('App\Question');

        $this->get(route('questions.index'))
            ->assertSee($question->title);
    }
}
