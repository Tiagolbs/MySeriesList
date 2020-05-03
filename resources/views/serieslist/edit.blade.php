@extends('adminlte::page')

@section('content')
    <h3>New Serie</h3>
    {!! Form::open(['url'=>"serieslist/$serie->id/update", 'method'=>'put']) !!}

        <div class="form-group">
            {!! Form::label('epsAssistidos', 'Watched Episodes:') !!}
            {!! Form::text('epsAssistidos', $serie->epsAssistidos, ['class'=>'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status', 'Status:') !!}
            {!! Form::select('status',
                            array('Complete',
                                  'Watching'),
                            'Watching', ['class'=>'form-control','required'])!!}
        </div> 

        <div class="form-group">
            {!! Form::submit('Edit Serie', ['class' => 'btn btn-primary']) !!}
            {!! Form::reset('Reset', ['class'=>'btn btn-default']) !!}
        </div>

    {!! Form::close() !!}
@stop