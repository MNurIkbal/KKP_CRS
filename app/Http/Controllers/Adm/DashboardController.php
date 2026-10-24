<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Laporan;
use App\Models\NotifBulanAdminModel;
use App\Models\NotifBulanModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class DashboardController extends Controller
{
    public function index()
    {
        $pagetitle = "Dashboard";
        
        if (Auth::user()->level == 'superadmin') {
            $grafik = NotifBulanAdminModel::all();

            $allLaporan = Laporan::with(['universitasRel', 'kekerasan'])->get();
            $laporanmasuk = $allLaporan->count();

            $laporanselesai = $allLaporan->filter(function ($laporan) {
                try {
                    return Crypt::decryptString($laporan->status_laporan) == 'Selesai';
                } catch (\Exception $e) { return false; }
            })->count();

            $laporanbelumselesai = $allLaporan->filter(function ($laporan) {
                try {
                    return Crypt::decryptString($laporan->status_laporan) == 'Laporan tidak sesuai dengan tindak kekerasan';
                } catch (\Exception $e) { return false; }
            })->count();

            $laporandiproses = $allLaporan->filter(function ($laporan) {
                try {
                    $st = Crypt::decryptString($laporan->status_laporan);
                    return $st != 'Selesai' && $st != 'Laporan tidak sesuai dengan tindak kekerasan';
                } catch (\Exception $e) { return false; }
            })->count();

            // Total PT terdaftar
            $totalUniv = \App\Models\Universitas::count();

            // Total Berkas Terenkripsi AES
            $totalBerkasTerenkripsi = $allLaporan->filter(function ($item) {
                return !empty($item->upload_identitas) || !empty($item->upload_bukti);
            })->count();

            // Tren bulanan 6 bulan terakhir global
            $months = collect([]);
            for ($i = 5; $i >= 0; $i--) {
                $m = Carbon::now()->subMonths($i)->format('Y-m');
                $mLabel = Carbon::now()->subMonths($i)->translatedFormat('M Y');
                $count = $allLaporan->filter(function ($item) use ($m) {
                    return Carbon::parse($item->created_at)->format('Y-m') === $m;
                })->count();
                $countSelesai = $allLaporan->filter(function ($item) use ($m) {
                    try {
                        return Carbon::parse($item->created_at)->format('Y-m') === $m && Crypt::decryptString($item->status_laporan) == 'Selesai';
                    } catch (\Exception $e) { return false; }
                })->count();

                $months->push([
                    'bulan' => $mLabel,
                    'total' => $count,
                    'selesai' => $countSelesai
                ]);
            }
            $superadminMonthly = $months;

            // Sebaran jenis kekerasan global
            $kekerasanCounts = [];
            foreach ($allLaporan as $lp) {
                $namaKekerasan = $lp->kekerasan->tipe_kekerasan ?? 'Lainnya';
                if (!isset($kekerasanCounts[$namaKekerasan])) {
                    $kekerasanCounts[$namaKekerasan] = 0;
                }
                $kekerasanCounts[$namaKekerasan]++;
            }

            // Status counts untuk donut chart
            $statusCounts = [
                'Diproses' => $laporandiproses,
                'Selesai'  => $laporanselesai,
                'Ditolak'  => $laporanbelumselesai,
            ];

            // 5 Laporan terbaru
            $recentLaporan = $allLaporan->sortByDesc('created_at')->take(6);
        } elseif (Auth::user()->level == "pt") {
            $univ_id = Auth::user()->universitas_id;
            $ptLaporan = Laporan::where('universitas', $univ_id)->get();
            $laporanmasuk = $ptLaporan->count();

            $laporanselesai = $ptLaporan->filter(function ($laporan) {
                try {
                    return Crypt::decryptString($laporan->status_laporan) == 'Selesai';
                } catch (\Exception $e) { return false; }
            })->count();

            $laporanbelumselesai = $ptLaporan->filter(function ($laporan) {
                try {
                    return Crypt::decryptString($laporan->status_laporan) == 'Laporan tidak sesuai dengan tindak kekerasan';
                } catch (\Exception $e) { return false; }
            })->count();

            $laporandiproses = $ptLaporan->filter(function ($laporan) {
                try {
                    $st = Crypt::decryptString($laporan->status_laporan);
                    return $st != 'Selesai' && $st != 'Laporan tidak sesuai dengan tindak kekerasan';
                } catch (\Exception $e) { return false; }
            })->count();

            // Tren bulanan 6 bulan terakhir universitas
            $months = collect([]);
            for ($i = 5; $i >= 0; $i--) {
                $m = Carbon::now()->subMonths($i)->format('Y-m');
                $mLabel = Carbon::now()->subMonths($i)->translatedFormat('M Y');
                $count = $ptLaporan->filter(function ($item) use ($m) {
                    return Carbon::parse($item->created_at)->format('Y-m') === $m;
                })->count();
                $months->push([
                    'bulan' => $mLabel,
                    'total' => $count
                ]);
            }
            $ptMonthly = $months;

            // Sebaran jenis kekerasan
            $kekerasanCounts = [];
            foreach ($ptLaporan as $lp) {
                $namaKekerasan = $lp->kekerasan->tipe_kekerasan ?? 'Lainnya';
                if (!isset($kekerasanCounts[$namaKekerasan])) {
                    $kekerasanCounts[$namaKekerasan] = 0;
                }
                $kekerasanCounts[$namaKekerasan]++;
            }

            // Status counts untuk donut chart
            $statusCounts = [
                'Diproses' => $laporandiproses,
                'Selesai'  => $laporanselesai,
                'Ditolak'  => $laporanbelumselesai,
            ];

            $recentLaporan = $ptLaporan->sortByDesc('created_at')->take(5);
            $namaUniv = Auth::user()->universitasRel->nama ?? 'Kampus Anda';

            $grafik = NotifBulanModel::where('universitas_id', $univ_id)->get();
        } elseif (Auth::user()->level == 'pelapor') {
            $userId = Auth::id();
            $userEmail = Auth::user()->email;
            $myLaporan = Laporan::where('user_id', $userId)->get();
            if ($myLaporan->isEmpty()) {
                $myLaporan = Laporan::all()->filter(function ($item) use ($userId, $userEmail) {
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
            $laporanmasuk = $myLaporan->count();
            $laporanselesai = $myLaporan->filter(function ($laporan) {
                try {
                    return Crypt::decryptString($laporan->status_laporan) == 'Selesai';
                } catch (\Exception $e) { return false; }
            })->count();
            $laporanbelumselesai = $myLaporan->filter(function ($laporan) {
                try {
                    return Crypt::decryptString($laporan->status_laporan) == 'Laporan tidak sesuai dengan tindak kekerasan';
                } catch (\Exception $e) { return false; }
            })->count();
            $laporandiproses = $myLaporan->filter(function ($laporan) {
                try {
                    $st = Crypt::decryptString($laporan->status_laporan);
                    return $st != 'Selesai' && $st != 'Laporan tidak sesuai dengan tindak kekerasan';
                } catch (\Exception $e) { return false; }
            })->count();

            // Data tren bulanan 6 bulan terakhir untuk pelapor
            $months = collect([]);
            for ($i = 5; $i >= 0; $i--) {
                $m = Carbon::now()->subMonths($i)->format('Y-m');
                $mLabel = Carbon::now()->subMonths($i)->translatedFormat('M Y');
                $count = $myLaporan->filter(function ($item) use ($m) {
                    return Carbon::parse($item->created_at)->format('Y-m') === $m;
                })->count();
                $months->push([
                    'bulan' => $mLabel,
                    'total' => $count
                ]);
            }
            $pelaporMonthly = $months;

            // Status counts untuk donut chart
            $statusCounts = [
                'Diproses' => $laporandiproses,
                'Selesai'  => $laporanselesai,
                'Ditolak'  => $laporanbelumselesai,
            ];

            $recentLaporan = $myLaporan->sortByDesc('created_at')->take(5);

            $grafik = collect([]);
        } else {

            $univ_id = Auth::user()->universitas_id;
            $laporanmasuk =  Laporan::where('mitra','!=',null)->get()->count();
            $laporanselesai = Laporan::where('mitra','!=',null)->get()->filter(function ($laporan) {
                return Crypt::decryptString($laporan->status_laporan) == 'Selesai';
            })->count();
            $laporanbelumselesai = Laporan::where('mitra','!=',null)->get()->filter(function ($laporan) {
                return Crypt::decryptString($laporan->status_laporan) == 'Laporan tidak sesuai dengan tindak kekerasan';
            })->count();
        }
        $pelaporMonthly = $pelaporMonthly ?? collect([]);
        $ptMonthly = $ptMonthly ?? collect([]);
        $superadminMonthly = $superadminMonthly ?? collect([]);
        $statusCounts = $statusCounts ?? [];
        $kekerasanCounts = $kekerasanCounts ?? [];
        $recentLaporan = $recentLaporan ?? collect([]);
        $laporandiproses = $laporandiproses ?? 0;
        $totalUniv = $totalUniv ?? 0;
        $totalBerkasTerenkripsi = $totalBerkasTerenkripsi ?? 0;
        $namaUniv = $namaUniv ?? '';

        return view('Admin/dashboard', compact(
            'laporanmasuk',
            'laporanselesai',
            'laporanbelumselesai',
            'laporandiproses',
            'totalUniv',
            'totalBerkasTerenkripsi',
            'pagetitle',
            'grafik',
            'pelaporMonthly',
            'ptMonthly',
            'superadminMonthly',
            'statusCounts',
            'kekerasanCounts',
            'recentLaporan',
            'namaUniv'
        ));
    }
}
