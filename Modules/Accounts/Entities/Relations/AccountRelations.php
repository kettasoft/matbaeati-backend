<?php

namespace Modules\Accounts\Entities\Relations;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Quotations\Entities\Quotation;
use Modules\Accounts\Entities\Verification;

trait AccountRelations
{
    /**
     * Quotations relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }

    /**
     * Verification relationship
     *
     * @return HasOne
     */
    public function verification(): HasOne
    {
        return $this->hasOne(Verification::class);
    }
}
