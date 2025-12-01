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
            $table->integer('sg_num')->unique();                         // Salary Grade number
            $table->decimal('base_rate', 12, 2);                         // Cost of Service Base Rate
            $table->decimal('premium_rate', 5, 2);                       // Premium rate percentage
            $table->decimal('premium_amount', 12, 2);                    // Computed premium amount
            $table->decimal('total_amount', 12, 2);                      // Base Rate + Premium
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

