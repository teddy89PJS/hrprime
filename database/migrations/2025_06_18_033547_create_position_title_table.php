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
    Schema::create('positions_titles', function (Blueprint $table) {
      $table->id();
      $table->string('position_name');
      $table->string('abbreviation');
      $table->string('item_no');
      $table->unsignedBigInteger('salary_grade_id');
      $table->unsignedBigInteger('employment_status_id');
      $table->enum('status', ['active', 'inactive'])->default('active');
      $table->timestamps();

      $table->foreign('salary_grade_id')->references('id')->on('salary_grades')->onDelete('cascade');
      $table->foreign('employment_status_id')->references('id')->on('employment_statuses')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('positions_titles');
  }
};
