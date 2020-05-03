<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $table = "series";
    protected $fillable = ['idSerieImdb', 'nomeSerie', 'numTemps', 'descricao', 'generoSerie', 'notaSerie', 'poster'];
}
