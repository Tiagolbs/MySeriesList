<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\listSerie;
use Auth;

class seriesListController extends Controller
{
    public function index() {
        if(Auth::guest()){
            return view('serieslist.noUser');
        }
        $series = listSerie::join('series', 'series.idSerie', '=', 'list_series.idSerie')
                            ->where('list_series.idUser', auth()->user()->id)
                            ->select('list_series.idListSeries as id', 'series.poster as poster', 'series.nomeSerie as nomeSerie', 'list_series.epsAssistidos as epsAssistidos', 'list_series.epsTotais as epsTotais', 'list_series.status as status', 'list_series.temporada as temporada', 'list_series.created_at as createdate', 'list_series.updated_at as lastupdate')
                            ->orderBy('status', 'desc')->paginate(10);
        
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

    public function addEp($id){
        listSerie::find($id)->increment('epsAssistidos', 1);
        $serie = listSerie::find($id);
        if($serie->epsAssistidos == $serie->epsTotais){
            $status = listSerie::find($id);
            $status->status = "Completed";
            $status->save();
        }else if($serie->status == 'Plan to Watch'){
            $status = listSerie::find($id);
            $status->status = "Watching";
            $status->save();
        }
        return redirect()->route('serieslist');
    }

    public function removeEp($id){
        listSerie::find($id)->decrement('epsAssistidos', 1);
        $serie = listSerie::find($id);
        if($serie->epsAssistidos < $serie->epsTotais and $serie->epsAssistidos > 0){
            $status = listSerie::find($id);
            $status->status = "Watching";
            $status->save();
        }else if($serie->epsAssistidos == 0){
            $status = listSerie::find($id);
            $status->status = "Plan to Watch";
            $status->save();
        }
        return redirect()->route('serieslist');
    }

    public function onlyCompleted(){
        $series = listSerie::join('series', 'series.idSerie', '=', 'list_series.idSerie')
                            ->where('list_series.idUser', auth()->user()->id)
                            ->where('list_series.status', 'Completed')
                            ->select('list_series.idListSeries as id', 'series.poster as poster', 'series.nomeSerie as nomeSerie', 'list_series.epsAssistidos as epsAssistidos', 'list_series.epsTotais as epsTotais', 'list_series.status as status', 'list_series.temporada as temporada', 'list_series.created_at as createdate', 'list_series.updated_at as lastupdate')
                            ->orderBy('nomeSerie')->paginate(10);
        return view('serieslist.index', ['series' => $series]);
    }

    public function onlyWatching(){
        $series = listSerie::join('series', 'series.idSerie', '=', 'list_series.idSerie')
                            ->where('list_series.idUser', auth()->user()->id)
                            ->where('list_series.status', 'Watching')
                            ->select('list_series.idListSeries as id', 'series.poster as poster', 'series.nomeSerie as nomeSerie', 'list_series.epsAssistidos as epsAssistidos', 'list_series.epsTotais as epsTotais', 'list_series.status as status', 'list_series.temporada as temporada', 'list_series.created_at as createdate', 'list_series.updated_at as lastupdate')
                            ->orderBy('nomeSerie')->paginate(10);
        return view('serieslist.index', ['series' => $series]);
    }

    public function onlyPlanToWatch(){
        $series = listSerie::join('series', 'series.idSerie', '=', 'list_series.idSerie')
                            ->where('list_series.idUser', auth()->user()->id)
                            ->where('list_series.status', 'Plan to Watch')
                            ->select('list_series.idListSeries as id', 'series.poster as poster', 'series.nomeSerie as nomeSerie', 'list_series.epsAssistidos as epsAssistidos', 'list_series.epsTotais as epsTotais', 'list_series.status as status', 'list_series.temporada as temporada', 'list_series.created_at as createdate', 'list_series.updated_at as lastupdate')
                            ->orderBy('nomeSerie')->paginate(10);
        return view('serieslist.index', ['series' => $series]);
    }

}
