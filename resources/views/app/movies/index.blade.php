@extends('app.layout')@section('header')
<link
    rel="stylesheet"
    href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}"
/>
<link rel="stylesheet" href="{{ asset('assets/app/css/movie.css') }}" />
@endsection @section('content')

<div class="container mt-2" id="loading" data-scheletrone="true">
    <div class="search-bar-container mt-5">
        <form action="">
            <input type="search" required />
            <i class="fa fa-search"></i>
        </form>
    </div>
    @foreach($data as $movie) @if(strpos(strtolower($movie->category),'korea')
    !== false )
    <div class="head-text text-center mt-2">
        <h2>Korea</h2>
    </div>
    @break @endif @endforeach
    <div class="d-flex flex-wrap mt-2">
        @foreach($data as $movie)
        @if(strpos(strtolower($movie->category),'korea') !== false )
        <div class="col-md-3 p-1 bd-highlight">
            <div class="card">
                <a href="{{route('app-play-movie',$movie->uuid)}}">
                    <div class="card-body">
                        <img
                            src="{{route('file-show-movie',$movie->path_banner)}}"
                            width="76"
                            height="110"
                        />
                        <div class="stars">
                            {{$movie->movie_rating

                            }}
                            <i class="fas fa-star" style="color: yellow"></i>
                        </div></div
                ></a>
            </div>
        </div>
        @endif @endforeach
    </div>

    @foreach($data as $movie) @if(strpos(strtolower($movie->category),'action')
    !== false )
    <div class="head-text text-center mt-2">
        <h2>Action</h2>
    </div>
    @break @endif @endforeach
    <div class="d-flex flex-wrap mt-2">
        @foreach($data as $movie)
        @if(strpos(strtolower($movie->category),'action') !== false )
        <div class="col-md-3 p-1 bd-highlight">
            <div class="card">
                <a href="{{route('app-play-movie',$movie->uuid)}}">
                    <div class="card-body">
                        <img
                            src="{{route('file-show-movie',$movie->path_banner)}}"
                            width="76"
                            height="110"
                        />
                        <div class="stars">
                            {{$movie->movie_rating

                            }}
                            <i class="fas fa-star" style="color: yellow"></i>
                        </div></div
                ></a>
            </div>
        </div>
        @endif @endforeach
    </div>
    @foreach($data as $movie) @if(strpos(strtolower($movie->category),'comedy')
    !== false )
    <div class="head-text text-center mt-2">
        <h2>Comedy</h2>
    </div>
    @break @endif @endforeach

    <div class="d-flex flex-wrap mt-2">
        @foreach($data as $movie)
        @if(strpos(strtolower($movie->category),'comedy') !== false )
        <div class="col-md-3 p-1 bd-highlight">
            <div class="card">
                <a href="{{route('app-play-movie',$movie->uuid)}}">
                    <div class="card-body">
                        <img
                            src="{{route('file-show-movie',$movie->path_banner)}}"
                            width="76"
                            height="110"
                        />
                        <div class="stars">
                            {{$movie->movie_rating

                            }}
                            <i class="fas fa-star" style="color: yellow"></i>
                        </div></div
                ></a>
            </div>
        </div>
        @endif @endforeach
    </div>
    @foreach($data as $movie) @if(strpos(strtolower($movie->category),'kids')
    !== false )
    <div class="head-text text-center mt-2">
        <h2>Kids</h2>
    </div>
    @break @endif @endforeach
    <div class="d-flex flex-wrap mt-2">
        @foreach($data as $movie)
        @if(strpos(strtolower($movie->category),'kids') !== false )
        <div class="col-md-3 p-1 bd-highlight">
            <div class="card">
                <a href="{{route('app-play-movie',$movie->uuid)}}">
                    <div class="card-body">
                        <img
                            src="{{route('file-show-movie',$movie->path_banner)}}"
                            width="76"
                            height="110"
                        />
                        <div class="stars">
                            {{$movie->movie_rating

                            }}
                            <i class="fas fa-star" style="color: yellow"></i>
                        </div></div
                ></a>
            </div>
        </div>
        @endif @endforeach
    </div>
    <div class="head-text text-center mt-2">
        <h2>Chanel TV</h2>
    </div>
    <div class="d-flex flex-wrap mt-2">
        @foreach($tv as $ch)
        <div class="col-md-3 p-1 bd-highlight">
            <div class="card">
                <a href="{{route('app-play-tv',$ch->uuid)}}">
                    <div class="card-body">
                        <img
                            src="{{route('file-show-tv',$ch->path_banner)}}"
                            width="76"
                            height="110"
                        /></div
                ></a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection @section('script')

<script>
    $("#loading").scheletrone({
        url: "{{route('loading-movie')}}",
        debug: {
            latency: 100,
        },
        incache: false,
        onComplete: function () {
            console.info("plugin is loaded");
            console.info("wait 3 secs for the data");
        },
    });
</script>
@endsection
