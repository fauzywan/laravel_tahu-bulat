<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buat_produk extends Model
{
    protected $table = 'buat_produk';
    protected $guarded = [];
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
    public function pemakaian()
    {
        return $this->hasMany(Pemakaian::class);
    }
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
    public function sesi()
    {
        return $this->belongsTo(sesi::class);
    }
    public function sesi_karyawan()
    {
        return $this->hasMany(sesi_karyawan::class);
    }
    public function sesi_produk()
    {
        return $this->belongsTo(sesi_produk::class);
    }
}
