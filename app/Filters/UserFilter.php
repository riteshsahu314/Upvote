<?php


namespace App\Filters;


class UserFilter extends Filters
{
    protected $default = 'name';

    protected function name()
    {
        $this->sortBy('name', 'asc');
    }
}
