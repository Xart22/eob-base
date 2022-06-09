<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="Cache-control" content="no-cache" />
        <title>Document</title>
        <link href="{{ asset('css/vjs.css') }}" rel="stylesheet" />
    </head>
    <body>
        @if($cctv_url != null)
        <video
            id="preview-player"
            class="video-js vjs-default-skin"
            controls
            muted
            autoplaya
            preload="auto"
        >
            <source src="{{ $cctv_url }}" type="application/x-mpegURL" />
        </video>
        @else
        <h1 style="color: white">Please Setting The Ip of Camera</h1>
        @endif
        <script src="{{
                asset('assets/plugins/jquery/jquery.min.js')
            }}"></script>
        <script src="{{ asset('js/vjs.min.js') }}"></script>
        <script src="{{ asset('js/videojs-http-streaming.min.js') }}"></script>

        <script>
            var player = videojs("preview-player");
            player.play();
            $(document).ready(function () {
                setInterval(() => {
                    location.reload(true);
                }, 60000);
            });
        </script>
    </body>
</html>
