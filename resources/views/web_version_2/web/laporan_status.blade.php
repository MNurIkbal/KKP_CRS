@extends('web_version_2.layout')

@section('content')
    <section class="section-top"
        style="background-image: url({{ asset('img/promotion-bg.jpg') }});  background-size:cover; background-position: center center;">
        <div class="container">
            <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                <div class="section-top-title">
                    <h1>Check Status Laporan</h1>
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section>
    <section class="feature section-padding">

        <form action="{{ route('cekstatus') }}" method="GET" enctype="multipart/form-data">
            @csrf
            <div class="section-title text-center wow zoomIn">
                <h2>Status Laporan</h2>
            </div>
            @if ($errors->any())
                <div class="container">
                    <div class="alert alert-danger">
                        <ul class="list-disc pl-5">
    
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            @endif
            <div class="container">
                @if (session('error'))
                    <div class="alert alert-danger" >
                        {{ session('error') }}

                    </div>
                @endif
            </div>
            <div class="container as_box">
                <div class="form-group m-5" style="padding-top: 40px !important;">
                    <label for="text-field" class="form-label">ID Laporan <span class="text-danger">*</span>
                    </label>
                    <input
                        class="form-control @error('id')
                                        is-invalid
                                    @enderror"
                        type="text" name="id" placeholder="Masukkan ID Laporan" required="">

                    @error('id')
                        <p class="text-danger text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group m-4 row">
                    <div class="col-12">
                        <span id="captcha-img" style="display:inline-block; transform: scale(2); transform-origin: left;">
                            {!! captcha_img('math') !!}
                        </span>
                        <br>
                        <br>
                        <button type="button" class="btn btn-secondary btn-sm" id="refresh-captcha"
                            title="Refresh Captcha">
                            <i class="fa fa-refresh"></i>
                        </button>
                        <div class="form-group mt-3">
                            <label for="">Kode Captcha <span class="text-red-500">*</span></label>
                            <input type="text"
                                class="form-control w-50 @error('captcha')
                                is-invalid
                            @enderror"
                                name="captcha" placeholder="Masukan Captcha" required>
                            @error('captcha')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="py-6 p-4 font-medium text-gray-900">
                    <div class="d-flex" style="justify-content: end">
                        <button type="submit" id="submitButton" class="btn w-100 btn-lg contact_btn" title="Kirim!">Check
                            Laporan</button>
                    </div>
                </div>
            </div><!--- END CONTAINER -->
        </form>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#refresh-captcha').click(function() {
            $.ajax({
                type: 'GET',
                url: "{{ url('capcha') }}",
                success: function(data) {
                    $('#captcha-img').html(data.captcha);
                }
            });
        });
    </script>
@endsection
