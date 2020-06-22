@extends('layouts.default')

@section('content')
    <center><h1 style="font-family:fantasy">MySeriesList</h1></center>

        {!! Form::open(['name'=>'form_name', 'route'=>'home']) !!}
            <div class="sidebar-form" style="width:100%">
                <div class="input-group" style="width:45%; margin:auto">
                    <input type="text" name="desc_filtro" class="form-control" style="width:80% !important;" placeholder="Search for tv show or movie">
                    <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </div>
        {!! Form::close() !!}

        <br>

        <div style="float: right; width: 50%">
        <table class="table table-strip table-bordered table-hover" style="background: #F4F6F9">
            <thead>
                <th>Poster</th>
                <th>Movie Title </th>
                <th>Score</th>
                <th></th>
            </thead>

            <tbody>
                @foreach($popularMovies as $Movie)
                    <tr>
                        <td style="width:5%"><img width = 95.4px height = 142.8px src="{{'https://image.tmdb.org/t/p/w500/'.$Movie['poster_path']}}" alt="poster"></td>
                        <td style="text-align:center; vertical-align:middle"><b>{{$Movie['title']}}</b></td>
                        <td width=5%  style="text-align:center; vertical-align:middle"><i style="color: #FFAE00"class="fas fa-star"></i><b>{{$Movie['vote_average']}}</b></td>
                        <td style="text-align:center; vertical-align:middle;width:13%"><a style="text-align:right" href="{{ route('home.addListMovies', ['id'=>$Movie['id']]) }}" class="btn btn-primary btn-sm">Add to List</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>

        <div style="float: left; width: 50%">
        <table class="table table-strip table-bordered table-hover" style="background: #F4F6F9">
            <thead>
                <th>Poster</th>
                <th>Serie Title</th>
                <th>Score</th>
                <th></th>
            </thead>

            <tbody>
                @foreach($popularSeries as $Serie)
                    <tr>
                        <td style="width:5%"><img width = 95.4px height = 142.8px src="{{'https://image.tmdb.org/t/p/w500/'.$Serie['poster_path']}}" alt="poster"></td>
                        <td style="text-align:center; vertical-align:middle"><b>{{$Serie['original_name']}}</b></td>
                        <td width=5% style="text-align:center; vertical-align:middle"><i style="color: #FFAE00"class="fas fa-star"></i><b>{{$Serie['vote_average']}}</b></td>
                        <td style="text-align:center; vertical-align:middle;width: 13%">
                            {!! Form::open(['route'=> ['home.addListSeries']]) !!}

                            <div hidden class="form-group">
                                {!! Form::label('idSerie', 'idSerie:') !!}
                                {!! Form::text('idSerie', $Serie['id'], ['class'=>'form-control', 'required', 'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('temporada', 'Season:') !!}
                                {!! Form::text('temporada', null, ['class'=>'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::submit('Add to List', ['class' => 'btn btn-primary']) !!}
                            </div>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
@stop
