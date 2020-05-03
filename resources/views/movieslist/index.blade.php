@extends('adminlte::page')

@section('content')
        <h1>Movies</h1>
        <table class="table table-strip table-bordered table-hover">
            <thead>
                <th>Poster</th>
                <th>Name</th>
                <th>Genres</th>
                <th>Score</th>
                <th>Description</th>
            </thead>

            <tbody>
                @foreach($movies as $movie)
                    <tr>
                        <td><img width = 120px height = 140px src={{$movie->poster}} alt="poster"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
@stop