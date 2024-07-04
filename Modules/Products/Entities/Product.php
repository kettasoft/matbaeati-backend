<?php

namespace Modules\Products\Entities;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Modules\Products\Entities\Helpers\ProductHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Products\Database\factories\ProductFactory;
use AhmedAliraqi\LaravelMediaUploader\Entities\Concerns\HasUploader;

class Product extends Model implements HasMedia
{
    use HasFactory,
        InteractsWithMedia,
        HasUploader,
        ProductHelpers;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'account_id',
        'store_id',
        'name',
        'description',
        'is_active',
    ];

    protected static function newFactory(): ProductFactory
    {
        return ProductFactory::new();
    }
}
