<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = ['user_id', 'vote_types_id'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($vote) {
            if ($vote->type->name == 'UpVote') {
                $vote->voteable->increment('score');
            } else if ($vote->type->name == 'DownVote') {
                $vote->voteable->decrement('score');
            }
        });
    }

    public function voteable()
    {
        return $this->morphTo();
    }

    public function type()
    {
        return $this->belongsTo(VoteType::class, 'vote_types_id');
    }
}
