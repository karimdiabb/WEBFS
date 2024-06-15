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
        Schema::table('table_sessions', function (Blueprint $table) {
            $table->foreign(['TableID'], 'sessiontables_ibfk_1')->references(['TableID'])->on('restaurant_tables')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('table_sessions', function (Blueprint $table) {
            $table->dropForeign('sessiontables_ibfk_1');
        });
    }
};
