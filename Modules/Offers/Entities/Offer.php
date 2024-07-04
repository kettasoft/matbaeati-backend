<?php

namespace Modules\Offers\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Offers\Database\factories\OfferFactory;

class Offer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    /**
     * The status indicating that a quotation is (on hold).
     *
     * @var string
     */
    public const REJECTED_STATUS = 'rejected';

    /**
     * The status indicating that a quotation is (on hold).
     *
     * @var string
     */
    public const ONHOLD_STATUS = 'onhold';

    /**
     * The status indicating that a quotation is completed.
     *
     * @var string
     */
    public const COMPLETED_STATUS = 'completed';

    protected static function newFactory(): OfferFactory
    {
        return OfferFactory::new();
    }
}
