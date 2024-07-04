<?php

namespace Modules\Categories\Entities\Relations;

trait CategoryRelations
{
    public function subcategories()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
