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

        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/hls.js/1.1.5/hls.min.js"
            integrity="sha512-O83G0C/Ypje2c3LTYElrDXQaqtKKxtu8WKlMLEMoIFs9HDeI4rMlpnn9AX5xvR3PgJpwSEBrZpxSzfE1usZqiQ=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        ></script>
        <video id="video" controls muted autoplay preload="auto"></video>
        <script>
            var video = document.getElementById("video");
            var videoSrc = "{{ $cctv_url }}";
            if (Hls.isSupported()) {
                var hls = new Hls();
                hls.loadSource(videoSrc);
                hls.attachMedia(video);
            }
            // HLS.js is not supported on platforms that do not have Media Source
            // Extensions (MSE) enabled.
            //
            // When the browser has built-in HLS support (check using `canPlayType`),
            // we can provide an HLS manifest (i.e. .m3u8 URL) directly to the video
            // element through the `src` property. This is using the built-in support
            // of the plain video element, without using HLS.js.
            //
            // Note: it would be more normal to wait on the 'canplay' event below however
            // on Safari (where you are most likely to find built-in HLS support) the
            // video.src URL must be on the user-driven white-list before a 'canplay'
            // event will be emitted; the last video event that can be reliably
            // listened-for when the URL is not on the white-list is 'loadedmetadata'.
            else if (video.canPlayType("application/vnd.apple.mpegurl")) {
                video.src = videoSrc;
            }
            video.addEventListener("loadedmetadata", function () {
                video.play();
            });
        </script>
        @else
        <h1 style="color: white">Please Setting The Ip of Camera</h1>
        @endif
    </body>
</html>
