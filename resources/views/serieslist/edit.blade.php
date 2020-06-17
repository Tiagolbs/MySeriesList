@extends('adminlte::page')

@section('content')
    <h3>Editing: {{$serieName->nomeSerie}}</h3>

    @if($errors->any())
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    {!! Form::open(['route'=> ['serieslist.update', 'id'=>$serie->idListSeries], 'method'=>'put']) !!}



        <div hidden class="form-group">
            {!! Form::label('idUser', 'idUser:') !!}
            {!! Form::text('idUser', $serie->idUser, ['class'=>'form-control', 'required', 'readonly']) !!}
        </div>
        <div hidden class="form-group">
            {!! Form::label('idSerie', 'idSerie:') !!}
            {!! Form::text('idSerie', $serie->idSerie, ['class'=>'form-control', 'readonly']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('temporada', 'Season:') !!}
            {!! Form::text('temporada', $serie->temporada, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('epsAssistidos', 'Watched Episodes: ') !!}
            {!! Form::text('epsAssistidos', $serie->epsAssistidos, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('epsTotais', 'Total Eps:') !!}
            {!! Form::text('epsTotais', $serie->epsTotais, ['class'=>'form-control', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status', 'Status:') !!}
            {!! Form::select('status',
                            array('Completed'=>'Completed',
                                  'Watching'=>'Watching',
                                  'Plan to Watch'=> 'Plan to Watch'),
                                  $serie->status, ['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::submit('Edit Serie', ['class' => 'btn btn-primary']) !!}
            {!! Form::reset('Reset', ['class'=>'btn btn-default']) !!}
        </div>

        

    {!! Form::close() !!}
@stop