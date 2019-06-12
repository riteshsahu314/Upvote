<?php

namespace Tests\Feature;

use App\Answer;
use App\Question;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AnswerTest extends TestCase
{
    use RefreshDatabase;

    protected $answer;

    protected function setUp():void
    {
        parent::setUp();
        $this->answer = create(Answer::class);
    }

    /** @test */
    function it_has_an_owner()
    {
        $this->assertInstanceOf(User::class, $this->answer->owner);
    }
    
    /** @test */
    function it_belongs_to_a_question()
    {
        $this->assertInstanceOf(Question::class, $this->answer->question);
    }
}
