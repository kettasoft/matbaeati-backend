<?php

namespace Modules\Accounts\Events;

use Illuminate\Queue\SerializesModels;
use Modules\Accounts\Entities\Account;

class Registered
{
    use SerializesModels;

    public Account $account;

    /**
     * Create a new event instance.
     */
    public function __construct(Account $account)
    {
        $this->account = $account;
    }
}
