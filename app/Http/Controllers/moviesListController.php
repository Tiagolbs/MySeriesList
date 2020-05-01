<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Serie;

class moviesListController extends Controller
{
    public function index() { //alterar Serie::All para a tabela movieslist
        $series = Serie::All();
        return view('movieslist', ['series' => $series]);
    }
}
