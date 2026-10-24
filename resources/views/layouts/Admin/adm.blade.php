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

    <!-- Google Font & Modern UI Overrides -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    <style>
        body, button, input, select, textarea, h1, h2, h3, h4, h5, h6, p, span, a, label, table {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        /* Pastikan FontAwesome dan RemixIcon menggunakan font icon mereka */
        i.fa, i.fas, i.far, i.fab, i.fa-solid, i.fa-regular, i.fa-brands, [class^="ri-"], [class^="mdi-"] {
            font-family: "Font Awesome 6 Free", "remixicon", "Material Design Icons" !important;
        }

        body {
            background-color: #f8fafc !important;
            color: #1e293b;
        }

        /* Topbar Header Modern */
        #page-topbar {
            background: #ffffff !important;
            border-bottom: 1px solid #e2e8f0 !important;
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.05) !important;
            z-index: 1002 !important;
        }

        /* Logo Brand Box dengan Background Gradient Selaras & Menyatu dengan Sidebar */
        .navbar-brand-box {
            background: linear-gradient(180deg, #070d18 0%, #0d1527 100%) !important;
            width: 250px !important;
            min-width: 250px !important;
            height: 70px !important;
            border-right: 1px solid rgba(255, 255, 255, 0.07) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
            display: flex !important;
            align-items: center !important;
            justify-content: flex-start !important;
            padding: 0 16px !important;
            box-sizing: border-box !important;
        }

        .navbar-brand-box a {
            display: flex !important;
            align-items: center !important;
            justify-content: flex-start !important;
            gap: 12px !important;
            text-decoration: none !important;
            width: 100% !important;
        }

        .brand-text-logo {
            font-weight: 800 !important;
            font-size: 16px !important;
            letter-spacing: -0.3px !important;
            color: #ffffff !important;
            line-height: 1.2 !important;
        }

        .brand-text-sub {
            font-size: 9.5px !important;
            color: #818cf8 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.8px !important;
            font-weight: 700 !important;
            display: block !important;
        }

        #vertical-menu-btn {
            color: #475569 !important;
        }

        .header-item {
            color: #334155 !important;
        }

        .header-profile-user {
            border: 2px solid #6366f1 !important;
            box-shadow: 0 2px 8px rgba(99, 102, 241, 0.25);
        }

        /* Layout & Sidebar Full Height dengan Smooth Gradient Elegan */
        html, body, #layout-wrapper {
            min-height: 100vh !important;
        }

        .vertical-menu {
            position: fixed !important;
            top: 70px !important;
            bottom: 0 !important;
            left: 0 !important;
            width: 250px !important;
            height: calc(100vh - 70px) !important;
            background: linear-gradient(180deg, #0d1527 0%, #0f172a 40%, #1e1b4b 100%) !important;
            border-right: 1px solid rgba(255, 255, 255, 0.07) !important;
            box-shadow: 6px 0 28px rgba(0, 0, 0, 0.25) !important;
            display: flex !important;
            flex-direction: column !important;
            z-index: 1001 !important;
        }

        .vertical-menu [data-simplebar] {
            height: 100% !important;
            max-height: 100% !important;
            overflow-y: auto !important;
            padding-top: 10px !important;
        }

        .main-content {
            margin-left: 250px !important;
            min-height: 100vh !important;
        }

        @media (max-width: 991.98px) {
            .navbar-brand-box {
                width: auto !important;
                min-width: unset !important;
            }
            .main-content {
                margin-left: 0 !important;
            }
        }

        /* Running Text (Marquee) in Topbar */
        .marquee-container {
            flex: 1;
            margin: 0 24px;
            overflow: hidden;
            white-space: nowrap;
            position: relative;
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 30px;
            padding: 7px 18px;
            display: flex;
            align-items: center;
        }

        .marquee-badge {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: #ffffff;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            padding: 3px 10px;
            border-radius: 20px;
            margin-right: 14px;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            box-shadow: 0 2px 6px rgba(79, 70, 229, 0.35);
        }

        .marquee-track {
            display: inline-block;
            white-space: nowrap;
            overflow: hidden;
            width: 100%;
        }

        .marquee-text {
            display: inline-block;
            padding-left: 100%;
            animation: marquee 25s linear infinite;
            font-size: 13.5px;
            font-weight: 600;
            color: #334155;
        }

        .marquee-container:hover .marquee-text {
            animation-play-state: paused;
        }

        @keyframes marquee {
            0% { transform: translate(0, 0); }
            100% { transform: translate(-100%, 0); }
        }

        .user-profile {
            padding: 16px 10px;
            background: linear-gradient(180deg, rgba(30, 41, 59, 0.7) 0%, rgba(15, 23, 42, 0.9) 100%);
            border-radius: 16px;
            margin: 14px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .user-profile h4 {
            color: #ffffff !important;
            font-weight: 700 !important;
        }

        .menu-title {
            color: #64748b !important;
            font-weight: 700 !important;
            font-size: 11px !important;
            letter-spacing: 1px !important;
            text-transform: uppercase !important;
            padding: 14px 22px 6px !important;
        }

        #sidebar-menu ul li a {
            color: #cbd5e1 !important;
            font-weight: 500 !important;
            font-size: 14px !important;
            padding: 12px 18px !important;
            border-radius: 12px !important;
            margin: 4px 12px !important;
            display: flex !important;
            align-items: center !important;
            gap: 14px !important;
            transition: all 0.25s ease !important;
        }

        #sidebar-menu ul li a i {
            font-size: 17px !important;
            color: #818cf8 !important; /* Terang & kontras */
            transition: all 0.25s ease !important;
            min-width: 24px;
            text-align: center;
            display: inline-block !important;
        }

        #sidebar-menu ul li a:hover,
        #sidebar-menu ul li.mm-active > a {
            color: #ffffff !important;
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%) !important;
            box-shadow: 0 8px 20px -4px rgba(79, 70, 229, 0.5) !important;
        }

        #sidebar-menu ul li a:hover i,
        #sidebar-menu ul li.mm-active > a i {
            color: #ffffff !important;
            transform: scale(1.1);
        }

        /* Card Modern Design */
        .card {
            border-radius: 18px !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: 0 4px 16px -2px rgba(15, 23, 42, 0.04) !important;
            background-color: #ffffff;
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            box-shadow: 0 10px 25px -4px rgba(15, 23, 42, 0.08) !important;
        }

        /* Buttons Modern */
        .btn {
            border-radius: 10px !important;
            font-weight: 600 !important;
            font-size: 13.5px !important;
            padding: 8px 16px !important;
            transition: all 0.2s ease !important;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%) !important;
            border: none !important;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3) !important;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(79, 70, 229, 0.4) !important;
        }

        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
            border: none !important;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3) !important;
        }

        /* Table Modern & Dropdown Action Fix */
        .table-responsive {
            overflow: visible !important;
            padding-bottom: 20px;
        }

        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto !important;
            }
        }

        .table {
            color: #334155 !important;
            vertical-align: middle !important;
            border-collapse: separate !important;
            border-spacing: 0 !important;
            margin-bottom: 1.5rem !important;
        }

        .table thead th {
            background: #f8fafc !important;
            color: #475569 !important;
            font-weight: 700 !important;
            font-size: 12px !important;
            text-transform: uppercase !important;
            letter-spacing: 0.6px !important;
            border-top: 1px solid #e2e8f0 !important;
            border-bottom: 2px solid #e2e8f0 !important;
            padding: 14px 18px !important;
            white-space: nowrap;
        }

        .table thead th:last-child {
            text-align: center !important;
            width: 110px !important;
        }

        .table tbody td {
            padding: 14px 18px !important;
            border-bottom: 1px solid #f1f5f9 !important;
            font-size: 13.5px !important;
            color: #334155;
            vertical-align: middle !important;
        }

        .table tbody td:last-child {
            text-align: center !important;
            width: 110px !important;
        }

        .table tbody tr {
            transition: background-color 0.15s ease;
        }

        .table tbody tr:hover {
            background-color: #f8fafc !important;
        }

        /* Tombol Aksi Dropdown Modern & Rapi */
        .btn-action-dropdown {
            background: #f1f5f9 !important;
            color: #334155 !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 8px !important;
            padding: 6px 14px !important;
            font-size: 12.5px !important;
            font-weight: 600 !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 6px !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05) !important;
            transition: all 0.2s ease !important;
        }

        .btn-action-dropdown:hover, 
        .btn-action-dropdown:focus, 
        .show > .btn-action-dropdown {
            background: #e2e8f0 !important;
            color: #0f172a !important;
            border-color: #94a3b8 !important;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1) !important;
        }

        .dropdown-menu {
            border-radius: 12px !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.12), 0 8px 10px -6px rgba(0, 0, 0, 0.08) !important;
            padding: 6px !important;
            z-index: 1060 !important;
            min-width: 140px !important;
        }

        .dropdown-item {
            border-radius: 8px !important;
            font-weight: 600 !important;
            font-size: 12.5px !important;
            padding: 8px 14px !important;
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
            transition: all 0.15s ease !important;
        }

        .dropdown-item:hover {
            background-color: #f1f5f9 !important;
            color: #4f46e5 !important;
        }

        .dropdown-item.text-danger:hover {
            background-color: #fef2f2 !important;
            color: #dc2626 !important;
        }

        /* Modern DataTables Styling: Search, Length, Pagination */
        .dataTables_wrapper {
            font-size: 13px !important;
            color: #475569 !important;
        }

        .dataTables_wrapper .dataTables_length {
            margin-bottom: 16px;
        }

        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #cbd5e1 !important;
            border-radius: 8px !important;
            padding: 6px 28px 6px 12px !important;
            font-size: 13px !important;
            color: #334155 !important;
            outline: none !important;
            background-color: #ffffff;
        }

        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 16px;
        }

        .dataTables_wrapper .dataTables_filter label {
            font-weight: 600 !important;
            color: #475569 !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 8px !important;
        }

        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #cbd5e1 !important;
            border-radius: 8px !important;
            padding: 6px 14px !important;
            font-size: 13px !important;
            color: #1e293b !important;
            outline: none !important;
            background-color: #ffffff !important;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04) !important;
            transition: all 0.2s ease !important;
            width: 220px !important;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #6366f1 !important;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15) !important;
        }

        .dataTables_wrapper .dataTables_info {
            padding-top: 14px !important;
            color: #64748b !important;
            font-weight: 500 !important;
        }

        .dataTables_wrapper .dataTables_paginate {
            padding-top: 12px !important;
        }

        .dataTables_wrapper .dataTables_paginate .pagination {
            gap: 4px;
        }

        .dataTables_wrapper .dataTables_paginate .page-item .page-link {
            border-radius: 8px !important;
            border: 1px solid #e2e8f0 !important;
            color: #475569 !important;
            font-weight: 600 !important;
            font-size: 12.5px !important;
            padding: 6px 12px !important;
            transition: all 0.15s ease !important;
        }

        .dataTables_wrapper .dataTables_paginate .page-item.active .page-link {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%) !important;
            border-color: #4f46e5 !important;
            color: #ffffff !important;
            box-shadow: 0 2px 8px rgba(79, 70, 229, 0.3) !important;
        }

        .dataTables_wrapper .dataTables_paginate .page-item .page-link:hover {
            background-color: #f1f5f9 !important;
            color: #1e293b !important;
        }

        /* Badges */
        .badge {
            padding: 6px 12px !important;
            border-radius: 20px !important;
            font-weight: 600 !important;
            font-size: 12px !important;
        }

        .badge.bg-success {
            background: #dcfce7 !important;
            color: #15803d !important;
        }

        .badge.bg-primary {
            background: #e0e7ff !important;
            color: #4338ca !important;
        }

        .badge.bg-danger {
            background: #fee2e2 !important;
            color: #b91c1c !important;
        }

        /* Footer */
        .footer {
            background: #ffffff !important;
            border-top: 1px solid #e2e8f0 !important;
            color: #64748b !important;
            font-size: 13px !important;
        }
    </style>

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
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('img/Logo-ADIA.png') }}" alt="Logo CRS" height="34" style="object-fit: contain;">
                            <div class="text-start">
                                <span class="brand-text-logo">CRS SATGAS</span>
                                <span class="brand-text-sub">LLDIKTI WILAYAH III</span>
                            </div>
                        </a>
                    </div>



                    <button type="button" class="btn matis btn-sm px-3 font-size-24 header-item waves-effect"
                        id="vertical-menu-btn">

                        <i class="ri-menu-2-line align-middle"></i>

                    </button>

                </div>

                <!-- Running Text Marquee -->
                <div class="marquee-container d-none d-md-flex">
                    <span class="marquee-badge">
                        <i class="fas fa-bullhorn"></i> Informasi
                    </span>
                    <div class="marquee-track">
                        <span class="marquee-text">
                            Layanan Pengaduan CRS Satgas PPKPT LLDIKTI wilayah III
                            Di CRS Satgas PPKPT LLDIKTI wilayah III,kami menyediakan saluran pengaduan yang aman dan cepat untuk memastikan perlindungan dan kesejahteraan semua pihak.
                        </span>
                    </div>
                </div>

                <style>
                    @media screen and (min-width:992px) {
                        .matis {
                            display: none
                        }
                    }
                </style>


                <div class="d-flex align-items-center">

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

                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"><i class="ri-logout-box-r-line align-middle me-1 text-danger"></i> Logout</a>

                        </div>

                    </div>

                </div>

            </div>

        </header>

        <!-- ========== Left Sidebar Start ========== -->

        <div class="vertical-menu">



            <div data-simplebar class="h-100">

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

                                    <span><i class="fas fa-print"></i> {{ Auth::user()->level == 'pelapor' ? 'Laporan Saya' : 'Laporan Masuk' }}</span>

                                </a>

                            </li>

                            @if (Auth::user()->level == 'pelapor')
                                <li>

                                    <a href="{{ url('laporan/form') }}" class="waves-effect">

                                        <span><i class="fas fa-file-circle-plus"></i> Buat Laporan</span>

                                    </a>

                                </li>
                            @endif
                        @endif

                        @if (Auth::user()->level != 'pelapor')
                            <li>
                                <a href="{{ route('adm.dekripsi_berkas') }}" class="waves-effect {{ request()->is('adm/dekripsi_berkas*') ? 'active' : '' }}">
                                    <span><i class="fas fa-lock-open text-warning"></i> Enkripsi & Dekripsi</span>
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->level == 'superadmin')
                            <li>
                                <a href="{{ route('adm.pengujian_kriptografi') }}" class="waves-effect {{ request()->is('adm/pengujian_kriptografi*') ? 'active' : '' }}">
                                    <span><i class="fas fa-flask-vial text-info"></i> Pengujian AES</span>
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->level != 'pelapor')
                            <li>

                                <a href="{{ url('adm/log') }}" class="waves-effect">

                                    <span><i class="fas fa-edit"></i> Log</span>

                                </a>

                            </li>
                        @endif



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
