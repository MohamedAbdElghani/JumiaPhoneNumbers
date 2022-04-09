<?php
namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * The Eloquent builder.
     *
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $builder;

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [];

    /**
     * Registered requested filters to operate upon.
     *
     * @var array
     */
    protected $requestedFilters = [];

    /**
     * Create a new ThreadFilters instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply the filters.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply($builder, $params = [])
    {
        $this->builder = $builder;

        $this->requestedFilters = $params;

        foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                logger("Export call function $filter");
                $this->$filter($value);
            }
        }
        return $this->builder;
    }

    /**
     * Fetch all relevant filters from the request.
     *
     * @return array
     */
    public function getFilters()
    {
        if (empty($this->requestedFilters)) {
            $this->requestedFilters = array_filter($this->request->only($this->filters));
        }
        return $this->requestedFilters;
    }
}
