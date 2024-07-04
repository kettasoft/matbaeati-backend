<?php

namespace Modules\Quotations\Http\Filters;

use App\Http\Filters\BaseFilters;
use Modules\Quotations\Entities\Quotation;

class QuotationFilter extends BaseFilters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [
        'id',
        'date',
        'status'
    ];

    /**
     * Filter the query by a given name.
     *
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function id($value)
    {
        if ($value) {
            return $this->builder->where('id', $value);
        }

        return $this->builder;
    }

    /**
     * Filter the query by a given barcode.
     *
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function date($value)
    {
        if ($value) {
            return $this->builder->whereDate('created_at', $value);
        }

        return $this->builder;
    }

    /**
     * Filter the query by a given sku.
     *
     * @param string|int $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function status($value)
    {
        if ($value) {
            $status = match($value) {
                'not_complete' => Quotation::NOT_COMPLETE_STATUS,
                'onhold' => Quotation::ONHOLD_STATUS,
                default => Quotation::COMPLETED_STATUS,
            };

            return $this->builder->where('status', $status);
        }

        return $this->builder;
    }
}
