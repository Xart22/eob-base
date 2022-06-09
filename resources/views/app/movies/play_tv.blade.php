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
                src="{{route('file-show-tv',$tv->path_file)}}"
                type="video/mp4"
            />
        </video>

        <div class="desc-movie mt-3">
            <p class="fs-6 text">{{$tv->ch_name}}</p>
        </div>
    </div>

    <div class="d-flex flex-wrap mt-2">
        @foreach($data as $movie)
        <div class="col-md-3 p-1 bd-highlight mb-3">
            <div class="card">
                <a href="{{route('app-play-tv',$movie->uuid)}}">
                    <div class="card-body">
                        <img
                            src="{{route('file-show-tv',$movie->path_banner)}}"
                            width="70"
                            height="110"
                        /></div
                ></a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection @section('script')
<script src="{{ asset('assets/plugins/videojs/video-js.min.js') }}"></script>
@endsection
