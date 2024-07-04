<?php


namespace Modules\Countries\Entities\Scopes;


use Illuminate\Database\Eloquent\Builder;

trait CountryScopes
{
    /**
     * Scope the query to include only default country.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDefault(Builder $builder)
    {
        return $builder->where('is_default', true);
    }
}
