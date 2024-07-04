<?php

namespace Modules\Subscriptions\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Subscriptions\Database\factories\SubscriptionFeatureFactory;

class SubscriptionFeature extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    
    protected static function newFactory(): SubscriptionFeatureFactory
    {
        //return SubscriptionFeatureFactory::new();
    }
}
