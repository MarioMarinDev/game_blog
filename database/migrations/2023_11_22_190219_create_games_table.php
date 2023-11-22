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
    Schema::create('games', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id');
      $table->string("name");
      $table->text("description")->nullable();
      $table->string("image");
      $table->float('rating', 3, 2)->nullable();
      $table->timestamps();

      $table->foreign('user_id')->references('id')->on('users');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('games');
  }
};
