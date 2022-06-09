@extends('app.layout') @section('header')
<link rel="stylesheet" href="{{ asset('assets/app/css/company.css') }}" />

@endsection @section('content')

<div class="container mt-5">
    <h4>{{$data->news_title}}</h4>
    @if($data->news_video != null)
    <img src="{{ route('file-show-company',$data->news_img) }}" width="320" />
    <div class="mt-2">
        <video controls autoplay width="320">
            <source src="{{ route('file-show-company',$data->news_video) }}" />
        </video>
    </div>
    @else
    <img src="{{ route('file-show-company',$data->news_img) }}" width="320" />
    @endif

    <div class="container-desc">
        {!! $data->news_content !!}

        <span>Source: {{$data->news_source}}</span>
    </div>
</div>

@endsection
