<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_visible');
            $table->string('title');
            $table->string('title2')->nullable();
            $table->string('description')->nullable();
            $table->string('description2')->nullable();
            $table->json('genre');
            $table->json('language');
            $table->json('subtitle');
            $table->string('country')->nullable();
            $table->string('rating');
            $table->decimal('score', 3, 1);
            $table->integer('runtime');
            $table->string('director')->nullable();
            $table->json('cast');
            $table->date('dateRelease')->nullable();
            $table->json('visual');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
};
