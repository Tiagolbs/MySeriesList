@extends('adminlte::page')

@section('content')
    <h3>New Serie</h3>
    {!! Form::open(['route'=>'serieslist.store']) !!}

        <div hidden class="form-group">
            {!! Form::label('idUser', 'idUser:') !!}
            {!! Form::text('idUser', auth()->user()->id, ['class'=>'form-control', 'required', 'readonly']) !!}
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
                            array('Completed'=>'Completed',
                                  'Watching'=>'Watching'),
                            'Watching', ['class'=>'form-control','required'])!!}
        </div>
        <div class="form-group">
            {!! Form::submit('Create Serie', ['class' => 'btn btn-primary']) !!}
            {!! Form::reset('Reset', ['class'=>'btn btn-default']) !!}
        </div>

        

    {!! Form::close() !!}
@stop