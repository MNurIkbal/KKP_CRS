@extends('web_version_2.layout')
@section('content')
    <style>
        @media screen and (max-width:770px) {
            .takut {
                display: none;
            }

            .fontt {
                font-size: 40px !important;
            }
        }

        @media screen and (max-width:500px) {
            .fontt {
                font-size: 30px !important;
            }
        }

    </style>
    <!-- START HOME -->
    <section class="home_bg ripple"
        style="background-image: url({{ asset('img/Background-PUSAKA-2024.png') }});  background-size:cover; background-position: center center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                    <div class="hero-text">
                        <h1 class="fontt">Layanan Pengaduan CRS Satgas PPKPT LLDIKTI wilayah III</h1>
                        <p class="takut">Di CRS Satgas PPKPT LLDIKTI wilayah III,kami menyediakan saluran pengaduan yang
                            aman dan cepat
                            untuk memastikan perlindungan dan kesejahteraan semua pihak.</p>
                        <a href="{{ url('laporan/form') }}" class="page-scroll btn btn-default btn_one">Buat Laporan</a>
                    </div>
                </div><!--- END COL -->
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END  HOME -->

    <!-- START ABOUT FEATURE CONTENT -->
    <section class="feature section-padding">
        <div class="container">
            <div class="section-title text-center wow zoomIn">
                <h2>Kami Hadir untuk Mendukung dan Melindungi Korban Kekerasan.</h2>
                <p>Setiap suara berharga. Kami hadir untuk memberikan ruang aman bagi siapa pun yang menjadi korban
                    kekerasan, pelecehan, dan diskriminasi. Laporkan sekarang, kami siap membantu proses perlindungan Anda.
                </p>
            </div>
            <div class="row as_box">
                <div class="col-lg-3 col-sm-6 col-xs-12 no-padding">
                    <div class="about_single wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.1s"
                        data-wow-offset="0">
                        <img src="{{ asset('img/shield.jpg') }}" alt="" style="width: 100px;height: 100px;" />
                        <h4> Aman dan Rahasia</h4>
                        <p>Laporan Anda dijaga dengan ketat dan tidak akan disebarkan tanpa persetujuan Anda.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12 no-padding">
                    <div class="about_single wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.1s"
                        data-wow-offset="0">
                        <img src="{{ asset('img/sikolog.jpg') }}" alt="" style="width: 100px;height: 100px;" />
                        <h4>Dukungan Psikologis</h4>
                        <p>Kami menyediakan layanan konseling gratis dari tenaga profesional untuk membantu pemulihan
                            trauma.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12 no-padding">
                    <div class="about_single wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.1s"
                        data-wow-offset="0">
                        <img src="{{ asset('img/hukum.jpg') }}" alt="" style="width: 100px;height: 100px;" />
                        <h4>Akses Hukum Cepat</h4>
                        <p>Tim hukum kami siap membantu Anda mengurus laporan dan perlindungan hukum dengan cepat.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12 no-padding">
                    <div class="about_single wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.1s"
                        data-wow-offset="0">
                        <img src="{{ asset('img/suport.jpg') }}" alt="" style="width: 100px;height: 100px;" />
                        <h4>24/7 Support</h4>
                        <p>Kami siap mendengarkan dan membantu Anda kapan saja, termasuk di luar jam kerja.</p>
                    </div>
                </div>
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END ABOUT FEATURE CONTENT -->


    <!--START SERVICE -->
    <div id="service" class="best-service section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="section-title-white">Layanan Kami</h2>
                        <p class="section-title-white">Laporkan kekerasan dan diskriminasi melalui platform kami yang
                            menjamin keamanan, kerahasiaan, dan respons cepat.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6 col-xs-12">
                    <div class="single_service ss_one">
                        <img src="{{ asset('img/lap.png') }}" alt="" style="width: 100px;height: auto;" />
                        <h3>Buat Laporan</h3>
                        <p>Ceritakan keluhanmu dengan jelas agar kami bisa segera membantu!</p>
                    </div>
                </div><!--END COL -->
                <div class="col-lg-4 col-sm-6 col-xs-12">
                    <div class="single_service ss_two">
                        <img src="{{ asset('img/sucre.jpg') }}" alt="" style="width: 100px;height: auto;" />
                        <h3>Laporan Terenkripsi</h3>
                        <p>Laporanmu aman. Data terenkripsi dari awal hingga akhir.</p>
                    </div>
                </div><!--END COL -->
                <div class="col-lg-4 col-sm-6 col-xs-12">
                    <div class="single_service ss_three">
                        <img src="{{ asset('img/stas.jpg') }}" alt="" style="width: 100px;height: auto;" />
                        <h3>Pantau Status</h3>
                        <p>Cek status laporanmu kapan saja dengan mudah.</p>
                    </div>
                </div><!--END COL -->
                <div class="col-lg-4 col-sm-6 col-xs-12">
                    <div class="single_service ss_four">
                        <img src="{{ asset('img/not.png') }}" alt="" style="width: 100px;height: auto;" />
                        <h3>Notifikasi Update</h3>
                        <p>Kami akan beri tahu setiap perkembangan terbaru laporanmu.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-xs-12">
                    <div class="single_service ss_five">
                        <img src="{{ asset('img/private.jpg') }}" alt="" style="width: 100px;height: auto;" />
                        <h3>Privasi Terjamin</h3>
                        <p>Privasi dan keamanan datamu adalah prioritas kami.</p>
                    </div>
                </div><!--END COL -->
                <div class="col-lg-4 col-sm-6 col-xs-12">
                    <div class="single_service ss_six">
                        <img src="{{ asset('img/feedback.jpg') }}" alt="" style="width: 100px;height: auto;" />
                        <h3>Feedback</h3>
                        <p>Berikan saran dan masukanmu untuk membantu kami menjadi lebih baik!</p>
                    </div>
                </div><!--END COL -->
            </div><!--END ROW -->
        </div><!--END CONTAINER -->
    </div>
    <!--END SERVICE -->

    <!-- START PROCESS -->


    <section class="process_area section-padding">
        <div class="container">
            <div class="section-title text-center">
                <h2>Proses Membuat Laporan</h2>
                <p>Pelaporan tindak kekerasan dilakukan melalui tahapan yang sistematis, mulai dari identifikasi kejadian
                    hingga penanganan oleh pihak berwenang.</p>
            </div>
            <div style="width: 100%;height: 600px;">
                <img src="{{ asset('img/activity_1.png') }}" alt="" style="width: 100%;height: 100%;object-fit: contain">
                
            </div>
            <br>
            <div style="display: flex;justify-content: center">
                <a class=" btn-lg contact_btn text-white" href="{{ url('informasi') }}" >Selengkapnya</a>
            </div>

        </div><!-- END CONTAINER -->
    </section>
    <!-- END PROCESS -->

    <!-- START HOME -->
    <section data-stellar-background-ratio="0.3" class="counter_area counter_feature">
        <div class="container">
            <div class="section-title text-center">
                <h2 class="text-white">Status Laporan</h2>
            </div>
            <div class="row text-center">
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="single-project single-project-three">
                        <span class="fas fa-clipboard-list"></span>
                        <h2 class="counter-num">{{ number_format($semua, 0) }}</h2>
                        <h4>Semua Laporan</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="single-project single-project-two">
                        <span class="fas fa-list-check"></span>
                        <h2 class="counter-num">{{ number_format($proses, 0) }}</h2>
                        <h4>Laporan Diproses</h4>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="single-project single-project-one">
                        <span class="fas fa-clipboard-check"></span>
                        <h2 class="counter-num">{{ number_format($selesai, 0) }}</h2>
                        <h4>Laporan Selesai</h4>
                    </div>
                </div><!-- END COL -->
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="single-project single-project-four">
                        <span class="fas fa-circle-xmark"></span>
                        <h2 class="counter-num">{{ number_format($ditolak, 0) }}</h2>
                        <h4>Laporan Ditolak</h4>
                    </div>
                </div><!-- END COL -->
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END  HOME DESIGN -->


    <!-- START COMPANY PARTNER LOGO  -->
    <div class="partner-logo section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="partner_title">
                        <h3>Kerja Sama</h3>
                    </div>
                    <div class="partner">
                        <a><img src="{{ asset('img/logoUBL.png') }}" alt="image"
                                style="width: 200px;height: 200px;object-fit: contain"></a>
                        <a><img src="{{ asset('img/pt_katolik_indo_atma.png') }}" alt="image"
                                style="width: 200px;height: 200px;object-fit: contain"></a>
                        <a><img src="{{ asset('img/pt_bayangkara_jakarta.png') }}" alt="image"
                                style="width: 200px;height: 200px;object-fit: contain"></a>
                        <a><img src="{{ asset('img/Yayasan-LIA.png') }}" alt="image"
                                style="width: 200px;height: 200px;object-fit: contain"></a>
                        <a><img src="{{ asset('img/YAI.png') }}" alt="image" style="width: 200px;height: 200px;object-fit: contain"></a>
                        <a><img src="{{ asset('img/Logo_Universitas_Pancasila.png') }}" alt="image" style="width: 200px;height: 200px;object-fit: contain"></a>
                        <a><img src="{{ asset('img/cropped-Lambang_Universitas_YARSI.jpg') }}" alt="image" style="width: 200px;height: 200px;object-fit: contain"></a>
                        <a><img src="{{ asset('img/UKI_LOGO.svg.png') }}" alt="image" style="width: 200px;height: 200px;object-fit: contain"></a>
                        <a><img src="{{ asset('img/Universitas_Nasional_Logo.png') }}" alt="image" style="width: 200px;height: 200px;object-fit: contain"></a>
                        <a><img src="{{ asset('img/Lambang_Resmi_UMJ.png') }}" alt="image" style="width: 200px;height: 200px;object-fit: contain"></a>
                        <a><img src="{{ asset('img/Logo-Universitas-Trisakti.png') }}" alt="image" style="width: 200px;height: 200px;object-fit: contain"></a>
                        <a><img src="{{ asset('img/multi_nusantara.png') }}" alt="image" style="width: 200px;height: 200px;object-fit: contain"></a>
                        <a><img src="{{ asset('img/Logo_Binus_University.png') }}" alt="image" style="width: 200px;height: 200px;object-fit: contain"></a>
                        <a><img src="{{ asset('img/Unbor.png') }}" alt="image" style="width: 200px;height: 200px;object-fit: contain"></a>
                        <a><img src="{{ asset('img/sumber_waras.png') }}" alt="image" style="width: 200px;height: 200px;object-fit: contain"></a>
                        <a><img src="{{ asset('img/gatot_subroto.png') }}" alt="image" style="width: 200px;height: 200px;object-fit: contain"></a>
                        <a><img src="{{ asset('img/44.png') }}" alt="image" style="width: 200px;height: 200px;object-fit: contain"></a>
                        <a><img src="{{ asset('img/gunadarma.png') }}" alt="image" style="width: 200px;height: 200px;object-fit: contain"></a>
                        <a><img src="{{ asset('img/said.png') }}" alt="image" style="width: 200px;height: 200px;object-fit: contain"></a>
                    </div>
                </div><!-- END COL  -->
            </div><!--END  ROW  -->
        </div><!-- END CONTAINER  -->
    </div>
    <!-- END COMPANY PARTNER LOGO -->
@endsection
