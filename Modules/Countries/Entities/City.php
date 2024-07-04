<?php

namespace Modules\Countries\Entities;

use App\Helpers\Selectable;
use App\Http\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Countries\Entities\Relations\CityRelations;

class City extends Model
{
    use Translatable,
        Filterable,
        Selectable,
        HasFactory,
        CityRelations;

    /**
     * The translated attributes that are mass assignable.
     *
     * @var array
     */
    public $translatedAttributes = ['name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['country_id'];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'translations',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Countries\Database\factories\CityFactory::new();
    }
}
