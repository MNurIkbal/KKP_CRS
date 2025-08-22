@extends('web_version_2.layout')
@section('content')
    <section class="section-top"
        style="background-image: url({{ asset('img/promotion-bg.jpg') }});  background-size:cover; background-position: center center;">
        <div class="container">
            <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                <div class="section-top-title">
                    <h1>Status Pengiriman Laporan</h1>
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section>

    <div class="container mx-auto mt-5 max-w-md">
        <div class="single_service ss_one" style="background-color: #525FE1 !important">
            <div style="display: flex;justify-content: center">
                <div class="mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-green-500" viewBox="0 0 20 20"
                        fill="currentColor" style="color: rgb(0, 255, 0);width: 100px">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 10-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            <h1 class=" text-center font-bold text-white">Terima kasih telah melapor!</h1>
            <p class="text-gray-700 mb-2 text-center text-white">
                Kami telah mengirimkan ID Laporan melalui email ke:
                <br>
                <h5 class="font-bold text-center text-white">{{ maskEmail($email) }}</h5>
            </p>
            <p class="text-gray-500 text-sm text-center text-white">
                Pastikan untuk memeriksa folder spam jika email tidak muncul di kotak masuk utama Anda.
            </p>
            <br>
            <div class="d-flex" style="justify-content: center">
                <a href="{{ url('/') }}" id="" class="btn btn-lg btn-success" title="Kembali!">
                    Kembali</a>
            </div>
        </div>
    </div>
@endsection
