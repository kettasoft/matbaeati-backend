<?php

namespace Modules\Subscriptions\Entities;

use Illuminate\Database\Eloquent\Model;

class SubscriptionTranslation extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'type',
        'title',
        'description',
        'status'
    ];
}
