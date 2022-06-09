@extends('layout.layout')
@section('title','Game')@section('breadcrumb','Game')@section('header')

<link
    rel="stylesheet"
    href="{{ asset('assets/plugins/ekko-lightbox/ekko-lightbox.css') }}"
/>
<link rel="stylesheet" href="{{ asset('assets/css/game.css') }}" />

<link
    rel="stylesheet"
    href="{{ asset('assets/plugins/dropzone/dropzone.css') }}"
/>
@endsection @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="card-title">Update Link Game</h4>
            </div>
            <div class="card-body">
                <form
                    action="{{ route('game.update',$detil_data->uuid) }}"
                    method="post"
                    enctype="multipart/form-data"
                    id="upload"
                >
                    @method('PUT') @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Name Game</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter Game Name"
                                    name="game_name"
                                    required
                                    value="{{ $detil_data->game_name }}"
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
                                    placeholder="Enter Game Category"
                                    name="game_category"
                                    required
                                    value="{{ $detil_data->game_category }}"
                                    autocomplete="off"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Game URL</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="game_url"
                                    placeholder="ex 192.168.x.x"
                                    required
                                    value="{{ $detil_data->game_url }}"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Game Banner</label>
                                <input
                                    type="file"
                                    class="form-control"
                                    name="game_banner"
                                    value="{{ $detil_data->path_banner}}"
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
                <h4 class="card-title">Game List</h4>
            </div>
            <div class="card-body">
                @foreach($data as $game)
                <div class="d-flex flex-wrap justify-content-around">
                    <div class="col mb-2">
                        <a target="_blank" href="{{ $game->game_url }}">
                            <img
                                src="{{ route('file-show-game',$game->path_banner) }}"
                                class="img-fluid mb-2"
                                alt="{{$game->game_name}}"
                            />
                        </a>
                        <p class="text-center">{{$game->game_name}}</p>
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
                                    data-book-id="{{$game->uuid}}"
                                >
                                    Delete
                                </button>
                                <a href="{{route('game.edit',$game->uuid)}}">
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
                    action="{{ route('game.destroy', 0) }}"
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
<script src="{{ asset('assets/js/game.js') }}"></script>
<script src="{{
        asset('assets/plugins/ekko-lightbox/ekko-lightbox.min.js')
    }}"></script>
<script src="{{ asset('assets/js/ajaxForm.js') }}"></script>

@endsection
