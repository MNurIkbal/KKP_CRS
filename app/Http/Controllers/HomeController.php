<?php

namespace App\Http\Controllers;

use App\Mail\KirimEmail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Models\Kekerasan;
use App\Models\DokumenIdentitas;
use App\Models\FaqModel;
use App\Models\KontakModel;
use App\Models\Universitas;
use App\Models\Laporan;
use App\Models\LaporanLog;
use App\Models\NotifBulanAdminModel;
use App\Models\NotifBulanModel;
use App\Models\NotifModel;
use App\Models\PengaturanModel;
use Illuminate\Support\Facades\Auth;
use App\Models\PesanModel;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Schema;
use Mews\Captcha\Facades\Captcha;

class HomeController extends Controller
{
    //
    public function __construct()
    {
        $this->folderIdentitas = "uploads/identitas/";
        $this->folderBukti = "uploads/bukti/";
    }
    public function captcha()
    {
        return response()->json(['captcha' => Captcha::img('math')]);
    }

    public function home()
    {
        $proses = Laporan::all()->filter(function ($item) {
            try {
                $status = Crypt::decryptString($item->status_laporan);
                return $status != 'Selesai' && $status != 'Laporan tidak sesuai dengan tindak kekerasan';
            } catch (\Exception $e) {
                // Jika gagal dekripsi, anggap tidak valid
                return false;
            }
        })->count();
        $selesai = Laporan::all()->filter(function ($item) {
            return Crypt::decryptString($item->status_laporan) == 'Selesai';
        })->count();
        $ditolak = Laporan::all()->filter(function ($item) {
            return Crypt::decryptString($item->status_laporan) == 'Laporan tidak sesuai dengan tindak kekerasan';
        })->count();
        $data = [
            'title' =>  'Beranda | CRS Satgas PPKPT LLDIKTI wilayah III',
            'semua' =>  Laporan::all()->count(),
            'proses'    => $proses,
            'selesai'   =>  $selesai,
            'ditolak'   =>  $ditolak
        ];
        return view('web_version_2.web.beranda', $data);
    }

    public function lupa_password()
    {
        return view('lupa_password');
    }

    public function informasi()
    {
        $data =  [
            'set'   =>  PengaturanModel::orderby('id', 'desc')->first(),
            'faq'   =>  FaqModel::orderby('judul', 'ASC')->get(),
            'title' =>    'Informasi | CRS Satgas PPKPT LLDIKTI wilayah III'
        ];
        return view('web_version_2.web.informasi', $data);
    }

    public function reset_password($email)
    {
        $now = date("d-m-Y H:i:s");
        $check = User::where('email', $email)->first();
        if (!$check) {
            return redirect()->to('login');
        }
        if (!$check->expired) {
            return redirect()->to('login');
        }
        $set = date("d-m-Y H:i:s", strtotime($check->expired));
        if ($now > $set) {
            return redirect()->to('login');
        }
        $email = $email;
        return view('password', compact('email'));
    }

