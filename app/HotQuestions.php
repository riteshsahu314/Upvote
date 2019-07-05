<?php


namespace App;


use Illuminate\Support\Facades\Redis;

class HotQuestions
{
    private function cacheKey()
    {
        return 'hot_questions';
    }

    public function get() {
         return array_map('json_decode', Redis::zrevrange($this->cacheKey(), 0, 9));
    }

    public function push($question)
    {
        Redis::zincrby($this->cacheKey(), 1, json_encode([
            'title' => $question->title,
            'link' => $question->path()
        ]));
    }
}
