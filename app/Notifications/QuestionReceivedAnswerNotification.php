<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class QuestionReceivedAnswerNotification extends Notification
{
    use Queueable;
    protected $question;
    protected $answer;

    /**
     * Create a new notification instance.
     *
     * @param $question
     * @param $answer
     */
    public function __construct($question, $answer)
    {
        $this->question = $question;
        $this->answer = $answer;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];    // TODO: make it mail also
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => $this->answer->owner->name . ' answered to ' . $this->question->title,
            'link' => $this->answer->path()
        ];
    }
}
