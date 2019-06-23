<?php

namespace App\Listeners;

use App\Events\AnswerHasNewComment;
use App\Notifications\AnswerReceivedCommentNotification;

class NotifyAnswerOwnerAboutComment
{
    /**
     * Handle the event.
     *
     * @param  AnswerHasNewComment  $event
     * @return void
     */
    public function handle(AnswerHasNewComment $event)
    {
        // Prepare notification for answer owner
        // except if the owner itself commented on the answer
        if ($event->answer->owner->id != $event->comment->owner->id) {
            $event->answer->owner->notify(new AnswerReceivedCommentNotification($event->answer, $event->comment));
        }
    }
}
