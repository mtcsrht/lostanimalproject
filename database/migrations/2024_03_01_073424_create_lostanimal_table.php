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
        Schema::create('lostanimal', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('userId')->unsigned()->index();
            $table->string('name');
            $table->tinyInteger('hasChipNumber')->default(0);
            $table->string('chipNumber')->nullable();
            $table->tinyInteger('gender')->default(0);
            $table->bigInteger('colorId')->unsigned();
            $table->string('description')->nullable();
            $table->string('markings')->nullable();
            $table->string('image')->nullable();
            $table->foreign('colorId')->references('id')->on('colors')->onDelete('cascade');
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lostanimal');
    }
};
