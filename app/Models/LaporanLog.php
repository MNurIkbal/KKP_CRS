<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanLog extends Model
{
    public $table = "laporan_log";
    protected $guarded = [];
     protected $casts = [
        'tgl_batas_proses' => 'datetime',
    ];

     /**
     * Relasi BelongsTo: Setiap log milik satu laporan
     */
    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'kode_laporan', 'kode_laporan');
    }
}


