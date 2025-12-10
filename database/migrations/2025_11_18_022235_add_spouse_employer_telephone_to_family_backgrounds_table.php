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
            $table->string('spouse_employer_telephone')->nullable()->after('spouse_employer_address');
        });
    }

    public function down()
    {
        Schema::table('family_backgrounds', function (Blueprint $table) {
            $table->dropColumn('spouse_employer_telephone');
        });
    }

};
