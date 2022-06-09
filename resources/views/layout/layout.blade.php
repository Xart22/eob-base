<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>@yield('title')</title>

        <!-- Google Font: Source Sans Pro -->
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
        />
        <!-- Font Awesome Icons -->
        <link
            rel="stylesheet"
            href="{{
                asset('assets/plugins/fontawesome-free/css/all.min.css')
            }}"
        />
        <!-- overlayScrollbars -->
        <link
            rel="stylesheet"
            href="{{
                asset(
                    'assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css'
                )
            }}"
        />
        <!-- Theme style -->

        <link
            rel="stylesheet"
            href="{{ asset('assets/dist/css/adminlte.min.css') }}"
        />
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
        <style>
            /* width */
            ::-webkit-scrollbar {
                width: 10px;
            }

            /* Track */
            ::-webkit-scrollbar-track {
                background: #f1f1f1;
            }

            /* Handle */
            ::-webkit-scrollbar-thumb {
                background: #888;
            }

            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
                background: #555;
            }
        </style>
        @yield('header')
    </head>

    <body
        class="
            hold-transition
            dark-mode
            sidebar-mini
            layout-fixed layout-navbar-fixed layout-footer-fixed
        "
    >
        <div class="wrapper">
            <!-- Preloader -->
            <div
                class="
                    preloader
                    flex-column
                    justify-content-center
                    align-items-center
                "
            >
                <img
                    class="animation__wobble"
                    src="{{ asset('assets/dist/img/AdminLTELogo.png') }}"
                    alt="AdminLTELogo"
                    height="60"
                    width="60"
                />
            </div>

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-dark">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            data-widget="pushmenu"
                            href="#"
                            role="button"
                            ><i class="fas fa-bars"></i
                        ></a>
                    </li>
                    <!-- <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
          </li> -->
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            data-widget="fullscreen"
                            href="#"
                            role="button"
                        >
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="index3.html" class="brand-link">
                    <img
                        src="{{ asset('assets/dist/img/AdminLTELogo.png') }}"
                        alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3"
                        style="opacity: 0.8"
                    />
                    <span class="brand-text font-weight-light">EoB</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img
                                src="{{
                                    asset('assets/dist/img/user2-160x160.jpg')
                                }}"
                                class="img-circle elevation-2"
                                alt="User Image"
                            />
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">Alexander Pierce</a>
                        </div>
                    </div>
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul
                            class="nav nav-pills nav-sidebar flex-column"
                            data-widget="treeview"
                            role="menu"
                            data-accordion="false"
                        >
                            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                            <li class="nav-item menu-open">
                                <a
                                    href="{{ route('dashboard') }}"
                                    class="nav-link active"
                                >
                                    <i
                                        class="nav-icon fas fa-tachometer-alt"
                                    ></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-header">DATA MASTER</li>
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-photo-video"></i>
                                    <p>
                                        Entertaiment
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>

                                <ul
                                    class="nav nav-treeview"
                                    style="display: none"
                                >
                                    <li class="nav-item">
                                        <a
                                            href="{{ route('movie.index') }}"
                                            class="nav-link"
                                        >
                                            <i
                                                class="far fa-circle nav-icon"
                                            ></i>
                                            <p>Movie</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a
                                            href="{{ route('music.index') }}"
                                            class="nav-link"
                                        >
                                            <i
                                                class="far fa-circle nav-icon"
                                            ></i>
                                            <p>Music</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a
                                            href="{{ route('photo.index') }}"
                                            class="nav-link"
                                        >
                                            <i
                                                class="far fa-circle nav-icon"
                                            ></i>
                                            <p>Photo</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a
                                            href="{{ route('game.index') }}"
                                            class="nav-link"
                                        >
                                            <i
                                                class="far fa-circle nav-icon"
                                            ></i>
                                            <p>Game</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a
                                            href="{{ route('ebook.index') }}"
                                            class="nav-link"
                                        >
                                            <i
                                                class="far fa-circle nav-icon"
                                            ></i>
                                            <p>e-Books</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a
                                            href="{{ route('tv.index') }}"
                                            class="nav-link"
                                        >
                                            <i
                                                class="far fa-circle nav-icon"
                                            ></i>
                                            <p>Chanel TV</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a
                                            href="{{ route('company.index') }}"
                                            class="nav-link"
                                        >
                                            <i
                                                class="far fa-circle nav-icon"
                                            ></i>
                                            <p>Profile Company</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a
                                            href="{{ route('news.index') }}"
                                            class="nav-link"
                                        >
                                            <i
                                                class="far fa-circle nav-icon"
                                            ></i>
                                            <p>e-News</p>
                                        </a>
                                    </li>
                                                                        <li class="nav-item">
                                        <a
                                            href="{{ route('slider.index') }}"
                                            class="nav-link"
                                        >
                                            <i
                                                class="far fa-circle nav-icon"
                                            ></i>
                                            <p>Slider</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-photo-video"></i>
                                    <p>
                                        Route
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>

                                <ul
                                    class="nav nav-treeview"
                                    style="display: none"
                                >
                                    <li class="nav-item">
                                        <a
                                            href="{{ route('location.index') }}"
                                            class="nav-link"
                                        >
                                            <i
                                                class="far fa-circle nav-icon"
                                            ></i>
                                            <p>Location</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a
                                            href="{{ route('route.index') }}"
                                            class="nav-link"
                                        >
                                            <i
                                                class="far fa-circle nav-icon"
                                            ></i>
                                            <p>Destination</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item menu-open">
                                <a
                                    href="{{ route('setting.index') }}"
                                    class="nav-link active"
                                >
                                    <i
                                        class="nav-icon fas fa-tachometer-alt"
                                    ></i>
                                    <p>Setting</p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">@yield('breadcrumb')</h1>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item">
                                        <a href="#">@yield('breadcrumb')</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        @yield('breadcrumb')
                                    </li>
                                </ol>
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <section class="content">
                    <div class="container-fluid">
                        @if (session('succes'))
                        <div class="alert alert-success notif">
                            {{ session("succes") }}
                        </div>
                        @endif @if (session('error'))
                        <div class="alert alert-danger notif">
                            {{ session("error") }}
                        </div>
                        @endif @if ($errors->any())
                        <div class="alert alert-danger">
                            <button
                                type="button"
                                class="close"
                                data-dismiss="alert"
                            >
                                ×
                            </button>
                            {{ $errors }}
                        </div>
                        @endif @yield('content')
                    </div>
                </section>
            </div>

            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->

            <!-- Main Footer -->
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->
        <!-- jQuery -->
        <script src="{{
                asset('assets/plugins/jquery/jquery.min.js')
            }}"></script>
        <!-- Bootstrap -->
        <script src="{{
                asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')
            }}"></script>
        <!-- overlayScrollbars -->
        <script src="{{
                asset(
                    'assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'
                )
            }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
        <!-- PAGE PLUGINS -->
        <!-- jQuery Mapael -->
        <script src="{{
                asset('assets/plugins/jquery-mousewheel/jquery.mousewheel.js')
            }}"></script>
        <script src="{{
                asset('assets/plugins/raphael/raphael.min.js')
            }}"></script>
        <script src="{{
                asset('assets/plugins/jquery-mapael/jquery.mapael.min.js')
            }}"></script>
        <script src="{{
                asset('assets/plugins/jquery-mapael/maps/usa_states.min.js')
            }}"></script>
        <script src="{{ asset('assets/js/ajaxForm.js') }}"></script>
        <script src="{{ asset('assets/js/app.js') }}"></script>
        @yield('script')
    </body>
</html>
