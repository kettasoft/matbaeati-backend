<?php

namespace Modules\Advertisements\Entities;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Advertisements\Database\factories\AdvertisementFactory;
use AhmedAliraqi\LaravelMediaUploader\Entities\Concerns\HasUploader;
use Modules\Advertisements\Entities\Relations\AdvertisementRelations;

class Advertisement extends Model implements HasMedia
{
    use HasFactory,
        AdvertisementRelations,
        InteractsWithMedia,
        HasUploader;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'description',
        'created_at',
        'target',
        'is_active',
        'account_id',
    ];

    public static const MAX_ADVERTISEMENTS_COUNT = 5;

    protected static function newFactory(): AdvertisementFactory
    {
        return AdvertisementFactory::new();
    }
}
