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
        Schema::create('accommodations', function (Blueprint $table) {
            $table->id('accommodationID');
            $table->foreignId('providerID')->constrained('service_providers', 'providerID');
            $table->foreignId('cityID')->constrained('cities', 'cityID');
            
            $table->string('hotelName');
            $table->decimal('averagePricePerNight', 10, 2);

            $table->decimal('rating', 2, 1)->default(0); 
            $table->string('type', 50)->default('Hotel'); // Hotel, Villa, Apartemen
            $table->json('facilities')->nullable(); // Array ['WiFi', 'Kolam Renang']
            
            $table->string('bookingLink')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accommodations');
    }
};