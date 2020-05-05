<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Serie;
use Auth;

class moviesListController extends Controller
{
    public function index() { 
        if(Auth::guest()){
            return view('serieslist.noUser');
        }
        $movies = DB::table('list_movies')->join('movies', 'movies.idMovie', '=', 'list_movies.idMovie')
                                          ->where('list_movies.idUser', auth()->user()->id)
                                          ->select('movies.poster as poster, movies.nome as nomeMovie, movies.status as status, movies_list.created_at as createDate, movies_list.updated_at as lastUpdate')
                                          ->orderBy('status', 'desc')->paginate(10);
        return view('movieslist.index', ['movies' => $movies]);
    }
}
