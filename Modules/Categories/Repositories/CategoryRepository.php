<?php

namespace Modules\Categories\Repositories;

use Modules\Categories\Entities\Category;
use Modules\Categories\Http\Filters\CategoryFilter;
use Modules\Contracts\CrudRepository;
use Modules\Products\Entities\Product;

class CategoryRepository implements CrudRepository
{
    /**
     * @var CategoryFilter
     */
    private CategoryFilter $filter;

    /**
     * CategoryRepository constructor.
     * @param CategoryFilter $filter
     */
    public function __construct(CategoryFilter $filter)
    {
        $this->filter = $filter;
    }

    /**
     * Get all models as a collection.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Category::filter($this->filter)->whereParentId(null)->paginate(request('perPage'));
    }

    /**
     * Get all active models as a collection.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection
     */
    public function actives()
    {
        return Category::filter($this->filter)->whereActive(1)->paginate(request('perPage'));
    }

    /**
     * Get all count models as a integer.
     *
     * @return int
     */
    public function count(): int
    {
        return Category::count();
    }

    /**
     * Save the created model to storage.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        $category = Category::create($data);

        $category->addAllMediaFromTokens($data['image'] ?? [], 'default');

        return $category;
    }

    /**
     * Display the given model instance.
     *
     * @param mixed $model
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($model)
    {
        if ($model instanceof Category) {
            return $model;
        }

        return Category::findOrFail($model);
    }

    /**
     * Update the given model in the storage.
     *
     * @param mixed $model
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($model, array $data)
    {
        $category = $this->find($model);

        if (!empty($category)) {
            $category->update($data);
        }

        $category->addAllMediaFromTokens($data['image'] ?? [], 'default');

        return $category;
    }

    /**
     * Delete the given model from storage.
     *
     * @param mixed $model
     * @return void
     */
    public function delete($model): bool
    {
        $check = Product::whereHas('category', function ($q) use($model) {
            return $q->where('category_id', $model->id);
        })->exists();

        if (!$check) {
            $this->find($model)->delete();
        }

        return !$check;
    }
}
