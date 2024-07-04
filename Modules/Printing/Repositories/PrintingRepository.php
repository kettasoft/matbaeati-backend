<?php

namespace Modules\Printing\Repositories;
use Illuminate\Http\Request;
use Modules\Printing\Entities\Printing;
use App\Contracts\CrudOperationsContract;
use Modules\Printing\Http\Filters\PrintingFilter;

class PrintingRepository implements CrudOperationsContract
{
    private PrintingFilter $filter;

    /**
     * OfferRepository constructor.
     * @param PrintingFilter $filter
     */
    public function __construct(PrintingFilter $filter)
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
        return Printing::filter($this->filter)->paginate(request('perPage'));
    }

    /**
     * Save the created model to storage.
     *
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(Request $request)
    {
        $printing = Printing::create($request->all());

        return $printing;
    }

    /**
     * Display the given model instance.
     *
     * @param mixed $model
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($model)
    {
        if ($model instanceof Printing) {
            return $model;
        }

        return Printing::findOrFail($model);
    }

    /**
     * Update the given model in the storage.
     *
     * @param mixed $model
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Model|false
     */
    public function update($model, Request $request)
    {
        $model->update($request->all());

        return $model;
    }

    /**
     * Delete the given model from storage.
     *
     * @param mixed $model
     * @return int|null
     */
    public function delete($model)
    {
        return $model->delete();
    }
}
