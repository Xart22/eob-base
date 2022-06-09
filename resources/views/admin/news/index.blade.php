@extends('layout.layout')
@section('title','e-News')@section('breadcrumb','e-News')@section('header')

<link
    rel="stylesheet"
    href="{{ asset('assets/plugins/ekko-lightbox/ekko-lightbox.css') }}"
/>
<link
    rel="stylesheet"
    href="{{
        asset('assets/plugins/summernote-0.8.18-dist/summernote-bs4.css')
    }}"
/>
<link rel="stylesheet" href="{{ asset('assets/css/news.css') }}" />

<link
    rel="stylesheet"
    href="{{ asset('assets/plugins/dropzone/dropzone.css') }}"
/>
@endsection @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="card-title">e-News</h4>
            </div>
            <div class="card-body">
                <form
                    action="{{ route('news.store') }}"
                    method="post"
                    enctype="multipart/form-data"
                    id="upload"
                >
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Headline News</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter Headline News"
                                    name="news_headline"
                                    required
                                    value="{{ old('news_headline') }}"
                                    autocomplete="off"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>News Content</label>
                                <textarea
                                    name="news_content"
                                    id="summernote"
                                ></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label
                                for="exampleFormControlTextarea1"
                                class="form-label"
                                >News Source</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Enter Source News"
                                name="news_source"
                                required
                                value="{{ old('news_source') }}"
                                autocomplete="off"
                            />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>News Video</label>
                                <input
                                    type="file"
                                    class="form-control"
                                    name="news_video"
                                    value="{{ old('news_video') }}"
                                    accept="video/*"
                                />
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label>News Image</label>
                                <input
                                    type="file"
                                    class="form-control"
                                    name="news_img"
                                    value="{{ old('news_img') }}"
                                    accept="image/*"
                                    required
                                />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="progress">
                            <div
                                class="
                                    progress-bar
                                    progress-bar-striped
                                    progress-bar-animated
                                    bg-danger
                                "
                                role="progressbar"
                                aria-valuenow="0"
                                aria-valuemin="0"
                                aria-valuemax="100"
                                style="width: 0%"
                            ></div>
                        </div>
                    </div>

                    <div class="alert alert-danger" style="display: none">
                        <ul id="showErr"></ul>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="card-title">e-News List</h4>
            </div>
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-around">
                    @if(!empty($data)) @foreach($data as $news)
                    <div class="card border p-2" style="width: 18rem">
                        <img
                            src="{{ route('file-show-news',$news->news_img) }}"
                            class="card-img-top"
                            alt="{{$news->news_headline}}"
                            width="200"
                            height="180"
                        />
                        <div class="card-body">
                            <p class="card-text">{{$news->news_headline}}</p>
                        </div>
                        <div class="d-flex justify-content-center mt-2">
                            <div
                                class="btn-group"
                                role="group"
                                aria-label="Basic mixed styles example"
                            >
                                <button
                                    onclick="deleteItem(this)"
                                    type="button"
                                    class="btn btn-danger"
                                    data-toggle="modal"
                                    data-target="#myModal"
                                    data-book-id="{{$news->uuid}}"
                                >
                                    Delete
                                </button>
                                <a href="{{route('news.edit',$news->uuid)}}">
                                    <button
                                        type="button"
                                        class="btn btn-warning"
                                    >
                                        Update
                                    </button></a
                                >

                                <button
                                    type="button"
                                    class="btn btn-success"
                                    onclick="detailItem(this)"
                                    data-toggle="modal"
                                    data-target="#detailModal"
                                    data-title="{{$news->news_headline}}"
                                    data-img="{{ route('file-show-news', $news->news_img) }}"
                                    data-content="{{ $news->news_content }}"
                                >
                                    Detail
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div
    class="modal fade"
    id="myModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="myModalLabel"
>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                >
                    <span aria-hidden="true" style="color: red">&times;</span>
                </button>
            </div>
            <div class="modal-body">Are You Sure ?</div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-danger"
                    data-dismiss="modal"
                >
                    Cancel
                </button>
                <form
                    action="{{ route('news.destroy', 0) }}"
                    method="post"
                    id="formDelete"
                >
                    @method('DELETE') @csrf
                    <button type="submit" class="btn btn-success">Sure!</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modail Detail -->
<div
    class="modal fade"
    id="detailModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="myModalLabel"
>
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="header"></h5>
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                >
                    <span aria-hidden="true" style="color: red">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="img-header">
                        <div class="carousel-item active">
                            <img
                                src=""
                                class="d-block w-100 rounded"
                                id="imgHeader"
                            />
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="content-text">
                        <article id="content"></article>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection @section('script')
<script src="{{ asset('assets/plugins/dropzone/dropzone.js') }}"></script>
<script src="{{
        asset('assets/plugins/summernote-0.8.18-dist/summernote-bs4.js')
    }}"></script>
<script src="{{ asset('assets/js/news.js') }}"></script>
<script src="{{
        asset('assets/plugins/ekko-lightbox/ekko-lightbox.min.js')
    }}"></script>

@endsection
