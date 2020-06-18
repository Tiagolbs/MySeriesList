@extends('layouts.default')

@section('content')
        <center><h1 style="font-family:fantasy">Status {{$user->name}}</h1><center>
        
        <?php if(auth()->user()->name != $user->name) : ?>
                <a href="{{ route('user.addFriend', ['name'=>$user->name])}}" class="btn btn-outline-secondary btn-sm"><b>ADD FRIEND</b></a>
        <?php endif ?>

        Total Watched Episodes: {{$user->lifeEps}}</br>
        Total Watched Time (minutes): {{$user->lifeTime}}</br>
        Total Watched Time (hours): {{round($user->lifeTime/60,2)}}</br>
        Total Watched Time (days): {{round($user->lifeTime/60/24,2)}}


        <?php if(auth()->user()->name == $user->name) : ?>
        <table class="table table-strip table-bordered table-hover">
            <thead>
                <th>Friends</th>
            </thead>
                  
        @foreach($friendsList as $friend)
                    <tr>
                        <td  style="text-align:center; vertical-align:middle"><a href="{{ route('user.profile', ['name'=>$friend->name])}}"><b>{{$friend->name}}</b></a>
                        <a href="{{ route('user.deleteFriend', ['id'=>$friend->id])}}" class = "btn-sm btn-danger"><b>DELETE</b></a>
                        </td>
                    </tr>
        @endforeach
        </table>
        <?php endif ?>
@stop
