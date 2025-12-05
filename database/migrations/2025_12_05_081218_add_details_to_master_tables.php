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
        Schema::table('transport_routes', function (Blueprint $table) {
            $table->text('description')->nullable();
            $table->json('images')->nullable(); // ['img1.jpg', 'img2.jpg']
        });

        Schema::table('accommodations', function (Blueprint $table) {
            $table->text('description')->nullable();
            $table->json('images')->nullable();
        });

        Schema::table('attractions', function (Blueprint $table) {
            // Description sudah ada di attractions sebelumnya, jadi kita skip atau modify
            // $table->text('description')->nullable(); 
            $table->json('images')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('transport_routes', function (Blueprint $table) {
            $table->dropColumn(['description', 'images']);
        });
        Schema::table('accommodations', function (Blueprint $table) {
            $table->dropColumn(['description', 'images']);
        });
        Schema::table('attractions', function (Blueprint $table) {
            $table->dropColumn(['images']);
        });
    }
};
