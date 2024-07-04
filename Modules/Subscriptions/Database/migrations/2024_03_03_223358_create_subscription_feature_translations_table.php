<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Subscriptions\Entities\SubscriptionFeature;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscription_feature_translations', function (Blueprint $table) {
            $table->id();
            // $table->foreignIdFor(SubscriptionFeature::class)->constrained('subscription_features');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_feature_translations');
    }
};
