<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\listSerie;

class seriesListController extends Controller
{
    public function index() {
        $series = listSerie::join('series', 'series.idSerie', '=', 'list_series.idSerie')->where('list_series.idUser', auth()->user()->id)->select('list_series.idListSeries as id', 'series.poster as poster', 'series.nomeSerie as nomeSerie', 'list_series.epsAssistidos as epsAssistidos', 'list_series.epsTotais as epsTotais', 'list_series.status as status', 'list_series.temporada as temporada')->orderBy('status', 'desc')->paginate(10);
            return view('serieslist.index', ['series' => $series]);
    }

    public function destroy($id) {
        listSerie::find($id)->delete();
        return redirect()->route('serieslist');
    }

    public function edit($id){
        $serie = listSerie::find($id);
        return view('serieslist.edit', compact('serie'));
    }

    public function create() {
        return view('serieslist.create');
    }

    public function store(Request $request) {
        $new_serie = $request->all();
        listSerie::Create($new_serie);

        return redirect()->route('serieslist');
    }

    public function update($id){
        listSerie::find($id)->update($request->all());
        return redirect()->route('serieslist');
    }

}
