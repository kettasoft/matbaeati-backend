<?php

namespace Modules\Countries\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\Countries\Entities\City;
use Modules\Countries\Entities\Country;
use Modules\Countries\Http\Requests\CityRequest;
use Modules\Countries\Repositories\CityRepository;

class CityController extends Controller
{
    use AuthorizesRequests;

    /**
     * @var CityRepository
     */
    private $repository;


    /**
     * CityController constructor.
     *
     * @param CityRepository $repository
     */
    public function __construct(CityRepository $repository)
    {
        $this->middleware('permission:read_cities')->only(['index']);
        $this->middleware('permission:create_cities')->only(['create', 'store']);
        $this->middleware('permission:update_cities')->only(['edit', 'update']);
        $this->middleware('permission:delete_cities')->only(['destroy']);
        $this->middleware('permission:show_cities')->only(['show']);
        $this->repository = $repository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CityRequest $request
     * @param Country $country
     * @return RedirectResponse
     */
    public function store(CityRequest $request, Country $country)
    {
        $this->repository->create($country, $request->all());

        flash(trans('countries::cities.messages.created'))->success();

        return redirect()->route('dashboard.countries.show', $country);
    }

    /**
     * Display the specified resource.
     *
     * @param Country $country
     * @param City $city
     * @return Application|Factory|View
     */
    public function show(Country $country, City $city)
    {
        $city = $this->repository->find($city);

        return view('countries::cities.show', compact('country', 'city'));
    }

    /**
     * Display the city edit form.
     *
     * @param Country $country
     * @param City $city
     * @return Application|Factory|View
     */
    public function edit(Country $country, City $city)
    {
        return view('countries::cities.edit', compact('country', 'city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CityRequest $request
     * @param Country $country
     * @param City $city
     * @return RedirectResponse
     */
    public function update(CityRequest $request, Country $country, City $city)
    {
        $this->repository->update($city, $request->all());

        flash(trans('countries::cities.messages.updated'))->success();

        return redirect()->route('dashboard.countries.show', $country);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Country $country
     * @param City $city
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Country $country, City $city)
    {
        $this->repository->delete($city);

        flash(trans('countries::cities.messages.deleted'))->error();

        return redirect()->route('dashboard.countries.show', $country);
    }
}
