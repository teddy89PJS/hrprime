<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('dual_citizenship', ['yes', 'no'])->nullable()->after('civil_status');
            $table->enum('citizenship_type', ['by_birth', 'by_naturalization'])->nullable()->after('dual_citizenship');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['dual_citizenship', 'citizenship_type']);
        });
    }
};
