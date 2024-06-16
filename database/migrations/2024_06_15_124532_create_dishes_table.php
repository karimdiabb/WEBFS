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
        Schema::create('dishes', function (Blueprint $table) {
            $table->integer('DishID', true);
            $table->string('DishName', 100)->nullable();
            $table->decimal('Price', 10)->nullable();
            $table->text('Description')->nullable();
            $table->integer('DishTypeID')->nullable()->index('idx_dishes_dishtypeid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dishes');
    }
};
