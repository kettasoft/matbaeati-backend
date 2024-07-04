<?php

namespace Modules\Products\Entities\Helpers;

use Modules\Stores\Entities\Store;
use Modules\Accounts\Entities\Supplier;

trait ProductHelpers
{
    public function account()
    {
        return $this->belongsTo(Supplier::class, 'account_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'account_id');
    }
}
