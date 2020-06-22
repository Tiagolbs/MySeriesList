<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class listMovie extends Model
{
    protected $table = "list_movies";
    protected $fillable = ['idUser', 'idMovie', 'status'];
    protected $primaryKey = 'idListMovie';
}
