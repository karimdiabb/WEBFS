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
        Schema::table('order_items', function (Blueprint $table) {
            $table->foreign(['OrderID'], 'orderitems_ibfk_1')->references(['OrderID'])->on('orders')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['MenuItemID'], 'orderitems_ibfk_2')->references(['MenuItemID'])->on('menu_items')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign('orderitems_ibfk_1');
            $table->dropForeign('orderitems_ibfk_2');
        });
    }
};
