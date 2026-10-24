<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Ikbal">
    <title>{{ $title }}</title>
    <!-- Latest Bootstrap min CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="icon" href="{{ asset('img/Logo-ADIA.png') }}">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <!--- owl carousel Css-->
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.css') }}">
    <!--slicknav Css-->
    <link rel="stylesheet" href="{{ asset('css/slicknav.css') }}">
    <!-- MAGNIFIC CSS -->
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <!-- animate CSS -->
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('css/slider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
<style>
    a::before {
        display: none !important;
    }

    /* Navbar Sticky Modern */
    #navigation {
        background: #ffffff !important;
        box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.07) !important;
        padding: 0 !important;
        position: sticky !important;
        top: 0 !important;
        z-index: 1050 !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        width: 100% !important;
    }

    /* Saat terkena class scroll navbar-fixed */
    #navigation.navbar-fixed {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        background: rgba(255, 255, 255, 0.98) !important;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08) !important;
        animation: fadeInDown 0.4s ease-out;
        z-index: 1050 !important;
    }

    #navigation .container {
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .navbar-container-inner {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        width: 100% !important;
        flex-wrap: nowrap !important;
    }

    .site-logo {
        display: flex !important;
        align-items: center !important;
        flex-shrink: 0 !important;
    }

    .site-logo img {
        height: 48px !important;
        max-height: 48px !important;
        width: auto !important;
        object-fit: contain !important;
    }

    .header_right {
        float: none !important;
        display: flex !important;
        align-items: center !important;
        flex-shrink: 0 !important;
    }

    #main-menu {
        margin: 0 !important;
        display: block !important;
    }

    #main-menu ul {
        margin: 0 !important;
        padding: 0 !important;
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        gap: 4px !important;
        list-style: none !important;
        white-space: nowrap !important;
    }

    #main-menu ul li {
        display: inline-flex !important;
        align-items: center !important;
        padding: 0 !important;
        margin: 0 !important;
        float: none !important;
        position: relative !important;
    }

    #main-menu ul li a.nav-link-item {
        color: #334155 !important;
        font-family: 'Poppins', sans-serif !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        padding: 8px 12px !important;
        border-radius: 8px !important;
        transition: all 0.2s ease !important;
        text-decoration: none !important;
        display: inline-flex !important;
        align-items: center !important;
        line-height: 1.4 !important;
    }

    #main-menu ul li a.nav-link-item:hover {
        color: #4f46e5 !important;
        background-color: #f8fafc !important;
    }

    #main-menu ul li a.nav-link-item.active {
        color: #4f46e5 !important;
        background-color: #eef2ff !important;
        font-weight: 700 !important;
    }

    .btn-nav-auth {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%) !important;
        color: #ffffff !important;
        font-family: 'Poppins', sans-serif !important;
        font-size: 13.5px !important;
        font-weight: 600 !important;
        padding: 8px 18px !important;
        border-radius: 20px !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3) !important;
        transition: all 0.25s ease !important;
        text-decoration: none !important;
        margin-left: 6px !important;
        white-space: nowrap !important;
        line-height: 1.4 !important;
    }

    .btn-nav-auth:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(79, 70, 229, 0.4) !important;
        color: #ffffff !important;
        background: linear-gradient(135deg, #4338ca 0%, #6d28d9 100%) !important;
    }

    @media (max-width: 991px) {
        #main-menu {
            display: none !important;
        }
        #mobile_menu {
            display: block !important;
        }
    }
</style>
</head>

