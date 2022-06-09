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
            <div class="w-50 mx-auto boder">
                <div class="container mx-auto boder">
                    <h4>{{$data->news_headline}}</h4>
                    @if($data->news_img != null)
                    <img
                        src="{{ route('file-show-news',$data->news_img) }}"
                        width="320"
                    />
                    @endif
                    <div class="container-desc">
                        @if($data->news_video != null)
                        <video controls autoplay width="320">
                            <source
                                src="{{ route('file-show-news',$data->news_video) }}"
                            />
                        </video>
                        @endif
                        <article>
                            {!! $data->news_content !!}
                            <span
                                >Source:
                                {{$data->news_source}}
                            </span>
                        </article>
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
