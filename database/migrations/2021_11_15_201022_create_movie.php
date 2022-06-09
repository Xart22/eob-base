<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovie extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie', function (Blueprint $table) {
            $table->id('id');
            $table->uuid('uuid');
            $table->string('movie_name')->unique();
            $table->string('category');
            $table->string('path_banner');
            $table->string('path_file');
            $table->text('movie_desc');
            $table->string('duration');
            $table->string('movie_actors');
            $table->string('movie_director');
            $table->float('movie_rating', 3, 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie');
    }
}
