<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series', function (Blueprint $table) {
            $table->bigIncrements('idSerie');
            $table->string('idSerieImdb', 10);
            $table->string('nomeSerie', 100);
            $table->integer('numTemps');
            $table->string('descricao', 999);
            $table->string('generoSerie', 100);
            $table->float('notaSerie');
            $table->string('poster', 9999);
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
        Schema::dropIfExists('series');
    }
}
