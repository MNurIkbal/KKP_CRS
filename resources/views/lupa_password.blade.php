<!doctype html>

<html lang="en">

<head>

    <meta charset="utf-8" />

    <title>Lupa Password</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- App favicon -->

    <link rel="icon" href="{{ asset('img/Logo-ADIA.png') }}">



    <!-- Bootstrap Css -->

    <link href="{{ asset('admin/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />

    <!-- Icons Css -->

    <link href="{{ asset('admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App Css-->

    <link href="{{ asset('admin/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>



<body class="auth-body-bg">

    <div class=""></div>

    <div class="wrapper-page">

        <div class="container-fluid p-0">

            <div class="card">

                <div class="card-body">

                    <div class="text-center mt-4">

                        <div class="mb-3">

                            <a href="{{ url('/login') }}" class="auth-logo">

                                <img src="{{ asset('img/Logo-ADIA.png') }}" height="100" class="logo-dark mx-auto"
                                    alt="">

                                <img src="{{ asset('img/Logo-ADIA.png') }}" height="100" class="logo-light mx-auto"
                                    alt="">

                            </a>

                        </div>

                    </div>



                    <h4 class="text-muted text-center font-size-18"><b>Lupa Password</b></h4>

                    {{-- Error Alert --}}

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">

                            {{ session('error') }}

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                <span aria-hidden="true">&times;</span>

                            </button>

                        </div>
                    @endif



                    <div class="p-3">

                        @if ($errors->any())

                            <div class="alert alert-danger alert-dismissible fade show border-0 mb-4" role="alert">
                                <ul>
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

                        @if (session()->get('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif

                        <form class="form-horizontal mt-3" action="{{ url('kirim_email') }}" method="post">

                            {{ csrf_field() }}

                            <div class="form-group mb-3 row">

                                <div class="col-12">
                                    <label for="" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input class="form-control" type="email" required="" placeholder="Email..."
                                        name="email" value="{{ old('email') }}">

                                </div>

                            </div>



                            <div class="form-group ">
                                <div class="col-12">
                                    <span id="captcha-img">
                                        {!! captcha_img('math') !!}
                                    </span>
                                    <br>
                                    <br>
                                    <button type="button" class="btn btn-secondary btn-sm" id="refresh-captcha"
                                        title="Refresh Captcha">
                                        <i class="fas fa-refresh"></i>
                                    </button>
                                    <input type="text"
                                        class="form-control mt-3 @error('captcha')
                            is-invalid
                        @enderror"
                                        name="captcha" placeholder="Masukan Captcha" required>
                                    @error('captcha')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>





                            <div class="form-group mb-3 text-center row mt-3 pt-1">

                                <div class="col-12">

                                    <button class="btn btn-info w-100 waves-effect waves-light"
                                        type="submit">Kirim</button>

                                </div>

                            </div>
                        </form>

                    </div>

                    <!-- end -->

                </div>

                <!-- end cardbody -->

            </div>

            <!-- end card -->

        </div>

        <!-- end container -->

    </div>

    <!-- end -->


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

    <!-- JAVASCRIPT -->

    <script src="{{ asset('admin/libs/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('admin/libs/metismenu/metisMenu.min.js') }}"></script>

    <script src="{{ asset('admin/libs/simplebar/simplebar.min.js') }}"></script>

    <script src="{{ asset('admin/libs/node-waves/waves.min.js') }}"></script>



    <script src="{{ asset('admin/js/app.js') }}"></script>



</body>

</html>
