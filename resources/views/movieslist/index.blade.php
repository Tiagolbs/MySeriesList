@extends('layouts.default')

@section('content')
        <center><h1 style="font-family:fantasy">MOVIES</h1></center>

        <div style="margin: auto; padding: 10px; text-align:center">
            <a href="{{ route('movieslist')}}" class="btn btn-outline-secondary btn-lg "><b>ALL MOVIES</b></a>
            <a href="{{ route('movieslist.onlyWatched')}}" class="btn btn-outline-secondary btn-lg"><b>WATCHED</b></a>
            <a href="{{ route('movieslist.onlyPlanToWatch')}}" class="btn btn-outline-secondary btn-lg"><b>PLAN TO WATCH</b></a>
        </div>

        {!! Form::open(['name'=>'form_name', 'route'=>'movieslist']) !!}
            <div class="sidebar-form" style="width:100%">
                <div class="input-group" style="width:45%; margin:auto">
                    <input type="text" name="desc_filtro" class="form-control" style="width:80% !important;" placeholder="Search by name">
                    <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </div>
        {!! Form::close() !!}

        <br>

        <div style="width: 100%; text-align: center;">
            <div style="width: 50%; display: inline-block">
                <table class="table table-strip table-bordered table-hover">
                    <thead>
                        <th>Poster</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Score</th>
                        <th>Watched Date</th>
                        <th>Actions</th>
                    </thead>

                    <tbody>
                        @foreach($movies as $movie)
                        <?php if($movie->status == "Watched"):?>
                            <?php $color = "#00C303" ?>
                        <?php elseif($movie->status == "Plan to Watch"):?>
                            <?php $color = "#00AEFF" ?>
                        <?php endif ?>
                            <tr>
                                <td style="width:5%; border-left: 6px solid {{$color}};"><img width = 95.4px height = 142.8px src="{{'https://image.tmdb.org/t/p/w500/'.$movie->poster}}" alt="poster"></td>
                                <td style="text-align:center; vertical-align:middle" style="width:20%"><a href="{{ route('movieslist.description', ['id'=>\Crypt::encrypt($movie->idImdb)])}}" ><b>{{$movie->nomeMovie}}</b></a></td>
                                <td style="text-align:center; vertical-align:middle" style="width:20%"><b>{{$movie->status}}</b></td>
                                <td style="text-align:center; vertical-align:middle"><i style="color: #FFAE00"class="fas fa-star"></i><b>{{$movie->score}}</b></td>
                                <td style="text-align:center; vertical-align:middle; width: 15%"><b>{{Carbon\Carbon::parse($movie->createdDate)->format('d/m/Y')}}</b></td>
                                <td style="text-align:center; vertical-align:middle; width: 20%">
                                    <a style="font-size:15px; display:block" href="{{ route('movieslist.changeStatus', ['id'=>$movie->idListMovies]) }}" class="btn btn-primary btn-sm">CHANGE STATUS</a>
                                    <a style="font-size:15px; display:block" href="#" onclick="return ConfirmaExclusao({{$movie->idListMovies}})" class="btn-sm btn-danger"><b>DELETE</b></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{$movies->links()}}
@stop

@section('table-delete')
"movieslist"
@endsection