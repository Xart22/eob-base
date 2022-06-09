@extends('layout.layout')
@section('title','Music')@section('breadcrumb','Music')@section('header')
<link rel="stylesheet" href="{{ asset('assets/css/music.css') }}" />
@endsection @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="card-title">Upload Music</h4>
            </div>
            <div class="card-body">
                <form
                    action="{{ route('music.store') }}"
                    method="post"
                    enctype="multipart/form-data"
                    id="upload"
                >
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Music Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter Music Name"
                                    name="music_name"
                                    required
                                    value="{{ old('music_name') }}"
                                    autocomplete="off"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Tag</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter Music Tag"
                                    name="music_tag"
                                    required
                                    value="{{ old('music_tag') }}"
                                    autocomplete="off"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Music File</label>
                                <input
                                    type="file"
                                    class="form-control"
                                    name="music_file"
                                    required
                                    value="{{ old('music_file') }}"
                                    accept="audio/*"
                                />
                                <input type="hidden" name="music_duration" />
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label>Music Banner</label>
                                <input
                                    type="file"
                                    class="form-control"
                                    name="music_banner"
                                    value="{{ old('music_banner') }}"
                                    accept="image/*"
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
                <h4 class="card-title">Music List</h4>
            </div>
            <div class="card-body">
                @if(!empty($data)) @foreach ($data as $music)
                <div class="row border">
                    <div class="col">
                        <p class="text-center mt-3">{{$music->music_name}}</p>
                    </div>
                    <div class="col">
                        <audio controls class="mt-2">
                            <source
                                src="{{route('file-show-music',$music->path_file)}}"
                                type="audio/mpeg"
                            />
                        </audio>
                    </div>
                    <div class="col">
                        <div
                            class="btn-group mt-2"
                            role="group"
                            aria-label="Basic mixed styles example"
                        >
                            <button
                                onclick="deleteItem(this)"
                                type="button"
                                class="btn btn-danger"
                                data-toggle="modal"
                                data-target="#myModal"
                                data-book-id="{{$music->uuid}}"
                            >
                                Delete
                            </button>
                            <a href="{{route('music.edit',$music->uuid)}}">
                                <button type="button" class="btn btn-warning">
                                    Update
                                </button></a
                            >
                        </div>
                    </div>
                </div>
                @endforeach @endif
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
                    action="{{ route('music.destroy', 0) }}"
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
@endsection @section('script')
<script src="{{ asset('assets/plugins/dropzone/dropzone.js') }}"></script>
<script src="{{ asset('assets/js/music.js') }}"></script>
<script src="{{ asset('assets/js/ajaxForm.js') }}"></script>

@endsection
