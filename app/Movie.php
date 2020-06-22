<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = "movies";
    protected $fillable = ['idImdb', 'nome', 'descricao', 'generoMovie', 'notaMovie', 'poster'];
    protected $primaryKey = 'idMovie';
}
