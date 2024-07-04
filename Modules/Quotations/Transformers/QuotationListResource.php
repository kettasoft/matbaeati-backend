<?php

namespace Modules\Quotations\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class QuotationListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            "id"=> $this->id,
            'account_id' => $this->account_id,
            'notes' => $this->notes,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_at_format' => $this->created_at->diffForHumans(),
        ];
    }
}
