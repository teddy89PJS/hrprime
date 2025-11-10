<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('requirements', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('position_id');
      $table->string('requirement');
      $table->timestamps();

      $table->foreign('position_id')
        ->references('id')->on('positions')
        ->onDelete('cascade');
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('requirements');
  }
};
