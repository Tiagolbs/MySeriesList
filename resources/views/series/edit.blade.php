@extends('adminlte::page')

@section('content')
    <h3>New Serie</h3>
    {!! Form::open(['url'=>'series/store']) !!}

        <div class="form-group">
            {!! Form::label('idSerieImdb', 'ID IMDB:') !!}
            {!! Form::text('idSerieImdb', null, ['class'=>'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('nomeSerie', 'Name:') !!}
            {!! Form::text('nomeSerie', null, ['class'=>'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('numTemps', 'Seasons:') !!}
            {!! Form::text('numTemps', null, ['class'=>'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('descricao', 'Description:') !!}
            {!! Form::text('descricao', null, ['class'=>'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('generoSerie', 'Genres:') !!}
            {!! Form::text('generoSerie', null, ['class'=>'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('notaSerie', 'Score:') !!}
            {!! Form::text('notaSerie', null, ['class'=>'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('poster', 'Poster Image Link:') !!}
            {!! Form::text('poster', null, ['class'=>'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Create Serie', ['class' => 'btn btn-primary']) !!}
            {!! Form::reset('Reset', ['class'=>'btn btn-default']) !!}
        </div>

        

    {!! Form::close() !!}
@stop