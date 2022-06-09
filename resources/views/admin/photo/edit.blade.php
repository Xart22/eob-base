@extends('layout.layout')
@section('title','Photo')@section('breadcrumb','Photo')@section('header')

<link
    rel="stylesheet"
    href="{{ asset('assets/plugins/ekko-lightbox/ekko-lightbox.css') }}"
/>
<link rel="stylesheet" href="{{ asset('assets/css/photo.css') }}" />

<link
    rel="stylesheet"
    href="{{ asset('assets/plugins/dropzone/dropzone.css') }}"
/>
@endsection @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="card-title">Photo</h4>
            </div>
            <div class="card-body">
                <form
                    action="{{ route('photo.update',$detil_data->uuid) }}"
                    method="post"
                    enctype="multipart/form-data"
                >
                    @method('PUT') @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Name Photo</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter Photo Name"
                                    name="photo_name"
                                    required
                                    value="{{ $detil_data->photo_name }}"
                                    autocomplete="off"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>File Photo</label>
                                <input
                                    type="file"
                                    class="form-control"
                                    name="photo_file"
                                    required
                                    value="{{ $detil_data->path_file }}"
                                />
                            </div>
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
                <h4 class="card-title">Photo List</h4>
            </div>
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-around">
                    @foreach($data as $photo)
                    <div class="col-sm-2 mb-2 border p-2">
                        <a
                            href="{{ route('file-show-photo',$photo->path_file) }}"
                            data-toggle="lightbox"
                            data-gallery="example-gallery"
                        >
                            <img
                                src="{{ route('file-show-photo',$photo->path_file) }}"
                                class="img-fluid"
                                width="300"
                            />
                        </a>
                        <p class="text-center">{{$photo->photo_name}}</p>
                        <div class="d-flex justify-content-center">
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
                                    data-book-id="{{$photo->uuid}}"
                                >
                                    Delete
                                </button>
                                <a href="{{route('photo.edit',$photo->uuid)}}">
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
                    action="{{ route('photo.destroy', 0) }}"
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
<script src="{{
        asset('assets/plugins/ekko-lightbox/ekko-lightbox.min.js')
    }}"></script>
<script src="{{ asset('assets/js/ajaxForm.js') }}"></script>
<script>
    $(document).on("click", '[data-toggle="lightbox"]', function (event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
</script>
@endsection
