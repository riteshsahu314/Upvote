<?php

namespace App\Listeners;

use App\Events\QuestionHasNewAnswer;
use App\Notifications\QuestionWasUpdated;

class NotifyQuestionOwner
{
    /**
     * Handle the event.
     *
     * @param  QuestionHasNewAnswer  $event
     * @return void
     */
    public function handle(QuestionHasNewAnswer $event)
    {
        // Prepare notification for question owner
        // except if the owner itself answered the question
        if ($event->question->owner->id != $event->answer->owner->id) {
            $event->question->owner->notify(new QuestionWasUpdated($event->question, $event->answer));
        }
    }
}
