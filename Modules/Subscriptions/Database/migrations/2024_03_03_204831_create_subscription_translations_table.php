<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Subscriptions\Entities\Subscription;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscription_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Subscription::class)->constrained('subscriptions');
            $table->text('description')->nullable();
            $table->string('title')->nullable();
            $table->string('type')->unique()->nullable();
            $table->string('locale')->index();
            $table->unique('subscription_id', 'locale');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_translations');
    }
};
