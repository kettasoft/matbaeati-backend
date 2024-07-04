<?php

namespace Modules\Printing\Entities;

use AhmedAliraqi\LaravelMediaUploader\Entities\Concerns\HasUploader;
use App\Helpers\Selectable;
use App\Http\Filters\Filterable;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Printing\Database\factories\PrintingFactory;
use Modules\Printing\Entities\Relations\PrintingRelations;

class Printing extends Model implements HasMedia
{
    use HasFactory,
        Filterable,
        Selectable,
        InteractsWithMedia,
        HasUploader,
        PrintingRelations;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'count',
        'colors',
        'category_id',
        'width',
        'height',
        'thickness',
        'quality',
        'price',
    ];

    /**
     * @var string
     */
    const ONHOLD_STATUS = 'onhold';

    /**
     * @var string
     */
    const ACCEPTER_STATUS = 'accepted';

    protected static function newFactory(): PrintingFactory
    {
        return PrintingFactory::new();
    }
}
