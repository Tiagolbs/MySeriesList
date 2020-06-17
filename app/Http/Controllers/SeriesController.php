<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Serie;

class SeriesController extends Controller
{

    public function index() {
        $series = Serie::All();
        return view('series.index', ['series' => $series]);
    }

    public function create() {
        return view('series.create');
    }

    public function store(Request $request) {
        $new_serie = $request->all();
        Serie::Create($new_serie);

        return redirect('series');
    }

    public function searchName($serie){
        $series = Serie::all();
        $series = $series->pluck('nomeSerie')->toArray();
        return in_array($serie, $series);
    }

    public function insertSerie($serie){
        $newSerie = new Serie;
        $newSerie->idSerieImdb = $serie['idImdb'];
        $newSerie->nomeSerie = $serie['nomeSerie'];
        $newSerie->numTemps = $serie['numTemps'];
        $newSerie->descricao = $serie['descricao'];
        $newSerie->generoSerie = $serie['generoSerie'];
        $newSerie->notaSerie = $serie['notaSerie'];
        $newSerie->poster = $serie['poster'];
        $newSerie->epTime = $serie['epTime'];
        $newSerie->save();
    }
}
