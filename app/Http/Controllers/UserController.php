<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\listSerie;
use App\Friends;
use Auth;
use DB;

class UserController extends Controller
{
    public function index() {
        $user = User::find(auth()->user()->id);

        $friendsList = Friends::select('name', 'id')->where('idUser', auth()->user()->id)->get();
        
        return view('user.profile', compact('user'), compact('friendsList'));
    }

    public function edit() {
        $user = User::find(auth()->user()->id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request) {
        User::find(\Crypt::decrypt($request->get('id')))->update($request->all());
        return redirect()->route('serieslist');
    }

    public function profile($name){
        $user = User::where('name', '=', $name)->first();

        $friendsList = Friends::select('name')->where('idUser', auth()->user()->id)->get();
        
        return view('user.profile', compact('user'), compact('friendsList'));
    }

    public function publicList($name){
        $idUser = User::where('name', '=', $name)->first();
        $series = listSerie::join('series', 'series.idSerie', '=', 'list_series.idSerie')
                                ->where('list_series.idUser', $idUser->id)
                                ->select('list_series.idListSeries as id', 'series.poster as poster', 'series.nomeSerie as nomeSerie', 'list_series.epsAssistidos as epsAssistidos', 'list_series.epsTotais as epsTotais', 'list_series.status as status', 'list_series.temporada as temporada', 'list_series.created_at as createdate', 'list_series.updated_at as lastupdate')
                                ->orderBy('status', 'desc')->paginate(10);
        
        return view('serieslist.publicList', ['series' => $series]);
    }

    public function addFriend($name){
        $idFriend = User::where('name', '=', $name)->first();

        $test = Friends::select('name')->where('idUser', '=', auth()->user()->id)->where('name', '=', $name)->first();

        if($test == NULL){
            $friend = new Friends();
            $friend->idUser = auth()->user()->id;
            $friend->idFriend = $idFriend->id;
            $friend->name = $name;
            $friend->save();
        }

        return redirect()->route('user.index');
    }

    public function deleteFriend($id){
            $friend = Friends::find($id)->delete();
            return redirect()->route('user.index');
    }
}
