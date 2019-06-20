<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    // Relationships to eager load
    protected $with = ['owner'];

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
