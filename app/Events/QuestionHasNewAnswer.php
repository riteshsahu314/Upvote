<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class QuestionHasNewAnswer
{
    use SerializesModels;
    public $question;
    public $answer;

    /**
     * Create a new event instance.
     *
     * @param \App\Question $question
     * @param \App\Answer $answer
     */
    public function __construct($question, $answer)
    {
        //
        $this->question = $question;
        $this->answer = $answer;
    }
}
