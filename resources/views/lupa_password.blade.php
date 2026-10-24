<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <title>Lupa Password | CRS LLDIKTI Wilayah III</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/Logo-ADIA.png') }}">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body, button, input, h1, h2, h3, h4, h5, h6, p, a, span {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            min-height: 100vh;
            background: radial-gradient(circle at 10% 20%, #0f172a 0%, #1e1b4b 50%, #090d16 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 16px;
            position: relative;
            overflow-x: hidden;
            color: #1e293b;
        }

        .ambient-glow-1 {
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.25) 0%, rgba(99, 102, 241, 0) 70%);
            top: -120px;
            left: -120px;
            pointer-events: none;
            filter: blur(40px);
        }

        .ambient-glow-2 {
            position: absolute;
            width: 450px;
            height: 450px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.22) 0%, rgba(168, 85, 247, 0) 70%);
            bottom: -100px;
            right: -100px;
            pointer-events: none;
            filter: blur(40px);
        }

        .card-custom {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 28px;
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.45),
                        0 0 0 1px rgba(255, 255, 255, 0.2);
            width: 100%;
            max-width: 460px;
            padding: 40px 34px;
            position: relative;
            z-index: 10;
        }

        .brand-header {
            text-align: center;
            margin-bottom: 26px;
        }

        .brand-logo-wrap {
            width: 72px;
            height: 72px;
            margin: 0 auto 14px;
            background: linear-gradient(135deg, #eef2ff 0%, #ede9fe 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 20px -4px rgba(99, 102, 241, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        .brand-logo-wrap img {
            max-height: 42px;
            object-fit: contain;
        }

        .brand-title {
            font-size: 22px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.5px;
            margin-bottom: 6px;
        }

        .brand-subtitle {
            font-size: 13.5px;
            color: #64748b;
            line-height: 1.5;
        }

        .input-group-custom {
            margin-bottom: 18px;
        }

        .input-group-custom label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 8px;
            letter-spacing: 0.2px;
        }

        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrap .input-icon {
            position: absolute;
            left: 16px;
            color: #94a3b8;
            font-size: 15px;
            pointer-events: none;
            transition: color 0.2s ease;
        }

        .form-control-custom {
            width: 100%;
            height: 50px;
            padding: 0 16px 0 46px;
            font-size: 14.5px;
            font-weight: 500;
            color: #0f172a;
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 14px;
            outline: none;
            transition: all 0.25s ease;
        }

        .form-control-custom:focus {
            background: #ffffff;
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
        }

        .form-control-custom:focus + .input-icon,
        .input-wrap:focus-within .input-icon {
            color: #6366f1;
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
            box-shadow: 0 14px 28px -4px rgba(79, 70, 229, 0.55);
        }

        .footer-links {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 24px;
            padding-top: 18px;
            border-top: 1px solid #e2e8f0;
            font-size: 13px;
        }

        .footer-link {
            color: #64748b;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
            display: inline-flex;
            align-items: center;
        }

        .footer-link:hover {
            color: #4f46e5;
        }
    </style>
</head>

<body>
    <div class="ambient-glow-1"></div>
    <div class="ambient-glow-2"></div>

    <div class="card-custom">
        <div class="brand-header">
            <div class="brand-logo-wrap">
                <img src="{{ asset('img/Logo-ADIA.png') }}" alt="Logo CRS">
            </div>
            <h1 class="brand-title">Lupa Kata Sandi?</h1>
            <p class="brand-subtitle">Masukkan alamat email terdaftar Anda untuk menerima tautan instruksi pemulihan kata sandi.</p>
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

        <form action="{{ url('kirim_email') }}" method="POST">
            @csrf

            <!-- Email -->
            <div class="input-group-custom">
                <label for="email">Alamat Email Terdaftar</label>
                <div class="input-wrap">
                    <i class="fas fa-envelope input-icon"></i>
                    <input class="form-control-custom" type="email" id="email" name="email"
                        required placeholder="nama@email.com" value="{{ old('email') }}" autofocus>
                </div>
            </div>

            <!-- Captcha -->
            <div class="captcha-card">
                <label class="d-block text-xs fw-semibold text-secondary mb-2" style="font-size: 12px;">Verifikasi Keamanan</label>
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
                <span>Kirim Link Reset Password</span>
                <i class="fas fa-paper-plane"></i>
            </button>

            <!-- Links -->
            <div class="footer-links">
                <a href="{{ route('login') }}" class="footer-link">
                    <i class="fas fa-chevron-left me-1"></i> Kembali ke Login
                </a>
                <a href="{{ url('/') }}" class="footer-link">
                    Beranda
                </a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
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
