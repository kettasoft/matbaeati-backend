<?php

namespace Modules\Layers\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Layers\Database\factories\UVFactory;

class UV extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    
    protected static function newFactory(): UVFactory
    {
        //return UVFactory::new();
    }
}
