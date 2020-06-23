<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Movies;
use App\listMovie;
use Auth;
use Illuminate\Support\Facades\Http;


class moviesListController extends Controller
{
    public function index(Request $filtro) {
        $filtragem = $filtro->get('desc_filtro');
        if($filtragem == NULL){
            $movies = listMovie::join('movies', 'movies.idMovie', '=', 'list_movies.idMovie')
                                ->where('list_movies.idUser', auth()->user()->id)
                                ->select('list_movies.status as status', 'list_movies.idListMovie as idListMovies','movies.notaMovie as score','movies.poster as poster', 'movies.nome as nomeMovie', 'list_movies.created_at as createDate', 'list_movies.updated_at as lastUpdate')
                                ->orderBy('status')->orderBy('nomeMovie')->paginate(8);
        }
        else{
            $movies = listMovie::join('movies', 'movies.idMovie', '=', 'list_movies.idMovie')
                                ->where('list_movies.idUser', auth()->user()->id)
                                ->select('list_movies.status as status', 'list_movies.idListMovie as idListMovies','movies.notaMovie as score','movies.poster as poster', 'movies.nome as nomeMovie', 'list_movies.created_at as createDate', 'list_movies.updated_at as lastUpdate')
                                ->where('movies.nome', 'like', '%'.$filtragem.'%')
                                ->orderBy('status')->orderBy('nomeMovie')->paginate(8)->setpath('movies?desc_filtro=',$filtragem);
        }

        return view('movieslist.index', ['movies' => $movies]);
    }

    public function destroy($id){
        listMovie::find($id)->delete();
        return redirect()->route('movieslist');
    }

    public function changeStatus($id){
        $movie = listMovie::find($id);
        if($movie->status == "Plan to Watch"){
            $movie->status = "Watched";
            $movie->save();
        }else{
            $movie->status = "Plan to Watch";
            $movie->save();
        }

        return redirect()->route('movieslist');
    }

    public function onlyPlanToWatch(){
        $movies = listMovie::join('movies', 'movies.idMovie', '=', 'list_movies.idMovie')
                                ->where('list_movies.idUser', auth()->user()->id)
                                ->select('list_movies.status as status', 'list_movies.idListMovie as idListMovies','movies.notaMovie as score','movies.poster as poster', 'movies.nome as nomeMovie', 'list_movies.created_at as createDate', 'list_movies.updated_at as lastUpdate')
                                ->where('status', '=', 'Plan to Watch')
                                ->orderBy('status')->orderBy('nomeMovie')->paginate(8);
        
        return view('movieslist.index', ['movies' => $movies]);
    }

    public function onlyWatched(){
        $movies = listMovie::join('movies', 'movies.idMovie', '=', 'list_movies.idMovie')
                                ->where('list_movies.idUser', auth()->user()->id)
                                ->select('list_movies.status as status', 'list_movies.idListMovie as idListMovies','movies.notaMovie as score','movies.poster as poster', 'movies.nome as nomeMovie', 'list_movies.created_at as createDate', 'list_movies.updated_at as lastUpdate')
                                ->where('status', '=', 'Watched')
                                ->orderBy('status')->orderBy('nomeMovie')->paginate(8);
        
        return view('movieslist.index', ['movies' => $movies]);
    }

    public function description(Request $request){
        $movie = Http::get('https://api.themoviedb.org/3/movie/'.\Crypt::decrypt($request->get('id')).'?api_key='.config('services.tmdb.token').'&append_to_response=videos,credits')->json();

        return view('movieslist.description', compact('movie'));
    }
}
