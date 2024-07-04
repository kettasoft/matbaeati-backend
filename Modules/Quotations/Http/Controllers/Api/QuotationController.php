<?php

namespace Modules\Quotations\Http\Controllers\Api;

use App\Helpers\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Modules\Quotations\Entities\Quotation;
use Modules\Quotations\Http\Requests\QuotationRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Modules\Quotations\Transformers\QuotationDetailsResource;
use Modules\Quotations\Transformers\QuotationListResource;

class QuotationController extends Controller
{
    use AuthorizesRequests, ValidatesRequests, ApiTrait;

    /**
     * @var \Modules\Quotations\Repositories\QuotationRepository
     */
    private $repository;

    /**
     * ArticleController constructor.
     * @param \Modules\Quotations\Repositories\QuotationRepository $repository
     */
    public function __construct(\Modules\Quotations\Repositories\QuotationRepository $repository)
    {
        $this->middleware('permission:read_quotations')->only(['index']);
        $this->middleware('permission:create_quotations')->only(['store']);
        $this->middleware('permission:update_quotations')->only(['update']);
        $this->middleware('permission:delete_quotations')->only(['destroy']);
        $this->middleware('permission:show_quotations')->only(['show']);
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $quotations = $this->repository->all();

        if (count($quotations) > 0) {
            $data = QuotationListResource::collection($quotations);
            return $this->sendResponse($data, 'success');
        }

        return $this->sendError('Sorry not found');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuotationRequest $request): JsonResponse
    {
        $quotation = $this->repository->create($request);

        return $this->sendResponse($quotation, 'success');
    }

    /**
     * Show the specified resource.
     */
    public function show(Quotation $quotation): JsonResponse
    {
        $quotation = $this->repository->find($quotation);

        if ($quotation) {
            $data = new QuotationDetailsResource($quotation);
            return $this->sendResponse($data,'success');
        }

        return $this->sendError('Sorry not found');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuotationRequest $request, $quotation): JsonResponse
    {
        $quotation = $this->repository->update($request, $quotation);

        abort_if(!$quotation, Response::HTTP_UNAUTHORIZED);

        return $this->sendResponse($quotation, 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quotation $quotation): JsonResponse
    {
        $result = $this->repository->delete($quotation);

        abort_if(is_null($result), Response::HTTP_UNAUTHORIZED);

        return $this->sendResponse($quotation, 'deleted');
    }
}
