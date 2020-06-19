@extends('adminlte::page')

@section('content')
    <h3>Editing: {{$user->name}}</h3>

    @if($errors->any())
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form enctype="multipart/form-data" action="updateAvatar" method="POST">
            <label> Profile Image: </label>
            <br>
            <input type = "file" name="avatar">
            <input type = "hidden" name = "_token" value = "{{csrf_token()}}">
            <input type = "submit" class="pull-right btn btn-sm btn-primary">
    </form>
    {!! Form::open(['route'=> ['user.update', 'id'=>\Crypt::encrypt($user->id)], 'method'=>'put']) !!}

        <div hidden class="form-group">
            {!! Form::label('id', 'id:') !!}
            {!! Form::text('id', $user->id, ['class'=>'form-control', 'required', 'readonly']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', $user->name, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::text('email', $user->email, ['class'=>'form-control']) !!}
        </div>

        <br>

        <div class="form-group">
            {!! Form::submit('Edit User', ['class' => 'btn btn-primary']) !!}
            {!! Form::reset('Reset', ['class'=>'btn btn-default']) !!}
        </div>

    {!! Form::close() !!}
@stop