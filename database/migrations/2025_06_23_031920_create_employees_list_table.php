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
        Schema::create('employees_list', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->nullable()->index();
            $table->foreignId('employee_name')->nullable()->index();
            $table->foreignId('position')->nullable()->index();
            $table->foreignId('employment_status')->nullable()->index();
            $table->foreignId('section')->nullable()->index();
            $table->foreignId('division')->nullable()->index();
            $table->foreignId('office_location')->nullable()->index();
            $table->foreignId('sg')->nullable()->index();
            $table->foreignId('username')->nullable()->index();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees_list');
    }
};
