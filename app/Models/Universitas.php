<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Universitas extends Model
{
    public $table = "universitas";
    protected $guarded = [];
    // public $timestamps = false;

    public function laporans()
    {
        return $this->hasMany(Laporan::class, 'universitas', 'id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'universitas_id', 'id');
    }
}


