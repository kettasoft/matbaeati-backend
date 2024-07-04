<?php

namespace App\Helpers;

trait ActiveCheckerTrait
{
    /**
     * Check if the item is active or note.
     *
     * @return boolean
     */
    public function isActive(): bool
    {
        return $this?->active ?? false;
    }
}
