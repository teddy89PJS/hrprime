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
    Schema::create('salary_grades', function (Blueprint $table) {
      $table->id();
      $table->integer('sg_num')->unique();            // SG number e.g. 1,2,3
      $table->decimal('step_increment', 12, 2);       // Increment per step
      $table->decimal('sg_amount', 12, 2);            // Base amount for SG
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('salary_grades');
  }
};
