<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\listSerie;
use Auth;
use App\Http\Requests\ListSeriesRequest;
use App\Serie;
use App\User;
use Illuminate\Support\Facades\Http;

class seriesListController extends Controller
{
    public function index(Request $filtro) {
        $filtragem = $filtro->get('desc_filtro');
        if($filtragem == NULL){
            $series = listSerie::join('series', 'series.idSerie', '=', 'list_series.idSerie')
                                ->where('list_series.idUser', auth()->user()->id)
                                ->select('series.idSerieImdb as idImdb','list_series.idListSeries as id', 'series.poster as poster', 'series.nomeSerie as nomeSerie', 'list_series.epsAssistidos as epsAssistidos', 'list_series.epsTotais as epsTotais', 'list_series.status as status', 'list_series.temporada as temporada', 'list_series.created_at as createdate', 'list_series.updated_at as lastupdate')
                                ->orderBy('status', 'desc')->orderBy('nomeSerie')->orderBy('temporada')->paginate(8);
        }
        else{
            $series = listSerie::join('series', 'series.idSerie', '=', 'list_series.idSerie')
                                    ->where('list_series.idUser', auth()->user()->id)
                                    ->select('series.idSerieImdb as idImdb','list_series.idListSeries as id', 'series.poster as poster', 'series.nomeSerie as nomeSerie', 'list_series.epsAssistidos as epsAssistidos', 'list_series.epsTotais as epsTotais', 'list_series.status as status', 'list_series.temporada as temporada', 'list_series.created_at as createdate', 'list_series.updated_at as lastupdate')
                                    ->where('nomeSerie', 'like', '%'.$filtragem.'%')
                                    ->orderBy('status', 'desc')->orderBy('nomeSerie')->orderBy('temporada')->paginate(8)->setpath('serieslist?desc_filtro=',$filtragem);
        }

        return view('serieslist.index', ['series' => $series]);
    }

    public function destroy($id) {
        listSerie::find($id)->delete();
        return redirect()->route('serieslist');
    }

    public function edit($id){
        $serie = listSerie::find($id);
        $serieName = Serie::find($serie->idSerie);
        return view('serieslist.edit', compact('serie'), compact('serieName'));
    }

    public function create() {
        return view('serieslist.create');
    }

    public function store(ListSeriesRequest $request) {
        $new_serie = $request->all();
        listSerie::Create($new_serie);

        return redirect()->route('serieslist');
    }

    public function update(ListSeriesRequest $request, $id){
        $serie = listSerie::find($id);
        if($serie->epsAssistidos < $request->epsAssistidos){
            $eps = User::select('lifeTime','lifeEps')->where('id', auth()->user()->id)->first();
            $epsTotal = $eps->lifeEps + ($request->epsAssistidos-$serie->epsAssistidos);

            $serieTime = listSerie::join('series', 'series.idSerie', '=', 'list_series.idSerie')
            ->where('list_series.idUser', auth()->user()->id)
            ->select('series.epTime as epTime')->where('list_series.idListSeries', $id)->first();        

            $epsTime = $eps->lifeTime + ($serieTime->epTime * ($request->epsAssistidos-$serie->epsAssistidos));

            $user = User::find(auth()->user()->id);
            $user->lifeTime = $epsTime;
            $user->lifeEps = $epsTotal;
            $user->save();
        }else{
            $eps = User::select('lifeTime','lifeEps')->where('id', auth()->user()->id)->first();
            $epsTotal = $eps->lifeEps - ($serie->epsAssistidos-$request->epsAssistidos);

            $serieTime = listSerie::join('series', 'series.idSerie', '=', 'list_series.idSerie')
            ->where('list_series.idUser', auth()->user()->id)
            ->select('series.epTime as epTime')->where('list_series.idListSeries', $id)->first();        

            $epsTime = $eps->lifeTime - ($serieTime->epTime * ($serie->epsAssistidos-$request->epsAssistidos));

            $user = User::find(auth()->user()->id);
            $user->lifeTime = $epsTime;
            $user->lifeEps = $epsTotal;
            $user->save();
        }
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

        $timeSerie = Serie::find($serie->idSerie);
        $statusUser = User::find(auth()->user()->id);
        $statusUser->increment('lifeEps', 1);
        $statusUser->lifeTime = $statusUser->lifeTime + $timeSerie->epTime;
        $statusUser->save();

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

        $timeSerie = Serie::find($serie->idSerie);
        $statusUser = User::find(auth()->user()->id);
        $statusUser->decrement('lifeEps', 1);
        $statusUser->lifeTime = $statusUser->lifeTime - $timeSerie->epTime;
        $statusUser->save();

        return redirect()->route('serieslist');
    }

    public function onlyCompleted(){
        $series = listSerie::join('series', 'series.idSerie', '=', 'list_series.idSerie')
                            ->where('list_series.idUser', auth()->user()->id)
                            ->where('list_series.status', 'Completed')
                            ->select('series.idSerieImdb as idImdb','list_series.idListSeries as id', 'series.poster as poster', 'series.nomeSerie as nomeSerie', 'list_series.epsAssistidos as epsAssistidos', 'list_series.epsTotais as epsTotais', 'list_series.status as status', 'list_series.temporada as temporada', 'list_series.created_at as createdate', 'list_series.updated_at as lastupdate')
                            ->orderBy('nomeSerie')->paginate(10);
        return view('serieslist.index', ['series' => $series]);
    }

    public function onlyWatching(){
        $series = listSerie::join('series', 'series.idSerie', '=', 'list_series.idSerie')
                            ->where('list_series.idUser', auth()->user()->id)
                            ->where('list_series.status', 'Watching')
                            ->select('series.idSerieImdb as idImdb','list_series.idListSeries as id', 'series.poster as poster', 'series.nomeSerie as nomeSerie', 'list_series.epsAssistidos as epsAssistidos', 'list_series.epsTotais as epsTotais', 'list_series.status as status', 'list_series.temporada as temporada', 'list_series.created_at as createdate', 'list_series.updated_at as lastupdate')
                            ->orderBy('nomeSerie')->paginate(10);
        return view('serieslist.index', ['series' => $series]);
    }

    public function onlyPlanToWatch(){
        $series = listSerie::join('series', 'series.idSerie', '=', 'list_series.idSerie')
                            ->where('list_series.idUser', auth()->user()->id)
                            ->where('list_series.status', 'Plan to Watch')
                            ->select('series.idSerieImdb as idImdb','list_series.idListSeries as id', 'series.poster as poster', 'series.nomeSerie as nomeSerie', 'list_series.epsAssistidos as epsAssistidos', 'list_series.epsTotais as epsTotais', 'list_series.status as status', 'list_series.temporada as temporada', 'list_series.created_at as createdate', 'list_series.updated_at as lastupdate')
                            ->orderBy('nomeSerie')->paginate(10);
        return view('serieslist.index', ['series' => $series]);
    }

    public function description(Request $request){
        $serie = Http::get('https://api.themoviedb.org/3/tv/'.\Crypt::decrypt($request->get('id')).'?api_key='.config('services.tmdb.token').'&append_to_response=videos,credits')->json();
        
        return view('serieslist.description', compact('serie'));
    }
}
