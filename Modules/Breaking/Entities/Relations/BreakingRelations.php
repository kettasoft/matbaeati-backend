<?php

namespace Modules\Breaking\Entities\Relations;

use Illuminate\Database\Eloquent\Model;
use Modules\Quotations\Entities\Quotation;

trait BreakingRelations
{
    /**
     * Quotations relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function quotations(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Quotation::class);
    }
}
