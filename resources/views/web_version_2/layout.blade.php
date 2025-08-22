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
        display: none
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
    <div id="navigation" class="navbar-light bg-faded site-navigation " >
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <div class="site-logo">
                        <a class="navbar-logo" href="{{ url('/') }}"><img src="{{ asset('img/Logo-ADIA.png') }}"
                                alt=""></a>
                    </div>
                </div><!--- END Col -->
                <div class="col-lg-10 col-md-9 col-sm-8">
                    <div class="header_right">
                        <nav id="main-menu" class="ml-auto">
                            <ul>
                                <li  style="padding-top: 10px;"><a class="@if (request()->is('/'))
                                    text-primary
                                @endif" href="{{ url('/') }}">Beranda</a></li>
                                <li style="padding-top: 10px;"><a href="{{ url('laporan/form') }}" class="@if (request()->is('laporan/form') || request()->is('responselaporan'))
                                    text-primary
                                @endif">Buat Laporan</a>
                                </li>
                                <li style="padding-top: 10px;"><a  class="@if (request()->is('laporan/status') || request()->is('cekstatus/*') || request()->is('kirim_chat'))
                                    text-primary
                                @endif" href="{{ url('laporan/status') }}">Cek Status
                                        Laporan</a></li>
                                        
                                <li style="padding-top: 10px;"><a href="{{ url('informasi') }}"  class="@if (request()->is('informasi'))
                                    text-primary
                                @endif">Informasi</a></li>
                                <li style="padding-top: 10px;"><a target="_blank" href="{{ asset($set->manual_book) }}">Buku
                                        Panduan</a></li>
                                <li style="padding-top: 10px;"><a class="@if (request()->is('kontak'))
                                    text-primary
                                @endif" href="{{ url('kontak') }}">Kontak</a></li>
                                <li  ><a class=" text-white" style="background: #525fe1;padding: 10px;border-radius: 5px;padding-bottom: 15px" href="{{ url('login') }}" target="_blank">Login Satgas</a></li>
                            </ul>
                        </nav>
                        <div id="mobile_menu"></div>
                    </div>
                </div><!--- END COL -->
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
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
