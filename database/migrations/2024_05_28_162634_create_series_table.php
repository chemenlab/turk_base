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
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('origin_name')->nullable();
            $table->text('description')->nullable();
            $table->string('poster')->nullable();
            $table->integer('year')->nullable();
            $table->string('quality')->nullable();
            $table->float('imdb_rating')->nullable();
            $table->float('kinopoisk_rating')->nullable();
            $table->integer('kinopoisk_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series');
    }
};
