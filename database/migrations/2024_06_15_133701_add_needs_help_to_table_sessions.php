<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('table_sessions', function (Blueprint $table) {
            $table->boolean('NeedsHelp')->default(false);
        });
    }

    public function down()
    {
        Schema::table('table_sessions', function (Blueprint $table) {
            $table->dropColumn('NeedsHelp');
        });
    }
};
