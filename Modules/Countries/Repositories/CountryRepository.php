<?php

namespace Modules\Countries\Repositories;

use Modules\Contracts\CrudRepository;
use Modules\Countries\Entities\Country;
use Modules\Countries\Http\Filters\CountryFilter;

class CountryRepository implements CrudRepository
{
    /**
     * @var \Modules\Countries\Http\Filters\CountryFilter
     */
    private $filter;

    /**
     * CountryRepository constructor.
     *
     * @param \Modules\Countries\Http\Filters\CountryFilter $filter
     */
    public function __construct(CountryFilter $filter)
    {
        $this->filter = $filter;
    }

    /**
     * Get all countries as a collection.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function all()
    {
        return Country::filter($this->filter)->paginate(request('perPage'));
    }

    /**
     * Save the created model to storage.
     *
     * @param array $data
     * @return \Modules\Countries\Entities\Country
     */
    public function create(array $data)
    {
        /** @var Country $country */
        $country = Country::create($data);

        $country->addAllMediaFromTokens($data['flag'] ?? [], 'flags');

        return $country;
    }

    /**
     * Display the given country instance.
     *
     * @param mixed $model
     * @return \Modules\Countries\Entities\Country
     */
    public function find($model)
    {
        if ($model instanceof Country) {
            return $model;
        }

        return Country::findOrFail($model);
    }

    /**
     * Update the given country in the storage.
     *
     * @param mixed $model
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($model, array $data)
    {
        $country = $this->find($model);

        $country->update($data);

        $country->addAllMediaFromTokens($data['flag'] ?? [], 'flags');

        return $country;
    }

    /**
     * Delete the given country from storage.
     *
     * @param mixed $model
     * @return void
     * @throws \Exception
     */
    public function delete($model)
    {
        $this->find($model)->delete();
    }
}
