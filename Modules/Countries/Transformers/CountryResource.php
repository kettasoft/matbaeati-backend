<?php

namespace Modules\Countries\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \Modules\Countries\Entities\Country */
class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'key' => $this->key,
            'is_default' => ! ! $this->is_default,
            'currency' => $this->currency,
            'flag' => url($this->getFirstMediaUrl('flags')),
            'cities' => CityResource::collection($this->whenLoaded('cities')),
        ];
    }
}
