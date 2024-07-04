<?php

namespace Modules\Countries\Http\Filters;

use App\Http\Filters\BaseFilters;

class CountryFilter extends BaseFilters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [
        'name',
        'code',
        'key',
    ];

    /**
     * Filter the query by a given name.
     *
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function name($value)
    {
        if ($value) {
            return $this->builder->whereTranslationLike('name', "%$value%");
        }

        return $this->builder;
    }

    /**
     * Filter the query by a given code.
     *
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function code($value)
    {
        if ($value) {
            return $this->builder->where('code', 'like', "%$value%");
        }

        return $this->builder;
    }

    /**
     * Filter the query by a given key.
     *
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function key($value)
    {
        if ($value) {
            return $this->builder->where('key', 'like', "%$value%");
        }

        return $this->builder;
    }
}
