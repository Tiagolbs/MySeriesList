@extends('layouts.default')

@section('content')
        <center><h1 style="font-family:fantasy">SERIES</h1></center>
        <div style="margin: auto; padding: 10px; text-align:center">
            <a href="{{ route('serieslist')}}" class="btn btn-outline-secondary btn-lg "><b>ALL SERIES</b></a>
            <a href="{{ route('serieslist.onlyWatching')}}" class="btn btn-outline-secondary btn-lg"><b>CURRENTLY WATCHING</b></a>
            <a href="{{ route('serieslist.onlyPlanToWatch')}}" class="btn btn-outline-secondary btn-lg"><b>PLAN TO WATCH</b></a>
            <a href="{{ route('serieslist.onlyCompleted')}}" class="btn btn-outline-secondary btn-lg"><b>COMPLETED SERIES</b></a>
        </div>

        {!! Form::open(['name'=>'form_name', 'route'=>'serieslist']) !!}
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
            <div style="width: 90%; display: inline-block">
                <table class="table table-strip table-bordered table-hover">
                    <thead>
                        <th>Poster</th>
                        <th>Name</th>
                        <th>Progress</th>
                        <th>Status</th>
                        <th>Started Date</th>
                        <th>Last Update</th>
                        <th></th>
                    </thead>

                    <tbody>
                        @foreach($series as $serie)
                        <?php if($serie->status == "Watching"):?>
                            <?php $color = "#00C303" ?>
                        <?php elseif($serie->status == "Completed"):?>
                            <?php $color = "gray" ?>
                        <?php else: ?>
                            <?php $color = "#00AEFF" ?>
                        <?php endif ?>



                            <tr>
                                <td style="width:5%; border-left: 6px solid {{$color}};"><img width = 95.4px height = 142.8px src="{{'https://image.tmdb.org/t/p/w500/'.$serie->poster}}" alt="poster"></td>
                                <td style="text-align:center; vertical-align:middle"><b>{{$serie->nomeSerie}} - Season {{$serie->temporada}}</b></td>
                                <td style="width:125px; text-align:center; vertical-align:middle">
                                    <b>{{$serie->epsAssistidos}} / {{$serie->epsTotais}}</b> 
                                    <?php if($serie->epsAssistidos != $serie->epsTotais): ?> 
                                        <a style="text-align:right" href="{{ route('serieslist.addEp', ['id'=>$serie->id]) }}" class="btn btn-outline-primary btn-sm">+</a>
                                    <?php endif ?>
                                        <a style="text-align:right" href="{{ route('serieslist.removeEp', ['id'=>$serie->id]) }}" class="btn btn-outline-danger btn-sm">-</a>
                                </td>
                                <td style="text-align:center; vertical-align:middle" style="width:10%"><b>{{$serie->status}}</b></td>
                                <td style="text-align:center; vertical-align:middle"><b>{{Carbon\Carbon::parse($serie->createdate)->format('d/m/Y')}}</b></td>
                                <td style="text-align:center; vertical-align:middle"><b>{{Carbon\Carbon::parse($serie->lastupdate)->format('d/m/Y')}}</b></td>
                                <td style="text-align:center; vertical-align:middle;"> 
                                    <a style="font-size:20px;" href="{{route('serieslist.edit', ['id'=>$serie->id]) }}" class="btn btn-primary"><b>EDIT</b></a>
                                    <a id="btnDelete" style="font-size:20px;" href="#" onclick="return ConfirmaExclusao({{$serie->id}})" class="btn btn-danger"><b>DELETE</b></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{$series->links()}}
        
@stop

@section('table-delete')
"serieslist"
@endsection