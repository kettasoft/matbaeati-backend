<?php

namespace Modules\Layers\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Layers\Database\factories\CellophaneFactory;

class Cellophane extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    
    protected static function newFactory(): CellophaneFactory
    {
        //return CellophaneFactory::new();
    }
}
