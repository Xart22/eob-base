@extends('layout.layout')
@section('title','Destination')@section('breadcrumb','Destination')@section('header')

<link
    rel="stylesheet"
    href="{{ asset('assets/plugins/select2/css/select2.min.css') }}"
/>

<link rel="stylesheet" href="{{ asset('assets/css/route.css') }}" />

@endsection @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="card-title">Destination</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('route.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Route Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter Destination Name"
                                    name="route_name"
                                    required
                                    value="{{ old('route_name') }}"
                                    autocomplete="off"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>From</label>
                                <select
                                    style="width: 100%"
                                    class="select2 form-control"
                                    name="from"
                                >
                                    <option></option>
                                    @foreach( $data_location as $location)
                                    <option value="{{$location->id}}">
                                        {{$location->location_name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Transit</label>
                                <select
                                    style="width: 100%"
                                    class="select2 form-control"
                                    name="translit[]"
                                    multiple
                                >
                                    <option></option>
                                    @foreach( $data_location as $location)
                                    <option value="{{$location->id}}">
                                        {{$location->location_name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>TO</label>
                                <select
                                    style="width: 100%"
                                    class="select2 form-control"
                                    name="to"
                                >
                                    <option></option>
                                    @foreach( $data_location as $location)
                                    <option value="{{$location->id}}">
                                        {{$location->location_name}}
                                    </option>
                                    @endforeach
                                </select>
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
                <h4 class="card-title">Route List</h4>
            </div>
            <div class="card-body">
                @foreach ($data_route as $route)
                <div class="row">
                    <div class="p-2 border w-100">
                        {{$route->route_name}}
                        <div class="flex-parent p-5">
                            <div class="input-flex-container">
                                @foreach($route->routeList as $location)
                                @if($loop->index)
                                <div class="input active">
                                    <span
                                        data-info="{{$location->getLocation->location_name}}"
                                    ></span>
                                </div>
                                @else
                                <div class="input">
                                    <span
                                        data-info="{{$location->getLocation->location_name}}"
                                    ></span>
                                </div>
                                @endif @endforeach
                            </div>
                            <div class="container">
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
                                        data-book-id="{{$route->id}}"
                                    >
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
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
                    action="{{ route('route.destroy', 0) }}"
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
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $(".select2").select2({
            placeholder: "Select a Location",
            allowClear: true,
        });
    });
</script>
@endsection
