@extends('layouts.default')

@section('content')
        <center><h3 style="font-family:fantasy">No User</h3><center>
        <center>
            <a href="{{ route('login')}}" class="btn btn-outline-secondary btn-lg"><b>Login</b></a>
            <a href="{{ route('register')}}" class="btn btn-outline-secondary btn-lg"><b>Register</b></a>
        </center>
@stop
