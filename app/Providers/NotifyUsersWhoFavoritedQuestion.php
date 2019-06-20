<?php

namespace App\Providers;

use App\Notifications\QuestionWasUpdated;
use App\Providers\QuestionHasNewAnswer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyUsersWhoFavoritedQuestion
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

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
                $favorite->user->notify(new QuestionWasUpdated($event->question, $event->answer));
            }
        }
    }
}
