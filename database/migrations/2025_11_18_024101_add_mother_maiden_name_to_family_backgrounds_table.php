<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('family_backgrounds', function (Blueprint $table) {
            $table->string('mother_maiden_name')->nullable()->after('father_extension_name');
        });
    }

    public function down()
    {
        Schema::table('family_backgrounds', function (Blueprint $table) {
            $table->dropColumn('mother_maiden_name');
        });
    }
};
