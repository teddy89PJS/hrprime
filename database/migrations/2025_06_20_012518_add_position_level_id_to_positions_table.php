<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('positions', function (Blueprint $table) {
            $table->unsignedBigInteger('position_level_id')->nullable()->after('id');
            $table->foreign('position_level_id')
                  ->references('id')
                  ->on('position_levels')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('positions', function (Blueprint $table) {
            $table->dropForeign(['position_level_id']);
            $table->dropColumn('position_level_id');
        });
    }
};

