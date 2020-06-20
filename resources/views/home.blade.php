@extends('layouts.default')

@section('content')
    <center><h1 style="font-family:fantasy">MySeriesList</h1></center>

        {!! Form::open(['name'=>'form_name', 'route'=>'user.searchFriend']) !!}
            <div class="sidebar-form" style="width:100%">
                <div class="input-group" style="width:45%; margin:auto">
                    <input type="text" name="desc_filtro" class="form-control" style="width:80% !important;" placeholder="Search tv show or movie">
                    <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </div>
        {!! Form::close() !!}

        <br>
@stop