<?php

namespace Modules\Breaking\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Breaking\Database\factories\CoverageFactory;

class Coverage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    
    protected static function newFactory(): CoverageFactory
    {
        //return CoverageFactory::new();
    }
}
