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
        Schema::create('shared_plans', function (Blueprint $table) {
            $table->id('shareID');
            $table->foreignId('planID')->constrained('travel_plans', 'planID')->onDelete('cascade');
            $table->string('sharedWith');
            $table->string('method', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shared_plans');
    }
};
