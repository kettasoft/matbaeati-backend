<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Quotations\Entities\Quotation;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('breakings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Quotation::class)->constrained('quotations');
            $table->unsignedBigInteger('machine_type_id')->nullable();
            $table->unsignedInteger('count');
            $table->unsignedSmallInteger('width');
            $table->unsignedSmallInteger('height');
            $table->unsignedSmallInteger('quality');
            $table->unsignedSmallInteger('thickness');
            $table->boolean('has_stub')->default(false);
            $table->float('price');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('machine_type_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('breakings');
    }
};
