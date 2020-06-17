@extends('adminlte::page')

@section('content')
        <center><h1 style="font-family:fantasy">Status {{$user->name}}</h1><center>
        Total Watched Episodes: {{$user->lifeEps}}</br>
        Total Watched Time (minutes): {{$user->lifeTime}}</br>
        Total Watched Time (hours): {{round($user->lifeTime/60,2)}}</br>
        Total Watched Time (days): {{round($user->lifeTime/60/24,2)}}
@stop