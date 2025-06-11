<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up()
  {
    Schema::create('events', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->string('type');
      $table->date('dateFrom');
      $table->date('dateTo');
      $table->string('status');
      $table->string('addedBy');
      $table->date('dateAdded');
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('events');
  }
};
