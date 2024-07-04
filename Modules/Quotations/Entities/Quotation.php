<?php

namespace Modules\Quotations\Entities;

use App\Helpers\Selectable;
use App\Http\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Quotations\Database\Factories\QuotationFactory;
use Modules\Quotations\Entities\Relations\QuotationRelations;

/**
 * Class Quotation
 *
 * Represents a quotation model.
 *
 * @package \Modules\Quotations\Entities\Quotation
 * @property string $notes
 * @property string $status
 * @property int $account_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Quotation extends Model
{
    use HasFactory,
        Filterable,
        Selectable,
        QuotationRelations;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'account_id',
        'notes',
        'status',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'completed' => 'boolean',
    ];

    /**
     * The status indicating that a quotation is (not complete).
     *
     * @var string
     */
    public const NOT_COMPLETE_STATUS = 'not_complete';

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

    protected static function newFactory(): QuotationFactory
    {
        return QuotationFactory::new();
    }
}
