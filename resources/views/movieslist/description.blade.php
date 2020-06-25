@extends('layouts.default')

@section('content')

    <div class = " tv-info border-b border-grey-800 ">

        <div style="float: left" class = " flex-none ">
            <img width = 286.2px height = 428.4px src="{{'https://image.tmdb.org/t/p/w500/'.$movie['poster_path']}}" alt="poster">
        </div>

        <div  class = " container mx-auto px-4 py-16 flex-col md: flex-row " >

            <div style="margin-left: 50px" class = "md: ml-24">
                <h2 class="text-4xl mt-4 md:mt-0 font-semibold">{{ $movie['title'] }}</h2>
                <span><i style="color: #FFAE00"class="fas fa-star"></i>{{ $movie['vote_average'] }}</span>
                <span class="mx-2">|</span>
                <span>{{ $movie['release_date'] }}</span>
                <span class="mx-2">|</span>
                @foreach($movie['genres'] as $genre)
                    <span>{{$genre['name']}}
                @endforeach
                <br><br>
                <p>{{ $movie[ 'overview']}} </p>

                <br>
                <span><b>Videos</b></span><br>
                @if (count($movie['videos']['results']) > 0)
                    @foreach($movie['videos']['results'] as $videos)
                        <div style="display: inline-block; margin-right: 10px">
                        <iframe width="192" height="108" src="{{'https://www.youtube.com/embed/'.$videos['key']}}"></iframe>
                        </div>
                    @endforeach
                @endif
            </div>
        
        </div>
        <br><br>
        <hr></hr>                   

        <h2 class="text-4xl font-semibold">Cast</h2>
        @foreach(array_slice($movie['credits']['cast'], 0, 16) as $cast)
        <div style="display:inline-block">
            <div class="mt-8">
                        <img width=192‬px heigh=108px src="{{'https://image.tmdb.org/t/p/w500/'.$cast['profile_path']}}" alt="actor1" class="hover:opacity-75 transition ease-in-out duration-150">
                        <div class="mt-2">
                            <span class="text-lg mt-2 hover:text-gray:300">{{ $cast['name'] }}</span>
                            <div class="text-sm text-gray-400">
                                {{ $cast['character'] }}
                            </div>
                        </div>
            </div>
        </div>
        @endforeach
    </div>
@stop