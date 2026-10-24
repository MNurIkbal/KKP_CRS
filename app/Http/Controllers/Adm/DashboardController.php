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

            
            $laporanmasuk =  Laporan::all()->count();
            $laporanselesai = Laporan::get()->filter(function ($laporan) {
                return Crypt::decryptString($laporan->status_laporan) == 'Selesai';
            })->count();

            $laporanbelumselesai = Laporan::get()->filter(function ($laporan) {
                return Crypt::decryptString($laporan->status_laporan) == 'Laporan tidak sesuai dengan tindak kekerasan';
            })->count();
        } elseif (Auth::user()->level == "pt") {
            $laporanmasuk =  Laporan::where('universitas', Auth::user()->universitas_id)->get()->count();
            $laporanselesai =  Laporan::where('universitas', Auth::user()->universitas_id)->get()->filter(function ($laporan) {
                return Crypt::decryptString($laporan->status_laporan) == 'Selesai';
            })->count();
            $laporanbelumselesai = Laporan::where('universitas', Auth::user()->universitas_id)->get()->filter(function ($laporan) {
                return Crypt::decryptString($laporan->status_laporan) == 'Laporan tidak sesuai dengan tindak kekerasan';
            })->count();
            $grafik = NotifBulanModel::where('universitas_id',Auth::user()->universitas_id)->get();
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
        $statusCounts = $statusCounts ?? [];
        $recentLaporan = $recentLaporan ?? collect([]);
        $laporandiproses = $laporandiproses ?? 0;

        return view('Admin/dashboard', compact(
            'laporanmasuk',
            'laporanselesai',
            'laporanbelumselesai',
            'laporandiproses',
            'pagetitle',
            'grafik',
            'pelaporMonthly',
            'statusCounts',
            'recentLaporan'
        ));
    }
}
