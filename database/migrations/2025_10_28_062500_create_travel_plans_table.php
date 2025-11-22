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
        Schema::create('travel_plans', function (Blueprint $table) {
            $table->id('planID');
            $table->foreignId('userID')->constrained('users', 'id')->onDelete('cascade');

            $table->string('planName');
            $table->decimal('amount', 12, 2); // Budget

            // Preference Data
            $table->foreignId('originCityID')->constrained('cities', 'cityID');
            $table->foreignId('destinationCityID')->constrained('cities', 'cityID');
            $table->foreignId('accommodationCityID')->nullable()->constrained('cities', 'cityID');

            $table->date('startDate');
            $table->date('endDate');
            $table->text('requestedActivities')->nullable(); // Disimpan sebagai JSON string

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel_plans');
    }
};
