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
        Schema::create('attractions', function (Blueprint $table) {
            $table->id('attractionID');
            $table->foreignId('cityID')->constrained('cities', 'cityID');
            
            $table->string('attractionName');
            $table->string('category')->nullable(); // Alam, Budaya, Kuliner, Belanja
            $table->decimal('estimatedCost', 10, 2)->default(0);
            
            // --- KOLOM TAMBAHAN ---
            $table->decimal('rating', 2, 1)->default(0); // Contoh: 4.7
            $table->integer('reviewCount')->default(0); // Contoh: 1200
            $table->text('description')->nullable(); 
            // ----------------------
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attractions');
    }
};
