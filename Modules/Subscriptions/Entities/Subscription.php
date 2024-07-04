<?php

namespace Modules\Subscriptions\Entities;

use App\Helpers\Selectable;
use App\Http\Filters\Filterable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Subscriptions\Database\factories\SubscriptionFactory;

class Subscription extends Model
{
    use HasFactory,
        Translatable,
        Filterable,
        Selectable;

    /**
     * @var array
     */
    public $translatedAttributes = ['title', 'type', 'description'];

    /**
     * @var array
     */
    protected $with = [
        'translations',
    ];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'created_at',
        'updated_at'
    ];

    protected static function newFactory(): SubscriptionFactory
    {
        return SubscriptionFactory::new();
    }
}
