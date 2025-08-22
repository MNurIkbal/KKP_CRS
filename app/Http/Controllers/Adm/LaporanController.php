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

        $template = Template::where('status', 'Laporan tidak sesuai dengan tindak kekerasan')->first();
        $status = $template->status;

        $laporan = Laporan::where('id', $id)->first();

        $log = new LaporanLog();
        $log->kode_laporan = $laporan->kode_laporan;
        $log->deskripsi_laporan = Crypt::encryptString($template->deskripsi_status);
        $log->status_laporan = Crypt::encryptString($template->status);
        $log->tgl_batas_proses = Carbon::now()->addDays(7);
        $log->save();

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

        Mail::send('email.updatestatus', $data, function ($message) use ($laporan) {
            // Tentukan alamat email penerima
            $message->to(Crypt::decryptString($laporan->email), Crypt::decryptString($laporan->nama))
                ->subject('Status Laporan PPKS Telah Diperbarui');
        });

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
        } else {
            $laporan = Laporan::where('merge_laporan_id', null)->where('mitra', "Mitra")->orderby('created_at', 'DESC')->get();
        }

        return view('Admin.laporan.index', compact('laporan', 'pagetitle'));
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


        PesanModel::create([
            'laporan_id'    => $request->input('id'),
            'nama'  =>  Auth::user()->name,
            'pesan' =>  $request->input('pesan'),
            'status'    =>  'Admin',
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


        return view('Admin.laporan.detail', compact('logs', 'pagetitle', 'laporan', 'statuslaporan', 'chat', 'universitas', 'jenis'));
    }

    public function hapus_logs_laporan(Request $request)
    {
        $id = $request->input('id');
        $lap = LaporanLog::find($id);
        $ma = Laporan::where('kode_laporan',$lap->kode_laporan)->first();
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

        $status = Template::where('status', 'Laporan Di Tinjau Ulang')->first();
        Laporan::where('id', $id)->update([
            'status_laporan'    =>  Crypt::encryptString($status->status),
            'ket'   =>  null,
            'updated_at'    =>  Carbon::now(),
        ]);

        $log = LaporanLog::create([
            'kode_laporan'  =>  $laporan->kode_laporan,
            'tanggal_diubah'    =>  Carbon::now(),
            'status_laporan'    =>  Crypt::encryptString($status->status),
            'deskripsi_laporan'  =>  Crypt::encryptString($status->deskripsi_status),
            'tgl_batas_proses' => Carbon::now()->addDays(7),
            'updated_at'    =>  Carbon::now()
        ]);
        $data = [
            'log' => $log,
            'template' => Template::where('status', $status->status)->get(),
            'pengaturan'    =>  PengaturanModel::first(),
            'laporan'   =>  $laporan
        ];

        Mail::send('email.updatestatus', $data, function ($message) use ($laporan) {

            // Tentukan alamat email penerima
            $message->to(Crypt::decryptString($laporan->email), Crypt::decryptString($laporan->nama))
                ->subject('Status Laporan PPKS Telah Diperbarui');
        });

        return redirect()->back()->with('success', 'Data Berhasil Diupdate');
    }

    public function update_status_laporan($status_laporan, $kode_laporan)
    {

        $laporan = Laporan::where('kode_laporan', $kode_laporan)->firstorfail();
        $template = Template::where('status', 'Laporan tidak sesuai dengan tindak kekerasan')->first();
        $template_dua = Template::where('status', 'Sedang diverifikasi')->first();
        if ($status_laporan == 1) {
            $status = $template_dua->status;
            $log = new LaporanLog();

            $log->kode_laporan = $kode_laporan;

            $log->deskripsi_laporan = Crypt::encryptString($template_dua->deskripsi_status);

            $log->status_laporan = Crypt::encryptString($template_dua->status);

            $log->tgl_batas_proses = Carbon::now()->addDays(7);
            $log->save();
        } else {
            $status = $template->status;
            $log = new LaporanLog();

            $log->kode_laporan = $kode_laporan;

            $log->deskripsi_laporan = Crypt::encryptString($template->deskripsi_status);

            $log->status_laporan = Crypt::encryptString($template->status);

            $log->tgl_batas_proses = Carbon::now()->addDays(7);
            $log->save();
        }

        $laporan->status_laporan = Crypt::encryptString($status);

        $laporan->save();

        $data = [
            'log' => $log,
            'template' => Template::where('status', $status_laporan)->get(),
            'pengaturan'    =>  PengaturanModel::first(),
            'laporan'   =>  $laporan
        ];

        Mail::send('email.updatestatus', $data, function ($message) use ($laporan) {

            // Tentukan alamat email penerima
            $message->to(Crypt::decryptString($laporan->email), Crypt::decryptString($laporan->nama))
                ->subject('Status Laporan PPKS Telah Diperbarui');
        });

        // log
        if ($status_laporan == 1) {
            $pesan = Auth::user()->name . ' menerima laporan dengan kode laporan ' . $laporan->kode_laporan . ' dan atas nama' . Crypt::decryptString($laporan->nama);
            $status = 'Menerima Laporan Masuk';
        } else {
            $pesan = Auth::user()->name . ' tidak menyetujui laporan ini karena laporan tidak sesuai dengan tindak kekerasan dengan kode laporan ' . $laporan->kode_laporan . ' dan atas nama' . Crypt::decryptString($laporan->nama);
            $status = 'Laporan tidak sesuai dengan tindak kekerasan';
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
        if ($request->file('upload_file')) {
            $file = $request->file('upload_file');
            $nowTimestamp = now()->timestamp;
            $fileName = "{$nowTimestamp}-{$file->getClientOriginalName()}";

            $file->move($this->folderLog, $fileName);

            $log->upload_file   = Crypt::encryptString($this->folderLog . $fileName);
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

            return redirect()->route('laporan.show', $kode_laporan)->with('success', 'Log Berhasil Diinput');
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

        $level = Auth::user()->level;
        if($level == "pt") {
            $laporan = Laporan::whereBetween('created_at', [$mulai, $akhir])->count();
        } else {
            $laporan = Laporan::whereBetween('created_at', [$mulai, $akhir])->count();
        }

        if (!$laporan) {
            return redirect()->back()->with('error', 'Data Tidak Ada');
        }

        return Excel::download(new ExportsLaporan($mulai, $akhir), "laporan $mulai - $akhir .xlsx");
    }
}
