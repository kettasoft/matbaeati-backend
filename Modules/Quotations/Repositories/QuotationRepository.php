<?php

namespace Modules\Quotations\Repositories;

use Illuminate\Http\Request;
use App\Contracts\CrudOperationsContract;
use Modules\Quotations\Entities\Quotation;
use Modules\Quotations\Http\Filters\QuotationFilter;

class QuotationRepository implements CrudOperationsContract
{
    private QuotationFilter $filter;

    /**
     * OfferRepository constructor.
     * @param QuotationFilter $filter
     */
    public function __construct(QuotationFilter $filter)
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
        return Quotation::filter($this->filter)->paginate(request('perPage'));
    }

    /**
     * Save the created model to storage.
     *
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(Request $request)
    {
        /**
         * @var \Modules\Accounts\Entities\Office
         */
        $user = auth()->user();

        $quotation = $user->quotations()->create($request->all());

        return $quotation;
    }

    /**
     * Display the given model instance.
     *
     * @param mixed $model
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($model)
    {
        if ($model instanceof Quotation) {
            return $model;
        }

        return Quotation::findOrFail($model);
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
        /**
         * @var \Modules\Accounts\Entities\Office
         */
        $user = auth()->user();

        if ($user->is($model->account)) {
            $model->update($request->all());

            return $model;
        }

        return false;
    }

    /**
     * Delete the given model from storage.
     *
     * @param mixed $model
     * @return int|null
     */
    public function delete($model)
    {
        /**
         * @var \Modules\Accounts\Entities\Office
         */
        $user = auth()->user();

        if ($user->is($model) || $user->hasPermission('delete_quotations')) {
            return $model->delete();
        }
    }
}
