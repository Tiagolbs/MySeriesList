<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class listSerie extends Model
{
    protected $table = "list_series";
    protected $fillable = ['idUser', 'idSerie' ,'temporada', 'epsAssistidos', 'epsTotais', 'status'];
    protected $primaryKey = 'idListSeries';
}
