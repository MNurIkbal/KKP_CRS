<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <title>Atur Password Baru | CRS LLDIKTI Wilayah III</title>
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
            padding: 0 46px 0 46px;
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

        .password-toggle {
            position: absolute;
            right: 14px;
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 4px 6px;
            font-size: 14px;
        }

        .password-toggle:hover {
            color: #475569;
        }

        .password-hint {
            font-size: 11.5px;
            color: #64748b;
            margin-top: 6px;
            line-height: 1.4;
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
            margin-top: 24px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px -4px rgba(79, 70, 229, 0.55);
        }

        .footer-links {
            display: flex;
            align-items: center;
            justify-content: center;
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
            <h1 class="brand-title">Atur Kata Sandi Baru</h1>
            <p class="brand-subtitle">Masukkan kata sandi baru untuk akun Anda ({{ $email }}).</p>
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

        <form action="{{ url('reset') }}" method="POST">
            @method('PUT')
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">

            <!-- Password Baru -->
            <div class="input-group-custom">
                <label for="pass1">Kata Sandi Baru</label>
                <div class="input-wrap">
                    <i class="fas fa-lock input-icon"></i>
                    <input id="pass1" class="form-control-custom" type="password" name="password"
                        required placeholder="Minimal 8 karakter">
                    <button type="button" class="password-toggle" onclick="togglePass('pass1', 'eyeIcon1')" title="Lihat password">
                        <i class="fa fa-eye" id="eyeIcon1"></i>
                    </button>
                </div>
                <div class="password-hint">
                    <i class="fas fa-circle-info me-1 text-primary"></i> Minimal 8 karakter, wajib kombinasi huruf besar, huruf kecil, angka, dan simbol.
                </div>
            </div>

            <!-- Ulangi Password Baru -->
            <div class="input-group-custom">
                <label for="pass2">Ulangi Kata Sandi Baru</label>
                <div class="input-wrap">
                    <i class="fas fa-lock input-icon"></i>
                    <input id="pass2" class="form-control-custom" type="password" name="password_new"
                        required placeholder="Ulangi kata sandi baru">
                    <button type="button" class="password-toggle" onclick="togglePass('pass2', 'eyeIcon2')" title="Lihat password">
                        <i class="fa fa-eye" id="eyeIcon2"></i>
                    </button>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-submit">
                <span>Simpan Kata Sandi Baru</span>
                <i class="fas fa-check"></i>
            </button>

            <!-- Links -->
            <div class="footer-links">
                <a href="{{ route('login') }}" class="footer-link">
                    <i class="fas fa-chevron-left me-1"></i> Batal & Kembali ke Login
                </a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function togglePass(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
</body>

</html>
