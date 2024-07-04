<?php

namespace Modules\Breaking\Entities;

use App\Helpers\Selectable;
use App\Http\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Breaking\Database\factories\BreakingFactory;

class Breaking extends Model
{
    use HasFactory,
        Filterable,
        Selectable,
        BreakingRelations;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): BreakingFactory
    {
        return BreakingFactory::new();
    }
}
