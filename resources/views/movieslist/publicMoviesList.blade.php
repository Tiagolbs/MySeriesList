@extends('layouts.default')

@section('content')
        <center><h1 style="font-family:fantasy">MOVIES</h1></center>

        <div style="width: 100%; text-align: center;">
            <div style="width: 50%; display: inline-block">
                <table class="table table-strip table-bordered table-hover">
                    <thead>
                        <th>Poster</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Score</th>
                        <th>Watched Date</th>
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
                                <td style="text-align:center; vertical-align:middle" style="width:20%"><b>{{$movie->nomeMovie}}</b></td>
                                <td style="text-align:center; vertical-align:middle" style="width:20%"><b>{{$movie->status}}</b></td>
                                <td style="text-align:center; vertical-align:middle"><i style="color: #FFAE00"class="fas fa-star"></i><b>{{$movie->score}}</b></td>
                                <td style="text-align:center; vertical-align:middle; width: 15%"><b>{{Carbon\Carbon::parse($movie->createdDate)->format('d/m/Y')}}</b></td>
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