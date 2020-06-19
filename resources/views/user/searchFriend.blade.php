@extends('layouts.default')

@section('content')
    <center><h1 style="font-family:fantasy">Search Friends</h1></center>

        {!! Form::open(['name'=>'form_name', 'route'=>'user.searchFriend']) !!}
            <div class="sidebar-form" style="width:100%">
                <div class="input-group" style="width:45%; margin:auto">
                    <input type="text" name="desc_filtro" class="form-control" style="width:80% !important;" placeholder="Search by name">
                    <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </div>
        {!! Form::close() !!}

        <br>
        
        <?php if(is_object($searchFriend) and $searchFriend != NULL): ?>
        <table style="margin-left: auto; margin-right: auto; width: 50%" class="table table-strip table-bordered table-hover">
            <thead>
                <th>Name</th>
            </thead>

            <tbody>
                @foreach($searchFriend as $friend)
                    <tr>
                        <td style="text-align:center; vertical-align:middle"><b>{{$friend->name}}</b>
                        <a style="float: right" href="{{ route('user.addFriend', ['name'=>$friend->name])}}" class="btn btn-outline-secondary btn-sm"><b>ADD FRIEND</b></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <?php endif ?>
@stop