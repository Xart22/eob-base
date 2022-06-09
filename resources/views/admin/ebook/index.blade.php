@extends('layout.layout')
@section('title','eBook')@section('breadcrumb','eBook')@section('header')

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
                <h4 class="card-title">Upload eBook</h4>
            </div>
            <div class="card-body">
                <form
                    action="{{ route('ebook.store') }}"
                    method="post"
                    enctype="multipart/form-data"
                    id="upload"
                >
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>eBook Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter ebook Name"
                                    name="ebook_name"
                                    required
                                    value="{{ old('ebook_name') }}"
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
                                    placeholder="Enter Ebook Tag"
                                    name="ebook_tag"
                                    required
                                    value="{{ old('ebook_tag') }}"
                                    autocomplete="off"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>eBook File</label>
                                <input
                                    type="file"
                                    class="form-control"
                                    name="ebook_file"
                                    required
                                    value="{{ old('ebook_file') }}"
                                    accept="application/epub+zip"
                                />
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label>eBook Cover</label>
                                <input
                                    type="file"
                                    class="form-control"
                                    name="ebook_cover"
                                    required
                                    value="{{ old('ebook_cover') }}"
                                    accept="image/*"
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
                <h4 class="card-title">eBook List</h4>
            </div>
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-around">
                    @foreach($data as $ebook)
                    <div class="card border p-2 mb-2" style="width: 18rem">
                        <img
                            src="{{ route('file-show-ebook',$ebook->path_cover) }}"
                            class="card-img-top"
                            alt="{{$ebook->ebook_name}}"
                            width="150"
                            height="350"
                        />
                        <div class="card-body">
                            <p class="card-text">{{$ebook->ebook_name}}</p>
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
                                    data-book-id="{{$ebook->uuid}}"
                                >
                                    Delete
                                </button>
                                <a href="{{route('ebook.edit',$ebook->uuid)}}">
                                    <button
                                        type="button"
                                        class="btn btn-warning"
                                    >
                                        Update
                                    </button></a
                                >
                                <a href="{{route('ebook.show',$ebook->uuid)}}">
                                    <button
                                        type="button"
                                        class="btn btn-success"
                                    >
                                        Detail
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
                    action="{{ route('ebook.destroy', 0) }}"
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
<script src="{{ asset('assets/js/ebook.js') }}"></script>
<script src="{{
        asset('assets/plugins/ekko-lightbox/ekko-lightbox.min.js')
    }}"></script>
<script src="{{ asset('assets/js/ajaxForm.js') }}"></script>

@endsection
