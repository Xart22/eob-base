@extends('layout.layout') @section('title','CH TV')@section('breadcrumb','CH
TV')@section('header')

<link
    rel="stylesheet"
    href="{{ asset('assets/plugins/ekko-lightbox/ekko-lightbox.css') }}"
/>
<link rel="stylesheet" href="{{ asset('assets/css/movie.css') }}" />

<link
    rel="stylesheet"
    href="{{ asset('assets/plugins/dropzone/dropzone.css') }}"
/>
@endsection @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="card-title">Upload CH TV</h4>
            </div>
            <div class="card-body">
                <form
                    action="{{ route('tv.update',$detil_data->uuid) }}"
                    method="post"
                    enctype="multipart/form-data"
                    id="upload"
                >
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>CH Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter CH Name"
                                    name="ch_name"
                                    required
                                    value="{{ $detil_data->ch_name }}"
                                    autocomplete="off"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>TV File</label>
                                <input
                                    type="file"
                                    class="form-control"
                                    name="ch_file"
                                    required
                                    value="{{ $detil_data->path_file}}"
                                    accept="video/*"
                                />
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label>TV Logo</label>
                                <input
                                    type="file"
                                    class="form-control"
                                    name="ch_banner"
                                    required
                                    value="{{ $detil_data->path_banner }}"
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
                <h4 class="card-title">CH List</h4>
            </div>
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-around">
                    @foreach($data as $ch)
                    <div class="col mb-2">
                        <div class="container movie-card">
                            <a
                                href="{{route('file-embded',$ch->uuid)}}"
                                data-toggle="lightbox"
                                data-title="{{$ch->ch_name}}"
                                data-gallery="mixedgallery"
                            >
                                <img
                                    src="{{ route('file-show-tv',$ch->path_banner) }}"
                                    class="img-fluid cover-img"
                                    alt="{{$ch->ch_name}}"
                                />
                            </a>
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
                                        data-book-id="{{$ch->uuid}}"
                                    >
                                        Delete
                                    </button>
                                    <a href="{{route('tv.edit',$ch->uuid)}}">
                                        <button
                                            type="button"
                                            class="btn btn-warning"
                                        >
                                            Update
                                        </button></a
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
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
                    action="{{ route('tv.destroy', 0) }}"
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
<script src="{{ asset('assets/js/movie.js') }}"></script>
<script src="{{
        asset('assets/plugins/ekko-lightbox/ekko-lightbox.min.js')
    }}"></script>
<script src="{{ asset('assets/js/ajaxForm.js') }}"></script>

@endsection
