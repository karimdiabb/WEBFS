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
        Schema::create('discounts', function (Blueprint $table) {
            $table->integer('DiscountID', true);
            $table->integer('DishID')->nullable()->index('idx_discounts_dishid');
            $table->decimal('DiscountPercentage', 5)->nullable();
            $table->date('StartDate')->nullable();
            $table->date('EndDate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
