<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Terminal (Bandara, Pelabuhan, Stasiun)
        Schema::create('transport_terminals', function (Blueprint $table) {
            $table->id('terminalID');
            $table->string('name'); // Contoh: Bandara Soekarno-Hatta
            $table->enum('type', ['Bandara', 'Pelabuhan', 'Stasiun', 'Terminal Bus']);
            $table->foreignId('cityID')->constrained('cities', 'cityID'); // Lokasi fisik terminal
            $table->string('code')->nullable(); // CGK, BDO, Merak
            $table->timestamps();
        });

        // 2. Kota <-> Terminal (Satu kota bisa punya akses ke banyak terminal)
        Schema::create('city_terminals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cityID')->constrained('cities', 'cityID');
            $table->foreignId('terminalID')->constrained('transport_terminals', 'terminalID');
            $table->integer('distance_km')->default(0); // Jarak dari pusat kota ke terminal
            $table->integer('travel_time_minutes')->default(0); // Estimasi waktu tempuh
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('city_terminals');
        Schema::dropIfExists('transport_terminals');
    }
};