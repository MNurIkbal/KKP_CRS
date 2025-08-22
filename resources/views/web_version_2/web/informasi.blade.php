@extends('web_version_2.layout')
@section('content')
    <style>
        /* Atur gambar di dalam konten informasi */
        .as_box img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 10px auto;
            /* gambar berada di tengah dengan jarak atas-bawah */
            border-radius: 8px;
            /* opsional untuk sudut membulat */
        }
    </style>
    <section class="section-top"
        style="background-image: url({{ asset('img/promotion-bg.jpg') }});  background-size:cover; background-position: center center;">
        <div class="container">
            <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                <div class="section-top-title">
                    <h1>Informasi </h1>
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section>
    <section class="feature section-padding">
        <div class="container">
            <div class="section-title text-center wow zoomIn">
                <h2>Papan Informasi CRS Satgas PPKPT LLDIKTI wilayah III</h2>
            </div>
            <div class="row">
                <div class="as_box p-3">
                    {!! $set->informasi !!}
                </div>
            </div>
        </div>
    </section>
    <section class="feature section-padding">
        <div class="container">
            <div class="section-title text-center wow zoomIn">
                <h2>Proses Membuat Laporan</h2>
                <p>Pelaporan tindak kekerasan dilakukan melalui tahapan yang sistematis, mulai dari identifikasi kejadian
                    hingga penanganan oleh pihak berwenang.</p>
            </div>
            <h5 class="text-center">1.Proses Pelapor</h5>
            <div class="d-flex justify-content-center p-3">
                <div style="width: 100%; max-width: 600px;">
                    <img src="{{ asset('img/activity_1.png') }}" alt="Proses Membuat Laporan"
                        style="width: 100%; height: auto; object-fit: contain; display: block; margin: 0 auto;">
                </div>
            </div>
            <br>
            <h5 class="text-center">2.Proses Tindak Lanjut Laporan</h5>
            <div class="d-flex justify-content-center p-3">
                <div style="width: 100%; max-width: 600px;">
                    <img src="{{ asset('img/acitivty_2.png') }}" alt="Proses Membuat Laporan"
                        style="width: 100%; height: auto; object-fit: contain; display: block; margin: 0 auto;">
                </div>
            </div>
            <br>
            <h5 class="text-center">3.Proses Pemeriksaan</h5>
            <div class="d-flex justify-content-center p-3">
                <div style="width: 100%; max-width: 600px;">
                    <img src="{{ asset('img/activity_3.png') }}" alt="Proses Membuat Laporan"
                        style="width: 100%; height: auto; object-fit: contain; display: block; margin: 0 auto;">
                </div>
            </div>
            <br>
            <h5 class="text-center">4.Proses Penyusunan Kesimpulan dan Rekomendasi</h5>
            <div class="d-flex justify-content-center p-3">
                <div style="width: 100%; max-width: 600px;">
                    <img src="{{ asset('img/activity_4.png') }}" alt="Proses Membuat Laporan"
                        style="width: 100%; height: auto; object-fit: contain; display: block; margin: 0 auto;">
                </div>
            </div>
            <br>
            <h5 class="text-center">5.Proses Tindak Lanjut Kesimpulan dan Rekomendasi</h5>
            <div class="d-flex justify-content-center p-3">
                <div style="width: 100%; max-width: 600px;">
                    <img src="{{ asset('img/activity_5.png') }}" alt="Proses Membuat Laporan"
                        style="width: 100%; height: auto; object-fit: contain; display: block; margin: 0 auto;">
                </div>
            </div>
            <br>
        </div>
    </section>
@endsection
