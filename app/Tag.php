<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Tag extends Model
{
    use Searchable, Filterable;

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }
}
