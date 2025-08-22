<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenIdentitas extends Model
{
    public $table = "dokumen_identitas";
    protected $guarded = [];
     public $timestamps = false;

    public function laporans()
    {
        return $this->hasMany(Laporan::class, 'jenis_identitas', 'id');
    }
}


