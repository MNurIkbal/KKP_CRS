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
        } else {

            $univ_id = Auth::user()->universitas_id;
            $laporanmasuk =  Laporan::where('mitra','!=',null)->get()->count();
            $laporanselesai = Laporan::where('mitra','!=',null)->get()->filter(function ($laporan) {
                return Crypt::decryptString($laporan->status_laporan) == 'Selesai';
            })->count();
            $laporanbelumselesai = Laporan::where('mitra','!=',null)->get()->filter(function ($laporan) {
                return Crypt::decryptString($laporan->status_laporan) == 'Laporan tidak sesuai dengan tindak kekerasan';
            })->count();
            $grafik = NotifBulanModel::where('universitas_id',"Mitra")->get();
        }
        return view('Admin/dashboard', compact('laporanmasuk', 'laporanselesai', 'laporanbelumselesai', 'pagetitle', 'grafik'));
    }
}
