<?php

namespace Modules\Subscriptions\Entities\Relations;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Accounts\Entities\Account;

trait SubscriptionRelations
{
    /**
     * Account relationship
     *
     * @return BelongsToMany
     */
    public function accounts(): BelongsToMany
    {
        return $this->belongsToMany(Account::class);
    }
}
