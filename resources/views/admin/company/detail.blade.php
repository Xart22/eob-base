<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>{{$data->news_headline}}</title>
    </head>
    <body>
        <div class="row">
            <div class="w-50 mx-auto">
                <div class="container mx-auto">
                    <h4>{{$data->news_headline}}</h4>
                    @if($data->news_video != null)
                    <video controls autoplay width="320">
                        <source
                            src="{{ route('file-show-company',$data->news_video) }}"
                        />
                    </video>

                    @else
                    <img
                        src="{{ route('file-show-company',$data->news_img) }}"
                        width="320"
                    />

                    @endif
                    <div class="container-desc">
                        {!! $data->news_content !!}
                        <span>Source: {{$data->news_source}}</span>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{
                asset('assets/plugins/jquery/jquery.min.js')
            }}"></script>
        <script src="{{
                asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')
            }}"></script>
    </body>
</html>
