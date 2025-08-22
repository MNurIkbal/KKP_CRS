<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
        }

        .header {
            text-align: center;
            padding: 10px 0;
            background-color: #007bff;
            color: #fff;
            border-radius: 8px;
        }

        .content {
            padding: 20px;
            font-size: 16px;
            line-height: 1.5;
            color: #333;
        }

        .button {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 30px;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Reset Your Password</h1>
        </div>

        <div class="content">
            <p>Halo {{ $nama }},</p>
            <p>Kami menerima permintaan untuk mereset kata sandi Anda. Untuk mereset kata sandi, klik tombol di bawah ini:</p>
            
            <a href="{{ $link }}" class="button" style="color: white">Reset Kata Sandi</a>
        
            <p>Jika Anda tidak meminta untuk mereset kata sandi, Anda tidak perlu melakukan tindakan lebih lanjut.</p>
        </div>
        
        <div class="footer">
            <p>Terima Kasih</p>
        </div>
    </div>
</body>
</html>
