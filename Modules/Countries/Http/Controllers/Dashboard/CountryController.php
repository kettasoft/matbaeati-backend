<?php

namespace Modules\Countries\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\Countries\Entities\Country;
use Modules\Countries\Http\Requests\CountryRequest;
use Modules\Countries\Repositories\CityRepository;
use Modules\Countries\Repositories\CountryRepository;

class CountryController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @var CountryRepository
     */
    private $repository;

    /**
     * @var CityRepository
     */
    private $cityRepository;


    /**
     * CountryController constructor.
     *
     * @param CountryRepository $repository
     * @param CityRepository $cityRepository
     */
    public function __construct(CountryRepository $repository, CityRepository $cityRepository)
    {
        $this->middleware('permission:read_countries')->only(['index']);
        $this->middleware('permission:create_countries')->only(['create', 'store']);
        $this->middleware('permission:update_countries')->only(['edit', 'update']);
        $this->middleware('permission:delete_countries')->only(['destroy']);
        $this->middleware('permission:show_countries')->only(['show']);

        $this->repository = $repository;
        $this->cityRepository = $cityRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $countries = $this->repository->all();

        return view('countries::countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('countries::countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CountryRequest $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(CountryRequest $request)
    {
        $country = $this->repository->create($request->all());

        flash(trans('countries::countries.messages.created'))->success();

        return redirect()->route('dashboard.countries.show', $country);
    }

    /**
     * Display the specified resource.
     *
     * @param Country $country
     * @return Application|Factory|View
     * @throws AuthorizationException
     * @throws Exception
     */
    public function show(Country $country)
    {
        $country = $this->repository->find($country);

        $cities = $this->cityRepository->all($country);

        return view('countries::countries.show', compact('country', 'cities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Country $country
     * @return Application|Factory|View
     */
    public function edit(Country $country)
    {
        return view('countries::countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CountryRequest $request
     * @param Country $country
     * @return RedirectResponse
     */
    public function update(CountryRequest $request, Country $country)
    {
        $country = $this->repository->update($country, $request->all());

        flash(trans('countries::countries.messages.updated'))->success();

        return redirect()->route('dashboard.countries.show', $country);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Country $country
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Country $country)
    {
        if ($country->is_default) {
            abort(403, 'cannot be deleted due to existence of is default option.');
        }

        $this->repository->delete($country);

        flash(trans('countries::countries.messages.deleted'))->error();

        return redirect()->route('dashboard.countries.index');
    }
}