<body>
    @php
        $set = App\Models\PengaturanModel::orderby('id', 'DESC')->first();
    @endphp
    <!-- START LOGO WITH CONTACT -->
    <section class="logo-contact" >
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="single-top-contact">
                        <i class="fas fa-phone"></i>
                        <h4><strong>{{ $set->no_wa }}</strong></h4>
                    </div>
                </div><!--- END COL -->
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="single-top-contact">
                        <i class="fa fa-envelope"></i>
                        <h4><strong>{{ $set->email }}</strong></h4>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 ">
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="top_social_profile">
                        <ul>

                            <li><a href="https://wa.me/{{ $set->no_wa }}" target="_blank" class="top_f_instagram"><i class="fab fa-whatsapp"
                                        title="Whatsapp"></i></a></li>
                            <li><a href="{{ $set->ig }}"  target="_blank" class="top_f_linkedin"><i class="fab fa-instagram"
                                        title="Instagram"></i></a></li>
                        </ul>
                    </div>
                </div><!--- END COL -->
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END LOGO WITH CONTACT -->

    <!-- START NAVBAR -->
    <div id="navigation" class="navbar-light bg-faded site-navigation">
        <div class="container">
            <div class="navbar-container-inner">
                <div class="site-logo">
                    <a class="navbar-logo d-flex align-items-center" href="{{ url('/') }}">
                        <img src="{{ asset('img/Logo-ADIA.png') }}" alt="Logo CRS">
                    </a>
                </div>
                <div class="header_right">
                    <nav id="main-menu">
                        <ul>
                            <li>
                                <a class="nav-link-item {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Beranda</a>
                            </li>
                            <li>
                                <a class="nav-link-item {{ (request()->is('laporan/form') || request()->is('responselaporan')) ? 'active' : '' }}" href="{{ url('laporan/form') }}">Buat Laporan</a>
                            </li>
                            <li>
                                <a class="nav-link-item {{ (request()->is('laporan/status') || request()->is('cekstatus*') || request()->is('kirim_chat')) ? 'active' : '' }}" href="{{ url('laporan/status') }}">Cek Status Laporan</a>
                            </li>
                            <li>
                                <a class="nav-link-item {{ request()->is('informasi') ? 'active' : '' }}" href="{{ url('informasi') }}">Informasi</a>
                            </li>
                            @if(isset($set->manual_book))
                                <li>
                                    <a class="nav-link-item" target="_blank" href="{{ asset($set->manual_book) }}">Buku Panduan</a>
                                </li>
                            @endif
                            <li>
                                <a class="nav-link-item {{ request()->is('kontak') ? 'active' : '' }}" href="{{ url('kontak') }}">Kontak</a>
                            </li>
                            <li>
                                @if(Auth::check())
                                    <a class="btn-nav-auth" href="{{ route('dashboard') }}">
                                        <i class="fas fa-gauge-high"></i> Dashboard
                                    </a>
                                @else
                                    <a class="btn-nav-auth" href="{{ url('login') }}">
                                        <i class="fas fa-arrow-right-to-bracket"></i> Masuk
                                    </a>
                                @endif
                            </li>
                        </ul>
                    </nav>
                    <div id="mobile_menu"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- END NAVBAR -->

    @yield('content')

    <!-- START FOOTER -->
    <div class="footer" style="background-color: #2C366A">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="footer_logo">
                        <img src="{{ asset('img/main.png') }}" alt="" />
                        <p class="text-white" style="text-align: justify">Di CRS Satgas PPKPT LLDIKTI wilayah III,kami menyediakan saluran pengaduan yang aman dan
                            cepat untuk memastikan perlindungan dan kesejahteraan semua pihak.</p>
                    </div>
                </div><!--- END COL -->
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="single_footer single_footer_top_one">
                        <h4>Hubungi Kami</h4>
                        <ul>
                            <li><a href="#"><i class="fas fa-location-dot"></i> {{ $set->alamat }}</a></li>
                            <li style="list-style: none"><a  href="https://wa.me/{{ $set->no_wa }}"><i class="fas fa-phone"></i> {{ $set->no_wa }}</a></li>
                            <li><a href="mailto:{{ $set->email }}"><i class="fas fa-envelope"></i> {{ $set->email }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-1">
                    <div class="single_footer single_footer_top">
                        <h4>Sosial Media</h4>
                        <div class="social_profile">
                        <ul>
                            <li><a href="https://wa.me/{{ $set->no_wa }}"  target="_blank" class="f_twitter"><i class="fab fa-whatsapp"
                                        title="Whatsaap"></i></a></li>
                            <li><a href="{{ $set->ig }}" target="_blank" class="f_instagram"><i
                                        class="fab fa-instagram" title="Instagram"></i></a></li>
                        </ul>
                    </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="single_footer single_footer_top">
                        <h4>Menu</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Beranda</a></li>
                            <li><a href="{{ url('laporan/form') }}">Buat Laporan</a></li>
                            <li><a href="{{ url('laporan/status') }}">Status Laporan</a></li>
                            <li><a href="{{ url('informasi') }}">Informasi</a></li>
                            <li><a href="{{ url('kontak') }}">Kontak</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="footer_copyright">
                        <p>&copy; {{ date("Y") }} LLDikti Wilayah III copyright all right reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mixitup.js') }}"></script>
    <script src="{{ asset('js/venobox.min.js') }}"></script>
    <script src="{{ asset('js/ripples-min.js') }}"></script>
    <script src="{{ asset('js/jquery.inview.min.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('js/scrolltopcontrol.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>

</html>
