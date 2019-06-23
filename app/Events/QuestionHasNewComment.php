<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class QuestionHasNewComment
{
    use SerializesModels;
    public $question;
    public $comment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($question, $comment)
    {

        $this->question = $question;
        $this->comment = $comment;
    }
}
