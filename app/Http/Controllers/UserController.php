<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\listSerie;
use App\Friends;
use Auth;
use Image;

class UserController extends Controller
{
    public function index() { #Profile privado
        $user = User::find(auth()->user()->id);

        $friendsList = Friends::join('users', 'users.id', '=', 'friends.idFriend')
                                ->select('friends.name as name', 'friends.id as id', 'users.avatar as avatar')
                                ->where('idUser', auth()->user()->id)->get();

        $countCompleted = listSerie::where('list_series.idUser', auth()->user()->id)->where('status', '=', 'Completed')->count();
        $countPtoW = listSerie::where('list_series.idUser', auth()->user()->id)->where('status', '=', 'Plan to Watch')->count();
        $countWatching= listSerie::where('list_series.idUser', auth()->user()->id)->where('status', '=', 'Watching')->count();

        return view('user.profile', compact('user'), compact(['friendsList', 'countCompleted', 'countPtoW', 'countWatching']));
    }

    public function edit() { #Editar informações do usuário
        $user = User::find(auth()->user()->id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request) {
        User::find(\Crypt::decrypt($request->get('id')))->update($request->all());
        return redirect()->route('serieslist');
    }

    public function profile($name){ #Profile publico
        $user = User::where('name', '=', $name)->first();

        $friendsList = Friends::select('name')->where('idUser', auth()->user()->id)->get();

        $test = Friends::select('name')->where('idUser', '=', auth()->user()->id)->where('name', '=', $name)->first();

        $countCompleted = listSerie::where('list_series.idUser', $user->id)->where('status', '=', 'Completed')->count();
        $countPtoW = listSerie::where('list_series.idUser', $user->id)->where('status', '=', 'Plan to Watch')->count();
        $countWatching= listSerie::where('list_series.idUser', $user->id)->where('status', '=', 'Watching')->count();
        
        return view('user.profile', compact('user'), compact(['friendsList', 'countCompleted', 'countPtoW', 'countWatching']))->with(compact('test'));
    }

    public function publicList($name){ #Lista de séries publica
        $idUser = User::where('name', '=', $name)->first();
        $series = listSerie::join('series', 'series.idSerie', '=', 'list_series.idSerie')
                                ->where('list_series.idUser', $idUser->id)
                                ->select('list_series.idListSeries as id', 'series.poster as poster', 'series.nomeSerie as nomeSerie', 'list_series.epsAssistidos as epsAssistidos', 'list_series.epsTotais as epsTotais', 'list_series.status as status', 'list_series.temporada as temporada', 'list_series.created_at as createdate', 'list_series.updated_at as lastupdate')
                                ->orderBy('status', 'desc')->paginate(10);
        
        return view('serieslist.publicList', ['series' => $series]);
    }

    public function addFriend($name){ #Adicionar amigo
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

    public function deleteFriend($id){ #Remover amigo
            $friend = Friends::find($id)->delete();
            return redirect()->route('user.index');
    }

    public function searchFriend(Request $filtro){ #Procurar amigo
        $filtragem = $filtro->get('desc_filtro');
        if($filtragem == NULL){
            $searchFriend = NULL;
        }
        else{
            $searchFriend = User::select('name', 'id')->where('name', 'like', '%'.$filtragem.'%')->get();
        }

        return view('user.searchFriend')->with(compact('searchFriend'));
    }

    public function updateAvatar(Request $request){
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save(public_path('/uploads/avatars/'.$filename));

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }

        return redirect()->route('user.index');

    }
}
