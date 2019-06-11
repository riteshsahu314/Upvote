<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class QuestionTest extends TestCase
{
    use RefreshDatabase;

    protected $question;

    protected function setUp():void
    {
        parent::setUp();

        $this->question = create('App\Question');
    }

    /** @test */
    function it_has_an_owner()
    {
        $this->assertInstanceOf(User::class, $this->question->owner);
    }

    /** @test */
    function it_has_answers()
    {
        $this->assertInstanceOf(Collection::class, $this->question->answers);
    }
}
