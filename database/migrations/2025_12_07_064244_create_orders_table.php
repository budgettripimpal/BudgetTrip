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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            // Menghubungkan order dengan item spesifik di rencana perjalanan
            $table->foreignId('plan_item_id')->constrained('plan_items', 'planItemID')->cascadeOnDelete();
            
            $table->string('order_number')->unique(); // ID unik untuk Midtrans
            $table->decimal('total_price', 15, 2);
            $table->string('status')->default('unpaid'); // unpaid, paid, cancelled
            $table->string('snap_token')->nullable(); // Token dari Midtrans
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
