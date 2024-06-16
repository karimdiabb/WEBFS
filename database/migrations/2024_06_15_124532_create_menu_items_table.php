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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->integer('MenuItemID', true);
            $table->integer('MenuID')->nullable()->index('idx_menuitems_menuid');
            $table->integer('DishID')->nullable()->index('idx_menuitems_dishid');
            $table->integer('ItemNumber')->nullable();
            $table->string('ExtraIdentifier')->nullable();

            $table->unique(['MenuID', 'ItemNumber', 'ExtraIdentifier'], 'unique_menuitem');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
