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
    Schema::create('transport_routes', function (Blueprint $table) {
        $table->id('routeID');
        $table->foreignId('providerID')->constrained('service_providers', 'providerID');
        $table->foreignId('originCityID')->constrained('cities', 'cityID');
        $table->foreignId('destinationCityID')->constrained('cities', 'cityID');
        
        $table->decimal('averagePrice', 10, 2);
        
        // --- KOLOM TAMBAHAN UNTUK UI ---
        $table->time('departureTime'); // Jam Berangkat (misal 08:00)
        $table->time('arrivalTime');   // Jam Tiba (misal 11:30)
        $table->string('class');       // Ekonomi, Bisnis, Eksekutif
        $table->json('facilities')->nullable(); // Menyimpan array ['AC', 'Wifi']
        // -------------------------------
        
        $table->string('bookingLink')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transport_routes');
    }
};
