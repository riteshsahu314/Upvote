<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($question) {
            $question->answers->each->delete();
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

    public function addAnswer($answer)
    {
        return $this->answers()->create($answer);
    }

    public function setSlugAttribute($value)
    {
        $slug = Str::slug($value);

        if (static::whereSlug($slug)->exists()) {
            $slug = "${slug}-" . $this->id;
        }

        $this->attributes['slug'] = $slug;
    }
}
