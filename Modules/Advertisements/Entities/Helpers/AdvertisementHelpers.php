<?php

namespace Modules\Advertisements\Entities\Helpers;

trait AdvertisementHelpers
{
    public function checkOwner()
    {
        return $this->is(auth()->user());
    }
}
