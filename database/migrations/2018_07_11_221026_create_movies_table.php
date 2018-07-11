<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('movie_id');
            $table->string('backdrop');
            $table->string('poster');
            $table->string('title')->unique();
            $table->text('description');
            $table->json('genre');
            $table->date('release_date');
            $table->date('release_year');
            $table->string('director');
            $table->json('cast');
            $table->string('overall_rating');
            $table->string('runtime');
            $table->json('country');
            $table->string('trailer')->nullable();
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
        Schema::dropIfExists('movies');
    }
}
