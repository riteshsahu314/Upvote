<?php


namespace App;


trait Filterable
{
    public function scopeFilter($query, $filter)
    {
        // apply the filter to the query
        return $filter->apply($query);
    }
}
