@extends('adminlte::page')

@section('content')
        <h1>Series</h1>
        <table class="table table-strip table-bordered table-hover">
            <thead>
                <th>Poster</th>
                <th>Name</th>
                <th>Season</th>
                <th>Eps</th>
                <th>Total Eps</th>
                <th>Status</th>
            </thead>

            <tbody>
                @foreach($series as $serie)
                    <tr>
                        <td style="width:5%"><img width = 120px height = 140px src={{$serie->poster}} alt="poster"></td>
                        <td style="width:20%">{{$serie->nomeSerie}}</td>
                        <td style="width:20%">{{$serie->temporada}}</td>
                        <td style="width:20%">{{$serie->epsAssistidos}}</td>
                        <td style="width:10%">{{$serie->epsTotais}}</td>
                        <td style="width:10%">{{$serie->status}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
@stop