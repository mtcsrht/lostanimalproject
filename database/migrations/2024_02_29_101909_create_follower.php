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
        Schema::create('follower', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('source_id')->unsigned();
            $table->bigInteger('target_id')->unsigned();
            $table->tinyInteger('isActive')->default(0);
            $table->foreign('source_id', 'source_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('target_id', 'target_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follower');
    }
};
