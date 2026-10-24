<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <title>Masuk ke Akun | CRS Satgas PPKPT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- App favicon -->
    <link rel="icon" href="{{ asset('img/Logo-ADIA.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap & Icons -->
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #3730a3;
            --secondary: #7c3aed;
            --accent: #06b6d4;
            --dark: #0f172a;
        }

        * {
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            min-height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #0b1120 0%, #1e1b4b 50%, #0f172a 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            position: relative;
            overflow-x: hidden;
        }

        /* Ambient Glow & Shapes */
        .ambient-glow-1 {
            position: absolute;
            width: 450px;
            height: 450px;
            top: -100px;
            left: -100px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.28) 0%, rgba(99, 102, 241, 0) 70%);
            border-radius: 50%;
            filter: blur(40px);
            pointer-events: none;
            animation: pulseGlow 8s ease-in-out infinite alternate;
        }

        .ambient-glow-2 {
            position: absolute;
            width: 500px;
            height: 500px;
            bottom: -120px;
            right: -120px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.25) 0%, rgba(168, 85, 247, 0) 70%);
            border-radius: 50%;
            filter: blur(50px);
            pointer-events: none;
            animation: pulseGlow 10s ease-in-out infinite alternate-reverse;
        }

        @keyframes pulseGlow {
            0% { transform: scale(1) translate(0, 0); opacity: 0.6; }
            100% { transform: scale(1.15) translate(20px, 30px); opacity: 0.9; }
        }

        .login-card {
            width: 100%;
            max-width: 460px;
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 28px;
            padding: 40px 36px;
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(255, 255, 255, 0.4);
            position: relative;
            z-index: 10;
            transition: transform 0.3s ease;
        }

        .brand-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .brand-logo-wrap {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 80px;
            background: #ffffff;
            border-radius: 22px;
            box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.25), 0 0 0 1px rgba(226, 232, 240, 0.8);
            margin-bottom: 16px;
            padding: 10px;
        }

        .brand-logo-wrap img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .brand-title {
            font-size: 24px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 6px;
            letter-spacing: -0.5px;
        }

        .brand-subtitle {
            font-size: 13.5px;
            color: #64748b;
            margin: 0;
            line-height: 1.5;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group-custom label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 7px;
        }

        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            color: #94a3b8;
            font-size: 15px;
            transition: color 0.2s ease;
            pointer-events: none;
            z-index: 5;
        }

        .form-control-custom {
            width: 100%;
            height: 50px;
            padding: 12px 16px 12px 46px;
            font-size: 14.5px;
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 14px;
            color: #0f172a;
            font-weight: 500;
            transition: all 0.25s ease;
            outline: none;
        }

        .form-control-custom:focus {
            background: #ffffff;
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
        }

        .form-control-custom:focus + .input-icon,
        .input-wrap:focus-within .input-icon {
            color: #4f46e5;
        }

        .password-toggle {
            position: absolute;
            right: 14px;
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 8px;
            font-size: 15px;
            transition: color 0.2s ease;
        }

        .password-toggle:hover {
            color: #475569;
        }

        /* Captcha Styling */
        .captcha-card {
            background: #f1f5f9;
            border: 1px dashed #cbd5e1;
            border-radius: 16px;
            padding: 14px 16px;
            margin-bottom: 22px;
        }

        .captcha-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .captcha-img-box {
            background: #ffffff;
            padding: 6px 14px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            display: inline-flex;
            align-items: center;
        }

        .refresh-btn {
            background: #e2e8f0;
            border: none;
            color: #475569;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .refresh-btn:hover {
            background: #cbd5e1;
            color: #0f172a;
            transform: rotate(90deg);
        }

        .btn-submit {
            width: 100%;
            height: 52px;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            border: none;
            border-radius: 14px;
            color: #ffffff;
            font-size: 15.5px;
            font-weight: 700;
            letter-spacing: 0.2px;
            cursor: pointer;
            box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.45);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 30px -5px rgba(79, 70, 229, 0.55);
            background: linear-gradient(135deg, #4338ca 0%, #6d28d9 100%);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .footer-links {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 22px;
            padding-top: 18px;
            border-top: 1px solid #f1f5f9;
            font-size: 13.5px;
        }

        .footer-link {
            color: #64748b;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .footer-link:hover {
            color: #4f46e5;
        }

        .badge-portal {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            background: #eef2ff;
            color: #4f46e5;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 12px;
        }
    </style>
