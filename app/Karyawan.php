<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Karyawan extends Model
{
    protected $table = 'karyawan';
    protected $guarded = [];
public function potongan_gaji()
{
    return $this->hasMany(Potongan_gaji::class);
}

    public function posisi()
    {

        return $this->belongsTo(Posisi::class);
    }
    public function buat_produk()
    {
        return $this->hasMany(Buat_produk::class);
    }
    public function absen()
    {
        return $this->hasMany(absen::class);
    }
    public function pemakaian()
    {
        return $this->hasMany(Pemakaian::class);
    }
    public function sesi_karyawan()
    {
        return $this->hasMany(sesi_karyawan::class);
    }
    public function peminjaman()
    {
        return $this->hasMany(peminjaman::class);
    }
    public function balo()
    {
        return 1;
    }
    public function potongan($tanggal)
    {
        return 0;
    }
    public function adonan($id)
    {

    }
    public function gaji_filter($tanggals)
    {
        return $this->sesi_karyawan->where('created_at','>=',$tanggals->mulai)->where('created_at','<=',$tanggals->tutup);
        
    }

    public function total_gaji($tanggal)
    {
        $dibuat= $this->gaji_filter($tanggal)->sum('dibuat');
        return number_format($dibuat / 740, 2) * 25000;
    }
    public function gaji_bersih($dibuat)
    {
        return $this->total_gaji($dibuat) - $this->potongan($dibuat);
    }
}
