<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->integer('OrderItemID', true);
            $table->integer('OrderID')->index('idx_orderitems_orderid');
            $table->integer('MenuItemID')->index('idx_orderitems_menuitemid');
            $table->integer('Quantity')->nullable();
            $table->decimal('ItemPrice', 10)->nullable();
            $table->mediumText('Note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
