<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Serie;

class seriesListController extends Controller
{
    public function index() { //alterar Serie::All para a tabela serieslist
        $series = Serie::All();
        return view('serieslist', ['series' => $series]);
    }
}
