<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class AnswerHasNewComment
{
    use SerializesModels;
    public $answer;
    public $comment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($answer, $comment)
    {
        $this->answer = $answer;
        $this->comment = $comment;
    }
}
