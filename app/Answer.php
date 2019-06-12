<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    // Relationships to eager load
    protected $with = ['owner'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($ansewr) {
            $ansewr->question->increment('answers_count');
        });
    }

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function question()
    {
        return $this->belongsTo('App\Question');
    }
}
