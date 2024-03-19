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
        Schema::create('animals', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->timestamps();
            $table->bigInteger('userId')->unsigned()->index();
            $table->string('name');
            $table->string('chipNumber')->nullable();
            $table->tinyInteger('gender')->default(0);
            $table->integer('colorId');
            $table->string('description', 1000)->nullable();
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
        Schema::dropIfExists('animals');
    }
};
