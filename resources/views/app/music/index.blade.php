<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link
            rel="stylesheet"
            href="{{ asset('assets/app/fontawesome/css/all.min.css') }}"
        />
        <link rel="stylesheet" href="{{ asset('assets/app/css/music.css') }}" />
        <link
            rel="stylesheet"
            href="{{
                asset('assets/bootstrap-5.1.3-dist/css/bootstrap.min.css')
            }}"
        />
        <title>Music Player</title>
    </head>
    <body>
        <h1>Music Player</h1>
        <div class="music-container" id="music-container">
            <div class="music-info">
                <h4 id="title"></h4>
                <div class="progress-container" id="progress-container">
                    <div class="progress" id="progress"></div>
                </div>
            </div>

            <audio src="" id="audio"></audio>

            <div class="img-container">
                <img src="" alt="music-cover" id="cover" />
            </div>

            <div class="navigation">
                <button id="prev" class="action-btn">
                    <i class="fas fa-backward"></i>
                </button>
                <button id="play" class="action-btn action-btn-big">
                    <i class="fas fa-play"></i>
                </button>
                <button id="next" class="action-btn">
                    <i class="fas fa-forward"></i>
                </button>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div style="overflow: scroll; height: 400px">
                        <div class="list-group" id="list-group">
                            @foreach ($tag as $t)
                            <h4 class="m-2">{{ $t }}</h4>
                            @foreach ($data as $m) @if ($m->music_tag == $t)
                            <a
                                href="#"
                                class="list-group-item list-group-item-action"
                                id="{{ $m->music_id }}"
                                onclick="playMusic(this.id)"
                            >
                                {{ $m->music_name }}
                            </a>
                            @endif @endforeach @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const tes  = {!! json_encode($data->toArray()) !!};
        </script>
        <script src="{{ asset('assets/app/js/music.js') }}"></script>
        <script src="{{
                asset('assets/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js')
            }}"></script>
    </body>
</html>
