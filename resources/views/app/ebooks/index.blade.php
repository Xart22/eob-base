@extends('app.layout') @section('header') @endsection @section('content')
<div class="container mt-3" id="loading">
    <h4>Ebooks List</h4>
    @foreach($data as $ebook)
    <a href="{{route('app-ebooks-read',$ebook->uuid)}}">
        <div class="row border mb-2">
            <div class="col p-2">
                <img
                    src="{{route('file-show-ebook',$ebook->path_cover)}}"
                    alt="{{$ebook->ebook_name}}"
                    width="50"
                />
            </div>
            <div class="col p-2">
                <p>{{$ebook->ebook_name}}</p>
            </div>
        </div></a
    >
    @endforeach
</div>
@endsection @section('script')
<script>
    $("#loading").scheletrone({
        url: "{{route('loading-ebooks')}}",
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
