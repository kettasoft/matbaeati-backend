<?php

namespace Modules\Categories\Entities\Helpers;

trait CategoryHelpers
{
    /**
     * The user profile image url.
     *
     * @return bool
     */
    public function getAvatar()
    {
        return $this->getFirstMediaUrl();
    }
}
