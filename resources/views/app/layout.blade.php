<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta
            http-equiv="Cache-Control"
            content="no-cache, no-store, must-revalidate"
        />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />
        <title>Document</title>
        <link
            rel="stylesheet"
            href="{{
                asset('assets/bootstrap-5.1.3-dist/css/bootstrap.min.css')
            }}"
        />
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
        />
        <link
            rel="stylesheet"
            href="{{
                asset('assets/plugins/fontawesome-free/css/all.min.css')
            }}"
        />
        <link
            rel="stylesheet"
            href="{{ asset('assets/plugins/skeleton/jquery.skeleton.css') }}"
        />
        <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" />

        @yield('header')
    </head>
    <body>
        <a onclick="history.back()" id="back">
            <div class="row" style="background-color: #e69b40">
                <div class="col ml-3 p-3">
                    <img
                        src="{{ asset('assets/img/back.png') }}"
                        height="25px"
                        width="25px"
                        style="
                            float: left;
                            margin-right: 50px;
                            filter: invert(100%);
                        "
                    />
                </div>
            </div>
        </a>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">@yield('content')</div>
            </div>
        </div>
        <script src="{{
                asset('assets/plugins/jquery/jquery.min.js')
            }}"></script>
        <script src="{{
                asset('assets/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js')
            }}"></script>
        <script src="{{
                asset('assets/plugins/skeleton/jquery.scheletrone.js')
            }}"></script>
        <script src="{{ asset('assets/app/js/app.js') }}"></script>
        @yield('script')
    </body>
</html>
