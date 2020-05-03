<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_series', function (Blueprint $table) {
            $table->bigIncrements('idListSeries');
            $table->unsignedBigInteger('idUser');
            $table->unsignedBigInteger('idSerie');
            $table->integer('temporada');
            $table->integer('epsAssistidos');
            $table->integer('epsTotais');
            $table->string('status', 100);
            $table->foreign('idUser')->references('id')->on('users');
            $table->foreign('idSerie')->references('idSerie')->on('series');
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
        Schema::dropIfExists('list_series');
    }
}
