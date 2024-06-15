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
        Schema::table('menu_items', function (Blueprint $table) {
            $table->foreign(['MenuID'], 'menuitems_ibfk_1')->references(['MenuID'])->on('menu')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['DishID'], 'menuitems_ibfk_2')->references(['DishID'])->on('dishes')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropForeign('menuitems_ibfk_1');
            $table->dropForeign('menuitems_ibfk_2');
        });
    }
};
