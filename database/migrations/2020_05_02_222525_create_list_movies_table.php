<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_movies', function (Blueprint $table) {
        $table->bigIncrements('idListMovie');
        $table->unsignedBigInteger('idUser');
        $table->unsignedBigInteger('idMovie');
        $table->string('status', 100);
        $table->foreign('idUser')->references('id')->on('users');
        $table->foreign('idMovie')->references('idMovie')->on('movies');
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
        Schema::dropIfExists('list_movies');
    }
}
