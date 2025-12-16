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
    Schema::create('payroll', function (Blueprint $table) {
      $table->id();
      $table->date('request_date')->default(now());
      $table->date('period_from');
      $table->date('period_to');
      $table->unsignedBigInteger('fund_source_id');
      $table->unsignedBigInteger('employee_name_id');
      $table->unsignedBigInteger('position_id');
      $table->unsignedBigInteger('sg_num_id');
      $table->unsignedBigInteger('employee_id');
      $table->unsignedBigInteger('base_rate_id');
      $table->unsignedBigInteger('premium_amount_id');
      $table->unsignedBigInteger('total_amount_id');
      $table->decimal('late_and_absences', 12, 2);
      $table->decimal('gross_amount_earned', 12, 2);
      $table->decimal('tax_witheld', 12, 2)->nullable();
      $table->unsignedBigInteger('deduction_name_id');
      $table->unsignedBigInteger('deduction_amount_id');
      $table->decimal('total_deductions', 12, 2);
      $table->decimal('net_amount_due_total', 12, 2);
      $table->text('remarks')->nullable();
      $table->string('status', 50)->default('Pending');
      $table->timestamps();

      $table->foreign('fund_source_id')->references('id')->on('fund_sources')->onDelete('cascade');
      $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('employee_name_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');
      $table->foreign('sg_num_id')->references('id')->on('salary_grades')->onDelete('cascade');
      $table->foreign('base_rate_id')->references('id')->on('salary_grades')->onDelete('cascade');
      $table->foreign('premium_amount_id')->references('id')->on('salary_grades')->onDelete('cascade');
      $table->foreign('total_amount_id')->references('id')->on('salary_grades')->onDelete('cascade');
      $table->foreign('deduction_name_id')->references('id')->on('deductions')->onDelete('cascade');
      $table->foreign('deduction_amount_id')->references('id')->on('deductions')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('payroll');
  }
};
