<?php

namespace Modules\Products\Http\Controllers;

use App\Helpers\ApiTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Modules\Products\Entities\Product;
use Modules\Products\Http\Requests\ProductRequest;
use Modules\Products\Repositories\ProductRepository;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller
{
    use ValidatesRequests, AuthorizesRequests, ApiTrait;

    private ProductRepository $repository;

    /**
     * ProductRepository constructor
     */
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $products = $this->repository->all();

        return $this->sendResponse($products, 'success');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @return JsonResponse
     */
    public function store(ProductRequest $request): JsonResponse
    {
        $product = $this->repository->create($request);

        return $this->sendResponse($product, trans('products::products.messages.created'));
    }

    /**
     * Show the specified resource.
     * 
     * @return JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        $product = $this->repository->find($product);

        return $this->sendResponse($product, 'success');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product): JsonResponse
    {
        if ($product->is(auth()->user()) || auth()->user()->isAdmin()) {
            $product = $this->repository->update($product, $request);
            return $this->sendResponse($product, trans('products::products.messages.created'));
        }

        return $this->sendUnauthorized();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->is(auth()->user()) || auth()->user()->isAdmin()) {
            $product = $this->repository->delete($product);
            return $this->sendSuccess('success');
        }

        return $this->sendUnauthorized();
    }
}
