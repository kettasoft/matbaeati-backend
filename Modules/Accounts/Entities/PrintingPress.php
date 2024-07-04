<?php

namespace Modules\Accounts\Entities;

use Parental\HasParent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Accounts\Database\Factories\PrintingPressFactory;

class PrintingPress extends Account
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

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory()
    {
        return PrintingPressFactory::new();
    }
}
