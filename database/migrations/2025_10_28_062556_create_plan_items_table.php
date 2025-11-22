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
        Schema::create('plan_items', function (Blueprint $table) {
            $table->id('planItemID');
            $table->foreignId('itineraryID')->constrained('itineraries', 'itineraryID')->onDelete('cascade');

            $table->string('description');
            $table->string('itemType', 50); // Transportasi/Akomodasi
            $table->decimal('estimatedCost', 10, 2);
            $table->string('bookingLink')->nullable();
            $table->string('providerName')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_items');
    }
};
