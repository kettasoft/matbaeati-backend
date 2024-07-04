<?php

namespace Modules\Accounts\Entities;

use Parental\HasParent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Accounts\Database\Factories\OfficeFactory;
use Modules\Accounts\Entities\Relations\OfficeRelations;

class Office extends Account
{
    use HasFactory, HasParent, OfficeRelations;

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

    protected static function newFactory(): OfficeFactory
    {
        return OfficeFactory::new();
    }
}
