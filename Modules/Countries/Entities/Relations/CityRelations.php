<?php


namespace Modules\Countries\Entities\Relations;


use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Countries\Entities\Country;
use Modules\Countries\Entities\Region;

trait CityRelations
{
    /**
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
