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
    Schema::table('users', function (Blueprint $table) {
      $table->string('employee_id')->unique()->after('id');
      $table->string('first_name')->after('employee_id');
      $table->string('middle_name')->nullable()->after('first_name');
      $table->string('last_name')->after('middle_name');
      $table->string('extension_name')->nullable()->after('last_name');
      $table->unsignedBigInteger('employment_status_id')->after('extension_name');
      $table->unsignedBigInteger('division_id')->after('employment_status_id');
      $table->unsignedBigInteger('section_id')->after('division_id');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('users', function (Blueprint $table) {
      //
    });
  }
};
