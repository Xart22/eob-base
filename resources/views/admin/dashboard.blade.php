@extends('layout.layout')
@section('title','Dashboard')@section('breadcrumb','Dashboard')@section('header')

<link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}" />
@endsection @section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"
                        ><i class="fas fa-users"></i
                    ></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Connected Devices</span>
                        <span class="info-box-number">0</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"
                        ><i class="fas fa-tachometer-alt"></i
                    ></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Speed</span>
                        <span class="info-box-number" id="speed"> 0 </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"
                        ><i class="fas fa-map-marker-alt"></i
                    ></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Location</span>
                        <span class="info-box-number" id="location">-</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"
                        ><i class="fas fa-location-arrow"></i
                    ></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Destination</span>
                        <span class="info-box-number" id="destination">-</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row mb-2">
            <div class="w-100 border p-3">
                <div class="row">
                    <div class="col">
                        <h4>Send Info To Screen</h4>
                        @if($info != null)
                        <form
                            action="{{ route('create-info') }}"
                            method="post"
                            id="info"
                        >
                            @csrf
                            <div class="form-group">
                                <label>Message</label>
                                <input
                                    style="text-transform: uppercase"
                                    type="text"
                                    class="form-control"
                                    name="message"
                                    placeholder="message"
                                    required
                                    value="{{ $info }}"
                                    autocomplete="off"
                                />
                            </div>
                            <button type="submit" class="btn btn-success">
                                Send
                            </button>
                            <button
                                type="button"
                                class="btn btn-danger"
                                id="delete"
                            >
                                Delete
                            </button>
                        </form>
                        @else
                        <form action="{{ route('create-info') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Message</label>
                                <input
                                    style="text-transform: uppercase"
                                    type="text"
                                    class="form-control"
                                    name="message"
                                    placeholder="message"
                                    required
                                    value="{{ old('message') }}"
                                    autocomplete="off"
                                />
                            </div>
                            <button type="submit" class="btn btn-success">
                                Send
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if($data != null)
        <div class="row">
            <div class="col">
                <div class="border p-3 w-100">
                    <h4>CCTV</h4>

                    <iframe
                        src="{{ route('stream-cctv') }}"
                        frameborder="0"
                        width="100%"
                        height="750px"
                    ></iframe>
                </div>
            </div>
        </div>
        @endif @if(!empty($route_name))
        <div class="row mt-3">
            <div class="col">
                <div class="w-100 p-3 border">
                    Destination : {{ $route_name }}
                    <div class="flex-parent p-2">
                        <div class="input-flex-container">
                            @foreach($route as $location)
                            <div class="input">
                                <span
                                    class="text-center"
                                    data-info="{{ $location }}"
                                    data-year="ETA 00:00"
                                ></span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <!--/. container-fluid -->
</section>
<input type="hidden" id="locationUrl" value="{{ route('getlocation') }}" />
<!-- /.content -->
@endsection @section('script')
<script type="importmap">
    {
        "imports": {
            "socket.io-client": "https://cdn.socket.io/4.4.1/socket.io.esm.min.js"
        }
    }
</script>
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<script type="module" src="{{ asset('assets/js/dashboard.js') }}"></script>
@endsection
