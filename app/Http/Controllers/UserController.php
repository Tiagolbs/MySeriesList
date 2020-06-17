<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\listSerie;

class UserController extends Controller
{
    public function index() {
        $user = User::find(auth()->user()->id);
        
        return view('user.status', ['user' => $user]);
    }

    public function edit() {
        $user = User::find(auth()->user()->id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request) {
        User::find(\Crypt::decrypt($request->get('id')))->update($request->all());
        return redirect()->route('serieslist');
    }

    public function status($name){
        $user = User::where('name', '=', $name)->first();
        
        return view('user.status', ['user' => $user]);
    }

    public function publicList($name){
        $idUser = User::where('name', '=', $name)->first();
        $series = listSerie::join('series', 'series.idSerie', '=', 'list_series.idSerie')
                                ->where('list_series.idUser', $idUser->id)
                                ->select('list_series.idListSeries as id', 'series.poster as poster', 'series.nomeSerie as nomeSerie', 'list_series.epsAssistidos as epsAssistidos', 'list_series.epsTotais as epsTotais', 'list_series.status as status', 'list_series.temporada as temporada', 'list_series.created_at as createdate', 'list_series.updated_at as lastupdate')
                                ->orderBy('status', 'desc')->paginate(10);
        
        return view('serieslist.publicList', ['series' => $series]);
    }
}
