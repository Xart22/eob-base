@extends('app.layout')@section('header')
<link
    rel="stylesheet"
    href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}"
/>
<link
    rel="stylesheet"
    href="{{ asset('assets/plugins/videojs/video-js.css') }}"
/>
<link rel="stylesheet" href="{{ asset('assets/app/css/movie.css') }}" />
@endsection @section('content')

<div class="container mt-5">
    <div class="container border mt-2">
        <video
            id="my-video"
            class="video-js vjs-big-play-centered responsive"
            controls
            width="320"
            preload="auto"
            data-setup="{responsive:true}"
            autoplay
            muted
        >
            <source
                src="{{route('file-show-movie',$movie->path_file)}}"
                type="video/mp4"
            />
        </video>

        <div class="desc-movie mt-3">
            <p class="fs-6 text">{{$movie->movie_name}}</p>
            <p class="fs-6 text text-muted">{{$movie->movie_desc}}</p>
            <p class="fs-6 text text-muted">
                Starting : @if($movie->movie_actors != null){{$movie->movie_actors
                }}@else - @endif
            </p>
            <p class="fs-6 text text-muted">
                Director : @if($movie->movie_director != null){{$movie->movie_director
                }}@else - @endif
            </p>
        </div>
    </div>

    <div class="d-flex flex-wrap mt-2">
        @foreach($data as $movie)
        <div class="col-md-3 p-1 bd-highlight mb-3">
            <div class="card">
                <a href="{{route('app-play-movie',$movie->uuid)}}">
                    <div class="card-body">
                        <img
                            src="{{route('file-show-movie',$movie->path_banner)}}"
                            width="70"
                            height="110"
                        />
                        <div class="stars">
                            {{$movie->movie_rating }}
                            <i class="fas fa-star" style="color: yellow"></i>
                        </div></div
                ></a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection @section('script')
<script src="{{ asset('assets/plugins/videojs/video-js.min.js') }}"></script>
@endsection
