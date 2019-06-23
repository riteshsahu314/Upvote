<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Stevebauman\Purify\Facades\Purify;

class Answer extends Model
{
    use RecordsActivity, Voteable;

    // Allow Mass Assignment
    protected $guarded = [];

    // Relationships to eager load
    protected $with = ['owner', 'comments'];

    /**
     * The accessors to append to the model's array or json form.
     *
     * @var array
     */
    protected $appends = ['isBest'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($ansewr) {
            $ansewr->question->increment('answers_count');
        });
    }

    public function path()
    {
        return $this->question->path() . "#answer-{$this->id}";
    }

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function question()
    {
        return $this->belongsTo('App\Question');
    }

    /**
     * Get all of the answer's comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }


    public function addComment($comment)
    {
        $this->comments()->create($comment);
    }

    public function isBest()
    {
        return $this->question->best_answer_id == $this->id;
    }

    public function getIsBestAttribute()
    {
        return $this->isBest();
    }

    public function getBodyAttribute($body)
    {
        return Purify::clean($body);
    }
}
