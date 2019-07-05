<?php


namespace App\Filters;


use Illuminate\Http\Request;

abstract class Filters
{
    protected $request, $builder;

    protected $default = 'new';

    /**
     * QuestionFilters constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder)
    {
        $this->builder = $builder;

        if ($this->request->has('sortBy')) {
            // apply the requested filter
            $filter = $this->request->sortBy;
        } else {
            // apply the default filter
            $filter = $this->default;
        }

        if (method_exists($this , $filter)) {
            $this->$filter();
        }
    }

    /**
     * Sort the model by the given column and order
     *
     * @param String $column
     * @return mixed
     */
    protected function sortBy(String $column, $order = 'desc')
    {
        return $this->builder->orderBy($column, $order);
    }

    /**
     * Sort the model by creation time
     *
     */
    protected function new()
    {
        $this->sortBy('created_at');
    }
}
