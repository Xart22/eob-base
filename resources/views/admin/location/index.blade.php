@extends('layout.layout')
@section('title','Location')@section('breadcrumb','Location')@section('header')

<link
    rel="stylesheet"
    href="{{
        asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')
    }}"
/>

@endsection @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="card-title">Location</h4>
            </div>
            <div class="card-body">
                <form
                    action="{{ route('location.store') }}"
                    method="post"
                    enctype="multipart/form-data"
                >
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Location Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter Location Name"
                                    name="location_name"
                                    required
                                    value="{{ old('location_name') }}"
                                    autocomplete="off"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Lat</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="ex -6.913368"
                                    name="lat"
                                    required
                                    value="{{ old('lat') }}"
                                    autocomplete="off"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Long</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="long"
                                    placeholder="ex 107.634311"
                                    required
                                    value="{{ old('long') }}"
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
                <h4 class="card-title">Location List</h4>
            </div>
            <div class="card-body">
                <table id="location" class="table table-striped">
                    <thead>
                        <th>No</th>
                        <th>Location Name</th>
                        <th>Lat</th>
                        <th>Long</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($data as $location)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$location->location_name}}</td>
                            <td>{{$location->lat}}</td>
                            <td>{{$location->long}}</td>
                            <td>
                                <div
                                    class="btn-group"
                                    role="group"
                                    aria-label="Basic example"
                                >
                                    <button
                                        onclick="deleteItem(this)"
                                        type="button"
                                        class="btn btn-danger"
                                        data-toggle="modal"
                                        data-target="#myModal"
                                        data-book-id="{{$location->uuid}}"
                                    >
                                        Delete
                                    </button>
                                    <a
                                        href="{{ route('location.edit',$location->uuid) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-warning"
                                        >
                                            Update
                                        </button></a
                                    >
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
                    action="{{ route('location.destroy', 0) }}"
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
        asset('assets/plugins/datatables/jquery.dataTables.js')
    }}"></script>
<script src="{{
        asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')
    }}"></script>

<script>
    $(document).ready(function () {
        $("#location").DataTable();
    });
</script>
@endsection
