<?php

namespace Modules\Advertisements\Http\Controllers;

use App\Helpers\ApiTrait;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Modules\Accounts\Entities\Advertisement;
use Modules\Advertisements\Http\Requests\AdvertisementRequest;
use Modules\Advertisements\Repositories\AdvertisementRepository;

class AdvertisementsController extends Controller
{
    use ValidatesRequests, AuthorizesRequests, ApiTrait;

    private AdvertisementRepository $repository;

    /**
     * AdvertisementsController construct
     */
    public function __construct(AdvertisementRepository $repository)
    {
        $this->middleware('permission:read_advertisements')->only('index');
        $this->middleware(['permission:create_advertisements', 'advertisement.limits'])->only('store');
        $this->middleware('permission:show_advertisements')->only('show');
        $this->middleware('permission:update_advertisements')->only('update');
        $this->middleware('permission:delete_advertisements')->only('destroy');
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $advertisements = $this->repository->all();

        return $this->sendResponse($advertisements, 'success');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param AdvertisementRequest $request
     * @return JsonResponse
     */
    public function store(AdvertisementRequest $request): JsonResponse
    {
        $advertisement = $this->repository->create($request);
        return $this->sendResponse($advertisement, trans('advertisements::advertisements.messages.created'));
    }

    /**
     * Show the specified resource.
     * 
     * @param Advertisement $advertisement
     * @return JsonResponse
     */
    public function show(Advertisement $advertisement)
    {
        if ($advertisement->is(auth()->user()) || auth()->user()->isAdmin()) {
            return $this->sendResponse($advertisement, 'success');
        }

        return $this->sendUnauthorized();
    }

    /**
     * Update the specified resource in storage.
     * @param AdvertisementRequest $request
     * @param Advertisement $advertisement
     * @return JsonResponse
     */
    public function update(AdvertisementRequest $request, Advertisement $advertisement): JsonResponse
    {
        if ($advertisement->checkOwner() || auth()->user()->isAdmin()) {
            $advertisement = $this->repository->update($advertisement, $request);
            return $this->sendResponse($advertisement, trans('advertisements::advertisements.messages.updated'));
        }

        return $this->sendUnauthorized();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advertisement $advertisement)
    {
        if ($advertisement->checkOwner() || auth()->user()->isAdmin()) {
            $this->repository->delete($advertisement);
            return $this->sendSuccess($advertisement, trans('advertisements::advertisements.messages.deleted'));
        }

        return $this->sendUnauthorized();
    }
}
