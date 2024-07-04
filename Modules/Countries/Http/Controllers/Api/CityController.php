<?php

namespace Modules\Countries\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\Countries\Entities\Country;
use Modules\Countries\Repositories\CityRepository;
use Modules\Countries\Transformers\GetCityResource;
use Modules\Support\Traits\ApiTrait;

class CityController extends Controller
{
    use AuthorizesRequests, ValidatesRequests, ApiTrait;

    /**
     * @var CityRepository
     */
    private CityRepository $repository;

    /**
     * CountryController constructor.
     *
     * @param CityRepository $repository
     */
    public function __construct(CityRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the countries.
     *
     * @return JsonResponse
     */
    public function index(Country $country): JsonResponse
    {
        $cities = $this->repository->all($country);

        if (count($cities) > 0) {
            $data = GetCityResource::collection($cities)->response()->getData(true);
            return $this->sendResponse($data, 'success');
        }

        return $this->sendError('Sorry not found');
    }

//    /**
//     * Display the specified country.
//     *
//     * @param City $city
//     * @param CityFilter $filter
//     * @return JsonResponse
//     */
//    public function show(City $city, CityFilter $filter): JsonResponse
//    {
//        if ($city) {
//            $city = $this->repository->find($city);
//
//            $data = new GetCityResource($city);
//            return $this->sendResponse($data, 'success');
//        }
//
//        return $this->sendError('Sorry not found');
//    }
}
