@extends('adminlte::page')

@section('content')
    <h3>New Serie</h3>
    {!! Form::open(['route'=>["serieslist.update", 'id'=>$serie->id], 'method'=>'put']) !!}
    
        <div class="form-group">
            {!! Form::label('idSerie', 'idSerie:') !!}
            {!! Form::text('idSerie', $serie->idSerie, ['class'=>'form-control', 'required','readonly']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('temporada', 'Season:') !!}
            {!! Form::text('temporada', $serie->temporada, ['class'=>'form-control', 'required','readonly']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('epsAssistidos', 'Watched Episodes: ') !!}
            {!! Form::text('epsAssistidos', null, ['class'=>'form-control', 'required','readonly']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('epsTotais', 'Total Eps:') !!}
            {!! Form::text('epsTotais', $serie->epsTotais, ['class'=>'form-control', 'required','readonly']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status', 'Status:') !!}
            {!! Form::select('status',
                            array('Completed'=>'Completed',
                                  'Watching'=>'Watching'),
                            'Watching', ['class'=>'form-control','required'])!!}
        </div> 

        <div class="form-group">
            {!! Form::submit('Edit Serie', ['class' => 'btn btn-primary']) !!}
            {!! Form::reset('Reset', ['class'=>'btn btn-default']) !!}
        </div>

    {!! Form::close() !!}
@stop