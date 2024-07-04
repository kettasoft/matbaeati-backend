<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Accounts\Entities\Account;
use Modules\Offers\Entities\Offer;
use Modules\Quotations\Entities\Quotation;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Quotation::class)->constrained('quotations');
            $table->foreignIdFor(Account::class)->constrained('accounts');
            $table->unsignedBigInteger('service_id');
            $table->string('status')->default(Offer::ONHOLD_STATUS);
            $table->float('price');
            $table->text('notes')->nullable();
            $table->date('estimated_delivery');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
