<?php

namespace Modules\Categories\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;
use Modules\Categories\Entities\Category;
use Modules\Categories\Http\Filters\SelectFilter;
use Modules\Categories\Transformers\CategorySelectResource;

class SelectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Modules\Categories\Http\Filters\SelectFilter $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function categories(SelectFilter $filter): AnonymousResourceCollection
    {
        $categories = Category::where('active', true)->filter($filter)->get();

        return CategorySelectResource::collection($categories);
    }

    /**
     * Display a single of the resource.
     *
     * @param Category $category
     * @return CategorySelectResource
     */
    public function category(Category $category)
    {
        return new CategorySelectResource($category);
    }
}
