<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title>
        <style>
            video {
                width: 100% !important;
                height: auto !important;
            }
        </style>
    </head>
    <body>
        <div class="container">
            @if($data->movie_name)
            <video controls autoplay>
                <source src="{{route('file-show-movie',$data->path_file) }}" />
            </video>
            @else
            <video controls autoplay>
                <source src="{{route('file-show-tv',$data->path_file) }}" />
            </video>
            @endif
        </div>
    </body>
</html>
