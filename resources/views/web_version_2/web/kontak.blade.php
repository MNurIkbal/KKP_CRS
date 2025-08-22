@extends('web_version_2.layout')
@section('content')
    <section class="section-top"
        style="background-image: url({{ asset('img/promotion-bg.jpg') }});  background-size:cover; background-position: center center;">
        <div class="container">
            <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                <div class="section-top-title">
                    <h1>Kontak Kami </h1>
                </div><!-- //.HERO-TEXT -->
            </div><!--- END COL -->
        </div><!--- END CONTAINER -->
    </section>
    <div class="address section-padding">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-4 col-sm-6 col-xs-12">
                    <div class="single_address">
                        <div class="address_br"><span class="fas fa-phone"></span></div>
                        <h4>Whatsapp</h4>
                        <p>{{ $set->no_wa }}</p>
                    </div>
                </div><!--- END COL -->
                <div class="col-lg-4 col-sm-6 col-xs-12">
                    <div class="single_address">
                        <div class="address_br"><span class="fas fa-envelope"></span></div>
                        <h4>Email</h4>
                        <p>
                            {{ $set->email }}
                        </p>
                    </div>
                </div><!--- END COL -->
                <div class="col-lg-4 col-sm-6 col-xs-12">
                    <div class="single_address">
                        <div class="address_br"><span class="fas fa-location-dot"></span></div>
                        <h4>Alamat</h4>
                        <p>{{ $set->alamat }}</p>

                    </div>
                </div><!--- END COL -->
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </div>
    <section id="contact" class="contact_us section-padding">
        <div class="container">
            <div class="row contact_us_bg">
                <div class="col-lg-7 col-sm-12 col-xs-12">
                    <div class="contact">
                        <h4>Hubungi Kami</h4>
                        <p class="text-justify">Jika Anda memiliki pertanyaan, masukan, atau ingin melaporkan sesuatu,
                            jangan ragu untuk
                            menghubungi kami. Tim kami siap membantu Anda dengan cepat dan profesional.</p>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="list-disc pl-5">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session()->get('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        <form class="form" name="enq" method="POST" action="{{ url('kirim_kontak') }}"
                            onsubmit="return validation();">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">Nama <span class="text-red-500">*</span></label>
                                    <input type="text" name="nama"
                                        class="form-control @error('nama')
                                        is-invalid
                                    @enderror"
                                        placeholder="nama" value="{{ old('nama') }}" required="required">
                                    @error('nama')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Email <span class="text-red-500">*</span></label>
                                    <input type="email" name="email"
                                        class="form-control @error('email')
                                        is-invalid
                                    @enderror"
                                        placeholder="Email" required="required" value="{{ old('email') }}">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="">Subject <span class="text-red-500">*</span></label>
                                    <input type="text" name="subjek"
                                        class="form-control @error('subjek')
                                        is-invalid
                                    @enderror"
                                        placeholder="Subject" required="required" value="{{ old('subjek') }}">
                                    @error('subjek')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="">Pesan <span class="text-red-500">*</span></label>
                                    <textarea rows="6" name="pesan"
                                        class="form-control @error('pesan')
                                        is-invalid
                                    @enderror"
                                        placeholder="Pesan Anda..." required="required">{{ old('pesan') }}</textarea>
                                    @error('pesan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group m-4 ">
                                    <div class="col12">
                                        <span id="captcha-img"
                                            style="display:inline-block; transform: scale(2); transform-origin: left;">
                                            {!! captcha_img('math') !!}
                                        </span>
                                        <br>
                                        <br>
                                        <button type="button" class="btn btn-secondary w-25 btn-sm" id="refresh-captcha"
                                            title="Refresh Captcha">
                                            <i class="fa fa-refresh"></i>
                                        </button>
                                        <div class="form-group mt-4">
                                            <label for="">Kode Captcha <span class="text-red-500">*</span></label>
                                            <input type="text"
                                                class="form-control w-100 @error('captcha')
                                is-invalid
                            @enderror"
                                                name="captcha" placeholder="Masukan Captcha" required>
                                            @error('captcha')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" value="Send message" name="submit" id="submitButton"
                                        class="btn btn-lg contact_btn" title="Submit Your Message!">Kirim Pesan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- END COL  -->
                <div class="col-lg-5 col-sm-12 col-xs-12">
                    <div class="map">
                        {!! $set->maps !!}
                    </div>
                </div><!-- END COL  -->
            </div><!-- END ROW -->
        </div><!-- END CONTAINER -->
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
