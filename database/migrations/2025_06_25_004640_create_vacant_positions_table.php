<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // database/migrations/xxxx_xx_xx_xxxxxx_create_vacant_positions_table.php

    public function up()
    {
        Schema::create('vacant_positions', function (Blueprint $table) {
            $table->id();
            $table->string('position_title');
            $table->foreignId('qualification_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

};
