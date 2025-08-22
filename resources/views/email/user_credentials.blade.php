<!DOCTYPE html>
<html>
<head>
    <title>Akun Baru Anda</title>
</head>
<body>
    <h1>Selamat Datang di Sistem Kami</h1>
    <p>Berikut adalah informasi akun Anda:</p>
    <ul>
        <li>Username: {{ $username }}</li>
        <li>Password: {{ $password }}</li>
    </ul>

    <p>Silakan Login melalui halaman admin di <a href="{{route('login')}}">sini</a>
</body>
</html>
