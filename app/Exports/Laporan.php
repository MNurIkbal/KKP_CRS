<?php

namespace App\Exports;

use App\Models\Laporan as ModelsLaporan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class Laporan implements FromView,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $mulai;
    protected $akhir;

    public function __construct($mulai, $akhir)
    {
        $this->mulai = $mulai;
        $this->akhir = $akhir;
    }

    public function view(): View
    {
        $user = auth()->user();
        $query = ModelsLaporan::whereBetween('created_at', [$this->mulai, $this->akhir]);

        if ($user && $user->level == 'pt') {
            // Khusus admin perguruan tinggi, hanya ambil laporan dari kampusnya
            $query->where('universitas', $user->universitas_id);
        } elseif ($user && $user->level == 'pelapor') {
            // Khusus pelapor, hanya ambil laporannya sendiri
            $userId = $user->id;
            $userEmail = $user->email;
            $query->where(function ($q) use ($userId) {
                $q->where('user_id', $userId);
            });
        }
        // Jika superadmin: tidak difilter berdasarkan universitas/user_id (mengambil semua data)

        $data = $query->orderBy('created_at', 'DESC')->get();

        // Fallback untuk pelapor jika data lama belum terisi user_id
        if ($user && $user->level == 'pelapor' && $data->isEmpty()) {
            $userEmail = $user->email;
            $data = ModelsLaporan::whereBetween('created_at', [$this->mulai, $this->akhir])->get()->filter(function ($item) use ($userEmail) {
                try {
                    return strtolower(trim(\Illuminate\Support\Facades\Crypt::decryptString($item->email))) === strtolower(trim($userEmail));
                } catch (\Exception $e) {
                    return false;
                }
            });
        }

        return view('Admin.export.laporan', [
            'laporan' => $data,
            'mulai' => $this->mulai,
            'akhir' => $this->akhir,
        ]);
    }
}
