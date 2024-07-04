<?php

namespace Modules\Advertisements\Entities\Relations;

use Modules\Accounts\Entities\Account;

trait AdvertisementRelations
{
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
