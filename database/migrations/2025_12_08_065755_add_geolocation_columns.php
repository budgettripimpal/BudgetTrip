<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tambah koordinat ke Kota
        Schema::table('cities', function (Blueprint $table) {
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
        });

        // 2. Tambah koordinat ke Akomodasi
        Schema::table('accommodations', function (Blueprint $table) {
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
        });

        // 3. Tambah koordinat ke Wisata
        Schema::table('attractions', function (Blueprint $table) {
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
        });

        // 4. Tambah koordinat ke Rute Transportasi (Titik Berangkat & Tiba)
        Schema::table('transport_routes', function (Blueprint $table) {
            $table->decimal('start_latitude', 10, 8)->nullable();
            $table->decimal('start_longitude', 11, 8)->nullable();
            $table->decimal('end_latitude', 10, 8)->nullable();
            $table->decimal('end_longitude', 11, 8)->nullable();
        });

        // 5. Tambah koordinat ke Plan Item agar bisa ditampilkan di Overview tanpa query ulang
        Schema::table('plan_items', function (Blueprint $table) {
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
        });
    }

    public function down(): void
    {
        // Hapus kolom jika rollback (opsional, sesuaikan nama tabel)
    }
};