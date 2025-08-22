<!doctype html>

<html lang="en">

<head>

    <meta charset="utf-8" />

    <title>{{ $pagetitle }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- App favicon -->

    <link rel="icon" href="{{ asset('img/Logo-ADIA.png') }}">



    <!-- jquery.vectormap css -->

    <link href="{{ asset('admin/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet"
        type="text/css" />



    <!-- DataTables -->

    <link href="{{ asset('admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />



    <!-- Responsive datatable examples -->

    <link href="{{ asset('admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />



    <!-- Bootstrap Css -->

    <link href="{{ asset('admin/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />

    <!-- Icons Css -->

    <link href="{{ asset('admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App Css-->

    <link href="{{ asset('admin/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    @stack('css')

</head>



<body data-topbar="dark">



    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <div id="layout-wrapper">



        <header id="page-topbar">

            <div class="navbar-header">

                <div class="d-flex">

                    <!-- LOGO -->

                    <div class="navbar-brand-box">

                        <a href="#" class="logo logo-dark">

                            <span class="logo-sm">

                                <img src="{{ asset('img/1.png') }}" alt="logo-sm" height="40">

                            </span>

                            <span class="logo-lg">

                                <img src="{{ asset('img/1.png') }}" alt="logo-dark" height="40">

                            </span>

                        </a>



                        <a href="{{ url('/') }}" class="logo logo-light">

                            <span class="logo-sm">

                                <img src="{{ asset('img/1.png') }}" alt="logo-sm-light" height="40">

                            </span>

                            <span class="logo-lg">

                                <img src="{{ asset('img/1.png') }}" alt="logo-light" height="40">

                            </span>

                        </a>

                    </div>



                    <button type="button" class="btn matis btn-sm px-3 font-size-24 header-item waves-effect"
                        id="vertical-menu-btn">

                        <i class="ri-menu-2-line align-middle"></i>

                    </button>

                </div>

                <style>
                    @media screen and (min-width:992px) {
                        .matis {
                            display: none
                        }
                    }
                </style>


                <div class="d-flex">

                    <div class="dropdown d-inline-block user-dropdown">

                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            <img class="rounded-circle header-profile-user"
                                src="{{ asset('admin/images/users/avatar-1.png') }}" alt="Header Avatar">

                            <span class="d-none d-xl-inline-block ms-1">{{ Auth::user()->name }}</span>

                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>

                        </button>

                        <div class="dropdown-menu dropdown-menu-end">

                            <!-- item-->

                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#mka" href="#"><i
                                    class="fas fa-user align-middle me-1"></i> Profile</a>
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#passw" href="#"><i
                                    class="fas fa-lock align-middle me-1"></i> Ganti Password</a>

                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"><i
                                    class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>

                        </div>

                    </div>

                </div>

            </div>

        </header>

        <!-- ========== Left Sidebar Start ========== -->

        <div class="vertical-menu">



            <div data-simplebar class="h-100">



                <!-- User details -->

                <div class="user-profile text-center mt-3">

                    <div class="">

                        <img src="{{ asset('admin/images/users/avatar-1.png') }}" alt=""
                            class="avatar-md rounded-circle">

                    </div>

                    <div class="mt-3">

                        <h4 class="font-size-16 mb-1">{{ Auth::user()->name }}</h4>

                        {{-- <span class="text-muted"><i class="align-middle font-size-14 text-success"></i> {{Auth::user()->username}}</span> --}}

                    </div>

                </div>



                <!--- Sidemenu -->

                <div id="sidebar-menu">

                    <!-- Left Menu Start -->

                    <ul class="metismenu list-unstyled" id="side-menu">

                        <li class="menu-title">Menu</li>



                        @if (Auth::user()->level == 'superadmin')
                            <li>

                                <a href="{{ route('dashboard') }}" class="waves-effect">

                                    <span><i class="fas fa-home"></i> Dashboard</span>

                                </a>

                            </li>

                            <li>

                                <a href="{{ route('laporan.index') }}" class="waves-effect">

                                    <span><i class="fas fa-print"></i> Laporan Masuk</span>

                                </a>

                            </li>
                            <li>

                                <a href="{{ url('adm/laporan_gabungan') }}" class="waves-effect">

                                    <span><i class="fas fa-inbox"></i> Laporan Gabungan</span>

                                </a>

                            </li>

                            <li>

                                <a href="{{ route('kekerasan.index') }}" class="waves-effect">

                                    <span><i class="fas fa-clipboard"></i> Jenis Kekerasan</span>

                                </a>

                            </li>

                            <li>

                                <a href="{{ route('identitas.index') }}" class="waves-effect">

                                    <span><i class="fas fa-folder-open"></i> Jenis Identitas</span>

                                </a>

                            </li>

                            <li>

                                <a href="{{ route('universitas.index') }}" class="waves-effect">

                                    <span><i class="fas fa-school"></i> Perguruan Tinggi</span>

                                </a>

                            </li>

                            <li>

                                <a href="{{ route('template.index') }}" class="waves-effect">

                                    <span><i class="fas fa-layer-group"></i> Template Status</span>

                                </a>

                            </li>

                            <li>

                                <a href="{{ url('adm/saran') }}" class="waves-effect">

                                    <span><i class="fas fa-envelope"></i> Saran Dan Masukan</span>

                                </a>

                            </li>
                            <li>

                                <a href="{{ route('user.index') }}" class="waves-effect">

                                    <span><i class="fas fa-users"></i> User</span>

                                </a>

                            </li>

                            <li>

                                <a href="{{ url('adm/pengaturan') }}" class="waves-effect">

                                    <span><i class="fas fa-cog"></i> Pengaturan</span>

                                </a>

                            </li>
                        @else
                            <li>

                                <a href="{{ route('dashboard') }}" class="waves-effect">

                                    <span><i class="fas fa-home"></i> Dashboard</span>

                                </a>

                            </li>

                            <li>

                                <a href="{{ route('laporan.index') }}" class="waves-effect">

                                    <span><i class="fas fa-print"></i> Laporan Masuk</span>

                                </a>

                            </li>
                            @if (Auth::user()->level == 'pt')
                                <li>

                                    <a href="{{ url('adm/laporan_gabungan') }}" class="waves-effect">

                                        <span><i class="fas fa-inbox"></i> Laporan Gabungan</span>

                                    </a>

                                </li>
                            @endif
                        @endif

                        <li>

                            <a href="{{ url('adm/log') }}" class="waves-effect">

                                <span><i class="fas fa-edit"></i> Log</span>

                            </a>

                        </li>



                    </ul>

                </div>

                <!-- Sidebar -->

            </div>

        </div>

        <!-- Left Sidebar End -->



        @yield('content')



        <!-- JAVASCRIPT -->
        <div class="modal fade" id="mka" tabindex="-1" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <form class="modal-dialog modal-lg" method="POST" action="{{ route('user.ganti_profile') }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="form-label">Nama <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" class="form-control" required placeholder="Nama"
                                value="{{ Auth::user()->name }}">
                            @error('nama')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email <span
                                    class="text-red-500">*</span></label>
                            <input type="email" name="email" class="form-control" required placeholder="Email"
                                value="{{ Auth::user()->email }}">
                            @error('email')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        @csrf
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal fade" id="passw" tabindex="-1" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <form class="modal-dialog modal-lg" method="POST" action="{{ route('ganti_password') }}">
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Ganti Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">Password Baru <span
                                    class="text-red-500">*</span></label>
                            <div class="input-group">
                                <input type="password" id="password" name="password" class="form-control" required
                                    placeholder="Password Baru">
                                <span class="input-group-text" onclick="togglePassword()" style="cursor: pointer;">
                                    <i class="fa fa-eye" id="eyeIcon"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password_baru" class="form-label">Ulangi Password Baru <span
                                    class="text-red-500">*</span></label>
                            <div class="input-group">
                                <input type="password" id="password_baru" name="password_baru" class="form-control"
                                    required placeholder="Ulangi Password Baru">
                                <span class="input-group-text" onclick="togglePasswordConfirm()"
                                    style="cursor: pointer;">
                                    <i class="fa fa-eye" id="eyeIconConfirm"></i>
                                </span>
                            </div>
                            @error('password_baru')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        @csrf
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
        <script src="{{ asset('admin/libs/jquery/jquery.min.js') }}"></script>

        <script src="{{ asset('admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <script src="{{ asset('admin/libs/metismenu/metisMenu.min.js') }}"></script>

        <script src="{{ asset('admin/libs/simplebar/simplebar.min.js') }}"></script>

        <script src="{{ asset('admin/libs/node-waves/waves.min.js') }}"></script>

        <!-- apexcharts -->

        <script src="{{ asset('admin/libs/apexcharts/apexcharts.min.js') }}"></script>



        <!-- jquery.vectormap map -->

        <script src="{{ asset('admin/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>

        <script src="{{ asset('admin/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js') }}"></script>




        <!-- App js -->

        <script src="{{ asset('admin/js/app.js') }}"></script>
        <script>
            function togglePassword() {
                const passwordInput = document.getElementById("password");
                const eyeIcon = document.getElementById("eyeIcon");

                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    eyeIcon.classList.remove("fa-eye");
                    eyeIcon.classList.add("fa-eye-slash");
                } else {
                    passwordInput.type = "password";
                    eyeIcon.classList.remove("fa-eye-slash");
                    eyeIcon.classList.add("fa-eye");
                }
            }


            function togglePasswordConfirm() {
                const passwordInput = document.getElementById("password_baru");
                const eyeIcon = document.getElementById("eyeIconConfirm");

                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    eyeIcon.classList.remove("fa-eye");
                    eyeIcon.classList.add("fa-eye-slash");
                } else {
                    passwordInput.type = "password";
                    eyeIcon.classList.remove("fa-eye-slash");
                    eyeIcon.classList.add("fa-eye");
                }
            }
        </script>
        @stack('js')

</body>



</html>
