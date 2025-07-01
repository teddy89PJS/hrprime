

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
        Schema::create('new_leave_credits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->string('employee_name_id');
            $table->decimal('vacation_leave', 12, 2);
            $table->decimal('sick_leave', 12, 2);
            $table->decimal('total_leave', 12, 2);
            $table->timestamps();

          // // ✅ foreign key to users.employee_id
          //   $table->foreign('employee_id')->references('employee_id')->on('users')->onDelete('cascade');

            // ✅ foreign key to users.id
            $table->foreign('employee_name_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leavecredits');
    }
};
