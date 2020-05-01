@extends('adminlte::page')

@section('content')
        <h1>Series</h1>
        <table class="table table-strip table-bordered table-hover">
            <thead>
                <th>Poster</th>
                <th>Name</th>
                <th>Genres</th>
                <th>Seasons</th>
                <th>Score</th>
                <th>Description</th>
            </thead>

            <tbody>
                @foreach($series as $serie)
                    <tr>
                        <td><img width = 120px height = 140px src={{$serie->poster}} alt="poster"></td>
                        <td style="width:20%">{{$serie->nomeSerie}}</td>
                        <td style="width:20%">{{$serie->generoSerie}}</td>
                        <td style="width:10%">{{$serie->numTemps}}</td>
                        <td style="width:10%">{{$serie->notaSerie}}</td>
                        <td style="width:40%">{{$serie->descricao}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
@stop