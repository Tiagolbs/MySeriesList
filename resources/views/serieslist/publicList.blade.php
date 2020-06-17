@extends('layouts.default')

@section('content')
        <center><h1 style="font-family:fantasy">SERIES</h1></center>

        <table class="table table-strip table-bordered table-hover">
            <thead>
                <th>Poster</th>
                <th>Name</th>
                <th>Progress</th>
                <th>Status</th>
                <th>Started Date</th>
                <th>Last Update</th>
            </thead>

            <tbody>
                @foreach($series as $serie)
                    <tr>
                        <td style="width:5%"><img width = 95.4px height = 142.8px src={{$serie->poster}} alt="poster"></td>
                        <td style="text-align:center; vertical-align:middle"><b>{{$serie->nomeSerie}} - Season {{$serie->temporada}}</b></td>
                        <td style="width:125px; text-align:center; vertical-align:middle">
                            <b>{{$serie->epsAssistidos}} / {{$serie->epsTotais}}</b>     
                        </td>
                        <td style="text-align:center; vertical-align:middle" style="width:10%"><b>{{$serie->status}}</b></td>
                        <td style="text-align:center; vertical-align:middle"><b>{{Carbon\Carbon::parse($serie->createdate)->format('d/m/Y')}}</b></td>
                        <td style="text-align:center; vertical-align:middle"><b>{{Carbon\Carbon::parse($serie->lastupdate)->format('d/m/Y')}}</b></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{$series->links()}}
        
@stop

@section('table-delete')
"serieslist"
@endsection