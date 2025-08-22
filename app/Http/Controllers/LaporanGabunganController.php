<?php

namespace App\Http\Controllers;

use App\Models\AktifitasModel;
use App\Models\Kekerasan;
use App\Models\Laporan;
use App\Models\LaporanLog;
use App\Models\MergeLaporanModel;
use App\Models\PengaturanModel;
use App\Models\PesanModel;
use App\Models\Template;
use App\Models\Universitas;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class LaporanGabunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->pagetitle = "Laporan Gabungan";

        $this->folderLog = "uploads/logs/";
    }

    public function index()
    {
        $pagetitle = "$this->pagetitle";
        if (Auth::user()->level == "pt") {
            $universitas = Auth::user()->universitas_id;
            $laporan = MergeLaporanModel::where('universitas_id', $universitas)->orderby('id', 'DESC')->get();
        } else {
            $laporan = MergeLaporanModel::orderby('id', 'DESC')->get();
        }
        $status = Template::all();

        return view('Admin.gabung_laporan.index', compact('laporan', 'pagetitle', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pagetitle = $this->pagetitle;
        if (Auth::user()->level == "pt") {
            $universitas = Auth::user()->universitas_id;
            $laporanselesai = Laporan::whereNull('merge_laporan_id')
                ->where('universitas', $universitas)
                ->get()
                ->filter(function ($laporan) {
                    $status = Crypt::decryptString($laporan->status_laporan);
                    $kategori = Crypt::decryptString($laporan->kategori);
                    return !in_array($status, ['Diterima', 'Laporan tidak sesuai dengan tindak kekerasan']) && in_array($kategori, ['Dosen/Tenaga Pendidik', 'Mahasiswa']);
                });
        } else {
            $laporanselesai = Laporan::whereNull('merge_laporan_id')
                ->get()
                ->filter(function ($laporan) {
                    $status = Crypt::decryptString($laporan->status_laporan);
                    $kategori = Crypt::decryptString($laporan->kategori);
                    return !in_array($status, ['Diterima', 'Laporan tidak sesuai dengan tindak kekerasan']) && in_array($kategori, ['Dosen/Tenaga Pendidik', 'Mahasiswa']);
                });
        }

        $status = Template::all();

        return view('Admin.gabung_laporan.tambah', compact('pagetitle', 'laporanselesai', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'  =>  'required',
            'laporan'   =>  'required',
            'deskripsi' =>  'required',
            'status'    =>  'required'
        ], [
            'nama.required'  => 'Nama Harus Diisi',
            'laporan.required'  =>  'Laporan Harus Diisi',
            'deskripsi.required' =>  'Deskripsi Harus Diisi',
            'status.required'    =>  'Status Harus Diisi'
        ]);

        $laporan = $request->input('laporan');
        if (count($laporan) < 2) {
            return redirect()->back()->with('error', 'Laporan Minimal 2');
        }
        if (count($laporan) == 20) {
            return redirect()->back()->with('error', 'Laporan Maksimal 20');
        }

        $check_status = Template::where('status', $request->input('status'))->first();
        $status = Crypt::encryptString($request->input('status'));
        if (count($laporan)) {
            $nama = $request->input('nama');
            if (Auth::user()->level == "pt") {
                MergeLaporanModel::create([
                    'nama'  =>  Crypt::encryptString($nama),
                    'status' => $status,
                    'deskripsi' => Crypt::encryptString($request->input('deskripsi')),
                    'universitas_id'   =>  Auth::user()->universitas_id,
                    'created_at'    =>  Carbon::now()
                ]);
            } else {
                MergeLaporanModel::create([
                    'nama'  =>  Crypt::encryptString($nama),
                    'status' => $status,
                    'deskripsi' => Crypt::encryptString($request->input('deskripsi')),
                    'created_at'    =>  Carbon::now()
                ]);
            }

            $akhir = MergeLaporanModel::orderby('id', 'DESC')->first();
            foreach ($laporan as $row) {
                Laporan::where('id', $row)->update([
                    'status_laporan' => $status,
                    'merge_laporan_id' =>  $akhir->id,
                    'updated_at'    =>  Carbon::now()
                ]);

                $laporans = Laporan::where('id', $row)->first();

                $log = new LaporanLog();
                $log->kode_laporan = $laporans->kode_laporan;
                $log->deskripsi_laporan = Crypt::encryptString($check_status->deskripsi);
                $log->status_laporan = $status;
                $log->tgl_batas_proses = Carbon::now()->addDays(7);
                $log->save();

                $data = [
                    'log' => $log,
                    'template' => Template::where('status', $request->input('status'))->get(),
                    'pengaturan'    =>  PengaturanModel::first(),
                    'laporan'   =>  $laporans
                ];

                Mail::send('email.updatestatus', $data, function ($message) use ($laporans) {

                    // Tentukan alamat email penerima
                    $message->to(Crypt::decryptString($laporans->email), Crypt::decryptString($laporans->nama))
                        ->subject('Status Laporan PPKS Telah Diperbarui');
                });
            }
        }

        $pesan = Auth::user()->name . ' membuat laporan gabungan sebaganyak ' . count($laporan) . ' dalam pengerjaan dengan status ' . $request->input('status');
        $status = 'Membuat Laporan Gabungan';
        AktifitasModel::create([
            'user_id'   =>  Auth::user()->id,
            'pesan' => $pesan,
            'status'    =>  $status,
            'created_at'    =>  Carbon::now()
        ]);

        return redirect()->to('adm/laporan_gabungan')->with('success', 'Data Berhasil Di Gabung');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $id = Crypt::decryptString($id);
        $laporan = MergeLaporanModel::find($id);
        if (!$laporan) {
            return abort(404);
        }

        $pagetitle = "$this->pagetitle";
        $detail_laporan = Laporan::where('merge_laporan_id', $id)->get();

        $first_laporan =  Laporan::where('merge_laporan_id', $id)->first();
        $statuslaporan = Template::all();
        return view('Admin.gabung_laporan.detail', compact('laporan', 'pagetitle', 'statuslaporan', 'detail_laporan', 'first_laporan', 'id'));
        } catch (\Throwable $th) {
            return abort(404);
        }
    }

    public function update_tinjau_ulang($id)
    {
        $id=  Crypt::decryptString($id);
        $laporan = MergeLaporanModel::where('id', $id)->get()->first(function ($item) {
            try {
                $status = Crypt::decryptString($item->status);
                return in_array($status, [
                    'Selesai',
                    'Laporan tidak sesuai dengan tindak kekerasan'
                ]);
            } catch (DecryptException $e) {
                return false;
            }
        });
        if (!$laporan) {
            return abort(404);
        }

        $status = Template::where('status', 'Laporan Di Tinjau Ulang')->first();
        MergeLaporanModel::where('id', $id)->update([
            'status'    =>      Crypt::encryptString($status->status),
            'updated_at'    =>  Carbon::now()
        ]);

        Laporan::where('merge_laporan_id', $id)->update([
            'status_laporan'    =>  Crypt::encryptString($status->status),
            'updated_at'    =>  Carbon::now()
        ]);

        $lapor = Laporan::where('merge_laporan_id', $id)->get();
        if ($lapor) {
            foreach ($lapor as $row) {
                $log = LaporanLog::create([
                    'kode_laporan'  =>  $row->kode_laporan,
                    'tanggal_diubah'    =>  Carbon::now(),
                    'status_laporan'    =>  Crypt::encryptString($status->status),
                    'deskripsi_laporan' =>  Crypt::encryptString($status->deskripsi_status),
                    'tgl_batas_proses' => Carbon::now()->addDays(7),
                    'created_at'    =>  Carbon::now()
                ]);

                $data = [
                    'log' => $log,
                    'template' => Template::where('status', $status->status)->get(),
                    'laporan' => $row,
                    'pengaturan' => PengaturanModel::first(),
                ];

                Mail::send('email.updatestatus', $data, function ($message) use ($row) {
                    $message->to(
                        Crypt::decryptString($row->email),
                        Crypt::decryptString($row->nama)
                    )->subject('Status Laporan PPKS Telah Diperbarui');
                });
            }
        }
        return redirect()->back()->with('success','Data Berhasil Diupdate');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function pendamping_gabung(Request $request)
    {
        $request->validate([
            'merge_laporan_id' => 'required',
            'nama'             => 'required',
            'no_hp'            => 'required'
        ], [
            'merge_laporan_id.required' => 'Laporan yang ingin digabung wajib dipilih.',
            'nama.required'             => 'Nama wajib diisi.',
            'no_hp.required'            => 'Nomor HP wajib diisi.',
        ]);


        Laporan::where('merge_laporan_id', $request->input('merge_laporan_id'))->update([
            'nama_pendamping'   =>  Crypt::encryptString($request->input('nama')),
            'no_wa_pendamping'  =>  Crypt::encryptString($request->input('no_hp'))
        ]);

        $lapor = MergeLaporanModel::find($request->input('merge_laporan_id'));

        $pesan = Auth::user()->name . ' menambahkan pendamping untuk laporan gabungan dengan nama ' . Crypt::decryptString($lapor->nama) . ',atas nama pendamping  ' . $request->input('nama') . ' dan no wa' . $request->input('no_hp');
        $status = 'Menambahkan Pendamping Di Laporan Gabungan';
        AktifitasModel::create([
            'user_id'   =>  Auth::user()->id,
            'pesan' => $pesan,
            'status'    =>  $status,
            'created_at'    =>  Carbon::now()
        ]);
        return redirect()->back()->with('success', 'Pendamping Berhasil Ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     */
    public function kirim_log(Request $request)
    {

        $request->validate([
            'status_laporan'    => 'required',
            'upload_file'       => 'mimes:jpeg,jpg,png,pdf,zip,mp4,mp3|max:20024',
            'deskripsi_laporan' => 'required',
            'tgl_batas_proses'  => 'required|date',
            'merge_laporan_id'  => 'required'
        ], [
            'status_laporan.required'     => 'Status laporan wajib diisi.',
            'upload_file.mimes'           => 'File harus berupa jpeg, jpg, png, pdf, zip, mp4, atau mp3.',
            'upload_file.max'             => 'Ukuran file maksimal 20 MB.',
            'deskripsi_laporan.required'  => 'Deskripsi laporan wajib diisi.',
            'tgl_batas_proses.required'   => 'Tanggal batas proses wajib diisi.',
            'tgl_batas_proses.date'       => 'Tanggal batas proses harus berupa format tanggal yang valid.',
            'merge_laporan_id.required'   => 'Laporan yang ingin digabung wajib dipilih.',
        ]);


        $report = Laporan::where('merge_laporan_id', $request->input('merge_laporan_id'))->get();
        $status_laporan = $request->status_laporan;
        if (count($report)) {

            $fileNameEncrypted = null;

            if ($request->hasFile('upload_file')) {
                $file = $request->file('upload_file');
                $nowTimestamp = now()->timestamp;
                $fileName = "{$nowTimestamp}-{$file->getClientOriginalName()}";

                // Pindahkan file hanya sekali
                $file->move($this->folderLog, $fileName);

                // Simpan path terenkripsi
                $fileNameEncrypted = Crypt::encryptString($this->folderLog . $fileName);
            }

            foreach ($report as $row) {
                $kode_laporan = $row->kode_laporan;

                $log = new LaporanLog();
                $log->kode_laporan = $kode_laporan;
                $log->deskripsi_laporan = Crypt::encryptString($request->deskripsi_laporan);
                $log->status_laporan = Crypt::encryptString($status_laporan);
                $log->tgl_batas_proses = $request->tgl_batas_proses;

                if ($fileNameEncrypted) {
                    $log->upload_file = $fileNameEncrypted;
                }

                if ($log->save()) {
                    // update laporan
                    $laporan = Laporan::where('kode_laporan', $kode_laporan)->firstOrFail();
                    $laporan->status_laporan = Crypt::encryptString($status_laporan);
                    $laporan->save();

                    // Kirim email
                    $data = [
                        'log' => $log,
                        'template' => Template::where('status', $status_laporan)->get(),
                        'laporan' => $laporan,
                        'pengaturan' => PengaturanModel::first(),
                    ];

                    Mail::send('email.updatestatus', $data, function ($message) use ($laporan) {
                        $message->to(
                            Crypt::decryptString($laporan->email),
                            Crypt::decryptString($laporan->nama)
                        )->subject('Status Laporan PPKS Telah Diperbarui');
                    });
                }
            }
        }

        MergeLaporanModel::where('id', $request->input('merge_laporan_id'))->update([
            'status'    =>  Crypt::encryptString($request->input('status_laporan')),
            'updated_at'    =>  Carbon::now()
        ]);

        $pesan = Auth::user()->name . ' mengupdate laporan gabungan ' . ' dalam pengerjaan dengan status ' . $request->input('status');
        $status = 'Mengupdate Laporan Gabungan';
        AktifitasModel::create([
            'user_id'   =>  Auth::user()->id,
            'pesan' => $pesan,
            'status'    =>  $status,
            'created_at'    =>  Carbon::now()
        ]);
        return redirect()->back()->with('success', 'Log Berhasil Diinput');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $check = MergeLaporanModel::find($id);
        if (!$check) {
            return abort(404);
        }
        $dua = Laporan::where('merge_laporan_id', $id)->first();
        if ($dua) {
            LaporanLog::where('kode_laporan', $dua->kode_laporan)->delete();
        }
        MergeLaporanModel::where('id', $id)->delete();
        Laporan::where('merge_laporan_id', $id)->delete();
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }

    public function detail_laporan_gabungan($kode,$id)
    {
        try {
            $id = Crypt::decryptString($id);
        $pagetitle = $this->pagetitle;

        $laporan = Laporan::where('kode_laporan', $kode)->firstorfail();

        $logs = LaporanLog::where('kode_laporan', $kode)->orderby('created_at', 'asc')->get();

        //ambil status laporan

        $statuslaporan = Template::get();
        $chat = PesanModel::where('laporan_id', $laporan->id)->get();
        $universitas = Universitas::where('id', $laporan->universitas)->first();
        $jenis = Kekerasan::where('id', $laporan->jenis_kekerasan)->first();
        // kirim email


        return view('Admin.gabung_laporan.detail_laporan', compact('logs', 'pagetitle', 'laporan', 'statuslaporan', 'chat', 'universitas', 'jenis','id'));
        } catch (\Throwable $th) {
            return abort(404);
        }
    }
}
