<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\config\services;
use App\Serie;
use App\listSerie;
use App\Movie;
use App\listMovie;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $filtro){
        $filtragem = $filtro->get('desc_filtro');
        if($filtragem == NULL){
            $popularMovies = Http::
            get('https://api.themoviedb.org/3/movie/popular?api_key='.config('services.tmdb.token'))
            ->json()['results'];

            $popularSeries = Http::
            get('https://api.themoviedb.org/3/tv/popular?api_key='.config('services.tmdb.token'))
            ->json()['results'];
        }else{
            $popularMovies = Http::
            get('https://api.themoviedb.org/3/search/movie?api_key='.config('services.tmdb.token').'&query='.$filtragem)
            ->json()['results'];
            $popularSeries = Http::
            get('https://api.themoviedb.org/3/search/tv?api_key='.config('services.tmdb.token').'&query='.$filtragem)
            ->json()['results'];
        }
        
        return view('home', ['popularMovies' => $popularMovies])->with(compact('popularSeries'));
    }


    public function addListSeries(Request $request){

        $season = $request->get('temporada');
        $idSerie = $request->get('idSerie');

        $serie = Http::get('https://api.themoviedb.org/3/tv/'.$idSerie.'?api_key='.config('services.tmdb.token'))
        ->json();

        $season = (int)$season - 1;

        if(Serie::where('idSerieImdb', '=', $idSerie)->first() == NULL){
            $addSerie = new Serie();
            $addSerie->idSerieImdb = $serie['id'];
            $addSerie->nomeSerie = $serie['original_name'];
            $addSerie->numTemps = sizeof($serie['seasons']);
            $addSerie->descricao = $serie['overview'];
            $addSerie->generoSerie = $serie['genres']['0']['name'];
            $addSerie->notaSerie = $serie['vote_average'];
            $addSerie->poster = $serie['poster_path'];
            $addSerie->epTime = $serie['episode_run_time'][0];
            $addSerie->save();
        }

        $idSerie = Serie::select('idSerie', 'numTemps')->where('idSerieImdb', '=', $idSerie)->first();
        if(listSerie::where('idUser', '=', auth()->user()->id)->where('idSerie','=',$idSerie->idSerie)->where('temporada','=',$season+1)->first() == NULL){
            $addList = new listSerie();
            $addList->idUser = auth()->user()->id;
            $addList->idSerie = $idSerie->idSerie;
            if($idSerie->numTemps < $season+1){
                return redirect()->route('home')->with('alert','Error: Season '. ($season+1) .' does not exist --- Last Season: '.$idSerie->numTemps);
            }
            $addList->temporada = $season+1;
            $addList->epsAssistidos = 0;
            $addList->epsTotais = $serie['seasons'][strval($season)]['episode_count'];
            $addList->status = "Plan to Watch";
            $addList->save();
        }

        return redirect()->route('serieslist');
    }

    public function addListMovies($id){
        $movie = Http::get('https://api.themoviedb.org/3/movie/'.$id.'?api_key='.config('services.tmdb.token'))
        ->json();


        if(Movie::where('idImdb', '=', $id)->first() == NULL){
            $addMovie = new Movie();
            $addMovie->idImdb = $movie['id'];
            $addMovie->nome = $movie['original_title'];
            $addMovie->poster = $movie['poster_path'];
            $addMovie->descricao = $movie['overview'];
            $addMovie->generoMovie = $movie['genres']['0']['name'];
            $addMovie->notaMovie = $movie['vote_average'];
            $addMovie->save();
        }

        $idMovie = Movie::select('idMovie')->where('idImdb', '=', $id)->first();
        if(listMovie::where('idUser', '=', auth()->user()->id)->where('idMovie', '=', $idMovie->idMovie)->first() == NULL){
            $addList = new listMovie();
            $addList->idUser = auth()->user()->id;
            $addList->idMovie = $idMovie->idMovie;
            $addList->status = "Plan to Watch";
            $addList->save();
        }

        return redirect()->route('movieslist');


    }
}