</head>

<body>
    <div class="ambient-glow-1"></div>
    <div class="ambient-glow-2"></div>

    <div class="login-card">
        <div class="brand-header">
            <div class="brand-logo-wrap">
                <img src="{{ asset('img/Logo-ADIA.png') }}" alt="Logo CRS">
            </div>
            <h1 class="brand-title">Selamat Datang</h1>
            <p class="brand-subtitle">Silakan login untuk pelapor, admin perguruan tinggi, maupun superadmin</p>
        </div>

        {{-- Alerts --}}
        @if (session()->get('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-4 text-sm" role="alert">
                <i class="fas fa-circle-check me-2"></i> {{ session()->get('success') }}
            </div>
        @endif

        @if (session()->get('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-4 text-sm" role="alert">
                <i class="fas fa-triangle-exclamation me-2"></i> {{ session()->get('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show rounded-4 text-sm" role="alert">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('proses_login') }}" method="POST">
            @csrf

            <!-- Email -->
            <div class="input-group-custom">
                <label for="email">Alamat Email</label>
                <div class="input-wrap">
                    <i class="fas fa-envelope input-icon"></i>
                    <input class="form-control-custom" type="email" id="email" name="email"
                        required placeholder="nama@email.com" value="{{ old('email') }}" autofocus>
                </div>
            </div>

            <!-- Password -->
            <div class="input-group-custom">
                <label for="main_password">Kata Sandi</label>
                <div class="input-wrap">
                    <i class="fas fa-lock input-icon"></i>
                    <input id="main_password" class="form-control-custom" type="password" name="password"
                        required placeholder="Masukkan kata sandi">
                    <button type="button" class="password-toggle" onclick="toggleMainPassword()" title="Lihat password">
                        <i class="fa fa-eye" id="eyeIconMain"></i>
                    </button>
                </div>
            </div>

            <!-- Captcha -->
            <div class="captcha-card">
                <label class="d-block text-xs fw-semibold text-secondary mb-2">Verifikasi Keamanan</label>
                <div class="captcha-row">
                    <div class="captcha-img-box" id="captcha-img">
                        {!! captcha_img('math') !!}
                    </div>
                    <button type="button" class="refresh-btn" id="refresh-captcha" title="Muat ulang Captcha">
                        <i class="fas fa-rotate-right"></i>
                    </button>
                </div>
                <div class="input-wrap mt-2">
                    <i class="fas fa-calculator input-icon"></i>
                    <input type="number" class="form-control-custom" style="height: 44px; padding-left: 42px;"
                        name="captcha" placeholder="Hasil hitungan..." required>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-submit">
                <span>Masuk Sekarang</span>
                <i class="fas fa-arrow-right"></i>
            </button>

            <!-- Links -->
            <div class="text-center mt-3 pt-2">
                <span class="text-muted" style="font-size: 13px;">Belum punya akun pelapor? <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">Daftar Akun Baru</a></span>
            </div>

            <div class="footer-links">
                <a href="{{ url('/') }}" class="footer-link">
                    <i class="fas fa-chevron-left me-1"></i> Kembali ke Beranda
                </a>
                <a href="{{ url('lupa_password') }}" class="footer-link">
                    Lupa password?
                </a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function toggleMainPassword() {
            const passwordInput = document.getElementById("main_password");
            const eyeIcon = document.getElementById("eyeIconMain");

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

        $('#refresh-captcha').click(function() {
            const btn = $(this);
            btn.find('i').addClass('fa-spin');
            $.ajax({
                type: 'GET',
                url: "{{ url('capcha') }}",
                success: function(data) {
                    $('#captcha-img').html(data.captcha);
                    btn.find('i').removeClass('fa-spin');
                },
                error: function() {
                    btn.find('i').removeClass('fa-spin');
                }
            });
        });
    </script>
</body>

</html>
