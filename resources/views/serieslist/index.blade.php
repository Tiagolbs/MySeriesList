@extends('layouts.default')

@section('content')
        <center><h1 style="font-family:fantasy">SERIES</h1></center>
        <div style="margin: auto; padding: 10px; text-align:center">
            <a href="{{ route('serieslist')}}" class="btn btn-outline-secondary btn-lg "><b>ALL SERIES</b></a>
            <a href="{{ route('serieslist.onlyWatching')}}" class="btn btn-outline-secondary btn-lg"><b>CURRENTLY WATCHING</b></a>
            <a href="{{ route('serieslist.onlyPlanToWatch')}}" class="btn btn-outline-secondary btn-lg"><b>PLAN TO WATCH</b></a>
            <a href="{{ route('serieslist.onlyCompleted')}}" class="btn btn-outline-secondary btn-lg"><b>COMPLETED SERIES</b></a>
        </div>
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
                    <tr>
                        <td style="width:5%"><img width = 95.4px height = 142.8px src={{$serie->poster}} alt="poster"></td>
                        <td style="text-align:center; vertical-align:middle"><b>{{$serie->nomeSerie}} - Season {{$serie->temporada}}</b></td>
                        <td style="width:125px; text-align:center; vertical-align:middle">
                            <b>{{$serie->epsAssistidos}} / {{$serie->epsTotais}}</b>     
                                <a style="text-align:right" href="{{ route('serieslist.addEp', ['id'=>$serie->id]) }}" class="btn btn-outline-primary btn-sm">+</a>
                                <a style="text-align:right" href="{{ route('serieslist.removeEp', ['id'=>$serie->id]) }}" class="btn btn-outline-danger btn-sm">-</a>
                        </td>
                        <td style="text-align:center; vertical-align:middle" style="width:10%"><b>{{$serie->status}}</b></td>
                        <td style="text-align:center; vertical-align:middle"><b>{{Carbon\Carbon::parse($serie->createdate)->format('d/m/Y')}}</b></td>
                        <td style="text-align:center; vertical-align:middle"><b>{{Carbon\Carbon::parse($serie->lastupdate)->format('d/m/Y')}}</b></td>
                        <td style="text-align:center; vertical-align:middle;"> 
                             <a style="font-size:20px;" href="#" onclick="return ConfirmaExclusao({{$serie->id}})" class="btn btn-outline-danger"><b>DELETE</b></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{$series->links()}}
        
@stop

@section('table-delete')
"serieslist"
@endsection