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
            $table->integer('OrderID', true);
            $table->integer('SessionID')->index('idx_orders_sessionid');
            $table->dateTime('OrderTime')->nullable();
            $table->decimal('TotalPrice', 10)->nullable();
            $table->boolean('ReorderFlag')->nullable();
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
