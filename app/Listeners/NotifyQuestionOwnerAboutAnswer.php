<?php

namespace App\Listeners;

use App\Events\QuestionHasNewAnswer;
use App\Notifications\QuestionReceivedAnswerNotification;

class NotifyQuestionOwnerAboutAnswer
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
            $event->question->owner->notify(new QuestionReceivedAnswerNotification($event->question, $event->answer));
        }
    }
}
