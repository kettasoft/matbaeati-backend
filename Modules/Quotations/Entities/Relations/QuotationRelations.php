<?php

namespace Modules\Quotations\Entities\Relations;

use Modules\Accounts\Entities\Account;
use Modules\Breaking\Entities\Breaking;
use Modules\Printing\Entities\Printing;

trait QuotationRelations
{
    /**
     * Quotation relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * Quotation relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function printing(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Printing::class);
    }

    /**
     * Quotation relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pasting(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Pasting::class);
    }

    /**
     * Quotation relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function breaking(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Breaking::class);
    }
}
