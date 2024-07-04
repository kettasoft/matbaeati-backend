<?php

namespace Modules\Accounts\Entities;

use Parental\HasParent;
use Modules\Accounts\Entities\Account;
use Modules\Accounts\Database\Factories\AdminFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Account
{
    use HasFactory, HasParent;

    /**
     * Get the class name for polymorphic relations.
     *
     * @return string
     */
    public function getMorphClass()
    {
        return Account::class;
    }

    /**
     * Get the default foreign key name for the model.
     *
     * @return string
     */
    public function getForeignKey()
    {
        return 'account_id';
    }

    protected static function newFactory(): AdminFactory
    {
        return AdminFactory::new();
    }
}
