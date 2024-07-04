<?php

namespace Modules\Printing\Http\Controllers\Api;

use App\Helpers\ApiTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Modules\Printing\Entities\Printing;
use Modules\Printing\Http\Requests\PrintingRequest;
use Modules\Printing\Repositories\PrintingRepository;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Response;

class PrintingController extends Controller
{
    use AuthorizesRequests, ValidatesRequests, ApiTrait;

    /**
     * @var PrintingRepository
     */
    private PrintingRepository $repository;

    /**
     * ArticleController constructor.
     * @param PrintingRepository $repository
     */
    public function __construct(PrintingRepository $repository)
    {
        $this->middleware('permission:read_printing')->only(['index']);
        $this->middleware('permission:create_printing')->only(['store']);
        $this->middleware('permission:update_printing')->only(['update']);
        $this->middleware('permission:delete_printing')->only(['destroy']);
        $this->middleware('permission:show_printing')->only(['show']);
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $printings = $this->repository->all();

        if (count($printings) > 0) {
            return $this->sendResponse($printings, 'success');
        }

        return $this->sendError('Sorry, no printings');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PrintingRequest $request): JsonResponse
    {
        $printing = $this->repository->create($request);

        return $this->sendResponse($printing, 'success');
    }

    /**
     * Show the specified resource.
     */
    public function show(Printing $printing): JsonResponse
    {
        $printing = $this->repository->find($printing);

        return $this->sendResponse($printing, 'success');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PrintingRequest $request, Printing $printing): JsonResponse
    {
        /**
         * @var \Modules\Accounts\Entities\Office
         */
        $account = auth()->user();

        $printing = $this->repository->find($printing);

        abort_if(!$account->is($printing->office), Response::HTTP_UNAUTHORIZED);

        $printing = $this->repository->update($printing, $request);

        return $this->sendResponse($printing, 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($printing): JsonResponse
    {
        /**
         * @var \Modules\Accounts\Entities\Office
         */
        $account = auth()->user();

        $printing = $this->repository->find($printing);

        abort_if(!$account->is($printing->office), Response::HTTP_UNAUTHORIZED);

        return $this->sendResponse($printing, 'success');
    }
}
