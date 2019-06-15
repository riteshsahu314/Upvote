<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];

    public function path()
    {
        return '/questions/' . $this->id;
    }
    
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function addAnswer($answer)
    {
        return $this->answers()->create($answer);
    }
}
