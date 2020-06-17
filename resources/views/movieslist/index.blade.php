@extends('layouts.default')

@section('content')
        <center><h1 style="font-family:fantasy">MOVIES</h1></center>
        <table class="table table-strip table-bordered table-hover">
            <thead>
                <th>Poster</th>
                <th>Name</th>
                <th>Status</th>
                <th>Watched Date</th>
                <th>Actions</th>
            </thead>

            <tbody>
                @foreach($movies as $movie)
                    <tr>
                        <td style="width:5%"><img width = 120px height = 140px src={{$serie->poster}} alt="poster"></td>
                        <td style="width:20%">{{$movie->nomeMovie}}</td>
                        <td style="width:20%">{{$movie->status}}</td>
                        <td style="text-align:center; vertical-align:middle"><b>{{Carbon\Carbon::parse($movie->createdDate)->format('d/m/Y')}}</b></td>
                        <td style="text-align:center; vertical-align:middle;"> 
                             <a style="font-size:30px; display:block" href="#" onclick="return ConfirmaExclusao({{$serie->id}})" class="btn-sm btn-danger"><b>DELETE</b></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
@stop