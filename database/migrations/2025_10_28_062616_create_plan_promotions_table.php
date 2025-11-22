<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plan_promotions', function (Blueprint $table) {
            $table->foreignId('planID')->constrained('travel_plans', 'planID')->onDelete('cascade');
            $table->foreignId('promotionID')->constrained('promotions', 'promotionID')->onDelete('cascade');
            $table->timestamps();

            // Composite Key
            $table->primary(['planID', 'promotionID']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_promotions');
    }
};
