@extends('layouts.default')

@section('content')

    {{--https://developers.google.com/chart/interactive/docs/gallery/piechart--}}
    <html>
        <head>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Watching',     <?php echo $countWatching ?>],
                ['Completed',      <?php echo $countCompleted ?>],
                ['Plan to Watch',  <?php echo $countPtoW ?>],
                ]);

                var options = {
                backgroundColor: '#F4F6F9',
                is3D: true,
                chartArea: {width:'100%',height:'100%'},
                fontSize: 16
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                chart.draw(data, options);
            }
            </script>
        </head>
    </html>        


        <center><img style="width:150px; height: 150px; border-radius: 50%;" src="/uploads/avatars/{{$user->avatar}}"></center>
        <center><h1 style="font-family:fantasy">{{$user->name}}</h1><center>

        <?php if(auth()->user()->name != $user->name and $test == NULL):?>
                <a href="{{ route('user.addFriend', ['name'=>$user->name])}}" class="btn btn-outline-secondary btn-sm"><b>ADD FRIEND</b></a>
        <?php endif ?>
        
        <br>
        
        <div style="width:100%;">
        
            <div style="width:30%; float: left;">
            <table class="table table-strip table-bordered table-hover">
                <thead>
                    <th>how much time did you spend in your life?</th>
                </thead>
                        <tr>
                            <td >           
                            Total Watched Episodes: {{$user->lifeEps}}</br>
                            Total Watched Time (minutes): {{$user->lifeTime}}</br>
                            Total Watched Time (hours): {{round($user->lifeTime/60,2)}}</br>
                            Total Watched Time (days): {{round($user->lifeTime/60/24,2)}}
                            </td>
                        </tr>
            </table>
            </div>

            <div style="float: left; width: 30%">
            <table class="table table-strip table-bordered table-hover">
                <thead>
                    <th>Series Status Chart</th>
                </thead>
                        <tr>
                            <td>           
                                <div id="piechart" style="width: 100%; height: 300px; float:left;"></div>
                            </td>
                        </tr>
            </table>
            </div>

            <div style="width:40%; float: left">
            <?php if(auth()->user()->name == $user->name) : ?>
            <table class="table table-strip table-bordered table-hover">
                <thead>
                    <th>Friends</th>
                    <th style="text-align:center">Name</th>
                    <th></th>
                    <th></th>
                    <th><a style='font-size:14px; float: right'href="{{ route('user.searchFriend')}}" class = "btn-sm btn-info"><b>Search Friend </b><i class="fa fa-search"></i></a></th>
                </thead>
                    
            @foreach($friendsList as $friend)
                        <tr>
                            <td><img style="width:50px; height: 50px; border-radius:50%; float:left" src="/uploads/avatars/{{$friend->avatar}}"></td>

                            <td  style="vertical-align:middle; text-align:center; width: 30%;">
                                <a  style="color: black" href="{{ route('user.profile', ['name'=>$friend->name])}}"><b>{{$friend->name}}</b></a>
                            </td>
                            <td style=" vertical-align:middle; text-align:center;"><a href="{{ route('user.publicList', ['name'=>$friend->name])}}" class = "btn-sm btn-info"><b>SERIES LIST</b></a>
                            <td style=" vertical-align:middle; text-align:center;"><a href="{{ route('user.publicMoviesList', ['name'=>$friend->name])}}" class = "btn-sm btn-info"><b>MOVIES LIST</b></a>
                            <td style="width:22%; vertical-align:middle; text-align:center;"><a href="{{ route('user.deleteFriend', ['id'=>$friend->id])}}" class = "btn-sm btn-danger"><b>DELETE</b></a></td>
                        </tr>
            @endforeach
            </table>
            <?php else:?>
                            <td style=" vertical-align:middle; text-align:center;"><a href="{{ route('user.publicList', ['name'=>$user->name])}}" class = "btn-sm btn-info"><b>SERIES LIST</b></a>
                            <td style=" vertical-align:middle; text-align:center;"><a href="{{ route('user.publicMoviesList', ['name'=>$user->name])}}" class = "btn-sm btn-info"><b>MOVIES LIST</b></a>
            <?php endif ?>
            </div>
        <div>
@stop
