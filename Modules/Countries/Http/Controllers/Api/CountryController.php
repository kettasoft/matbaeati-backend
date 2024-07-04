<?php

namespace Modules\Countries\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Modules\Countries\Entities\Country;
use Modules\Countries\Http\Filters\CityFilter;
use Modules\Countries\Repositories\CountryRepository;
use Modules\Countries\Transformers\CountryResource;
use Modules\Support\Traits\ApiTrait;

class CountryController extends Controller
{
    use AuthorizesRequests, ValidatesRequests, ApiTrait;

    /**
     * @var \Modules\Countries\Repositories\CountryRepository
     */
    private $repository;

    /**
     * CountryController constructor.
     *
     * @param \Modules\Countries\Repositories\CountryRepository $repository
     */
    public function __construct(CountryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the countries.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $countries = $this->repository->all();

        if (count($countries) > 0) {
            $data = CountryResource::collection($countries)->response()->getData(true);
            return $this->sendResponse($data, 'success');
        }

        return $this->sendError('Sorry not found');
    }

    /**
     * Display the specified country.
     *
     * @param \Modules\Countries\Entities\Country $country
     * @param \Modules\Countries\Http\Filters\CityFilter $filter
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Country $country, CityFilter $filter)
    {
        if ($country) {
            $country = $this->repository->find($country);

            $data = new CountryResource($country);
            return $this->sendResponse($data, 'success');
        }

        return $this->sendError('Sorry not found');
    }

    /**
     * Display the specified country.
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function default()
    {
        $country = Country::with('cities')->default()->firstOrFail();

        $country = $this->repository->find($country);

        if ($country) {
            $country = $this->repository->find($country);

            $data = new CountryResource($country);
            return $this->sendResponse($data, 'success');
        }

        return $this->sendError('Sorry not found');
    }
}
