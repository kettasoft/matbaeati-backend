<?php


namespace Modules\Countries\Entities\Relations;


use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Countries\Entities\City;
use Modules\Countries\Entities\Region;

trait CountryRelations
{
    /**
     * @return HasMany
     */
    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }


//    /**
//     * @return HasManyThrough
//     */
//    public function regions(): HasManyThrough
//    {
//        return $this->hasManyThrough(Region::class, City::class);
//    }
}
