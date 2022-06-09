@extends('app.layout') @section('header')
<link rel="stylesheet" href="{{ asset('assets/app/css/cctv.css') }}" />
<link href="{{ asset('css/vjs.css') }}" rel="stylesheet" />
@endsection @section('content')

<div class="w-100">
    @if($cctv_url != null)
    <video
        id="preview-player"
        class="video-js vjs-default-skin"
        controls
        muted
        autoplay
        preload="auto"
        width="350"
        height="350"
    >
        <source src="{{ $cctv_url }}" type="application/x-mpegURL" />
    </video>
    @else
    <h1 style="color: white">Please Setting The Ip of Camera</h1>
    @endif
    <div class="container mt-3">
        <h4 id="location" style="color: white"></h4>
        <h4 id="speed" style="color: white"></h4>
    </div>
</div>

@endsection @section('script')
<script src="{{ asset('js/vjs.min.js') }}"></script>
<script src="{{ asset('js/videojs-http-streaming.min.js') }}"></script>
<script>
    $(document).ready(function () {
        var player = videojs("preview-player");
        player.play();
        updateLocation();
        setInterval(() => {
            updateLocation();
        }, 1000);
        setInterval(() => {
            location.reload(true);
        }, 60000);
    });

    function updateLocation() {
        $.get("/public/app/nvr/location", (res) => {
            const destionation =
                res.location_name[res.location_name.length - 1];
            const speed = res.speed <= 20 ? 0 : res.speed;
            const location = res.position;
            const eta = res.eta;

            $("#speed").text(speed + " Km/j");
            $("#location").text(location);
        });
    }
</script>
@endsection