    public function reset(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/',
            'password_new' => 'required|min:8|same:password',
        ], [
            'password.required' => 'Kata sandi lama wajib diisi.',
            'password.min' => 'Kata sandi lama minimal harus terdiri dari 8 karakter.',
            'password.regex' => 'Kata sandi lama harus mengandung huruf besar, huruf kecil, angka, dan simbol.',

            'password_new.required' => 'Kata sandi baru wajib diisi.',
            'password_new.min' => 'Kata sandi baru minimal harus terdiri dari 8 karakter.',
            'password_new.same' => 'Kata sandi baru harus sama dengan kata sandi lama.',
        ]);

        User::where('email', $request->input('email'))->update([
            'password'  =>  bcrypt($request->input('password')),
            'expired'   =>  null
        ]);

        return redirect()->to('login')->with('success', 'Password Berhasil Diganti');
    }

    public function kirim_email(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'captcha'   =>  'required|captcha'
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'email.max' => 'Alamat email tidak boleh lebih dari 255 karakter.',
            'captcha.required'  => 'Captcha wajib diisi.',
            'captcha.captcha'   => 'Captcha yang dimasukkan tidak sesuai.',
        ]);


        $check = User::where('email', $request->input('email'))->first();
        if (!$check) {
            return redirect()->back()->with('error', 'Email Tidak Ditemukan');
        }

        Mail::to($request->email)->send(new KirimEmail($request->input('email')));
        $waktuSekarang = Carbon::now();

        // Menambahkan 15 menit ke waktu sekarang
        $waktu15MenitKeDepan = $waktuSekarang->addMinutes(15);

        User::where('email', $request->input('email'))->update([
            'expired'   =>  $waktu15MenitKeDepan
        ]);

        return redirect()->to('login')->with('success', 'Email Berhasil Dikirim');
    }

    public function form()
    {
        // Pastikan pengguna telah login terlebih dahulu sebelum membuat laporan
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu sebagai pelapor untuk membuat laporan pengaduan.');
        }

        // Admin Perguruan Tinggi dan Superadmin tidak boleh membuat laporan (khusus role pelapor/user)
        if (Auth::user()->level !== 'pelapor') {
            return redirect()->route('dashboard')
                ->with('error', 'Akses ditolak: Akun administrator (Superadmin / Admin Kampus) tidak diizinkan membuat laporan pengaduan. Pembuatan laporan hanya diperuntukkan bagi akun Pelapor / User.');
        }

        // Pastikan kolom user_id ada di tabel laporan
        if (!\Illuminate\Support\Facades\Schema::hasColumn('laporan', 'user_id')) {
            try {
                \Illuminate\Support\Facades\Schema::table('laporan', function (\Illuminate\Database\Schema\Blueprint $table) {
                    $table->unsignedBigInteger('user_id')->nullable()->after('id');
                });
            } catch (\Exception $e) {
                // Ignore jika kolom sudah dibuat secara paralel
            }
        }

        //tampilin form laporan
        $universitas = Universitas::orderby('nama', 'asc')->get();
        $kekerasan = Kekerasan::orderby('tipe_kekerasan', 'asc')->get();
        $identitas = DokumenIdentitas::orderby('id', 'asc')->get();
        $title = "Buat Laporan | CRS Satgas PPKPT LLDIKTI wilayah III";
        return view('web_version_2.web.buat_laporan', compact('universitas', 'kekerasan', 'identitas', 'title'));
    }

    public function kontak()
    {
        $set = PengaturanModel::orderby('id', 'DESC')->first();
        $data = [
            'set'   =>  $set,
            'title' =>    'Kontak Kami | CRS Satgas PPKPT LLDIKTI wilayah III'
        ];
        return view('web_version_2.web.kontak', $data);
    }

    public function kirim_kontak(Request $request)
    {
        $request->validate([
            'nama'  =>  'required|max:255',
            'email' =>  'required|email|max:255',
            'pesan' =>  'required',
            'subjek'    =>  'required',
            'captcha'   =>  'required|captcha'
        ], [
            'nama.required' =>  'Nama Harus Diisi',
            'nama.max'  =>  'Nama Terlalu Panjang',
            'email.required'    =>  'Email Harus Diisi',
            'email.max' =>  'Email Terlalu Panjang',
            'email.email'   =>  'Email Tidak Valid',
            'subjek.reuqired'   =>  'Subjek Harus Diisi',
            'pesan.required'    =>  'Pesan Harus Diisi',
            'captcha.required'  => 'Captcha wajib diisi.',
            'captcha.captcha'   => 'Captcha yang dimasukkan tidak sesuai.',
        ]);

        KontakModel::create([
            'nama'  =>  $request->input('nama'),
            'email' =>  $request->input('email'),
            'subjek'    =>  $request->input('subjek'),
            'pesan' =>  $request->input('pesan'),
            'created_at'    =>  Carbon::now()
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Dikirim');
    }

    public function submitlaporan(Request $request)
    {
        // Pastikan pengguna telah login sebelum submit laporan
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Sesi login telah berakhir. Silakan login kembali.');
        }

        // Admin Perguruan Tinggi dan Superadmin tidak boleh submit laporan
        if (Auth::user()->level !== 'pelapor') {
            return redirect()->route('dashboard')
                ->with('error', 'Akses ditolak: Akun administrator tidak diizinkan membuat laporan pengaduan.');
        }

        // Pastikan kolom user_id ada di tabel laporan
        if (!\Illuminate\Support\Facades\Schema::hasColumn('laporan', 'user_id')) {
            try {
                \Illuminate\Support\Facades\Schema::table('laporan', function (\Illuminate\Database\Schema\Blueprint $table) {
                    $table->unsignedBigInteger('user_id')->nullable()->after('id');
                });
            } catch (\Exception $e) {
                // Ignore jika kolom sudah dibuat
            }
        }

        $request->validate([
            'kategori'  => 'required',
            'pelapor'   => 'required',
            'password_file' => 'required|min:4',
            'captcha'   => 'required|captcha',
            'upload_bukti' => 'mimes:png,jpeg,pdf,zip|max:1024',
            'upload_identitas' => 'mimes:png,jpeg,jpg,zip|max:1024',
        ], [
            'kategori.required' => 'Kategori wajib diisi.',
            'pelapor.required'  => 'Nama pelapor wajib diisi.',
            'password_file.required' => 'Password enkripsi dokumen wajib diisi.',
            'password_file.min' => 'Password enkripsi dokumen minimal 4 karakter.',
            'captcha.required'  => 'Captcha wajib diisi.',
            'captcha.captcha'   => 'Captcha yang dimasukkan tidak sesuai.',
            'upload_bukti.file' => 'Bukti harus berupa file.',
            'upload_bukti.max' => 'Ukuran bukti maksimal 1MB.',
            'upload_bukti.mimes' => 'Format bukti harus PNG, JPEG, PDF, atau ZIP.',
            'upload_identitas.max' => 'Ukuran file identitas maksimal 1MB.',
            'upload_identitas.mimes' => 'Format file identitas harus PNG, JPEG, JPG, atau ZIP.',
        ]);

        $kategori = $request->input('kategori');
        if ($kategori == "Mitra") {
            $request->validate([
                'nama' => 'nullable|string|max:255',
                'no_identitas' => 'required|string',
                'bekerja' => 'required',
                'jenis_kelamin' => 'required',
                'email' => 'nullable|email',
                'no_hp' => 'required|string',
                'jenis_identitas' => 'required|string',
                'tanggal_kejadian' => 'required|date|before_or_equal:today',
                'kronologi_kejadian' => 'required',
                'lokasi_kejadian' => 'required',
                'jenis_kekerasan' => 'required',

            ], [
                'nama.required' => 'Nama wajib diisi.',
                'nama.string' => 'Nama harus berupa teks.',
                'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',

                'no_identitas.required' => 'Nomor identitas wajib diisi.',
                'no_identitas.string' => 'Nomor identitas harus berupa teks.',

                'bekerja.required' => 'Status bekerja wajib diisi.',

                'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',

                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',

                'no_hp.required' => 'Nomor HP wajib diisi.',
                'no_hp.string' => 'Nomor HP harus berupa teks.',

                'jenis_identitas.required' => 'Jenis identitas wajib diisi.',
                'jenis_identitas.string' => 'Jenis identitas harus berupa teks.',

                'tanggal_kejadian.required' => 'Tanggal kejadian wajib diisi.',
                'tanggal_kejadian.date' => 'Tanggal kejadian harus berupa format tanggal.',
                'tanggal_kejadian.before_or_equal' => 'Tanggal kejadian tidak boleh melebihi hari ini.',

                'kronologi_kejadian.required' => 'Kronologi kejadian wajib diisi.',

                'lokasi_kejadian.required' => 'Lokasi kejadian wajib diisi.',

                'jenis_kekerasan.required' => 'Jenis kekerasan wajib dipilih.',

            ]);
        } else {
            $request->validate([
                'nama' => 'required|string|max:255',
                'no_identitas' => 'required|string',
                'universitas' => 'required|string',
                'jenis_kelamin' => 'required',
                'email' => 'required|email',
                'no_hp' => 'required|string',
                'jenis_identitas' => 'required|string',
                'tanggal_kejadian' => 'required|date|before_or_equal:today',
                'kronologi_kejadian' => 'required',
                'lokasi_kejadian' => 'required',
                'jenis_kekerasan' => 'required',
            ], [
                'nama.required' => 'Nama wajib diisi.',
                'nama.string' => 'Nama harus berupa teks.',
                'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',

                'no_identitas.required' => 'Nomor identitas wajib diisi.',
                'no_identitas.string' => 'Nomor identitas harus berupa teks.',

                'universitas.required' => 'Nama universitas wajib diisi.',
                'universitas.string' => 'Nama universitas harus berupa teks.',

                'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',

                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',

                'no_hp.required' => 'Nomor HP wajib diisi.',
                'no_hp.string' => 'Nomor HP harus berupa teks.',

                'jenis_identitas.required' => 'Jenis identitas wajib dipilih.',
                'jenis_identitas.string' => 'Jenis identitas harus berupa teks.',

                'tanggal_kejadian.required' => 'Tanggal kejadian wajib diisi.',
                'tanggal_kejadian.date' => 'Tanggal kejadian harus dalam format tanggal yang benar.',
                'tanggal_kejadian.before_or_equal' => 'Tanggal kejadian tidak boleh melebihi tanggal hari ini.',

                'kronologi_kejadian.required' => 'Kronologi kejadian wajib diisi.',

                'lokasi_kejadian.required' => 'Lokasi kejadian wajib diisi.',

                'jenis_kekerasan.required' => 'Jenis kekerasan wajib dipilih.',
            ]);
        }

        $bulanIni = Carbon::now()->format('Y-m');
        $kategori = $request->input('kategori');

        // Hanya proses jika kategori diizinkan
        $kategoriDiizinkan = ['Mahasiswa', 'Dosen/Tenaga Pendidik', 'Mitra'];
        if (in_array($kategori, $kategoriDiizinkan)) {
            // Ambil universitas, atau fallback ke 'Mitra' jika kosong
            $unif = $request->input('universitas') ?? 'Mitra';

            // Cek apakah data bulan ini dan universitas sama (atau 'Mitra' juga dianggap sama)
            $main = NotifBulanModel::where('bulan', $bulanIni)
                ->where(function ($query) use ($unif) {
                    if ($unif === 'Mitra') {
                        $query->whereNull('universitas_id')
                            ->orWhere('universitas_id', 'Mitra');
                    } else {
                        $query->where('universitas_id', $unif);
                    }
                })
                ->first();

            if ($main) {
                // Jika sudah ada, tambahkan views
                $main->increment('views');
            } else {
                // Jika belum ada, buat entri baru
                NotifBulanModel::create([
                    'views' => 1,
                    'bulan' => $bulanIni,
                    'universitas_id' => $unif,
                    'updated_at' => Carbon::now()
                ]);
            }
        }

        $bulanIni_dua = Carbon::now()->format('Y-m');

        $adminNotif = NotifBulanAdminModel::where('bulan', $bulanIni_dua)->first();

        if ($adminNotif) {
            // Jika sudah ada, tambahkan views
            $adminNotif->increment('views');
        } else {
            // Jika belum ada, buat entri baru
            NotifBulanAdminModel::create([
                'bulan' => $bulanIni_dua,
                'views'  => 1,
                'created_at' => Carbon::now()
            ]);
        }

        if (!Schema::hasColumn('laporan', 'ket')) {
            Schema::table('laporan', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->text('ket')->nullable()->after('status_laporan');
            });
        }

        $laporan = new Laporan();
        $laporan->id = Str::random(10);
        $laporan->user_id = Auth::check() ? Auth::id() : null;
        $kodelaporan = "REP-" . $this->generateKodeLaporan();
        $laporan->kode_laporan = $kodelaporan;
        $nama = Auth::check() ? Auth::user()->name : ($request->nama ?? '');
        $laporan->nama = Crypt::encryptString($nama);
        $laporan->no_identitas = Crypt::encryptString($request->no_identitas);
        $laporan->jenis_kelamin = Crypt::encryptString($request->jenis_kelamin);
        if ($request->input('kategori') != "Mitra") {
            $laporan->universitas = $request->universitas;
        }

        $email = Auth::check() ? Auth::user()->email : ($request->email ?? '');
        $laporan->email = Crypt::encryptString($email);
        $laporan->no_hp = Crypt::encryptString($request->no_hp);
        $laporan->jenis_identitas = $request->jenis_identitas;
        $laporan->tanggal_kejadian = Crypt::encryptString($request->tanggal_kejadian);
        $laporan->kronologi_kejadian = Crypt::encryptString($request->kronologi_kejadian);
        $laporan->lokasi_kejadian    = Crypt::encryptString($request->lokasi_kejadian);
        $laporan->jenis_kekerasan    = $request->jenis_kekerasan;
        $sevenDaysLater = Carbon::now()->addDays(7)->toDateString();
        $laporan->tgl_batas_proses = $sevenDaysLater;

        $laporan->status_laporan     = Crypt::encryptString("Diterima");
        $laporan->deskripsi_laporan     = Crypt::encryptString($request->deskripsi_laporan);
        $laporan->kategori = Crypt::encryptString($request->input('kategori'));
        if ($request->input('kategori') == "Mitra") {
            $laporan->instansi_bekerja = Crypt::encryptString($request->input('bekerja'));
            $laporan->mitra = "Mitra";
        }


        // Handle password enkripsi file
        $passwordFile = $request->input('password_file');
        $laporan->password_file = $passwordFile;
        $aesKey = substr(md5($passwordFile), 0, 16);

        $totalEnkripsiTime = 0;
        $totalFileSize = 0;

        if ($request->file('upload_identitas')) {
            $file = $request->file('upload_identitas');
            $nowTimestamp = now()->timestamp;
            $fileName = "{$nowTimestamp}-{$file->getClientOriginalName()}";
            $sourcePath = $file->getPathname();
            $fileSize = filesize($sourcePath);
            $totalFileSize += $fileSize;

            $startIdTime = microtime(true);
            $aes = new \App\Helpers\AES($aesKey);
            $mod = $fileSize % 16;
            $banyak = ($mod == 0) ? ($fileSize / 16) : ((($fileSize - $mod) / 16) + 1);

            $fileSource = fopen($sourcePath, 'rb');
            $destinationDir = public_path($this->folderIdentitas);
            if (!file_exists($destinationDir)) {
                mkdir($destinationDir, 0777, true);
            }
            $fileOutput = fopen(public_path($this->folderIdentitas . $fileName), 'wb');
            ini_set('max_execution_time', -1);
            ini_set('memory_limit', -1);
            for ($bawah = 0; $bawah < $banyak; $bawah++) {
                $data = fread($fileSource, 16);
                $cipher = $aes->encrypt($data);
                fwrite($fileOutput, $cipher);
            }
            fclose($fileSource);
            fclose($fileOutput);
            $totalEnkripsiTime += (microtime(true) - $startIdTime);

            $laporan->upload_identitas = Crypt::encryptString($this->folderIdentitas . $fileName);
        }

        if ($request->file('upload_bukti')) {
            $file = $request->file('upload_bukti');
            $nowTimestamp = now()->timestamp;
            $fileName = "{$nowTimestamp}-{$file->getClientOriginalName()}";
            $sourcePath = $file->getPathname();
            $fileSize = filesize($sourcePath);
            $totalFileSize += $fileSize;

            $startBuktiTime = microtime(true);
            $aes = new \App\Helpers\AES($aesKey);
            $mod = $fileSize % 16;
            $banyak = ($mod == 0) ? ($fileSize / 16) : ((($fileSize - $mod) / 16) + 1);

            $fileSource = fopen($sourcePath, 'rb');
            $destinationDir = public_path($this->folderBukti);
            if (!file_exists($destinationDir)) {
                mkdir($destinationDir, 0777, true);
            }
            $fileOutput = fopen(public_path($this->folderBukti . $fileName), 'wb');
            ini_set('max_execution_time', -1);
            ini_set('memory_limit', -1);
            for ($bawah = 0; $bawah < $banyak; $bawah++) {
                $data = fread($fileSource, 16);
                $cipher = $aes->encrypt($data);
                fwrite($fileOutput, $cipher);
            }
            fclose($fileSource);
            fclose($fileOutput);
            $totalEnkripsiTime += (microtime(true) - $startBuktiTime);

            $laporan->upload_bukti = Crypt::encryptString($this->folderBukti . $fileName);
        }

        // Simpan metadata performa enkripsi
        if (!Schema::hasColumn('laporan', 'waktu_enkripsi')) {
            Schema::table('laporan', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->string('waktu_enkripsi')->nullable()->after('password_file');
                $table->string('ukuran_file')->nullable()->after('waktu_enkripsi');
            });
        }
        $laporan->waktu_enkripsi = number_format($totalEnkripsiTime, 2);
        $laporan->ukuran_file = number_format($totalFileSize / 1048576, 2);

        $laporan->pelapor = Crypt::encryptString($request->input('pelapor'));

        if ($laporan->save()) {
            // Auto register/link pelapor account bila belum terdaftar
            $reporterEmail = strtolower(trim($request->email));
            $existingUser = User::where('email', $reporterEmail)->first();
            if (!$existingUser) {
                User::create([
                    'name' => $request->nama,
                    'email' => $reporterEmail,
                    'password' => \Illuminate\Support\Facades\Hash::make($passwordFile),
                    'level' => 'pelapor',
                    'universitas_id' => $request->input('kategori') != 'Mitra' ? $request->universitas : null,
                    'status' => 'Aktif',
                ]);
            }

            //simpan ke laporanlog
            $log = new LaporanLog();
            $log->kode_laporan = $kodelaporan;
            $log->tanggal_diubah = date('Y-m-d H:i:s');
            $log->status_laporan = Crypt::encryptString("Diterima");
            $log->deskripsi_laporan = Crypt::encryptString("Laporan Masuk ke Sistem");
            $log->tgl_batas_proses = $sevenDaysLater;
            $log->password_file = $passwordFile;
            $log->save();

            //kirim email
            $pt = $request->input('universitas');
            $users = User::where('universitas_id', $pt)->first();
            if ($users) {
                //kirim email
                $data_dua = [
                    'nama'  =>  $request->nama,
                    'id'    =>  $laporan->id,
                    'pengaturan'    =>  PengaturanModel::first(),
                ];

                Mail::send('email.laporanditerimaadmin', $data_dua, function ($message) use ($users) {
                    // Tentukan alamat email penerima
                    $message->to($users->email, $users->name)
                        ->subject('Laporan Masuk Pengaduan LLDIKTI Wilayah III');
                });
            }

            $data = [
                'nama'  =>  $request->nama,
                'id'    =>  $laporan->id,
                'pengaturan'    =>  PengaturanModel::first(),
            ];

            Mail::send('email.laporanditerima', $data, function ($message) use ($request) {
                // Tentukan alamat email penerima
                $message->to($request->email, $request->nama)
                    ->subject('Laporan Pengaduan LLDIKTI Wilayah III');
            });


            return redirect()->route('responselaporan')->with('laporan', $laporan);
        }
    }


    public function status()
    {
        $data = [
            'title' =>    'Kontak Kami | CRS Satgas PPKPT LLDIKTI wilayah III'
        ];
        return view('web_version_2.web.laporan_status', $data);
    }

    public function cekstatus(Request $request)
    {

        $request->validate([
            'id' => 'required',
            'captcha' => 'required|captcha',
        ], [
            'id.required' => 'ID wajib diisi.',
            'captcha.required' => 'Kode captcha wajib diisi.',
            'captcha.captcha' => 'Kode captcha yang dimasukkan tidak sesuai.',
        ]);
        $id = $request->id;

        $laporan = Laporan::where('id', $id)->get();

        if ($laporan->isEmpty()) {
            return back()->with('error', 'Data tidak ditemukan.');
        }

        $idField = $laporan->first()->kode_laporan;
        $ids = $laporan->first()->id;

        $logs = LaporanLog::where('kode_laporan', $idField)->get();
        // Simpan kode laporan ke session
        session(['kode_laporan' => $idField]);
        $chat = PesanModel::where('laporan_id', $id)->get();
        $first  = Laporan::find($id);
        $title =     'Status Laporan | CRS Satgas PPKPT LLDIKTI wilayah III';
        $jenis_kekerasan = Kekerasan::where('id', $laporan->first()->jenis_kekerasan)->first();
        $universitas = Universitas::where('id', $laporan->first()->universitas)->first();
        return view('web_version_2.web.status_respon', compact('id', 'logs', 'ids', 'chat', 'first', 'title', 'jenis_kekerasan', 'universitas'));
    }

    public function cekstatus_dua(Request $request)
    {
        $id = $request->id;

        $laporan = Laporan::where('id', $id)->get();

        if ($laporan->isEmpty()) {
            return back()->with('error', 'Data tidak ditemukan.');
        }

        $idField = $laporan->first()->kode_laporan;
        $ids = $laporan->first()->id;

        $logs = LaporanLog::where('kode_laporan', $idField)->get();
        // Simpan kode laporan ke session
        session(['kode_laporan' => $idField]);
        $chat = PesanModel::where('laporan_id', $id)->get();
        $first  = Laporan::find($id);
        $title =     'Status Laporan | CRS Satgas PPKPT LLDIKTI wilayah III';
        $jenis_kekerasan = Kekerasan::where('id', $laporan->first()->jenis_kekerasan)->first();
        $universitas = Universitas::where('id', $laporan->first()->universitas)->first();
        return view('web_version_2.web.status_respon', compact('id', 'logs', 'ids', 'chat', 'first', 'title', 'jenis_kekerasan', 'universitas'));
    }

    public function kirim_chat(Request $request)
    {
        $request->validate([
            'pesan' => 'required',
            'id' => 'required',
        ], [
            'pesan.required' => 'Pesan wajib diisi.',
            'id.required' => 'ID wajib diisi.',
        ]);


        $check = Laporan::where('id', $request->input('id'))->first();
        if (!$check) {
            return abort(404);
        }

        PesanModel::create([
            'laporan_id'    => $request->input('id'),
            'nama'  =>  Crypt::decryptString($check->nama),
            'pesan' =>  $request->input('pesan'),
            'status'    =>  'Member',
            'created_at'    =>  Carbon::now(),
        ]);
        $id = $request->id;

        $laporan = Laporan::where('id', $id)->get();

        if ($laporan->isEmpty()) {
            return back()->with('error', 'Data tidak ditemukan.');
        }

        $idField = $laporan->first()->kode_laporan;
        $ids = $laporan->first()->id;

        $logs = LaporanLog::where('kode_laporan', $idField)->get();
        // Simpan kode laporan ke session
        session(['kode_laporan' => $idField]);
        $chat = PesanModel::where('laporan_id', $id)->get();
        $first  = Laporan::find($id);
        $title =     'Kontak Kami | CRS Satgas PPKPT LLDIKTI wilayah III';
        $jenis_kekerasan = Kekerasan::where('id', $laporan->first()->jenis_kekerasan)->first();
        $universitas = Universitas::where('id', $laporan->first()->universitas)->first();
        return view('web_version_2.web.status_respon', compact('id', 'logs', 'ids', 'chat', 'first', 'title', 'jenis_kekerasan', 'universitas'));
    }


    public function responselaporan()
    {
        if (!session()->get('laporan')) {
            return redirect()->route('home');
        }

        $data = [
            'email' => Crypt::decryptString(session()->get('laporan')->email),
            'title' =>    'Status Pengiriman Laporan | CRS Satgas PPKPT LLDIKTI wilayah III'
        ];

        return view('web_version_2.web.status_email', $data);
    }



    function generateKodeLaporan()
    {
        $tanggal = Carbon::now()->format('ymdHmis');

        DB::beginTransaction();

        try {
            $lastLaporan = Laporan::whereDate('created_at', Carbon::today())
                ->orderBy('created_at', 'desc')
                ->lockForUpdate()
                ->first();

            if ($lastLaporan) {
                $lastNomorUrut = (int)substr($lastLaporan->kode_laporan, 6, 4);
                $nomorUrut = $lastNomorUrut + 1;
            } else {
                $nomorUrut = 1;
            }

            $nomorUrut = str_pad($nomorUrut, 4, '0', STR_PAD_LEFT);

            $kodeLaporan = $tanggal . $nomorUrut;

            DB::commit();

            return $kodeLaporan;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function decryptForm(Request $request)
    {
        return view('decrypt_file');
    }

    public function decryptProcess(Request $request)
    {
        $request->validate([
            'password_file' => 'required',
            'file_path' => 'required',
            'model_type' => 'required',
            'model_id' => 'required'
        ]);

        $password = $request->input('password_file');
        
        $modelType = $request->input('model_type');
        $modelId = $request->input('model_id');
        $filePath = Crypt::decryptString($request->input('file_path'));
        
        if ($modelType === 'log') {
            $log = LaporanLog::find($modelId);
            if (!$log) return back()->with('error', 'Log tidak ditemukan.');

            $dbPassword = $log->password_file;
            $deskripsi = Crypt::decryptString($log->deskripsi_laporan);
            
            $words = explode(' ', trim($deskripsi));
            $firstWord = $words[0];
            $defaultPassword = 'CRS2026' . $firstWord;

            if ($password !== $dbPassword && $password !== $defaultPassword) {
                return back()->with('error', 'Maaf, Password tidak sesuai.');
            }
            $targetKey = $dbPassword;
        } elseif ($modelType === 'laporan') {
            $laporan = Laporan::find($modelId);
            if (!$laporan) return back()->with('error', 'Data laporan tidak ditemukan.');

            $dbPassword = $laporan->password_file;
            $defaultPassword = 'CRS2026';

            if ($password !== $dbPassword && $password !== $defaultPassword) {
                return back()->with('error', 'Maaf, Password tidak sesuai.');
            }
            $targetKey = $dbPassword;
        } else {
            return back()->with('error', 'Tipe file tidak valid untuk dekripsi.');
        }

        $fullPath = public_path($filePath);
        if (!file_exists($fullPath)) {
            return back()->with('error', 'File tidak ditemukan di server.');
        }

        $startTime = microtime(true);
        $fileSize = filesize($fullPath);
        $hashInput = md5($targetKey);
        $aesKey = substr($hashInput, 0, 16);
        $aes = new \App\Helpers\AES($aesKey);
        
        $mod = $fileSize % 16;
        $banyak = ($mod == 0) ? ($fileSize / 16) : ((($fileSize - $mod) / 16) + 1);

        $fileSource = fopen($fullPath, 'rb');
        $plainContent = '';
        
        ini_set('max_execution_time', -1);
        ini_set('memory_limit', -1);
        for($bawah=0; $bawah<$banyak; $bawah++){
            $data = fread($fileSource, 16);
            $plainContent .= $aes->decrypt($data);
        }
        fclose($fileSource);

        $endTime = microtime(true);
        $timeTaken = number_format($endTime - $startTime, 3);
        $sizeMB = number_format($fileSize / 1048576, 2);
        $sizeKB = number_format($fileSize / 1024, 2);

        $fileName = basename($fullPath);
        // Clean padding if any (often null bytes in AES, but depends on implementation)
        $plainContent = rtrim($plainContent, "\0");
        
        // Return file download with metrics headers & cookie
        return response($plainContent)
            ->header('Cache-Control', 'no-cache private')
            ->header('Content-Description', 'File Transfer')
            ->header('Content-Type', 'application/octet-stream')
            ->header('Content-length', strlen($plainContent))
            ->header('Content-Disposition', 'attachment; filename=' . $fileName)
            ->header('Content-Transfer-Encoding', 'binary')
            ->header('X-Decrypt-Time', $timeTaken)
            ->header('X-Decrypt-Size-MB', $sizeMB)
            ->header('Set-Cookie', 'crs_decrypt_status=success; Path=/')
            ->header('Set-Cookie', 'crs_decrypt_time=' . $timeTaken . '; Path=/')
            ->header('Set-Cookie', 'crs_decrypt_size=' . $sizeMB . '; Path=/');
    }
}
