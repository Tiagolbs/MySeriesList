<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Serie;

class moviesListController extends Controller
{
    public function index() { 
        $movies = DB::table('list_movies')->join('movies', 'movies.idMovie', '=', 'list_movies.idMovie')->where('list_movies.idUser', auth()->user()->id)->select('movies.poster as poster')->get();
        return view('movieslist.index', ['movies' => $movies]);
    }
}
