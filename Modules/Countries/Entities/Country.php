<?php

namespace Modules\Countries\Entities;

use App\Helpers\Selectable;
use App\Http\Filters\Filterable;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Modules\Countries\Entities\Scopes\CountryScopes;
use Modules\Countries\Entities\Helpers\CountryHelper;
// use Modules\Support\Traits\Selectable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Countries\Entities\Relations\CountryRelations;
use AhmedAliraqi\LaravelMediaUploader\Entities\Concerns\HasUploader;

class Country extends Model implements HasMedia
{
    use Translatable,
        Filterable,
        CountryHelper,
        Selectable,
        HasUploader,
        InteractsWithMedia,
        HasFactory,
        CountryRelations,
        CountryScopes;

    /**
     * The translated attributes that are mass assignable.
     *
     * @var array
     */
    public $translatedAttributes = ['name', 'currency'];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'translations',
        'media',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'code',
        'key',
        'is_default',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_default' => 'boolean',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Countries\Database\factories\CountryFactory::new();
    }

    /**
     * Define the media collections.
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('flags')
            ->useFallbackUrl('https://www.countryflags.io/' . $this->code . '/shiny/64.png')
            ->registerMediaConversions(function () {
                $this->addMediaConversion('thumb')
                    ->width(50);

                $this->addMediaConversion('small')
                    ->width(120);

                $this->addMediaConversion('medium')
                    ->width(160);

                $this->addMediaConversion('large')
                    ->width(320);

                $this->addMediaConversion('extra_large')
                    ->width(720);
            });
    }

    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // Handle saving event, it fire when creating and updating.
        static::saving(function (Country $country) {
            // Determine default country if not exists.
            if (Country::where('is_default', true)->doesntExist()) {
                $country->forceFill(['is_default' => true]);
            }

            // If other country marked as default, replace the default country with it.
            if ($country->is_default) {
                Country::withoutEvents(function () {
                    Country::where('is_default', true)->update([
                        'is_default' => null,
                    ]);
                });

                $country->forceFill(['is_default' => true]);
            }
        });
    }
}
