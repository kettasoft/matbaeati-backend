<?php

namespace Modules\Accounts\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'type' => $this->type,
            // 'code' => $userCode,
            // 'avatar' => $this->getAvatar(),
            'device_token' => $this->device_token,
            'preferred_locale' => $this->preferred_locale,
            'token' => $this->createTokenForDevice($request->device_name),
            'reset_token' => $this->reset_token ?: '',
            'verified' => $this->hasVerifiedEmail(),
            // 'verified_at' => $this->email_verified_at ? $this->email_verified_at->toDateTimeString() : '',
            'created_at' => $this->created_at->toDateTimeString(),
            'created_at_formatted' => $this->created_at->diffForHumans(),
        ];
    }
}
