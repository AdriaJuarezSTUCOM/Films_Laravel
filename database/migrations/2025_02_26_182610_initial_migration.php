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
        Schema::create('films', function (Blueprint $table) {
            $table->bigInteger("id", true, true);
            $table->string('name', 100);
            $table->integer('year');
            $table->string('genre', 50);
            $table->string('country', 30);
            $table->integer('duration');
            $table->string('img_url', 255);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('actors', function (Blueprint $table) {
            $table->bigInteger("id", true, true);
            $table->string('name', 30);
            $table->string('surname', 30);
            $table->date('birthdate');
            $table->string('country', 30);
            $table->string('img_url', 255);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('films_actors', function (Blueprint $table) {
            $table->bigInteger("film_id", false, true);
            $table->bigInteger("actor_id", false, true);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
        Schema::dropIfExists('actors');
        Schema::dropIfExists('films_actors');
    }
};
