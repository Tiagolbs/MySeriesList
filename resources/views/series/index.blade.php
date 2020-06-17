@extends('adminlte::page')

@section('content')
        <center><h1>SERIES</h1><center>
        <table class="table table-strip table-bordered table-hover">
            <thead>
                <th>Poster</th>
                <th>Name</th>
                <th>Seasons</th>
            </thead>

            <tbody>
                @foreach($series as $serie)
                    <tr>
                        <td style="width:5%"><img width = 120px height = 140px src={{$serie->poster}} alt="poster"></td>
                        <td style="width:20%">{{$serie->nomeSerie}}</td>
                        <td style="width:20%">{{$serie->numTemps}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
@stop