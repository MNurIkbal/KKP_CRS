<?php

namespace App\Console\Commands;

use App\Models\Laporan;
use App\Models\LaporanLog;
use App\Models\PengaturanModel;
use App\Models\Template;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class KirimNotif extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:kirim';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kirim Email Notif ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $laporan = Laporan::all()->filter(function ($item) {
        //     $status = Crypt::decryptString($item->status_laporan);
        //     return !in_array($status, ['Selesai', 'Ditolak']);
        // });
        // if(count($laporan)) {
        //     foreach($laporan as $row) {
                
        //         $logs_akhir = LaporanLog::where('kode_laporan', $row->kode_laporan)->orderby('created_at', 'DESC')->first();
        //         $checs = Crypt::decryptString($logs_akhir->status_laporan);
                
        //         if ($checs == "Selesai") {
        //         } elseif ($checs == "Ditolak") {
        //         } else {
        //             $akhir = date("Y-m-d", strtotime($logs_akhir->tgl_batas_proses));
                    
        //             if (date("Y-m-d") > $akhir) {
        //                 $lap = Laporan::where("kode_laporan", $row->kode_laporan)->first();
        //                 $data = [
        //                     'log' => $logs_akhir,
        //                     'template' => Template::where('status', $checs)->get(),
        //                     'laporan'   => $lap,
        //                     'pengaturan'    =>  PengaturanModel::first(),
        //                 ];
    
        //                 $kategori = Crypt::decryptString($row->kategori);
        //                 if($kategori == "Mitra") {
        //                     $instansi_bekerja = Crypt::decryptString($row->instansi_bekerja);
    
        //                 } else {
        //                     $universitas = $row->universitas;
        //                     $user = User::where('universitas_id',$universitas)->where('status','Aktif')->get();
        //                 }
    
        //                 if(count($user)) {
        //                     foreach($user as $raw) {
                                
        //                         Mail::send('email.expired', $data, function ($message) use ($lap) {
        //                             // Tentukan alamat email penerima
        //                             $message->to($raw->email, Crypt::decryptString($lap->nama))
        //                                 ->subject('Proses Penanganan Laporan Melampaui Batas');
        //                         });
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // }

        $laporan = Laporan::all()->filter(function ($item) {
            $status = Crypt::decryptString($item->status_laporan);
            return !in_array($status, ['Selesai', 'Ditolak']);
        });
        
        if ($laporan->count()) {
            foreach ($laporan as $row) {
        
                $logs_akhir = LaporanLog::where('kode_laporan', $row->kode_laporan)
                                ->orderBy('created_at', 'DESC')
                                ->first();
        
                if (!$logs_akhir) continue;
        
                $checs = Crypt::decryptString($logs_akhir->status_laporan ?? '');
        
                if (!in_array($checs, ['Selesai', 'Ditolak'])) {
        
                    $akhir = date("Y-m-d", strtotime($logs_akhir->tgl_batas_proses));
        
                    if (date("Y-m-d") > $akhir) {
        
                        $lap = Laporan::where("kode_laporan", $row->kode_laporan)->first();
        
                        $data = [
                            'log'        => $logs_akhir,
                            'template'   => Template::where('status', $checs)->get(),
                            'laporan'    => $lap,
                            'pengaturan' => PengaturanModel::first(),
                        ];
        
                        $kategori = Crypt::decryptString($row->kategori ?? '');
        
                        if ($kategori === "Mitra") {
                            // Jika mitra, ambil user berdasarkan instansi
                            $instansi_bekerja = Crypt::decryptString($row->instansi_bekerja ?? '');
                            $user = User::where('instansi_bekerja', $instansi_bekerja)->where('status', 'Aktif')->limit(5)->get();
                        } else {
                            // Jika mahasiswa, ambil berdasarkan universitas
                            $universitas = $row->universitas;
                            $user = User::where('universitas_id', $universitas)->where('status', 'Aktif')->limit(5)->get();
                        }
        
                        if ($user->count()) {
                            foreach ($user as $raw) {
                                Mail::send('email.expired', $data, function ($message) use ($raw, $lap) {
                                    $message->to($raw->email, Crypt::decryptString($lap->nama ?? 'User'))
                                            ->subject('Proses Penanganan Laporan Melampaui Batas');
                                });
                            }
                        }
                    }
                }
            }
        }
        
    }
}
