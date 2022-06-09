@extends('layout.layout')
@section('title','Movie')@section('breadcrumb','Movie')@section('header')

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
                <h4 class="card-title">Upload Movie</h4>
            </div>
            <div class="card-body">
                <form
                    action="{{ route('movie.store') }}"
                    method="post"
                    enctype="multipart/form-data"
                    id="upload"
                >
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Movie Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter Movie Name"
                                    name="movie_name"
                                    required
                                    value="{{ old('movie_name') }}"
                                    autocomplete="off"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Category</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter Movie Category"
                                    name="movie_category"
                                    required
                                    value="{{ old('movie_category') }}"
                                    autocomplete="off"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Actors</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter Movie Actors"
                                    name="movie_actors"
                                    required
                                    value="{{ old('movie_actors') }}"
                                    autocomplete="off"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Director</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter Movie director"
                                    name="movie_director"
                                    required
                                    value="{{ old('movie_director') }}"
                                    autocomplete="off"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Movie Rating</label>
                                <input
                                    id="rating"
                                    type="number"
                                    class="form-control"
                                    placeholder="Enter Movie Rating"
                                    step="0.5"
                                    min="0"
                                    max="10"
                                    name="movie_rating"
                                    required
                                    value="{{ old('movie_rating') }}"
                                />
                                <span
                                    class="fs-6 text-danger"
                                    style="display: none"
                                    >Max 10 Stars</span
                                >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label
                                for="exampleFormControlTextarea1"
                                class="form-label"
                                >Description Movie</label
                            >
                            <textarea
                                class="form-control"
                                id="exampleFormControlTextarea1"
                                rows="4"
                                name="movie_desc"
                            ></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Movie File</label>
                                <input
                                    type="file"
                                    class="form-control"
                                    name="movie_file"
                                    required
                                    value="{{ old('movie_file') }}"
                                    accept="video/*"
                                />
                                <input type="hidden" name="movie_duration" />
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label>Movie Banner</label>
                                <input
                                    type="file"
                                    class="form-control"
                                    name="movie_banner"
                                    required
                                    value="{{ old('movie_banner') }}"
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
                <h4 class="card-title">Movie List</h4>
            </div>
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-around">
                    @foreach($data as $movie)
                    <div class="col mb-2">
                        <div class="container movie-card">
                            <a
                                href="{{route('file-embded',$movie->uuid)}}"
                                data-toggle="lightbox"
                                data-title="{{$movie->movie_name}}"
                                data-gallery="mixedgallery"
                            >
                                <img
                                    src="{{ route('file-show-movie',$movie->path_banner) }}"
                                    class="img-fluid cover-img"
                                    alt="{{$movie->movie_name}}"
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
                                        data-book-id="{{$movie->uuid}}"
                                    >
                                        Delete
                                    </button>
                                    <a
                                        href="{{route('movie.edit',$movie->uuid)}}"
                                    >
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
                    action="{{ route('movie.destroy', 0) }}"
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
