<?php

namespace Modules\Categories\Http\Controllers\Dashboard;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Routing\Controller;
use Modules\Categories\Entities\Category;
use Modules\Categories\Http\Requests\CategoryRequest;
use Modules\Categories\Repositories\CategoryRepository;

class CategoryController extends Controller
{

    use AuthorizesRequests, ValidatesRequests;

    /**
     * @var CategoryRepository
     */
    protected CategoryRepository $repository;

    /**
     * CategoryController constructor.
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->middleware('permission:read_categories')->only(['index']);
        $this->middleware('permission:create_categories')->only(['create', 'store']);
        $this->middleware('permission:update_categories')->only(['edit', 'update']);
        $this->middleware('permission:delete_categories')->only(['destroy']);
        $this->middleware('permission:show_categories')->only(['show']);
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     * @return Factory|View
     */
    public function index(): View
    {
        $categories = $this->repository->all();

        return view('categories::categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Factory|View
     */
    public function create(): View
    {
        return view('categories::categories.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        $category = $this->repository->create($request->all());

        flash(trans('categories::categories.messages.created'))->success();

        return redirect()->route('dashboard.categories.show', $category);
    }

    /**
     * Show the specified resource.
     * @param Category $category
     * @return View
     */
    public function show(Category $category): View
    {
        $category = $this->repository->find($category);
        return view('categories::categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Category $category
     * @return Factory|View
     */
    public function edit(Category $category): View
    {
        return view('categories::categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     * @param CategoryRequest $request
     * @param Category $article
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $category = $this->repository->update($category, $request->all());

        flash(trans('categories::categories.messages.updated'))->success();

        return redirect()->route('dashboard.categories.show', $category);
    }

    /**
     * Remove the specified resource from storage.
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        if ($this->repository->delete($category)) {
            flash(trans('categories::categories.messages.deleted'))->success();

            return redirect()->route('dashboard.categories.index');
        }

        flash(trans('categories::categories.messages.cant_delete'))->error();

        return back();
    }
}
