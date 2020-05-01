@extends('adminlte::page')

@section('content')
        @foreach($series as $serie)
            <li>{{ $serie->nomeSerie }} </li>
            <li>{{ $serie->numTemps }} </li>
            <li>{{ $serie->generoSerie }} </li>
            <li>{{ $serie->notaSerie }} </li>
            <br>
        @endforeach
@stop