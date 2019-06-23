<?php

namespace App\Listeners;

use App\Events\QuestionHasNewComment;
use App\Notifications\QuestionReceivedCommentNotification;

class NotifyQuestionOwnerAboutComment
{
    /**
     * Handle the event.
     *
     * @param  QuestionHasNewComment  $event
     * @return void
     */
    public function handle(QuestionHasNewComment $event)
    {
        // Prepare notification for question owner
        // except if the owner itself commented on the question
        if ($event->question->owner->id != $event->comment->owner->id) {
            $event->question->owner->notify(new QuestionReceivedCommentNotification($event->question, $event->comment));
        }
    }
}
