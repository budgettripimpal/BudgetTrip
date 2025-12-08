<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transport_routes', function (Blueprint $table) {
            $table->integer('total_seats')->default(40)->after('class'); // Kapasitas kursi
        });

        Schema::table('plan_items', function (Blueprint $table) {
            $table->string('ticket_code')->nullable()->after('providerName')->unique(); // Kode Unik Tiket
            $table->json('seat_numbers')->nullable()->after('ticket_code'); // Menyimpan array kursi [1, 2]
        });
    }

    public function down(): void
    {
        Schema::table('transport_routes', function (Blueprint $table) {
            $table->dropColumn('total_seats');
        });
        Schema::table('plan_items', function (Blueprint $table) {
            $table->dropColumn(['ticket_code', 'seat_numbers']);
        });
    }
};
