<?php

namespace App;

use App\Events\QuestionHasNewAnswer;
use App\Events\QuestionHasNewComment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Stevebauman\Purify\Facades\Purify;

class Question extends Model
{
    use RecordsActivity, Voteable;

    protected $guarded = [];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['owner'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($question) {
            $question->answers->each->delete();
            $question->comments->each->delete();
            $question->favorites->each->delete();
        });

        static::created(function ($question){
            $question->update(['slug' => $question->title]);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function path()
    {
        return '/questions/' . $this->slug;
    }
    
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * Get all of the question's comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function addAnswer($answer)
    {
        $answer = $this->answers()->create($answer);

        event(new QuestionHasNewAnswer($this, $answer));

        return $answer;
    }

    public function addComment($comment)
    {
        $comment = $this->comments()->create($comment);

        event(new QuestionHasNewComment($this, $comment));
    }

    public function markBestAnswer(Answer $answer)
    {
        $this->update(['best_answer_id' => $answer->id]);
    }

    public function favorites()
    {
        return $this->hasMany('App\Favorite');
    }

    public function isFavorited()
    {
        return !! $this->favorites()->where('user_id', auth()->id())->count();
    }

    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }

    public function getFavoritesCountAttribute()
    {
        return $this->favorites()->count();
    }

    public function favorite()
    {
        $attributes =['user_id' => auth()->id()];

        if (!$this->favorites()->where($attributes)->exists()) {
            // this will prevent the user from favoriting a question more than once
            $this->favorites()->create($attributes);
        }
    }

    public function unfavorite()
    {
        $attributes =['user_id' => auth()->id()];

        if ($this->favorites()->where($attributes)->exists()) {
            // this will prevent the user from unfavoriting an unfavorited question
            $this->favorites()->where($attributes)->delete();
        }
    }

    public function setSlugAttribute($value)
    {
        $slug = Str::slug($value);

        if (static::whereSlug($slug)->exists()) {
            $slug = "${slug}-" . $this->id;
        }

        $this->attributes['slug'] = $slug;
    }

    public function getBodyAttribute($body)
    {
        return Purify::clean($body);
    }
}
