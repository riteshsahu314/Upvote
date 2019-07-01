<?php


namespace App\Filters;


class TagFilter extends Filters
{
    protected $default = 'name';

    protected function name()
    {
        $this->sortBy('name', 'asc');
    }
}
