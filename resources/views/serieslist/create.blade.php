@extends('adminlte::page')

@section('content')
    <h3>New Serie</h3>
    {!! Form::open(['url'=>'serieslist/store']) !!}

        <div class="form-group">
            {!! Form::label('idUser', 'idUser:') !!}
            {!! Form::text('idUser', null, ['class'=>'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('idSerie', 'idSerie:') !!}
            {!! Form::text('idSerie', null, ['class'=>'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('temporada', 'Season:') !!}
            {!! Form::text('temporada', null, ['class'=>'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('epsAssistidos', 'Watched Episodes: ') !!}
            {!! Form::text('epsAssistidos', null, ['class'=>'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('epsTotais', 'Total Eps:') !!}
            {!! Form::text('epsTotais', null, ['class'=>'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status', 'Status:') !!}
            {!! Form::select('status',
                            array('Complete',
                                  'Watching'),
                            'Watching', ['class'=>'form-control','required'])!!}
        </div>
        <div class="form-group">
            {!! Form::submit('Create Serie', ['class' => 'btn btn-primary']) !!}
            {!! Form::reset('Reset', ['class'=>'btn btn-default']) !!}
        </div>

        

    {!! Form::close() !!}
@stop