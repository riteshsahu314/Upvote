<?php


namespace App\Filters;


class QuestionFilter extends Filters
{
    /**
     * Get the questions with most votes
     *
     */
    protected function votes()
    {
        $this->sortBy('score');
    }

    /**
     * Get the popular questions i.e. the questions with most answers
     *
     */
    protected function popular()
    {
        $this->sortBy('answers_count');
    }
}
