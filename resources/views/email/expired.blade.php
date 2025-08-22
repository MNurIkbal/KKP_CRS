<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Layanan Pengaduan CRS Satgas PPKPT LLDIKTI wilayah III</title>

</head>

<body>

    <div style="font-family:Arial,sans-serif;line-height:1.8;color:#333;background-color:#f4f4f4;padding:40px">
        <div class="adM">

        </div>
        <div style="max-width:650px;margin:auto;border-radius:12px;background-color:#fff;padding:30px">
            <div class="adM">
                
            </div>
            <div style="text-align:center;margin-bottom:30px">
                <h2 style="color:#525FE1;font-size:24px;margin-top:0;margin-bottom:10px;line-height:1.4">Layanan
                    Pengaduan<br> CRS Satgas PPKPT LLDIKTI wilayah III
                </h2>

            </div>

            <p style="font-size:16px;margin-bottom:20px">Halo Sobat, <span
                    style="font-weight:bold;color:#525FE1">{{ Illuminate\Support\Facades\Crypt::decryptString($laporan->nama) }}</span></p>

            <p style="font-size:16px;margin-bottom:20px">Status <span class="il">laporan</span> Anda telah
                diperbarui. Berikut adalah informasi terbaru:</p>

            <div style="background-color:#fafafa;padding:20px;border-radius:12px;margin-bottom:30px">

                <div style="margin-bottom:16px">

                    <p style="font-size:16px;text-align:center;margin:0">

                        Status <span class="il">Laporan</span>:<br>

                        <span
                            style="color:#525FE1"><strong>{{ Illuminate\Support\Facades\Crypt::decryptString($log->status_laporan) }}</strong></span>

                    </p>

                </div>

                <div>

                    <p style="font-size:16px;text-align:center;margin:0">

                        Deskripsi <span class="il">Laporan</span>:<br>

                        <strong><span
                                class="il">{!! Illuminate\Support\Facades\Crypt::decryptString($log->deskripsi_laporan) !!}</strong>

                    </p>

                    <b>
                        <h2 style="color: red;">Proses Penanganan Laporan Ini Sudah Melampaui Batas Mohon Untuk Di Proses Segara</h2>
                    </b>

                </div>

                <div>

                    <p style="font-size:16px;text-align:center;margin:0">

                        Tanggal <span class="il">Batas Proses</span>:<br>

                        <strong><span class="il">
                                @if ($log->tgl_batas_proses)
                                    {{ date('d, F Y', strtotime($log->tgl_batas_proses)) }}
                                @endif
                        </strong>

                    </p>

                </div>

            </div>

            <div style="text-align:center;margin-top:30px">

                <a href="{{ url('laporan/status') }}"
                    style="background-color:#525FE1;color:white;padding:12px 36px;text-decoration:none;border-radius:50px;font-size:16px;display:inline-block;width:auto;text-align:center;font-weight:bold"
                    target="_blank">

                    Cek Status Anda

                </a>

            </div>

            <p style="font-size:16px;margin-top:40px;margin-bottom:20px">Jika Anda memiliki pertanyaan atau membutuhkan
                bantuan, jangan ragu untuk menghubungi kami di <a href="mailto:{{ $pengaturan->email }}"
                    style="color:#525FE1;text-decoration:none"
                    target="_blank">{{ $pengaturan->email }}</a> atau <a
                    href="https://wa.me/{{ $pengaturan->no_wa }}" style="color:#525FE1;text-decoration:none" target="_blank"
                    data-saferedirecturl="https://www.google.com/url?q=https://wa.me/{{ $pengaturan->no_wa }}&amp;source=gmail&amp;ust=1739324124095000&amp;usg=AOvVaw0P5IRGg-yMCDNTM4kiYLbr">nomor
                    telepon</a>.</p>

            <p style="margin-top:30px;text-align:center;font-size:16px">Salam hangat,<br><span
                    style="font-weight:bold;color:#525FE1">Tim LLDIKTI Wilayah III</span></p>

        </div>
        
    </div>

</body>

</html>
