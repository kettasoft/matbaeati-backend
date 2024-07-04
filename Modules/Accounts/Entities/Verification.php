<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Accounts\Database\factories\VerificationFactory;

/**
 * @property int $id
 * @property int $code
 * @property \Carbon\Carbon $expire_ar
 */
class Verification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'code',
        'expire_at',
    ];

    protected static function newFactory(): VerificationFactory
    {
        return VerificationFactory::new();
    }
}
