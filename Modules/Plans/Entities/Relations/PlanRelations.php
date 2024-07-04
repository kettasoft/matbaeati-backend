<?php

namespace Modules\Plans\Entities\Relations;

use Modules\Plans\Entities\Feature;

trait PlanRelations
{
    public function accounts()
    {
        //
    }

    public function featues()
    {
        return $this->hasMany(Feature::class);
    }
}
