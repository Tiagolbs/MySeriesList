@extends('adminlte::page')

@section('content')
    {!! Form::open(['route'=> ['series.update', 'id'=>$serie->idSerie], 'method'=>'put']) !!}



        <divclass="form-group">
            {!! Form::label('idSerieImdb', 'idSerieImdb:') !!}
            {!! Form::text('idSerieImdb', $serie->idSerieImdb, ['class'=>'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('nomeSerie', 'nomeSerie:') !!}
            {!! Form::text('nomeSerie', $serie->nomeSerie, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('numTemps', 'numTemps:') !!}
            {!! Form::text('numTemps', $serie->numTemps, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('descricao', 'descricao: ') !!}
            {!! Form::text('descricao', $serie->descricao, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('generoSerie', 'generoSerie:') !!}
            {!! Form::text('generoSerie', $serie->generoSerie, ['class'=>'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('notaSerie', 'notaSerie:') !!}
            {!! Form::text('notaSerie', $serie->notaSerie, ['class'=>'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('poster', 'poster:') !!}
            {!! Form::text('poster', $serie->poster, ['class'=>'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('epTime', 'epTime:') !!}
            {!! Form::text('epTime', $serie->epTime, ['class'=>'form-control', 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Edit Serie', ['class' => 'btn btn-primary']) !!}
            {!! Form::reset('Reset', ['class'=>'btn btn-default']) !!}
        </div>



    {!! Form::close() !!}
@stop
