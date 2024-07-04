<?php

namespace Modules\Categories\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Modules\Categories\Entities\Category;
use Modules\Categories\Repositories\CategoryRepository;
use Modules\Categories\Transformers\CategoryResource;
use Modules\Support\Traits\ApiTrait;

class CategoryController extends Controller
{
    use AuthorizesRequests, ValidatesRequests, ApiTrait;

    /**
     * @var CategoryRepository
     */
    protected CategoryRepository $repository;

    /**
     * CategoryController constructor.
     *
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the countries.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $categorire = $this->repository->actives();
        if (count($categorire) > 0) {
            $data = CategoryResource::collection($categorire)->response()->getData(true);
            return $this->sendResponse($data, 'success');
        }

        return $this->sendError('Sorry not found');
    }

    /**
     * Show the specified resource.
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Category $category): \Illuminate\Http\JsonResponse
    {
        if ($category->isActive()) {
            $category = $this->repository->find($category);

            $data = new CategoryResource($category);
            return $this->sendResponse($data, 'success');
        }

        return $this->sendError('Sorry not found');
    }

    /**
     * Display a listing of the country count.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function count(): int
    {
        $count = $this->repository->count();

        return $count;
    }
}
