<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    public $table = "laporan";
    protected $guarded = [];
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Relasi One-to-Many: Satu laporan memiliki banyak log
     */
    public function logs()
    {
        return $this->hasMany(LaporanLog::class, 'kode_laporan', 'kode_laporan');
    }

   public function universitasRel()
    {
        return $this->belongsTo(Universitas::class, 'universitas', 'id');
    }

    public function identitasRel()
    {
        return $this->belongsTo(DokumenIdentitas::class, 'jenis_identitas', 'id');
    }
}


