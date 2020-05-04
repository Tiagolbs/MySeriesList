@extends('adminlte::page')

@section('content')
        <center><h1>MOVIES</h1><center>
        <table class="table table-strip table-bordered table-hover">
            <thead>
                <th>Poster</th>
                <th>Name</th>
                <th>Status</th>
                <th>Started Date</th>
                <th>Last Update</th>
            </thead>

            <tbody>
                @foreach($movies as $movie)
                    <tr>
                        <td style="width:5%"><img width = 120px height = 140px src={{$serie->poster}} alt="poster"></td>
                        <td style="width:20%">{{$movie->nomeMovie}}</td>
                        <td style="width:20%">{{$movie->status}}</td>
                        <td style="width:20%">{{$movie->createdDate}}</td>
                        <td style="width:20%">{{$movie->lastUpdate}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
@stop