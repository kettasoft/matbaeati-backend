<?php

namespace Modules\Printing\Entities\Relations;

use Modules\Accounts\Entities\Office;
use Modules\Quotations\Entities\Quotation;

trait PrintingRelations
{
    /**
     * Quotations relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quotations()
    {
        return $this->belongsTo(Quotation::class);
    }

    /**
     * Quotations relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function office()
    {
        return $this->belongsTo(Office::class);
    }
}
