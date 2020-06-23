@extends('layouts.default')

@section('content')

    <div class = " tv-info border-b border-grey-800 ">

        <div style="float: left" class = " flex-none ">
            <img width = 286.2px height = 428.4px src="{{'https://image.tmdb.org/t/p/w500/'.$serie['poster_path']}}" alt="poster">
        </div>

        <div  class = " container mx-auto px-4 py-16 flex-col md: flex-row " >

            <div style="margin-left: 50px" class = "md: ml-24">
                <h2 class="text-4xl mt-4 md:mt-0 font-semibold">{{ $serie['name'] }}</h2>
                <span><i style="color: #FFAE00"class="fas fa-star"></i>{{ $serie['vote_average'] }}</span>
                <span class="mx-2">|</span>
                <span>{{ $serie['first_air_date'] }}</span>
                <span class="mx-2">|</span>
                @foreach($serie['genres'] as $genre)
                    <span>{{$genre['name']}}
                @endforeach
                <br><br>
                <p>{{ $serie[ 'overview']}} </p>

                <div class="mt-12">
                    <div class="flex mt-4">
                    <span><b>Featured Crew</b></span><br>
                        @foreach ($serie['created_by'] as $crew)
                            <div style="display: inline-block; margin-right: 20px" class="mr-8">
                                <div>{{ $crew['name']}}</div>
                                <div class="text-sm text-gray-400">Creator</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <br>
                <span><b>Videos</b></span><br>
                @if (count($serie['videos']['results']) > 0)
                    @foreach($serie['videos']['results'] as $videos)
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
        @foreach($serie['credits']['cast'] as $cast)
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