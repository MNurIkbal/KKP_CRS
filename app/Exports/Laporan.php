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
        $data = ModelsLaporan::whereBetween('created_at', [$this->mulai, $this->akhir])->get();

        return view('Admin.export.laporan', [
            'laporan' => $data,
            'mulai' => $this->mulai,
            'akhir' => $this->akhir,
        ]);
    }
}
