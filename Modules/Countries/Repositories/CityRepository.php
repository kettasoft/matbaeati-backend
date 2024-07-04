<?php

namespace Modules\Countries\Repositories;

use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Modules\Countries\Entities\City;
use Modules\Countries\Entities\Country;
use Modules\Countries\Http\Filters\CityFilter;

class CityRepository
{
    /**
     * @var CityFilter
     */
    private $filter;

    /**
     * ClientRepository constructor.
     *
     * @param CityFilter $cityFilter
     */
    public function __construct(CityFilter $cityFilter)
    {
        $this->filter = $cityFilter;
    }

    /**
     * Get all cities as a collection.
     *
     * @param Country $country
     * @return LengthAwarePaginator
     */
    public function all(Country $country)
    {
        return $country->cities()
            ->filter($this->filter)
            ->paginate(request('perPage'));
    }

    /**
     * Save the created city to storage.
     *
     * @param Country $country
     * @param array $data
     * @return Model
     */
    public function create(Country $country, array $data)
    {
        return $country->cities()->create($data);
    }

    /**
     * Display the given country instance.
     *
     * @param mixed $model
     * @return City
     */
    public function find($model)
    {
        if ($model instanceof City) {
            return $model;
        }

        return City::findOrFail($model);
    }

    /**
     * Update the given city in the storage.
     *
     * @param City $city
     * @param array $data
     * @return Model
     */
    public function update(City $city, array $data)
    {
        $city->update($data);

        return $city;
    }

    /**
     * Delete the given city from storage.
     *
     * @param City $city
     * @return void
     * @throws Exception
     */
    public function delete(City $city)
    {
        $city->delete();
    }
}
