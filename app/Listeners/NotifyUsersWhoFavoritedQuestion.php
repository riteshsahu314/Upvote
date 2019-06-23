<?php

namespace App\Listeners;

use App\Events\QuestionHasNewAnswer;
use App\Notifications\QuestionReceivedAnswerNotification;

class NotifyUsersWhoFavoritedQuestion
{
    /**
     * Handle the event.
     *
     * @param  QuestionHasNewAnswer  $event
     * @return void
     */
    public function handle(QuestionHasNewAnswer $event)
    {
        // Prepare notification for all users who favorited the question
        // except the user who answered to the question
        foreach ($event->question->favorites as $favorite) {
            if ($favorite->user_id != $event->answer->user_id) {
                $favorite->user->notify(new QuestionReceivedAnswerNotification($event->question, $event->answer));
            }
        }
    }
}
