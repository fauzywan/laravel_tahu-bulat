<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemakaian extends Model
{
    protected $table = "pemakaian";
    protected $guarded = [];
    public function buat_produk()
    {
        return $this->belongsTo(Buat_produk::class);
    }
    public function biaya_produksi()
    {
        return $this->belongsTo(Biaya_produksi::class);
    }
    public function sesi()
    {
        return $this->belongsTo(sesi::class);
    }
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function belanja()
    {
        return $this->belongsTo(Belanja::class);
    }
}
