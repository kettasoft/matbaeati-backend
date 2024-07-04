<?php

namespace Modules\Subscriptions\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Subscriptions\Database\factories\SubscriptionFeatureTranslationFactory;

class SubscriptionFeatureTranslation extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'description'
    ];
}
