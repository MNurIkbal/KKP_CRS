<!DOCTYPE html>

<html>

<head>

    <title>Layanan Pengaduan CRS Satgas PPKPT LLDIKTI wilayah III</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div
        style="font-family: Arial, sans-serif; line-height: 1.8; color: rgb(51, 51, 51); background-color: rgb(244, 244, 244); padding: 40px;">
        <div class="adM">

        </div>
        <div
            style="max-width: 650px; margin: auto; border-radius: 10px; background-color: rgb(255, 255, 255); padding: 30px;">
            <div class="adM">

            </div>
            <div style="text-align: center; margin-bottom: 30px;">
                <div class="adM">

                </div>

                <h2
                    style="color: #525FE1; font-size: 20px; margin-top: 0px; margin-bottom: 5px; line-height: 1.2;">
                    Layanan Pengaduan<br><span class="il">CRS Satgas PPKPT LLDIKTI wilayah III</span></h2>

            </div>

            <p style="font-size: 16px;">Halo Sobat, <span
                    style="font-weight: bold; color:#525FE1">{{ $nama }}</span></p>

            <p style="font-size: 16px;">Terima Kasih Telah Melapor Kepada Kami. Berikut Info Tentang Laporan Anda:</p>

            <div
                style="background-color: rgb(250, 250, 250); border-left: 4px solid #525FE1; padding: 20px; border-radius: 16px;">

                <div>

                    <p style="font-size: 16px;">

                        Nama Pelapor: <strong>{{ $nama }}</strong> <br>

                        Kode Laporan: <strong>{{ $id }}</strong>

                    </p>

                </div>



            </div>

            <div>

                <p style="font-size: 16px; text-align: center;">

                    Status Laporan:<br><strong style="color:#525FE1; border-radius: 16px; padding: 12px 24px;">Diterima</strong>
                </p>

            </div>

            <div style="text-align: center; margin-top: 30px;">

                <a href="{{ route('status') }}"
                    style="background-color: #525FE1; color: white; padding: 12px 36px; text-decoration: none; border-radius: 50px; font-size: 16px; display: inline-block; width: auto; text-align: center; font-weight: bold;"
                    target="_blank">
                    Cek Status Anda
                </a>
            </div>
            <p style="font-size: 16px; margin-bottom: 20px;">Kami sangat senang Anda telah memberitahu kami. Di sini, kami berkomitmen untuk membantu berbagai program dan kegiatan yang mendukung pemberdayaan masyarakat.</p>
            <p style="font-size: 16px; margin-bottom: 20px;">Jika Anda memiliki pertanyaan atau membutuhkan bantuan,
                jangan ragu untuk menghubungi kami di <a href="mailto:{{ $pengaturan->email }}"
                    style="color: #525FE1; text-decoration: none;" target="_blank">
                {{ $pengaturan->email }}
                </a> atau <a href="https://wa.me/{{ $pengaturan->no_wa }}"
                    style="color: #525FE1; text-decoration: none;" target="_blank">{{ $pengaturan->no_wa }}</a>.</p>
            <p style="font-size: 16px; margin-bottom: 20px;">Jangan lupa untuk mengunjungi <a
                    href="https://crs-lldikti3.kemdikbud.go.id/" style="color: #525FE1; text-decoration: none;"
                    target="_blank">website
                    kami</a> untuk informasi lebih lanjut.</p>
            <p style="margin-top: 30px; text-align: center; font-size: 16px;">Salam hangat,<br><span
                    style="font-weight: bold; color: #525FE1;">Tim <span class="il">LLDIKTI </span> Wilayah
                    III</span></p>
            
        </div>
    </div>

</body>

</html>
