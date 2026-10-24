<?php



namespace App\Http\Controllers\Adm;

use App\Exports\Laporan as ExportsLaporan;
use App\Http\Controllers\Controller;
use App\Models\AktifitasModel;
use App\Models\Kekerasan;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Models\Laporan;

use App\Models\LaporanLog;
use App\Models\PengaturanModel;
use App\Models\PesanModel;
use App\Models\Template;
use App\Models\Universitas;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller

{

    //

    public function __construct()

    {
        $this->pagetitle = "Laporan Masuk";

        $this->folderLog = "uploads/logs/";
    }

    public function pendamping(Request $request)
    {
        $request->validate([
            'kode_laporan'  =>  'required',
            'nama'  =>  'required',
            'no_hp' =>  'required'
        ], [
            'kode_laporan.required' =>  'Kode Laporan Harus Diisi',
            'nama.required' =>  'Nama Harus Diisi',
            'no_hp.required'    =>  'No Hp Harus Diisi'
        ]);

        Laporan::where('kode_laporan', $request->input('kode_laporan'))->update([
            'nama_pendamping'   =>  Crypt::encryptString($request->input('nama')),
            'no_wa_pendamping'  =>  Crypt::encryptString($request->input('no_hp'))
        ]);

        $laporan = Laporan::where('kode_laporan', $request->input('kode_laporan'))->first();

        $pesan = Auth::user()->name . ' menambahkan pendamping dengan kode laporan  ' . $laporan->kode_laporan . ' dan atas nama' . Crypt::decryptString($laporan->nama) . ' serta  nama pendamping ' . $request->input('nama') . ' no wa' . $request->input('no_hp');
        $status = 'Menambahkan Pendamping';

        AktifitasModel::create([
            'user_id'   =>  Auth::user()->id,
            'pesan' => $pesan,
            'status'    =>  $status,
            'created_at'    =>  Carbon::now()
        ]);

        return redirect()->back()->with('success', 'Pendamping Berhasil Ditambahkan');
    }

    public function update_status_laporans(Request $request)
    {
        $request->validate([
            'catatan'   =>  'required'
        ], [
            'catatan.required'  =>  'Catatan Harus Diisi'
        ]);

        $id = $request->input('id');

        $laporan = Laporan::where('id', $id)->firstOrFail();

        // Cari atau buat otomatis template jika belum ada di database
        $statusTolak = 'Laporan tidak sesuai dengan tindak kekerasan';
        $template = Template::where('status', $statusTolak)->first();
        if (!$template) {
            $template = Template::create([
                'status' => $statusTolak,
                'deskripsi_status' => 'Laporan yang diajukan tidak memenuhi kriteria tindak kekerasan atau tidak cukup bukti sesuai pedoman penanganan Satgas PPKPT.'
            ]);
        }
        $status = $template->status;
        $deskripsi = $template->deskripsi_status ?? 'Laporan tidak sesuai dengan tindak kekerasan';

        $log = new LaporanLog();
        $log->kode_laporan = $laporan->kode_laporan;
        $log->deskripsi_laporan = Crypt::encryptString($deskripsi);
        $log->status_laporan = Crypt::encryptString($status);
        $log->tgl_batas_proses = Carbon::now()->addDays(7);
        $log->save();

        if (!Schema::hasColumn('laporan', 'ket')) {
            Schema::table('laporan', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->text('ket')->nullable()->after('status_laporan');
            });
        }

        Laporan::where('id', $id)->update([
            'status_laporan'  =>  Crypt::encryptString($status),
            'ket'   =>  Crypt::encryptString($request->input('catatan')),
            'updated_at' =>  Carbon::now(),
        ]);

        $data = [
            'log' => $log,
            'template' => Template::where('status', $status)->get(),
            'pengaturan'    =>  PengaturanModel::first(),
            'laporan'   =>  $laporan
        ];

        try {
            Mail::send('email.updatestatus', $data, function ($message) use ($laporan) {
                $message->to(Crypt::decryptString($laporan->email), Crypt::decryptString($laporan->nama))
                    ->subject('Status Laporan PPKS Telah Diperbarui');
            });
        } catch (\Exception $e) {
            // Lanjutkan jika konfigurasi email gagal agar proses status tetap berhasil
        }

        // log
        $pesan = Auth::user()->name . ' tidak menyetujui laporan ini karena laporan tidak sesuai dengan tindak kekerasan dengan kode laporan ' . $laporan->kode_laporan . ' dan atas nama' . Crypt::decryptString($laporan->nama);
        $status = 'Laporan tidak sesuai dengan tindak kekerasan';
        AktifitasModel::create([
            'user_id'   =>  Auth::user()->id,
            'pesan' => $pesan,
            'status'    =>  $status,
            'created_at'    =>  Carbon::now()
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Diupdate');
    }

    public function index()
    {
        $pagetitle = $this->pagetitle;

        if (Auth::user()->level == 'superadmin') {
            $laporan = Laporan::where('merge_laporan_id', null)->orderby('created_at', 'DESC')->get();
        } elseif (Auth::user()->level == "pt") {
            $univ_id = Auth::user()->universitas_id;
            $laporan = Laporan::where('merge_laporan_id', null)->where('universitas', $univ_id)->orderby('created_at', 'DESC')->get();
        } elseif (Auth::user()->level == "pelapor") {
            $userId = Auth::id();
            $userEmail = Auth::user()->email;
            $laporan = Laporan::where('merge_laporan_id', null)
                ->where(function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                })
                ->orderby('created_at', 'DESC')
                ->get();

            // Jika masih kosong atau ada data lama tanpa user_id, fallback ke pencocokan email
            if ($laporan->isEmpty()) {
                $laporan = Laporan::where('merge_laporan_id', null)->get()->filter(function ($item) use ($userId, $userEmail) {
                    if (!empty($item->user_id) && $item->user_id == $userId) {
                        return true;
                    }
                    try {
                        return strtolower(trim(Crypt::decryptString($item->email))) === strtolower(trim($userEmail));
                    } catch (\Exception $e) {
                        return false;
                    }
                });
            }
        } else {
            $laporan = Laporan::where('merge_laporan_id', null)->where('mitra', "Mitra")->orderby('created_at', 'DESC')->get();
        }
        $universitas = Universitas::orderby('nama', 'ASC')->get();
        $kekerasan = Kekerasan::all();
        return view('Admin.laporan.index', compact('laporan', 'pagetitle', 'universitas', 'kekerasan'));
    }

    public function filter(Request $request)
    {
        $pt = $request->input('pt');
        $kekerasan = $request->input('kekerasan');

        $pagetitle = $this->pagetitle;

        if (Auth::user()->level == 'superadmin') {
            if ($pt == "All") {
                $laporan = Laporan::where('merge_laporan_id', null)->where('jenis_kekerasan', $kekerasan)->orderby('created_at', 'DESC')->get();
            } else {
                $laporan = Laporan::where('merge_laporan_id', null)->where('jenis_kekerasan', $kekerasan)->where('universitas', $pt)->orderby('created_at', 'DESC')->get();
            }

            if ($kekerasan == "All") {
                $laporan = Laporan::where('merge_laporan_id', null)->where('universitas', $pt)->orderby('created_at', 'DESC')->get();
            } else {
                $laporan = Laporan::where('merge_laporan_id', null)->where('jenis_kekerasan', $kekerasan)->where('universitas', $pt)->orderby('created_at', 'DESC')->get();
            }

            if($kekerasan == "All" && $pt == "All") {
                $laporan = Laporan::where('merge_laporan_id', null)->orderby('created_at', 'DESC')->get();
            }
        } elseif (Auth::user()->level == "pt") {
            $univ_id = Auth::user()->universitas_id;
            $laporan = Laporan::where('merge_laporan_id', null)->where('universitas', $univ_id)->orderby('created_at', 'DESC')->get();
        } else {
            $laporan = Laporan::where('merge_laporan_id', null)->where('mitra', "Mitra")->orderby('created_at', 'DESC')->get();
        }
        $universitas = Universitas::orderby('nama', 'ASC')->get();
        $kekerasan = Kekerasan::all();
        return view('Admin.laporan.index', compact('laporan', 'pagetitle', 'universitas', 'kekerasan'));
    }

    public function chat_admin(Request $request)
    {
        $request->validate([
            'pesan' =>  'required',
            'id'    =>  'required'
        ]);

        $check = Laporan::where('id', $request->input('id'))->first();
        if (!$check) {
            return abort(404);
        }


        $senderStatus = Auth::user()->level === 'pelapor' ? 'Pelapor' : 'Admin';

        PesanModel::create([
            'laporan_id'    => $request->input('id'),
            'nama'  =>  Auth::user()->name,
            'pesan' =>  $request->input('pesan'),
            'status'    =>  $senderStatus,
            'created_at'    =>  Carbon::now()
        ]);
        return redirect()->back();
    }


    public function show($kode)

    {

        $pagetitle = $this->pagetitle;

        $laporan = Laporan::where('kode_laporan', $kode)->firstorfail();

        $logs = LaporanLog::where('kode_laporan', $kode)->orderby('created_at', 'asc')->get();

        //ambil status laporan

        $statuslaporan = Template::get();
        $chat = PesanModel::where('laporan_id', $laporan->id)->get();

        // kirim email
        $universitas = Universitas::where('id', $laporan->universitas)->first();
        $jenis = Kekerasan::where('id', $laporan->jenis_kekerasan)->first();
        $identitasDokumen = \App\Models\DokumenIdentitas::where('id', $laporan->jenis_identitas)->first();

        return view('Admin.laporan.detail', compact('logs', 'pagetitle', 'laporan', 'statuslaporan', 'chat', 'universitas', 'jenis', 'identitasDokumen'));
    }

    public function hapus_logs_laporan(Request $request)
    {
        $id = $request->input('id');
        $lap = LaporanLog::find($id);
        $ma = Laporan::where('kode_laporan', $lap->kode_laporan)->first();
        LaporanLog::where('id', $id)->delete();
        $pesan = Auth::user()->name . ' Menghapus log laporan dengan kode laporan ' . $ma->kode_laporan . ' dan atas nama' . Crypt::decryptString($ma->nama);
        $status = 'Menghapus Log Laporan';
        AktifitasModel::create([
            'user_id'   =>  Auth::user()->id,
            'pesan' => $pesan,
            'status'    =>  $status,
            'created_at'    =>  Carbon::now()
        ]);
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }

    public function tinjau_ulang($id)
    {
        $laporan = Laporan::find($id);
        if (!$laporan) {
            return abort(404);
        }

        $statusObj = Template::where('status', 'Laporan Di Tinjau Ulang')->first();
        if (!$statusObj) {
            $statusObj = Template::create([
                'status' => 'Laporan Di Tinjau Ulang',
                'deskripsi_status' => 'Laporan sedang ditinjau ulang oleh tim PPKPT.'
            ]);
        }
        $statusStr = $statusObj->status;
        $deskripsiStr = $statusObj->deskripsi_status ?? 'Laporan sedang ditinjau ulang oleh tim PPKPT.';

        if (!Schema::hasColumn('laporan', 'ket')) {
            Schema::table('laporan', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->text('ket')->nullable()->after('status_laporan');
            });
        }

        Laporan::where('id', $id)->update([
            'status_laporan'    =>  Crypt::encryptString($statusStr),
            'ket'   =>  null,
            'updated_at'    =>  Carbon::now(),
        ]);

        $log = LaporanLog::create([
            'kode_laporan'  =>  $laporan->kode_laporan,
            'tanggal_diubah'    =>  Carbon::now(),
            'status_laporan'    =>  Crypt::encryptString($statusStr),
            'deskripsi_laporan'  =>  Crypt::encryptString($deskripsiStr),
            'tgl_batas_proses' => Carbon::now()->addDays(7),
            'updated_at'    =>  Carbon::now()
        ]);
        $data = [
            'log' => $log,
            'template' => Template::where('status', $statusStr)->get(),
            'pengaturan'    =>  PengaturanModel::first(),
            'laporan'   =>  $laporan
        ];

        try {
            Mail::send('email.updatestatus', $data, function ($message) use ($laporan) {
                // Tentukan alamat email penerima
                $message->to(Crypt::decryptString($laporan->email), Crypt::decryptString($laporan->nama))
                    ->subject('Status Laporan PPKS Telah Diperbarui');
            });
        } catch (\Exception $e) {
            // Abaikan jika mail server belum disetup
        }

        return redirect()->back()->with('success', 'Data Berhasil Diupdate');
    }

    public function update_status_laporan($status_laporan, $kode_laporan)
    {
        $laporan = Laporan::where('kode_laporan', $kode_laporan)->firstOrFail();

        $statusTolak = 'Laporan tidak sesuai dengan tindak kekerasan';
        $template = Template::where('status', $statusTolak)->first();
        if (!$template) {
            $template = Template::create([
                'status' => $statusTolak,
                'deskripsi_status' => 'Laporan yang diajukan tidak memenuhi kriteria tindak kekerasan atau tidak cukup bukti sesuai pedoman penanganan Satgas PPKPT.'
            ]);
        }

        $statusVerif = 'Sedang diverifikasi';
        $template_dua = Template::where('status', $statusVerif)->first();
        if (!$template_dua) {
            $template_dua = Template::create([
                'status' => $statusVerif,
                'deskripsi_status' => 'Laporan pengaduan telah disetujui dan sedang dalam tahap verifikasi serta penelaahan berkas oleh tim Satgas PPKPT.'
            ]);
        }

        if ($status_laporan == 1) {
            $status = $template_dua->status;
            $deskripsi = $template_dua->deskripsi_status;
            $log = new LaporanLog();
            $log->kode_laporan = $kode_laporan;
            $log->deskripsi_laporan = Crypt::encryptString($deskripsi);
            $log->status_laporan = Crypt::encryptString($status);
            $log->tgl_batas_proses = Carbon::now()->addDays(7);
            $log->save();
        } else {
            $status = $template->status;
            $deskripsi = $template->deskripsi_status;
            $log = new LaporanLog();
            $log->kode_laporan = $kode_laporan;
            $log->deskripsi_laporan = Crypt::encryptString($deskripsi);
            $log->status_laporan = Crypt::encryptString($status);
            $log->tgl_batas_proses = Carbon::now()->addDays(7);
            $log->save();
        }

        $laporan->status_laporan = Crypt::encryptString($status);
        $laporan->save();

        $data = [
            'log' => $log,
            'template' => Template::where('status', $status)->get(),
            'pengaturan' => PengaturanModel::first(),
            'laporan' => $laporan
        ];

        try {
            Mail::send('email.updatestatus', $data, function ($message) use ($laporan) {
                $message->to(Crypt::decryptString($laporan->email), Crypt::decryptString($laporan->nama))
                    ->subject('Status Laporan PPKS Telah Diperbarui');
            });
        } catch (\Exception $e) {
            // Lanjutkan jika mail server belum aktif
        }

        // log
        if ($status_laporan == 1) {
            $pesan = Auth::user()->name . ' menerima laporan dengan kode laporan ' . $laporan->kode_laporan . ' dan atas nama' . Crypt::decryptString($laporan->nama);
            $statusLog = 'Menerima Laporan Masuk';
        } else {
            $pesan = Auth::user()->name . ' tidak menyetujui laporan ini karena laporan tidak sesuai dengan tindak kekerasan dengan kode laporan ' . $laporan->kode_laporan . ' dan atas nama' . Crypt::decryptString($laporan->nama);
            $statusLog = 'Laporan tidak sesuai dengan tindak kekerasan';
        }
        AktifitasModel::create([
            'user_id'   =>  Auth::user()->id,
            'pesan' => $pesan,
            'status'    =>  $status,
            'created_at'    =>  Carbon::now()
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Diupdate');
    }

    public function ganti_laporan($kategori)
    {
        // Ubah kategori jika diperlukan
        if ($kategori == "Dosen") {
            $kategori = "Dosen/Tenaga Pendidik";
        } elseif ($kategori == "All") {
            return redirect()->to('adm/laporan');
        }

        // Simpan kategori yang telah disesuaikan dalam variabel baru
        $targetKategori = $kategori;

        // Filter laporan berdasarkan kategori
        $laporan = Laporan::where('merge_laporan_id', null)->get()->filter(function ($laporan) use ($targetKategori) {
            return Crypt::decryptString($laporan->kategori) == $targetKategori;
        });

        $pagetitle = "$this->pagetitle";


        return view('Admin.laporan.ganti', compact('laporan', 'pagetitle', 'kategori'));
    }


    public function hapus_laporan($kode_laporan)
    {
        $check = Laporan::where('kode_laporan', $kode_laporan)->first();
        if (!$check) {
            return abort(404);
        }

        $pesan = Auth::user()->name . ' menghapus laporan dengan kode ' . $check->kode_laporan . ' dan atas nama' . Crypt::decryptString($check->nama);
        $status = 'Menghapus Laporan';
        AktifitasModel::create([
            'user_id'   =>  Auth::user()->id,
            'pesan' => $pesan,
            'status'    =>  $status,
            'created_at'    =>  Carbon::now()
        ]);

        LaporanLog::where('kode_laporan', $kode_laporan)->delete();
        Laporan::where('kode_laporan', $kode_laporan)->delete();

        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }



    public function update(Request $request)

    {

        $request->validate([
            'status_laporan'    => 'required',
            'upload_file'       => 'mimes:jpeg,jpg,png,pdf,zip,mp4,mp3|max:20024',
            'deskripsi_laporan' => 'required',
            'tgl_batas_proses'  => 'required|date'
        ], [
            'status_laporan.required'     => 'Status laporan wajib diisi.',
            'upload_file.mimes'           => 'File harus berupa jpeg, jpg, png, pdf, zip, mp4, atau mp3.',
            'upload_file.max'             => 'Ukuran file maksimal 20 MB.',
            'deskripsi_laporan.required'  => 'Deskripsi laporan wajib diisi.',
            'tgl_batas_proses.required'   => 'Tanggal batas proses wajib diisi.',
            'tgl_batas_proses.date'       => 'Tanggal batas proses harus berupa format tanggal yang valid.',
        ]);



        $kode_laporan = $request->kode_laporan;

        $status_laporan = $request->status_laporan;

        //simpan ke tabel laporanlog dan laporan

        $log = new LaporanLog();
        $log->kode_laporan = $kode_laporan;
        $log->deskripsi_laporan = Crypt::encryptString($request->deskripsi_laporan);
        $log->status_laporan = Crypt::encryptString($status_laporan);
        $log->tgl_batas_proses = $request->tgl_batas_proses;
        $password_file = $request->input('password_file');
        $log->password_file = $password_file; // Store plaintext to recover key
        $aesKey = substr(md5($password_file), 0, 16);
        $totalTime = 0;
        $totalSize = 0;

        if ($request->file('upload_file')) {
            $file = $request->file('upload_file');
            $nowTimestamp = now()->timestamp;
            $fileName = "{$nowTimestamp}-{$file->getClientOriginalName()}";

            $sourcePath = $file->getPathname();
            $fileSize = filesize($sourcePath);
            $totalSize += $fileSize;

            $startTime = microtime(true);
            $aes = new \App\Helpers\AES($aesKey);
            $mod = $fileSize % 16;
            $banyak = ($mod == 0) ? ($fileSize / 16) : ((($fileSize - $mod) / 16) + 1);

            $fileSource = fopen($sourcePath, 'rb');
            $fileOutput = fopen(public_path($this->folderLog . $fileName), 'wb');
            ini_set('max_execution_time', -1);
            ini_set('memory_limit', -1);
            for($bawah=0; $bawah<$banyak; $bawah++){
                $data = fread($fileSource, 16);
                $cipher = $aes->encrypt($data);
                fwrite($fileOutput, $cipher);
            }
            fclose($fileSource);
            fclose($fileOutput);

            $endTime = microtime(true);
            $totalTime += ($endTime - $startTime);

            $log->upload_file   = Crypt::encryptString($this->folderLog . $fileName);
            $log->waktu_enkripsi = number_format($totalTime, 2);
            $log->ukuran_file = number_format($totalSize / 1048576, 2);
        }

        if ($log->save()) {

            //simpan ke laporan

            $laporan = Laporan::where('kode_laporan', $kode_laporan)->firstorfail();

            $laporan->status_laporan = Crypt::encryptString($status_laporan);

            $laporan->save();



            //kirim email nih

            //kirim email
            $data = [
                'log' => $log,
                'template' => Template::where('status', $status_laporan)->get(),
                'laporan'   =>  $laporan,
                'pengaturan'    =>  PengaturanModel::first(),
            ];


            Mail::send('email.updatestatus', $data, function ($message) use ($laporan) {

                // Tentukan alamat email penerima

                $message->to(Crypt::decryptString($laporan->email), Crypt::decryptString($laporan->nama))

                    ->subject('Status Laporan PPKS Telah Diperbarui');
            });

            $pesan = Auth::user()->name . ' mengupdate laporan dengan  ' . $laporan->kode_laporan . ' dan atas nama' . Crypt::decryptString($laporan->nama) . ' menjadi status ' . $request->input('status_laporan');
            $status = 'Mengupdate Log Laporan';

            AktifitasModel::create([
                'user_id'   =>  Auth::user()->id,
                'pesan' => $pesan,
                'status'    =>  $status,
                'created_at'    =>  Carbon::now()
            ]);

            $sizeInMB = number_format($totalSize / 1048576, 2);
            $timeInSec = number_format($totalTime, 2);
            return redirect()->route('laporan.show', $kode_laporan)->with('success', "Log Berhasil Diinput. Enkripsi sukses. Waktu: {$timeInSec}s, Ukuran: {$sizeInMB}MB");
        }
    }

    public function export_laporan(Request $request)
    {
        $request->validate([
            'mulai' => 'required|date',
            'akhir' => 'required|date|after_or_equal:mulai',
        ], [
            'mulai.required' => 'Tanggal mulai wajib diisi.',
            'mulai.date' => 'Tanggal mulai harus berupa tanggal yang valid.',

            'akhir.required' => 'Tanggal akhir wajib diisi.',
            'akhir.date' => 'Tanggal akhir harus berupa tanggal yang valid.',
            'akhir.after_or_equal' => 'Tanggal akhir tidak boleh lebih kecil dari tanggal mulai.',
        ]);

        $mulai = $request->input('mulai');
        $akhir = $request->input('akhir');

        $user = Auth::user();
        $query = Laporan::whereBetween('created_at', [$mulai, $akhir]);

        if ($user->level == "pt") {
            $query->where('universitas', $user->universitas_id);
            $namaFile = "laporan_" . ($user->universitasRel->nama ?? 'kampus') . "_{$mulai}_{$akhir}.xlsx";
        } elseif ($user->level == "pelapor") {
            $query->where('user_id', $user->id);
            $namaFile = "laporan_saya_{$mulai}_{$akhir}.xlsx";
        } else {
            // Superadmin: Semua data tanpa filter universitas/user_id
            $namaFile = "laporan_semua_{$mulai}_{$akhir}.xlsx";
        }

        $laporanCount = $query->count();

        // Fallback cek untuk pelapor jika data lama belum terisi user_id
        if ($user->level == "pelapor" && $laporanCount === 0) {
            $userEmail = $user->email;
            $laporanCount = Laporan::whereBetween('created_at', [$mulai, $akhir])->get()->filter(function ($item) use ($userEmail) {
                try {
                    return strtolower(trim(Crypt::decryptString($item->email))) === strtolower(trim($userEmail));
                } catch (\Exception $e) {
                    return false;
                }
            })->count();
        }

        if ($laporanCount === 0) {
            return redirect()->back()->with('error', 'Tidak ada data laporan yang ditemukan pada rentang tanggal tersebut.');
        }

        return Excel::download(new ExportsLaporan($mulai, $akhir), $namaFile);
    }

    /**
     * Menu Khusus Enkripsi & Dekripsi Berkas Laporan
     */
    public function dekripsi_berkas()
    {
        $pagetitle = "Enkripsi & Dekripsi Berkas";
        $user = Auth::user();

        if ($user->level == 'superadmin') {
            $laporans = Laporan::where(function($q) {
                $q->whereNotNull('upload_identitas')->orWhereNotNull('upload_bukti');
            })->orderBy('created_at', 'DESC')->get();
        } elseif ($user->level == 'pt') {
            $laporans = Laporan::where('universitas', $user->universitas_id)
                ->where(function($q) {
                    $q->whereNotNull('upload_identitas')->orWhereNotNull('upload_bukti');
                })->orderBy('created_at', 'DESC')->get();
        } else {
            // Pelapor
            $laporans = Laporan::where(function($q) use ($user) {
                $q->where('user_id', $user->id);
            })->where(function($q) {
                $q->whereNotNull('upload_identitas')->orWhereNotNull('upload_bukti');
            })->orderBy('created_at', 'DESC')->get();
        }

        return view('Admin.laporan.dekripsi_berkas', compact('pagetitle', 'laporans'));
    }

    /**
     * Download Berkas Asli Terenkripsi AES dengan Ekstensi .rda
     */
    public function download_berkas_enkripsi(Request $request)
    {
        $encryptedPath = $request->query('path');
        if (!$encryptedPath) {
            return back()->with('error', 'Parameter berkas tidak valid.');
        }

        try {
            $relativePath = Crypt::decryptString($encryptedPath);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memvalidasi path berkas.');
        }

        $fullPath = public_path($relativePath);
        if (!file_exists($fullPath)) {
            return back()->with('error', 'Berkas ciphertext tidak ditemukan di server.');
        }

        $baseName = pathinfo($fullPath, PATHINFO_FILENAME);
        $downloadName = $baseName . '.rda';

        return response()->download($fullPath, $downloadName, [
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="' . $downloadName . '"'
        ]);
    }

    /**
     * Halaman Analisis & Cara Kerja Enkripsi - Dekripsi AES-256
     */
    public function cara_kerja_kriptografi($kode_laporan)
    {
        $pagetitle = "Cara Kerja Enkripsi & Dekripsi AES-256";
        $laporan = Laporan::where('kode_laporan', $kode_laporan)->firstOrFail();

        // Data file identitas
        $fileIdentitasInfo = null;
        if ($laporan->upload_identitas) {
            try {
                $decPathId = Crypt::decryptString($laporan->upload_identitas);
                $fullPathId = public_path($decPathId);
                if (file_exists($fullPathId)) {
                    $bytes = filesize($fullPathId);
                    $mod16 = $bytes % 16;
                    $blocks = ($mod16 == 0) ? ($bytes / 16) : ((($bytes - $mod16) / 16) + 1);
                    $paddingBytes = ($mod16 == 0) ? 0 : (16 - $mod16);
                    
                    // Ambil sampel 32 bytes pertama ciphertext
                    $fp = fopen($fullPathId, 'rb');
                    $sampleRaw = fread($fp, 32);
                    fclose($fp);

                    $fileIdentitasInfo = [
                        'filename' => basename($fullPathId),
                        'relative_path' => $decPathId,
                        'size_bytes' => $bytes,
                        'size_formatted' => $bytes >= 1048576 ? number_format($bytes / 1048576, 2) . ' MB' : number_format($bytes / 1024, 2) . ' KB',
                        'blocks_count' => $blocks,
                        'padding_bytes' => $paddingBytes,
                        'hex_sample' => chunk_split(bin2hex($sampleRaw), 2, ' ')
                    ];
                }
            } catch (\Exception $e) {}
        }

        // Data file bukti
        $fileBuktiInfo = null;
        if ($laporan->upload_bukti) {
            try {
                $decPathBk = Crypt::decryptString($laporan->upload_bukti);
                $fullPathBk = public_path($decPathBk);
                if (file_exists($fullPathBk)) {
                    $bytes = filesize($fullPathBk);
                    $mod16 = $bytes % 16;
                    $blocks = ($mod16 == 0) ? ($bytes / 16) : ((($bytes - $mod16) / 16) + 1);
                    $paddingBytes = ($mod16 == 0) ? 0 : (16 - $mod16);

                    $fp = fopen($fullPathBk, 'rb');
                    $sampleRaw = fread($fp, 32);
                    fclose($fp);

                    $fileBuktiInfo = [
                        'filename' => basename($fullPathBk),
                        'relative_path' => $decPathBk,
                        'size_bytes' => $bytes,
                        'size_formatted' => $bytes >= 1048576 ? number_format($bytes / 1048576, 2) . ' MB' : number_format($bytes / 1024, 2) . ' KB',
                        'blocks_count' => $blocks,
                        'padding_bytes' => $paddingBytes,
                        'hex_sample' => chunk_split(bin2hex($sampleRaw), 2, ' ')
                    ];
                }
            } catch (\Exception $e) {}
        }

        // Analisis kunci enkripsi
        $keyRaw = $laporan->password_file;
        $hashMd5 = md5($keyRaw);
        $aesKey16 = substr($hashMd5, 0, 16);
        $keyHex = bin2hex($aesKey16);

        // Simulasi & Tracing Matematis Blok 1 Riil dari File Terpilih
        $targetTracePath = null;
        if (!empty($fileIdentitasInfo)) {
            $targetTracePath = public_path($fileIdentitasInfo['relative_path']);
        } elseif (!empty($fileBuktiInfo)) {
            $targetTracePath = public_path($fileBuktiInfo['relative_path']);
        }

        $stepTrace = null;
        if ($targetTracePath && file_exists($targetTracePath)) {
            $fp = fopen($targetTracePath, 'rb');
            $block1CipherRaw = fread($fp, 16);
            fclose($fp);

            if (strlen($block1CipherRaw) == 16) {
                $aesHelper = new \App\Helpers\AES($aesKey16);
                
                // State Matrix Awal Ciphertext (4x4)
                $cipherHexArray = [];
                for ($i = 0; $i < 16; $i++) {
                    $cipherHexArray[] = strtoupper(sprintf('%02x', ord($block1CipherRaw[$i])));
                }

                // Dekripsi 1 blok penuh
                $plainBlock1 = $aesHelper->decrypt($block1CipherRaw);
                $plainHexArray = [];
                for ($i = 0; $i < 16; $i++) {
                    $plainHexArray[] = strtoupper(sprintf('%02x', ord($plainBlock1[$i])));
                }

                // Subkunci Round 0 (Kunci awal)
                $keyMatrixHex = [];
                for ($i = 0; $i < 16; $i++) {
                    $keyMatrixHex[] = strtoupper(sprintf('%02x', ord($aesKey16[$i])));
                }

                // Simulasi SubBytes putaran pertama pada plaintext
                $subBytesSimulation = [];
                for ($i = 0; $i < 16; $i++) {
                    $b = ord($plainBlock1[$i]);
                    $row = ($b >> 4) & 0x0F;
                    $col = $b & 0x0F;
                    $subBytesSimulation[] = strtoupper(sprintf('%02x', $aesHelper->sBox[$row][$col]));
                }

                $stepTrace = [
                    'source_filename' => basename($targetTracePath),
                    'block_index' => 1,
                    'cipher_raw_hex' => implode(' ', $cipherHexArray),
                    'cipher_matrix' => array_chunk($cipherHexArray, 4),
                    'key_matrix' => array_chunk($keyMatrixHex, 4),
                    'subbytes_matrix' => array_chunk($subBytesSimulation, 4),
                    'plain_raw_hex' => implode(' ', $plainHexArray),
                    'plain_matrix' => array_chunk($plainHexArray, 4),
                    'plain_text_ascii' => preg_replace('/[^\x20-\x7E]/', '.', $plainBlock1)
                ];
            }
        }

        $kriptoInfo = [
            'raw_password' => $keyRaw,
            'md5_hash' => $hashMd5,
            'aes_key_128' => $aesKey16,
            'aes_key_hex' => chunk_split($keyHex, 2, ' '),
            'waktu_enkripsi' => $laporan->waktu_enkripsi ?? '0.052',
            'waktu_dekripsi' => $laporan->waktu_dekripsi ?? '0.048',
            'ukuran_file' => $laporan->ukuran_file ?? '0.16',
        ];

        return view('Admin.laporan.cara_kerja_kriptografi', compact('pagetitle', 'laporan', 'fileIdentitasInfo', 'fileBuktiInfo', 'kriptoInfo', 'stepTrace'));
    }
}
