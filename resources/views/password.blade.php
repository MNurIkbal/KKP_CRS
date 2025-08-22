<!doctype html>

<html lang="en">

<head>

    <meta charset="utf-8" />

    <title>Password Baru</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- App favicon -->

    <link rel="shortcut icon" href="{{ asset('admin/images/favicon.ico') }}">



    <!-- Bootstrap Css -->

    <link href="{{ asset('admin/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />

    <!-- Icons Css -->

    <link href="{{ asset('admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App Css-->

    <link href="{{ asset('admin/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />



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

                        <form class="form-horizontal mt-3" action="{{ url('reset') }}" method="post">

                            @method("PUT")
                            {{ csrf_field() }}
                            <input type="hidden" name="email" value="{{ $email }}">

                            <div class="form-group">
                                <label for="input-placeholder">Password
                                    <span class="ms-2" data-bs-toggle="tooltip" data-bs-placement="right"
                                        title="(Minimal 8 karakter dan harus gabungan huruf besar, huruf kecil, angka, simbol)">
                                        <i class="fas fa-question-circle"></i></span>
                                    <code></code></label>
                                <input required type="password" name="password" class="form-control"
                                    placeholder="***********" id="pass1">
                                <div id="password-strength-status"></div> <!-- Di sini meteran akan muncul -->
                                    @error('password')
                                        <small>{{ $message }}</small>
                                    @enderror
                            </div>
                            <div class="form-group mb-3 row">

                                <div class="col-12">
                                    <label for="" class="form-label">Ulangi Password Baru</label>
                                    <input class="form-control" type="password" required=""
                                        placeholder="Ulangi Password Baru" name="password_new">
                                </div>

                            </div>


                            <div class="form-group mb-3 text-center row mt-3 pt-1">

                                <div class="col-12">

                                    <button class="btn btn-info w-100 waves-effect waves-light"
                                        type="submit">Simpan</button>

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



    <!-- JAVASCRIPT -->

    <script src="{{ asset('admin/libs/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('admin/libs/metismenu/metisMenu.min.js') }}"></script>

    <script src="{{ asset('admin/libs/simplebar/simplebar.min.js') }}"></script>

    <script src="{{ asset('admin/libs/node-waves/waves.min.js') }}"></script>



    <script src="{{ asset('admin/js/app.js') }}"></script>

</body>

</html>
