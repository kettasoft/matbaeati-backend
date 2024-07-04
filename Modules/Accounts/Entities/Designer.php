<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Accounts\Database\factories\DesignerFactory;
use Parental\HasParent;

class Designer extends Account
{
    use HasFactory, HasParent;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
}
