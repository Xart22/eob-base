@extends('layout.layout')
@section('title','Setting')@section('breadcrumb','Setting')@section('header')
<link
    rel="stylesheet"
    href="{{ asset('assets/plugins/select2/css/select2.min.css') }}"
/>
@endsection @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="card-title">Setting</h4>
            </div>
            <div class="card-body">
                @if(!$data)
                <form action="{{ route('setting.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>IP NVR</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter IP NVR"
                                    name="ip_nvr"
                                    required
                                    value="{{ old('ip_nvr') }}"
                                    autocomplete="off"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>IP CCTV</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter IP CCTV"
                                    name="cctv"
                                    required
                                    value="{{ old('cctv') }}"
                                    autocomplete="off"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Route Destination</label>
                                <select
                                    style="width: 100%"
                                    class="form-control select2"
                                    name="route_id"
                                >
                                    <option></option>
                                    @foreach( $routes as $route)
                                    <option value="{{$route->id}}">
                                        {{$route->route_name}}
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
                @else
                <form
                    action="{{ route('setting.update',$data->id) }}"
                    method="post"
                >
                    @method('PUT') @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>IP NVR</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter IP NVR"
                                    name="ip_nvr"
                                    required
                                    value="{{ $data->ip_nvr }}"
                                    autocomplete="off"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>IP CCTV</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter IP CCTV"
                                    name="cctv"
                                    required
                                    value="{{ $data->cctv }}"
                                    autocomplete="off"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Route Destination</label>
                                <select
                                    style="width: 100%"
                                    class="form-control select2"
                                    name="route_id"
                                >
                                                                        <option value="{{$data->route_id}}">
                                        {{ $route_name }}
                                    </option>
                                    @foreach( $routes as $route)
                                    <option value="{{$route->id}}">
                                        {{$route->route_name}}
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
                @endif
            </div>
        </div>
    </div>
</div>

@endsection @section('script')
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $(".select2").select2({
            placeholder: "Select a Destination Route",
            allowClear: true,
        });
    });
</script>
@endsection
