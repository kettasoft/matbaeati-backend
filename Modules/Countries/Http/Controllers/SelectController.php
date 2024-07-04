<?php

namespace Modules\Countries\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;
use Modules\Countries\Entities\City;
use Modules\Countries\Entities\Country;
use Modules\Countries\Http\Filters\SelectFilter;
use Modules\Countries\Transformers\CitySelectResource;
use Modules\Countries\Transformers\CountrySelectResource;
use Modules\Countries\Transformers\GetCountryResource;
use Modules\Countries\Transformers\GetRegionResource;

class SelectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param SelectFilter $filter
     * @return AnonymousResourceCollection
     */
    public function countries(SelectFilter $filter)
    {
        $countries = Country::filter($filter)->get();

        return CountrySelectResource::collection($countries);
    }

    /**
     * Display a listing of the resource.
     *
     * @param SelectFilter $filter
     * @return AnonymousResourceCollection
     */
    public function cities(SelectFilter $filter)
    {
        $countries = City::with('country')->filter($filter)->get();

        return CitySelectResource::collection($countries);
    }

    /**
     * Display a listing of the resource.
     *
     * @param SelectFilter $filter
     * @return AnonymousResourceCollection
     */
    public function getCountries(SelectFilter $filter)
    {
        $countries = Country::filter($filter)->paginate();

        return GetCountryResource::collection($countries);
    }

    /**
     * Display a listing of the resource.
     *
     * @param SelectFilter $filter
     * @param Country $country
     * @return AnonymousResourceCollection
     */
    public function getCities(SelectFilter $filter, Country $country)
    {
        $cities = City::where('country_id', $country->id)->filter($filter)->get();
        return CitySelectResource::collection($cities);
    }

}
