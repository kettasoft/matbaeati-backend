<?php

namespace Modules\Chats\Entities\Relations;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Accounts\Entities\Account;

trait ChatRelations
{
    public function recevier(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
