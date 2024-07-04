<?php

namespace Modules\Products\Repositories;

use Illuminate\Http\Request;
use App\Contracts\CrudOperationsContract;

class ProductRepository implements CrudOperationsContract
{
    /**
     * Get all models as a collection.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
    }

    /**
     * Save the created model to storage.
     *
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(Request $request)
    {
    }

    /**
     * Display the given model instance.
     *
     * @param mixed $model
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($model)
    {
    }

    /**
     * Update the given model in the storage.
     *
     * @param mixed $model
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($model, Request $request)
    {
    }

    /**
     * Delete the given model from storage.
     *
     * @param mixed $model
     * @return void
     */
    public function delete($model)
    {
    }
}
