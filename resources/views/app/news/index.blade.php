@extends('app.layout') @section('header')

<style>
    p {
        color: white;
    }
    span {
        color: white;
    }
    h4 {
        color: white;
    }
</style>
@endsection @section('content')

<div class="container mt-5 mb-5">
    <h4 class="text-center">
        {{$data->news_headline}}
    </h4>
    <img src="{{ route('file-show-news',$data->news_img) }}" width="320" />
    <div class="container-desc mt-2 text-justify p-1" style="color: white">
        {!! $data->news_content !!}
        <br /><br />
        <span>Source: {{$data->news_source}}</span>
    </div>
</div>

@endsection
